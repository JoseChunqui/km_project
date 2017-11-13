<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12 sm8 offset-sm2>
        <div class="mb-4">
          <v-btn light disabled>Añadir Cuestionario</v-btn>
          <v-dialog v-model="dialog" persistent max-width="500px">
            <!-- <v-btn color="primary" dark slot="activator">Añadir Cuestionario</v-btn> -->
            <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewForm">
              <input type="hidden" name="_token" :value="this.csrfToken">
              <div>
                <!--  fake fields are a workaround for chrome/opera autofill getting the wrong fields -->
                <input id="username" style="display:none" type="text" name="fakeusernameremembered">
                <input id="password" style="display:none" type="password" name="fakepasswordremembered">
              </div>
              <v-card>
                <v-card-title>
                  <span class="headline">Nuevo Docente</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-text-field label="Nombre del Docente" name="name" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Email" type="email" name="email" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Contraseña" type="password" name="password" required></v-text-field>
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
        <div v-for="course in this.dataCourses">
          <v-container grid-list-md>
            <span class="subheading">{{course.name}}</span>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex v-for="form in course.forms" :key="form.id">
                  <v-card class="elevation-5">
                    <v-card-title>
                      <v-layout wrap row>
                        <v-flex>
                          <span class="title">{{form.name}}</span>
                        </v-flex>
                        <v-flex class="text-xs-right">
                          <v-tooltip bottom>
                            <v-btn small flat slot="activator">Activo</v-btn>
                            <span>Desactivar</span>
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
                              <v-btn small light disabled>Administrar</v-btn>
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
    data: () => ({
      dialog: false
    }),
    methods: {
      getFormShowUrl(id){
        return '/respuestas/'+id;
      }
    },
    props: {
      dataCourses: Array,
      actionNewForm: String,
      csrfToken: String
    },
    mounted: function(){
      console.log(this.dataForms);
    }
  }
</script>
