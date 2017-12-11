<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12 sm12 md12 lg8 offset-lg2>
        <div class="mb-4">
          <!-- <v-btn light disabled>Añadir Cuestionario</v-btn> -->
          <v-dialog v-model="dialog" persistent max-width="500px">
            <v-btn color="primary" dark slot="activator">Añadir Cuestionario</v-btn>
            <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewForm">
              <input type="hidden" name="_token" :value="this.csrfToken">
              <v-card>
                <v-card-title>
                  <span class="headline">Nuevo Cuestionario</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-select
                        :items="this.dataCourses"
                        label="Curso"
                        v-model="course_select"
                        item-text="name"
                        item-value="id"
                        required
                        ></v-select>
                        <input type="hidden" name="course" :value="course_select">
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Nombre del Cuestionario" name="name" required></v-text-field>
                      </v-flex>
                      <v-flex xs4>
                        <v-text-field :value="show_code_course_selected()" disabled></v-text-field>
                      </v-flex>
                      <v-flex xs8>
                        <v-text-field label="Clave del cuestionario" name="key" required></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                  <small>*Indica que son campos requeridos</small>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" flat @click.native="dialog = false">Cancelar</v-btn>
                  <v-btn color="blue darken-1" flat @click.native="dialog = false" type="submit">Guardar</v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </div>
        <div v-for="course in dataCoursesLocale">
          <v-container grid-list-md>
            <span class="subheading">{{course.name}}</span>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex v-for="(form, index) in course.forms" :key="form.id">
                  <v-card class="elevation-1 mb-4">
                    <v-toolbar color="grey lighten-3" class="elevation-1">
                      <v-toolbar-title>{{form.name}}</v-toolbar-title>
                      <v-spacer></v-spacer>
                      <v-tooltip bottom>
                        <v-btn small :class="{ 'success': form.active, 'error': !form.active  }" dark flat slot="activator" @click="change_form_state(form)">{{form.active ? 'Activo' : 'Desactivado'}}</v-btn>
                        <span>{{form.active ? 'Desactivar' : 'Activar'}}</span>
                      </v-tooltip>
                    </v-toolbar>
                    <v-card-text>
                      <v-container>
                        <v-layout wrap>
                          <v-flex xs12 md3>
                            <div class="mt-1 text-xs-center">
                              <strong>Clave:</strong>
                              <v-tooltip bottom>
                                <v-btn flat slot="activator" @click="dialog_change_password.splice(index,1,true)">{{form.key}}</v-btn>
                                <span>Cambiar Clave</span>
                              </v-tooltip>
                              <v-dialog v-model="dialog_change_password[index]" persistent max-width="500px">
                                <v-card>
                                  <v-card-title>
                                    <span class="headline">Cambiar Clave</span>
                                  </v-card-title>
                                  <v-form method="POST" autocomplete="off" class="container" :action="getFormEditUrl(form.id)">
                                    <input type="hidden" name="_token" :value="csrfToken">
                                    <v-card-text>
                                      <v-container grid-list-md>
                                        <v-layout wrap>
                                          <v-flex xs12>
                                            <v-text-field label="Nombre del formulario" name="name" required readonly :value="form.name"></v-text-field>
                                          </v-flex>
                                          <v-flex xs4>
                                            <v-text-field :value="course.code+'-'" disabled></v-text-field>
                                          </v-flex>
                                          <v-flex xs8>
                                            <v-text-field label="Clave del cuestionario" name="clave" :value="getKeyForm(form.key, course.code)" required></v-text-field>
                                          </v-flex>
                                        </v-layout>
                                      </v-container>
                                      <small>*Indica que son campos requeridos</small><br>
                                      <small>**La clave del cuestionario siempre lleva como prefijo el código del curso.</small>
                                    </v-card-text>
                                    <v-card-actions>
                                      <v-spacer></v-spacer>
                                      <v-btn color="blue darken-1" flat @click.native="dialog_change_password.splice(index,1,false)">Cancelar</v-btn>
                                      <v-btn color="blue darken-1" flat @click.native="dialog_change_password.splice(index,1,false)" type="submit">Guardar Cambios</v-btn>
                                    </v-card-actions>
                                  </v-form>
                                </v-card>
                              </v-dialog>
                            </div>
                          </v-flex>
                          <v-flex xs12 md3>
                            <div class="mt-1 text-xs-center">
                              <v-tooltip bottom>
                                <v-btn @click="trigger_answers_index_form()" flat slot="activator">
                                  # de Respuestas: {{form.questionnaires.length}}
                                </v-btn>
                                <span>Ver respuestas</span>
                              </v-tooltip>
                            </div>
                          </v-flex>
                          <v-flex xs12 md6>
                            <v-layout row wrap>
                              <v-flex class="mt-2 text-xs-center">
                                <v-form id="answersIndexForm" method="get" :action="answersIndexUrl">
                                  <div hidden>
                                    <input type="text" name="form" :value="form.id">
                                  </div>
                                  <v-btn small color="primary" dark type="submit">Ver Respuestas</v-btn>
                                </v-form>
                              </v-flex>
                              <v-flex class="mt-2 text-xs-center">
                                <v-dialog v-model="dialog_manage[index]" persistent max-width="500px">
                                  <v-btn color="primary" dark small slot="activator">Administrar</v-btn>
                                  <v-form method="POST" autocomplete="off" class="container" :action="actionManageForm">
                                    <input type="hidden" name="_token" :value="csrfToken">
                                    <v-card>
                                      <v-card-title>
                                        <span class="headline">Administrar Formulario</span>
                                      </v-card-title>
                                      <v-card-text>
                                        <v-container grid-list-md>
                                          <div>
                                            <textarea hidden name="data" :value="JSON.stringify(form.data)"></textarea>
                                            <input hidden type="text" name="form" :value="form.id">
                                          </div>
                                          <v-layout wrap>
                                            <v-flex xs12 v-for="section in form.data" :key="section.section" :id="section.section">
                                              <v-checkbox v-bind:label="section.section" v-model="section.active" light :disabled="section.section == 'IDENTIFICACIÓN'"></v-checkbox>
                                            </v-flex>
                                          </v-layout>
                                        </v-container>
                                      </v-card-text>
                                      <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" flat @click.native="dialog_manage.splice(index,1,false)">Cancelar</v-btn>
                                        <v-btn color="blue darken-1" flat @click.native="dialog_manage.splice(index,1,false)" type="submit">Guardar</v-btn>
                                      </v-card-actions>
                                    </v-card>
                                  </v-form>
                                </v-dialog>
                              </v-flex>
                              <!-- <v-flex class="mt-1 text-xs-center">
                                <v-tooltip bottom>
                                  <v-btn flat icon color="red" slot="activator" @click="delete_form(form.id, course, index)">
                                    <v-icon>delete</v-icon>
                                  </v-btn>
                                  <span>Eliminar Cuestionario</span>
                                </v-tooltip>
                              </v-flex> -->
                            </v-layout>
                          </v-flex>
                        </v-layout>
                      </v-container>
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
            </v-container>
          </v-container>
        </div>
      </v-flex>
    </v-layout>
    <div role="notifications">
      <notifications group="success" position="top center"/>
      <notifications group="error" position="top center"/>
    </div>
  </v-container>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        course_select : null,
        dialog_manage : [],
        dialog_change_password: [],
        dataCoursesLocale: this.dataCourses,
        check_sections: []
      }
    },
    created: function(){
      const vue = this;
      vue.dataCourses.forEach(function(course){
        course.forms.forEach(function(form){
          vue.dialog_manage.push(false);
          vue.dialog_change_password.push(false);
        })
      });
    },
    computed: {
      //
    },
    methods: {
      getKeyForm(key, code){
        return key.replace(code+'-','');
      },
      getFormEditUrl(id){
        return '/forms/edit/'+id;
      },

      trigger_answers_index_form(){
        document.getElementById("answersIndexForm").submit();
      },

      show_code_course_selected(){
        var vue = this;
        var code_to_return = '';
        if(vue.course_select){
          code_to_return = vue.dataCourses.find(function(course){
            return course.id = vue.course_select;
          }).code;
          code_to_return += '-'
        }
        return code_to_return;
      },

      //Axios methods
      change_form_state(form){
        var url = '/cuestionarios/estado';
        axios.post(url, {
          form : form.id
        })
        .then(response => {
          if(response.data.success){
            form.active = ! form.active;
            this.$notify({
              group: 'success',
              type: 'success',
              title: 'Modificación realizada con éxito',
              text: 'Se cambió el estado del cuestionario'
            });
          }else{
            this.$notify({
              group: 'error',
              type: 'error',
              title: 'Ha ocurrido un error',
              text: 'No se ha podido realziar los cambios solicitados, intente de nuevo'
            });
          }

        })
        .catch(e => {
          this.$notify({
            group: 'error',
            type: 'error',
            title: 'Ha ocurrido un error',
            text: 'No se ha podido realziar los cambios solicitados, intente de nuevo'
          });
          // console.log(e);
        })

      },
      delete_form(form_id, course, index){
        course.forms.splice(index, 1);
      }
    },
    props: {
      dataCourses: Array,
      actionNewForm: String,
      actionManageForm: String,
      answersIndexUrl: String,
      csrfToken: String
    },
    mounted: function(){
      console.log(this.dataCourses);
    }
  }
</script>
