<template>
  <v-card class="card--flex-toolbar">
    <v-toolbar card color="white" prominent>
      <v-toolbar-title class="body-2 grey--text hidden-xs-only">Administración del Conocimiento</v-toolbar-title>
      <v-spacer></v-spacer>
      <div class="mr-4 text-xs-center" v-if="!view()">
        <v-btn @click.native="next">Siguiente</v-btn>
        <v-btn  :disabled="this.tabs.indexOf(this.active) +1 != this.tabs.length && !allow" @click.native="save">Guardar</v-btn>
      </div>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text>
      <div >
        <div v-if="!questionnaire_completed">
          <v-tabs dark grow v-model="active">
            <v-tabs-bar color="blue darken-2">
              <v-tabs-item v-for="section in range" v-if="section.active" :key="section.section" :href="'#' + section.section" ripple>
                <span class="caption"> {{ section.section }} </span>
              </v-tabs-item>
              <v-tabs-slider color="yellow"></v-tabs-slider>
            </v-tabs-bar>
            <v-tabs-items>
              <v-form>
                <v-tabs-content v-for="section in range" v-if="section.active" :key="section.section" :id="section.section">
                  <v-container fluid>
                    <v-card flat>
                      <v-card-text>
                        <div v-for="(question,index) in section.questions">
                          <div v-if="question.type == 'text' || question.type == 'textarea'" class="flex sm6 offset-sm3">
                            <div v-if="!view()">
                              <v-text-field
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :counter="question.type == 'textarea' ? 400 : 100"
                              v-validate="ch_validate2(question.restrictions, question.required)"
                              :value = "question.answer"
                              @input="value => { question.answer = value }"
                              :data-vv-name="question.statement"
                              :data-vv-scope="slugify(section.section)"
                              :error-messages="vee_errors.collect(question.statement)"
                              :required = "question.required"
                              :multi-line = "question.type == 'textarea'"
                              ></v-text-field>
                            </div>
                            <div v-else>
                              <v-text-field
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :value = "question.answer"
                              :multi-line = "question.type == 'textarea'"
                              readonly
                              ></v-text-field>
                            </div>
                          </div>
                          <div v-if="question.type == 'select'" class="flex sm6 offset-sm3">
                            <div v-if="!view()">
                              <v-select
                              v-bind:items="question.options"
                              :v-model="slugify(question.statement)"
                              :label="question.statement"
                              v-validate="ch_validate2(question.restrictions, question.required)"
                              :value = "question.answer"
                              @input="value => { question.answer = value }"
                              :data-vv-name="slugify(question.statement)"
                              :data-vv-scope="slugify(section.section)"
                              :error-messages="vee_errors.collect(slugify(question.statement))"
                              single-line
                              :required = "question.required"
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
                          <div v-if="question.type == 'number'"  class="flex sm6 offset-sm3">
                            <div v-if="!view()">
                              <v-text-field
                              type="number"
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              v-validate="ch_validate2(question.restrictions, question.required)"
                              :value = "question.answer"
                              :data-vv-name="slugify(question.statement)"
                              :data-vv-scope="slugify(section.section)"
                              :error-messages="vee_errors.collect(slugify(question.statement))"
                              @input="value => { question.answer = value }"
                              :required = "question.required"
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
                          <div v-if="question.type == 'date'" class="flex sm6 offset-sm3 mt-2">
                            <div v-if="!view()">
                                <v-menu
                                lazy
                                :close-on-content-click="false"
                                :v-model="cat(slugify(question.statement),'-menu')"
                                transition="scale-transition"
                                offset-y
                                full-width
                                :nudge-right="40"
                                max-width="290px"
                                min-width="290px"
                                >
                                <v-text-field
                                slot="activator"
                                :label="question.statement"
                                :data-vv-name="slugify(question.statement)"
                                :data-vv-scope="slugify(section.section)"
                                data-vv-delay="10"
                                v-validate="ch_validate2(question.restrictions, question.required)"
                                :error-messages="vee_errors.collect(slugify(question.statement))"
                                v-model="dateFormatted"
                                @blur="fecha_nacimiento = parseDate(dateFormatted)"
                                @imput="value => { question.answer = value }"
                                :value = "question.answer"
                                prepend-icon="event"
                                :required = "question.required"
                                ></v-text-field>
                                <v-date-picker v-model="fecha_nacimiento"
                                  @input="dateFormatted = formatDate($event); question.answer = formatDate($event)"
                                  no-title scrollable actions>
                                  <template slot-scope="{ save, cancel }">
                                    <v-card-actions>
                                      <v-spacer></v-spacer>
                                      <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
                                      <v-btn flat color="primary" @click="save">OK</v-btn>
                                    </v-card-actions>
                                  </template>
                                </v-date-picker>
                              </v-menu>
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
                          <div v-if="question.type == 'table'" class="mb-4 mt-4">
                            <label class="mb-2 mt-2">
                              {{question.statement}}
                            </label>
                            <div class="table__overflow elevation-1 mb-4 mt-4">
                              <table class="datatable table bordered">
                                <tbody>
                                  <tr v-for="(file, index_fil) in question.files">
                                    <td v-for="(column,index_col) in file.columns">
                                      <div v-if="column.editable">
                                        <div v-if="!view()">
                                          <v-text-field
                                          :label="column.value"
                                          :data-vv-name="cat(section.section , cat(String(index),cat(String(index_fil),String(index_col))))"
                                          :data-vv-scope="slugify(section.section)"
                                          v-validate="ch_validate2(column.restrictions, column.required)"
                                          :error-messages="vee_errors.collect(cat(section.section , cat(String(index),cat(String(index_fil),String(index_col)))))"
                                          :value = "column.answer"
                                          @input="value => { column.answer = value }"
                                          :required = "column.required"
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
                                      <div v-else>
                                        <span>{{column.value}}</span>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div v-if="question.type == 'multiquestion'" class="mb-4 mt-4">
                            <div v-for="(sub_question, sub_index) in question.questions">
                              <div v-if="sub_question.type == 'table'">
                                <label class="mb-4 mt-4">
                                  {{sub_question.statement}}
                                </label>
                                <div class="table__overflow elevation-1 mb-4 mt-4">
                                  <table class="datatable table bordered">
                                    <tbody>
                                      <tr v-for="(file, index_fil) in sub_question.files">
                                        <td v-for="(column,index_col) in file.columns">
                                          <div v-if="column.editable">
                                            <div v-if="!view()">
                                              <v-text-field
                                              :label="column.value"
                                              :data-vv-name="cat(section.section , cat(String(index),cat(String(sub_index),cat(String(index_fil),String(index_col)))))"
                                              :data-vv-scope="slugify(section.section)"
                                              v-validate="ch_validate2(column.restrictions, column.required)"
                                              :error-messages="vee_errors.collect(cat(section.section , cat(String(index),cat(String(sub_index),cat(String(index_fil),String(index_col))))))"
                                              :value = "column.answer"
                                              @input="value => { column.answer = value }"
                                              :required = "column.required"
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
<style media="screen">
  table.bordered tbody tr{
    border: 1px solid black;
  }
  table.bordered tbody tr td{
    border: 1px solid black;
  }
