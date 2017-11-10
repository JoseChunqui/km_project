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
    <div class="table__overflow elevation-10">
      <table class="datatable table">
        <thead>
          <tr>
            <th>
              Nombre de la Institución
            </th>
            <th>
              Abreviatura
            </th>
            <th>
              Número de usuarios
            </th>
            <th>
              Acciones
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="institution in dataInstitutions">
            <td>
              {{institution.name}}
            </td>
            <td>
              {{institution.abbreviation}}
            </td>
            <td>
              {{institution.users.length}}
            </td>
            <td>
              <v-btn>Ver</v-btn>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false
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
