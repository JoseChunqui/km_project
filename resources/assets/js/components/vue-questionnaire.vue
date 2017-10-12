<template>
  <v-app id="inspire">
    <div class="container">
      <v-tabs dark grow v-model="active">
        <v-tabs-bar class="cyan">
          <v-tabs-item v-for="section in range" :key="section.section" :href="'#' + section.section" ripple>
            <span class="caption"> {{ section.section }} </span>
          </v-tabs-item>
          <v-tabs-slider color="yellow"></v-tabs-slider>
        </v-tabs-bar>
        <v-tabs-items>
          <v-tabs-content v-for="section in range" :key="section.section" :id="section.section">
            <v-container fluid>
              <v-card flat>
                <v-card-text>
                  <div v-for="question in section.questions">
                    <div v-if="question.type == 'text'">
                      <v-text-field
                      :label="question.statement"
                      :v-model="question.statement"
                      :counter="100"
                      :value = "[view() ? (question.answer == ''? '-' : question.answer) : '']"
                      :readonly="view()"
                      @input="value => { question.answer = value }"
                      required
                      ></v-text-field>
                    </div>
                    <div v-if="question.type == 'select'">
                      <div v-if="!view()">
                        <v-select
                        v-bind:items="question.options"
                        :v-model="question.statement"
                        :label="question.statement"
                        @input="value => { question.answer = value }"
                        single-line
                        bottom
                        ></v-select>
                      </div>
                      <div v-else>
                        <v-text-field
                        type="text"
                        :label="question.statement"
                        :value = "question.answer == ''? '-' : question.answer"
                        readonly
                        ></v-text-field>
                      </div>
                    </div>
                    <div v-if="question.type == 'number'">
                      <div v-if="!view()">
                        <v-text-field
                        type="number"
                        :label="question.statement"
                        @input="value => { question.answer = value }"
                        required
                        ></v-text-field>
                      </div>
                      <div v-else>
                        <v-text-field
                        type="text"
                        :label="question.statement"
                        :value = "question.answer == ''? '-' : question.answer"
                        readonly
                        ></v-text-field>
                      </div>
                    </div>
                    <div v-if="question.type == 'e-mail'">
                      <div v-if="!view()">
                        <v-text-field
                        type="email"
                        :label="question.statement"
                        @input="value => { question.answer = value }"
                        required
                        ></v-text-field>
                      </div>
                      <div v-else>
                        <v-text-field
                        type="text"
                        :label="question.statement"
                        :value = "question.answer == ''? '-' : question.answer"
                        readonly
                        ></v-text-field>
                      </div>
                    </div>
                    <div v-if="question.type == 'textarea'">
                      <v-text-field
                      :label="question.statement"
                      :v-model="question.statement"
                      :counter="100"
                      :value = "[view() ? (question.answer == ''? '-' : question.answer) : '']"
                      :readonly="view()"
                      @input="value => { question.answer = value }"
                      multi-line
                      required
                      ></v-text-field>
                    </div>
                    <div v-if="question.type == 'table'">
                      <label>
                        {{question.statement}}
                      </label>
                      <div class="table__overflow elevation-10">
                        <table class="datatable table">
                          <tbody>
                            <tr v-for="file in question.files">
                              <td v-for="column in file.columns">
                                <div v-if="column.editable">
                                  <v-text-field
                                  :label="column.value"
                                  :value = "[view() ?  column.answer : '']"
                                  :readonly="view()"
                                  @input="value => { column.answer = value }"
                                  ></v-text-field>
                                </div>
                                <div v-else>
                                  <span>{{column.value}}</span>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div v-if="question.type == 'multiquestion'">
                      <div v-for="sub_question in question.questions">
                        <div v-if="sub_question.type == 'table'">
                          <label>
                            {{sub_question.statement}}
                          </label>
                          <div class="table__overflow elevation-10">
                            <table class="datatable table">
                              <tbody>
                                <tr v-for="file in sub_question.files">
                                  <td v-for="column in file.columns">
                                    <div v-if="column.editable">
                                      <v-text-field
                                      :label="column.value"
                                      :value = "[view() ?  column.answer : '']"
                                      :readonly="view()"
                                      @input="value => { column.answer = value }"
                                      ></v-text-field>
                                    </div>
                                    <div v-else>
                                      <span>{{column.value}}</span>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </v-card-text>
              </v-card>
            </v-container>
          </v-tabs-content>
        </v-tabs-items>
      </v-tabs>

      <div class="text-xs-center mt-3">
        <v-btn @click.native="next">next tab</v-btn>
      </div>
      <div class="text-xs-center mt-3">
        <v-btn @click.native="save">Save</v-btn>
      </div>
    </div>
  </v-app>
</template>

<script>
  // import { validationMixin } from 'vuelidate'
  // import { required, maxLength, email } from 'vuelidate/lib/validators'
  export default {
    // mixins: [validationMixin],
    // validations: {
    //   name: { required, maxLength: maxLength(10) },
    //   email: { required, email },
    //   select: { required },
    //   checkbox: { required }
    // },
    data () {
      return {
        range: this.dataRange,
        visualization: this.functionForm,
        tabs:[],
        active: null,
        name: ''
      }
    },
    created: function(){
      for (var counter in this.range) {
        this.tabs.push(this.range[counter].section);
      }
    },
    methods: {
      next () {
        this.active = this.tabs[(this.tabs.indexOf(this.active) + 1) % this.tabs.length]
      },
      save () {
        axios.get('/questionnaire_save', {
          params:{
            token: window.location.pathname.split("/").pop(),
            data: JSON.stringify(this.range)
          }
        })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      view () {
        if(this.visualization == 'show'){
          return true;
        }else{
          return false;
        }
      }
    },
    props: {
      dataRange : Array,
      functionForm: String
    },
    mounted: function() {
      console.log('mounted');
    }
  }
</script>