</style>

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
        name: '',
        fecha_nacimiento : '1990-01-01',
        dateFormatted: null
      }
    },
    created: function(){
      for (var counter in this.range) {
        this.tabs.push(this.range[counter].section);
      }
    },
    methods: {
      parseDate (date) {
        if (!date) {
          return null
        }
        const [day, month, year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },
      formatDate (date) {
        if (!date) {
          return null
        }

        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year}`
      },
      cat(text1, text2){
        return text1.concat(text2)
      },
      ch_validate2(restrictions, required = false){
        var custom_validate = ''
        if(restrictions.key == "None"){
          //
        }else if(restrictions.key == "DNI"){
          custom_validate = 'digits:8'
        }
        else if(restrictions.key == "Age"){
          custom_validate = 'between:15,99'
        }
        else if(restrictions.key == "Phone"){
          custom_validate = 'digits:7'
        }
        else if(restrictions.key == "Celular"){
          custom_validate = 'digits:9'
        }
        else if(restrictions.key == "vigesimal"){
          custom_validate = 'between:0,20'
        }
        else if(restrictions.key == "Email"){
          custom_validate = 'email'
        }
        // else if(restrictions.key == "Date"){
        //   custom_validate = 'email'
        // }
        return  required ? 'required'+ '|' + custom_validate : custom_validate


      },
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
        const vue = this;
        console.log(vue.range);
        vue.$validator.validateAll(vue.slugify(vue.active)).then((result) => {
          if (result) {
            vue.active = vue.tabs[(vue.tabs.indexOf(vue.active) + 1) % vue.tabs.length]
            if(vue.tabs.indexOf(vue.active) +1 == vue.tabs.length){
              vue.allow = true;
            }
          }
        });
      },
      save () {
        this.$validator.validateAll();
        console.log(this.slugify('E-mail'));
        console.log(this.vee_errors.items['length']);

        if(this.vee_errors.items['length'] == 0){
          console.log("valido");
          const vm = this;
          axios.post(this.saveLink, {
              csrf_token: vm.csrfToken,
              token: window.location.pathname.split("/").pop(),
              data: JSON.stringify(this.range)
          })
          .then(function (response) {
            vm.questionnaire_completed = true
          })
          .catch(function (error) {
            console.log(error)
          })

        }else{
          // this.active = this.tabs[0]
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
      saveLink: String,
      csrfToken: String
    },
    mounted: function() {

      console.log(this.vee_errors);
      console.log('mounted');
    }
  }
</script>
