<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12 sm12 md12 lg8 offset-lg2>
        <div class="mb-4">
          <v-dialog v-model="dialog" persistent max-width="500px">
            <v-btn color="primary" dark slot="activator">Añadir Institución</v-btn>
            <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewInstitution">
              <input type="hidden" name="_token" :value="this.csrfToken">
              <v-card>
                <v-card-title>
                  <span class="headline">Nueva Institución</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-text-field label="Nombre de la Institución" name="name" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Abreviatura" type="text" name="abbreviation"></v-text-field>
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
        <v-data-table v-bind:headers="headers" :items="this.dataInstitutions" class="elevation-1">
          <template slot="headerCell" slot-scope="props">
            <span slot="activator">
              {{ props.header.text }}
            </span>
          </template>
          <template slot="items" slot-scope="props">
            <td class="text-xs-left">{{ props.item.name }}</td>
            <td class="text-xs-left">{{ props.item.abbreviation }}</td>
            <td class="text-xs-left">{{ props.item.users.length }}</td>
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
        headers:[
          { text: 'Nombre de la Institución', align: 'left', value: 'name'},
          { text: 'Abreviatura', align: 'left', value: 'abbreviation'},
          { text: 'Número de docentes registrados', align: 'left', value: 'users.length'}
        ]
      }
    },
    methods: {

    },
    props: {
      dataInstitutions: Array,
      actionNewInstitution: String,
      csrfToken: String
    }
  }
</script>
