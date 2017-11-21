<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12 sm8 offset-sm2>
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
                  <v-card class="elevation-5">
                    <v-card-title>
                      <v-layout wrap row>
                        <v-flex>
                          <span class="title">{{form.name}}</span>
                        </v-flex>
                        <v-flex class="text-xs-right">
                          <v-tooltip bottom>
                            <v-btn small flat slot="activator" @click="form.active = !form.active">{{form.active ? 'Activo' : 'Desactivado'}}</v-btn>
                            <span>{{form.active ? 'Desactivar' : 'Activar'}}</span>
                          </v-tooltip>
                        </v-flex>
                      </v-layout>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-layout wrap>
                          <v-flex xs12 sm4>
                            <div class="mt-2">
                              Clave: {{form.key}}
                            </div>
                          </v-flex>
                          <v-flex xs12 sm4>
                            <div class="mt-2">
                              # de Respuestas: {{form.questionnaires.length}}
                            </div>
                          </v-flex>
                          <v-flex xs12 sm4>
                            <div class="text-xs-center">
                              <v-btn small color="primary" dark :href="getFormShowUrl(form.id)">Ver Respuestas</v-btn>
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
                            </div>
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
  </v-container>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        course_select : null,
        dialog_manage : [],
        dataCoursesLocale: this.dataCourses,
        check_sections: []
      }
    },
    created: function(){
      const vue = this;
      vue.dataCourses.forEach(function(course){
        course.forms.forEach(function(form){
          vue.dialog_manage.push(false);
        })
      });
    },
    methods: {
      getFormShowUrl(id){
        return '/respuestas/'+id;
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
      }
    },
    props: {
      dataCourses: Array,
      actionNewForm: String,
      actionManageForm: String,
      csrfToken: String
    },
    mounted: function(){
      console.log(this.dataCourses);
    }
  }
</script>
