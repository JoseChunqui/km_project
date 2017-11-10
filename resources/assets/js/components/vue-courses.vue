<template>
  <div>
    <div class="mb-4">
      <v-dialog v-model="dialog" persistent max-width="500px">
        <v-btn color="primary" dark slot="activator">Añadir un nuevo Curso</v-btn>
        <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewCourse">
          <input type="hidden" name="_token" :value="this.csrfToken">
          <v-card>
            <v-card-title>
              <span class="headline">Nueva Institución</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-text-field label="Nombre del Curso" name="name" required></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field label="Codigo del Curso" type="text" name="abbreviation"></v-text-field>
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
        <td class="text-xs-left">{{ props.item.user.institution.name }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.code }}</td>
        <td class="text-xs-center">
          <v-dialog v-model="dialog_details" persistent max-width="500px">
            <v-btn color="primary" dark slot="activator">Detalles de Formularios</v-btn>
            <v-form method="GET" autocomplete="off" class="container" :action="getFormEditUrl(props.item.forms[0].id)">
              <v-card>
                <v-card-title>
                  <span class="headline">Formularios asignados</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12 sm6 md6>
                        <v-text-field label="Nombre del formulario" name="name" required readonly :value="props.item.forms[0].name"></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6 md6>
                        <v-text-field label="Clave del formulario" type="text" required name="clave" :value="props.item.forms[0].key"></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                  <small>*Indica que son campos requeridos</small>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" flat @click.native="dialog_details = false">Cancelar</v-btn>
                  <v-btn color="blue darken-1" flat @click.native="dialog_details = false" type="submit">Guardar Cambios</v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        dialog_details: false,
        headers: [
          { text: 'Nombre de la Institución', align: 'left'},
          { text: 'Nombre del curso', align: 'left'},
          { text: 'Código del curso', align: 'left'},
          { text: 'Acciones', align: 'center'}
        ],
      }
    },
    methods: {
      getFormEditUrl(id){
        return '/forms/edit/'+id;
      }
    },
    props: {
      dataCourses: Array,
      actionNewCourse: String,
      csrfToken: String
    }
  }
</script>
