<template>
  <v-card class="card--flex-toolbar">

    <v-snackbar
      :timeout = "Number(1500)"
      color="error"
      top
      v-model="v_alert"
      >
      Faltan llenar o corregir algunos campos en esta sección
      <!-- <v-btn dark flat @click.native="v_alert = false">Cerrar</v-btn> -->
    </v-snackbar>

    <div role="notifications">
      <notifications group="success" position="top center"/>
      <notifications group="error" position="top center"/>
    </div>

    <v-toolbar card color="white" prominent class="text-xs-center">
      <v-toolbar-title class="body-2 grey--text hidden-md-and-down">Administración del Conocimiento</v-toolbar-title>
      <v-spacer class="hidden-md-and-down"></v-spacer>
      <v-flex class="mr-0 text-lg-right" v-if="!view()">
        <v-btn v-if="!this.questionnaire_completed" @click.native="previus" :disabled="! previus_allow">Anterior</v-btn>
        <v-btn v-if="!this.questionnaire_completed" @click.native="next" :disabled="! next_allow">Siguiente</v-btn>
        <v-btn v-if="!this.questionnaire_completed" :disabled="this.tabs.indexOf(this.active) +1 != this.tabs.length" @click.native="save">Finalizar</v-btn>
      </v-flex>
      <div class="mr-4 hidden-md-and-down">
      </div>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text>
      <div >
        <div v-if="!questionnaire_completed">
          <v-tabs dark grow v-model="active">
            <v-tabs-bar class="hidden-md-and-down">
              <v-tabs-item activeClass="blue darken-2" class="light-blue darken-1" v-for="section in range" v-if="section.active" :key="section.section" :href="'#' + section.section" ripple :disabled="!view()" >
              <!-- <v-tabs-item activeClass="blue darken-2" class="light-blue darken-1" v-for="section in range" v-if="section.active" :key="section.section" :href="'#' + section.section" ripple> -->
                <span class="caption diabled-text-white"> {{ section.section }} </span>
              </v-tabs-item>
              <v-tabs-slider color="yellow"></v-tabs-slider>
            </v-tabs-bar>
            <div class="hidden-lg-and-up text-xs-center">
              <div class="title">
                {{active}}
              </div>
              <div class="">
                {{progress_tab}}
              </div>
            </div>
            <v-tabs-items touchless>
              <v-form>
                <v-tabs-content v-for="(section, index_sec) in range" v-if="section.active" :key="section.section" :id="section.section">
                  <v-container fluid>
                    <v-card flat>
                      <v-card-text>
                        <div v-for="(question,index) in section.questions">
                          <div v-if="question.type == 'text' || question.type == 'textarea' || question.type == 'number'" :class="{'flex sm6 offset-sm3': question.statement !== '¿Qué expectativas tiene del curso?'}">
                            <div v-if="!view()">
                              <v-text-field
                              :type="question.type == 'number' ? 'number' : 'text'"
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              :counter="question.type == 'textarea' ? 400 : (question.type == 'text' ? 100 : '')"
                              v-validate="ch_validate2(question.restrictions, question.required)"
                              :value = "question.answer"
                              @blur="value => { question.answer = value }"
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
                              @blur="value => { question.answer = value }"
                              :data-vv-name="question.statement"
                              :data-vv-scope="slugify(section.section)"
                              :error-messages="vee_errors.collect(question.statement)"
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
                          <!-- <div v-if="question.type == 'number'"  class="flex sm6 offset-sm3">
                            <div v-if="!view()">
                              <v-text-field
                              :type="question.type"
                              :label="question.statement"
                              :v-model="slugify(question.statement)"
                              v-validate="ch_validate2(question.restrictions, question.required)"
                              :value = "question.answer"
                              :data-vv-name="question.statement"
                              :data-vv-scope="slugify(section.section)"
                              :error-messages="vee_errors.collect(question.statement)"
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
                          </div> -->
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
                                :data-vv-name="question.statement"
                                :data-vv-scope="slugify(section.section)"
                                data-vv-delay="10"
                                v-validate="ch_validate2(question.restrictions, question.required)"
                                :error-messages="vee_errors.collect(question.statement)"
                                v-model="dateFormatted"
                                @blur="fecha_nacimiento = parseDate(dateFormatted); value => { question.answer = value }"
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
                            <span class="caption mb-2 hidden-sm-and-up">(Deslícese hacia la derecha en la tabla)</span>
                            <div class="table__overflow elevation-1 mb-4 mt-4">
                              <table class="datatable table bordered">
                                <tbody>
                                  <tr v-for="(file, index_fil) in question.files">
                                    <td v-for="(column,index_col) in file.columns">
                                      <div v-if="column.editable">
                                        <div v-if="!view()">
                                          <div v-if="column.type == 'Date'">
                                            <v-menu
                                            lazy
                                            :close-on-content-click="false"
                                            transition="scale-transition"
                                            offset-y
                                            full-width
                                            :nudge-right="40"
                                            max-width="290px"
                                            min-width="290px"
                                            :disabled="file.disabled"
                                            >
                                            <v-text-field
                                            slot="activator"
                                            :ref="vv_name_cell(index_sec,index,index_fil,index_col)"
                                            :value = "column.answer"
                                            @blur="$set(column,'answer', $event)"
                                            :data-vv-as="truncate_string(question.files[0].columns[index_col].value,25)"
                                            :data-vv-name="vv_name_cell(index_sec,index,index_fil,index_col)"
                                            :name="vv_name_cell(index_sec,index,index_fil,index_col)"
                                            :data-vv-scope="slugify(section.section)"
                                            v-validate="ch_validate2(column.restrictions, column.required, vv_name_cell(index_sec,index,index_fil,index_col))"
                                            :error-messages="vee_errors.collect(vv_name_cell(index_sec,index,index_fil,index_col))"
                                            :data-vv-value-path="column.answer"
                                            data-vv-delay="1000"
                                            prepend-icon="event"
                                            :disabled="file.disabled"
                                            ></v-text-field>
                                            <v-date-picker
                                              @input="$set(column,'answer', formatDate($event));removeError(vv_name_cell(index_sec,index,index_fil,index_col));"
                                              :value="parseDate(column.answer)"
                                              no-title scrollable actions
                                              >
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
                                          <div v-else-if="column.type == 'text' || column.type == 'textarea' || column.type == 'number'">
                                            <v-text-field
                                            :type="column.type == 'number' ? 'number' : 'text'"
                                            :label="column.value"
                                            :data-vv-as="truncate_string(question.files[0].columns[index_col].value, 25) + ' ' + truncate_string(file.columns[0].value,25)"
                                            :data-vv-name="vv_name_cell(index_sec,index,index_fil,index_col)"
                                            :data-vv-scope="slugify(section.section)"
                                            v-validate="ch_validate2(column.restrictions, column.required)"
                                            :error-messages="vee_errors.collect(vv_name_cell(index_sec,index,index_fil,index_col))"
                                            :value = "column.answer"
                                            @blur="value => { column.answer = value }"
                                            :required = "column.required"
                                            :disabled="file.disabled"
                                            ></v-text-field>
                                          </div>
                                          <div class="text-xs-center" v-else-if="column.type == 'toogle'">
                                            <v-btn
                                              :class="{'blue-grey darken-1' : !file.disabled, 'light-green lighten-2' : file.disabled }"
                                              :dark = "check_row_in_table(file)"
                                              small
                                              @click.native = "disable_file_table(file,slugify(section.section))"
                                              :disabled = "!check_row_in_table(file)"
                                              >
                                              {{!file.disabled ? (check_row_in_table(file) ? column.value : 'Realizada') : 'Activar'}}
                                            </v-btn>
                                          </div>
                                          <div v-else-if="column.type == 'select'">
                                            <v-select
                                            v-bind:items="column.options"
                                            :label="column.value"
                                            v-validate="ch_validate2(column.restrictions, column.required)"
                                            :value = "column.answer"
                                            @blur="value => { column.answer = value }"
                                            :data-vv-as="truncate_string(question.files[0].columns[index_col].value, 25) + ' ' + truncate_string(file.columns[0].value,25)"
                                            :data-vv-name="vv_name_cell(index_sec,index,index_fil,index_col)"
                                            :data-vv-scope="slugify(section.section)"
                                            :error-messages = "vee_errors.collect(vv_name_cell(index_sec,index,index_fil,index_col))"
                                            single-line
                                            bottom
                                            ></v-select>
                                          </div>
                                        </div>
                                        <div v-else>
                                          <v-text-field
                                          type="text"
                                          :value = "column.answer == ''? '-' : column.answer"
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
                          <!-- <div v-if="question.type == 'multiquestion'" class="mb-4 mt-4">
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
                                              <div v-if="column.type == 'Date'">
                                                <v-menu
                                                lazy
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                :nudge-right="40"
                                                max-width="290px"
                                                min-width="290px"
                                                >
                                                <v-text-field
                                                slot="activator"
                                                :value = "column.answer"
                                                @input="$set(column,'answer', $event)"
                                                :data-vv-as="truncate_string(sub_question.files[0].columns[index_col].value,40)"
                                                :data-vv-name="vv_name_cell(index_sec,index,index_fil,index_col,sub_index)"
                                                :data-vv-scope="slugify(section.section)"
                                                v-validate="ch_validate2(column.restrictions, column.required, vv_name_cell(index_sec,index,index_fil,index_col,sub_index))"
                                                :error-messages="vee_errors.collect(vv_name_cell(index_sec,index,index_fil,index_col,sub_index))"
                                                :data-vv-value-path="column.answer"
                                                data-vv-delay="1000"
                                                prepend-icon="event"
                                                :disabled="file.disabled"
                                                ></v-text-field>
                                                <v-date-picker
                                                  @input="$set(column,'answer', formatDate($event));removeError(vv_name_cell(index_sec,index,index_fil,index_col,sub_index))"
                                                  :value="parseDate(column.answer)"
                                                  no-title scrollable actions
                                                  >
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
                                              <div v-else-if="column.type == 'text' || column.type == 'textarea' || column.type == 'number'">
                                                <v-text-field
                                                :label="column.value"
                                                style="font-size:12px;"
                                                :type="column.type == 'number' ? 'number' : 'text'"
                                                :data-vv-as="truncate_string(sub_question.files[0].columns[index_col].value, 40) + ' ' + truncate_string(file.columns[0].value, 40)"
                                                :data-vv-name="vv_name_cell(index_sec,index,index_fil,index_col,sub_index)"
                                                :data-vv-scope="slugify(section.section)"
                                                v-validate="ch_validate2(column.restrictions, column.required)"
                                                :error-messages="vee_errors.collect(vv_name_cell(index_sec,index,index_fil,index_col,sub_index))"
                                                :value = "column.answer"
                                                @input="value => { column.answer = value }"
                                                :disabled="file.disabled"
                                                ></v-text-field>
                                              </div>
                                            </div>
                                            <div v-else>
                                              <v-text-field
                                              type="text"
                                              :value = "column.answer == ''? '-' : column.answer"
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
                          </div> -->
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
          Gracias por llenar el cuestionario
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
        range: this.dataRange,
        visualization: this.functionForm,
        tabs:[],
        active: null,
        name: '',
        fecha_nacimiento : '1990-01-01',
        dateFormatted: null,
        previus_allow : false,
        next_allow : true,
        v_alert : false
      }
    },
    created: function(){
      for (var counter in this.range) {
        this.tabs.push(this.range[counter].section);
      }
    },
    computed: {
      progress_tab : function() {
        return String(this.tabs.indexOf(this.active) + 1) + ' de ' + String(this.tabs.length)
      }
    },
    watch :{
      active : function (){
        const vue = this;

        if(vue.tabs.indexOf(vue.active) == 0){
          this.previus_allow = false;
        }else{
          this.previus_allow = true;
        }

        if(vue.tabs.indexOf(vue.active) + 1 == vue.tabs.length){
          vue.next_allow = false;
        }else{
          vue.next_allow = true;
        }
      }
    },
    methods: {
      check_row_in_table(file){
        var to_be_returned = true;
        for (var counter_i in file.columns){
          if(file.columns[counter_i].answer !== ""){
            to_be_returned = false;
          }
        }
        return to_be_returned;
      },

      truncate_string(string, max_lenght = 25){
        var to_be_returned = string;
        if(string.length > max_lenght){
          to_be_returned = string.substring(0,max_lenght) + '...';
        }
        // console.log(to_be_returned);
        return to_be_returned ;
      },
      vv_name_cell(index_sec,index_question, index_fil, index_col, index_subquestion = null){
        var sub_return = ''
        sub_return = 'celda-' + String(index_sec) + String(index_question) + String(index_fil) + String(index_col);
        if(index_subquestion){
          sub_return = sub_return + String(index_subquestion);
        }
        return sub_return;
      },
      disable_file_table(file, section){
        this.$set(file,'disabled',!file.disabled);
        for (var counter_i in file.columns){
          this.$set(file.columns[counter_i],'answer','');
        }
        if(section){
          this.vee_errors.clear(section)
        }
      },

      removeError(field = null){
        if(field){
          this.$refs[field][0].focus();

        }else{
          this.vee_errors.clear()
        }
      },

      parseDate (date) {
        if (!date) {
          return null
        }else{
          if(date.split('/').length < 3){
            return null
          }else{
            const [day, month, year] = date.split('/')
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
          }
        }
      },
      formatDate (date) {
        if (!date) {
          return null
        }
        this.vee_errors.clear();
        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year}`
      },
      cat(text1, text2){
        return text1.concat(text2)
      },
      ch_validate2(restrictions, required = false, self = null){
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
        else if(restrictions.key == "Date"){
          custom_validate = 'date_format:DD/MM/YYYY'
          if(restrictions.value == 'after:previus'){
            if(self){
              var current_target = 'celda-'+(self.split('celda-')[1] - 1);
              custom_validate = custom_validate + '|' + 'after:' + (String(current_target))
            }
          }

          if(restrictions.value == 'before:today'){
            const today = moment().format('DD/MM/YYYY');
            custom_validate = custom_validate + '|' + 'before:' + today
          }

        }
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
      previus () {
        const vue = this;
        vue.active = vue.tabs[(vue.tabs.indexOf(vue.active) - 1) % vue.tabs.length];
      },
      next () {
        const vue = this;
        vue.$validator.validateAll(vue.slugify(vue.active)).then((result) => {
          if (result) {
            vue.active = vue.tabs[(vue.tabs.indexOf(vue.active) + 1) % vue.tabs.length]
          }else{
            this.v_alert = true
          }
        });
      },
      disable_tab(section) {
        const vue = this;
        vue.$validator.validateAll(section).then((result) =>{
          return result;
        });
      },

      save () {
        const vm = this;
        vm.$validator.validateAll(vm.slugify(vm.active)).then((result) => {
          if (result) {
            axios.post(this.saveLink, {
                csrf_token: vm.csrfToken,
                token: window.location.pathname.split("/").pop(),
                data: JSON.stringify(this.range)
            })
            .then(function (response) {
              if(response.data.success){
                vm.questionnaire_completed = true
                vm.$notify({
                  group: 'success',
                  type: 'success',
                  title: 'Cuestionario KM',
                  text: 'Su informacion se ha grabado satisfactoriamente. Gracias por su participacion'
                });

              }else{
                vm.$notify({
                  group: 'error',
                  type: 'error',
                  title: 'Ha ocurrido un error',
                  text: 'No se ha podido guardar el cuestionario. Intente nuevamente o notifique al docente.'
                });
              }
            })
            .catch(function (error) {
              vm.$notify({
                group: 'error',
                type: 'error',
                title: 'Ha ocurrido un error',
                text: 'No se ha podido guardar el cuestionario. Intente nuevamente o notifique al docente.'
              });
            })
          }else{
            this.v_alert = true;
          }
        });
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

    }
  }
</script>

<style scoped>
  .diabled-text-white{
    color: #fafafade !important
  }
  .input-group--text-field input, .input-group--text-field textarea{
    font-size: 10px !important
  }
</style>
