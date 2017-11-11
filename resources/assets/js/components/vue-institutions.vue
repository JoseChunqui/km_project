<template>
  <div>
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
    <v-data-table hide-actions v-bind:headers="headers" :items="this.dataInstitutions" class="elevation-1">
      <template slot="headerCell" slot-scope="props">
        <span slot="activator">
          {{ props.header.text }}
        </span>
      </template>
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.abbreviation }}</td>
        <td class="text-xs-left">{{ props.item.users.length }}</td>
        <td class="text-xs-center">
          <v-btn>Ver</v-btn>
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
        headers:[
          { text: 'Nombre de la Institución', align: 'left'},
          { text: 'Abreviatura', align: 'left'},
          { text: 'Número de usuarios', align: 'left'},
          { text: 'Acciones', align: 'center'}
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
