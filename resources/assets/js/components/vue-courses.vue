<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12 sm12 md12 lg8 offset-lg2>
        <div class="mb-4">
          <v-dialog v-model="dialog" persistent max-width="500px">
            <v-btn color="primary" dark slot="activator">Añadir un nuevo Curso</v-btn>
            <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewCourse">
              <input type="hidden" name="_token" :value="this.csrfToken">
              <v-card>
                <v-card-title>
                  <span class="headline">Nuevo Curso</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-select
                        :items="this.dataInstitutions"
                        label="Institución"
                        v-model="institution_select"
                        item-text="name"
                        @input="setInstitution()"
                        ></v-select>
                      </v-flex>
                      <v-flex xs12 v-if="view_users_select">
                        <v-select
                        :items="users_select_items"
                        label="Docente"
                        v-model="users_select"
                        item-text="name"
                        item-value="id"
                        ></v-select>
                        <input type="hidden" name="user" :value="users_select">
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Nombre del Curso" name="name" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Código del Curso" type="text" name="code"></v-text-field>
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
        <v-data-table v-bind:headers="headers" :items="this.dataCourses" class="elevation-1">
          <template slot="headerCell" slot-scope="props">
            <span slot="activator">
              {{ props.header.text }}
            </span>
          </template>
          <template slot="items" slot-scope="props">
            <td class="text-xs-left">{{ props.item.user.institution ? props.item.user.institution.name : 'Administrador'}}</td>
            <td class="text-xs-left">{{ props.item.user.name }}</td>
            <td class="text-xs-left">{{ props.item.name }}</td>
            <td class="text-xs-left">{{ props.item.code }}</td>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        dialog_details: [],
        institution_select:null,
        view_users_select: false,
        users_select: null,
        users_select_items: [],
        headers: [
          { text: 'Nombre de la Institución', align: 'left', value: 'user.institution.name'},
          { text: 'Docente', align: 'left', value: 'user.name'},
          { text: 'Nombre del curso', align: 'left', value: 'name'},
          { text: 'Código del curso', align: 'left', value: 'code'},
        ]
      }
    },
    created: function(){
      const vue = this;
      vue.dataCourses.forEach(function(course){
        vue.dialog_details.push(false);
      });
    },
    methods: {
      setInstitution(){
        var vue = this;
        vue.users_select_items = this.dataInstitutions.find(function(element){
          return element == vue.institution_select;
        }).users;
        vue.view_users_select = true;
      },
      getFormEditUrl(id){
        return '/forms/edit/'+id;
      }
    },
    props: {
      dataCourses: Array,
      dataInstitutions: Array,
      actionNewCourse: String,
      csrfToken: String
    },
    mounted: function(){
      console.log(this.dialog_details);
      console.log(this.dataCourses);
    }
  }
</script>
