<template>
  <v-card class="card--flex-toolbar">
    <v-toolbar card color="white" prominent>
      <v-toolbar-title class="body-2 grey--text">Administración del Conocimiento</v-toolbar-title>
      <v-spacer></v-spacer>
      <div class="mr-4" v-if="!view()">
        <v-btn @click.native="next">Siguiente</v-btn>
        <v-btn  :disabled="this.tabs.indexOf(this.active) +1 != this.tabs.length && !allow" @click.native="save">Guardar</v-btn>
      </div>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text>
      <div class="container">
        <div v-if="!questionnaire_completed">
          <v-tabs dark grow v-model="active">
            <v-tabs-bar class="cyan">
              <v-tabs-item v-for="section in range" :key="section.section" :href="'#' + section.section" ripple>
                <span class="caption"> {{ section.section }} </span>
              </v-tabs-item>
              <v-tabs-slider color="yellow"></v-tabs-slider>
            </v-tabs-bar>
            <v-tabs-items>
              <v-form>
                <v-tabs-content v-for="section in range" :key="section.section" :id="section.section">
                  <v-container fluid>
                    <v-card flat>
                      <v-card-text>
                        <div v-for="question in section.questions">

                          <div v-if="question.type == 'text'">
                            <div v-if="!view()">
                              <div v-if="question.required">
                                <v-text-field
                                :label="question.statement"
                                :v-model="slugify(question.statement)"
                                :counter="100"
                                :readonly="view()"
                                v-validate="'required'"
                                :value = "question.answer"
                                @input="value => { question.answer = value }"
                                :data-vv-name="slugify(question.statement)"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                required
                                ></v-text-field>
                              </div>
                              <div v-else>
                                <v-text-field
                                :label="question.statement"
                                :v-model="slugify(question.statement)"
                                :counter="100"
                                :value = "[view() ? (question.answer == ''? '-' : question.answer) : '']"
                                :readonly="view()"
                                @input="value => { question.answer = value }"
                                ></v-text-field>
                              </div>
                            </div>
                            <div v-else>
                              <v-text-field
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :value = "question.answer"
                              readonly
                              ></v-text-field>
                            </div>
                          </div>
                          <div v-if="question.type == 'select'">
                            <div v-if="!view()">
                              <div v-if="question.required">
                                <v-select
                                v-bind:items="question.options"
                                :v-model="slugify(question.statement)"
                                :label="question.statement"
                                v-validate="'required'"
                                :value = "question.answer"
                                @input="value => { question.answer = value }"
                                :data-vv-name="slugify(question.statement)"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                single-line
                                required
                                bottom
                                ></v-select>
                              </div>
                              <div v-else>
                                <v-select
                                v-bind:items="question.options"
                                :v-model="slugify(question.statement)"
                                :label="question.statement"
                                @input="value => { question.answer = value }"
                                single-line
                                bottom
                                ></v-select>
                              </div>
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
                              <div v-if="question.required">
                                <v-text-field
                                type="number"
                                :label="question.statement"
                                :v-model="slugify(question.statement)"
                                v-validate="'required'"
                                :value = "question.answer"
                                :data-vv-name="slugify(question.statement)"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                @input="value => { question.answer = value }"
                                required
                                ></v-text-field>
                              </div>
                              <div v-else>
                                <v-text-field
                                type="number"
                                :label="question.statement"
                                :value = "question.answer"
                                :v-model="slugify(question.statement)"
                                @input="value => { question.answer = value }"
                                ></v-text-field>
                              </div>
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
                              <div v-if="question.required">
                                <v-text-field
                                type="email"
                                :label="question.statement"
                                :v-model="slugify(question.statement)"
                                :value = "question.answer"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                v-validate="'required|email'"
                                :data-vv-name="slugify(question.statement)"
                                @input="value => { question.answer = value }"
                                required
                                ></v-text-field>
                              </div>
                              <div v-else>
                                <v-text-field
                                type="email"
                                :label="question.statement"
                                :v-model="slugify(question.statement)"
                                :value = "question.answer"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                v-validate="'email'"
                                :data-vv-name="slugify(question.statement)"
                                @input="value => { question.answer = value }"
                                ></v-text-field>
                              </div>
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
                            <div v-if="question.required">
                              <v-text-field
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :counter="100"
                              :value = "[view() ? (question.answer == ''? '-' : question.answer) : '']"
                              v-validate="'required'"
                              :data-vv-name="slugify(question.statement)"
                              :error-messages="vee_errors.collect(slugify(question.statement))"
                              :readonly="view()"
                              @input="value => { question.answer = value }"
                              multi-line
                              required
                              ></v-text-field>

                            </div>
                            <div v-else>
                              <v-text-field
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :counter="100"
                              :value = "[view() ? (question.answer == ''? '-' : question.answer) : '']"
                              :readonly="view()"
                              @input="value => { question.answer = value }"
                              multi-line
                              ></v-text-field>
                            </div>
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
                                        :required = "question.required"
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
                                            :required = "question.required"
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
              </v-form>
            </v-tabs-items>
          </v-tabs>
        </div>
        <div v-else>
          Gracias por llenar el cuestionario.
        </div>
      </div>
    </v-card-text>
  </v-card>

</template>

<script>
  export default {
    $validator: true,
    data () {
      return {
        questionnaire_completed: false,
        allow: false,
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
      slugify(string) {
        return string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
      },
      next () {
        this.active = this.tabs[(this.tabs.indexOf(this.active) + 1) % this.tabs.length]
        if(this.tabs.indexOf(this.active) +1 == this.tabs.length){
          this.allow = true;
        }
      },
      save () {
        this.$validator.validateAll();
        console.log(this.slugify('E-mail'));
        console.log(this.vee_errors.items['length']);

        if(this.vee_errors.items['length'] == 0){
          console.log("valido");
          const vm = this;
          axios.get(this.saveLink, {
            params:{
              token: window.location.pathname.split("/").pop(),
              data: JSON.stringify(this.range)
            }
          })
          .then(function (response) {
            vm.questionnaire_completed = true
          })
          .catch(function (error) {
            console.log(error)
          })

        }else{
          this.active = this.tabs[0]
          console.log("no valido");
        }
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
      functionForm: String,
      saveLink: String
    },
    mounted: function() {

      console.log(this.vee_errors);
      console.log('mounted');
    }
  }
</script>
