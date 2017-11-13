<template>
  <div>
    <div class="mb-4">
      <v-dialog v-model="dialog" persistent max-width="500px">
        <v-btn color="primary" dark slot="activator">Añadir Docente</v-btn>
        <v-form method="POST" autocomplete="off" class="container" :action="this.actionNewUser">
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
                    <v-select
                    :items="this.dataInstitutions"
                    label="Institución"
                    v-model="institution_select"
                    item-text="name"
                    item-value="id"
                    single-line
                    ></v-select>
                    <input type="hidden" name="institution" :value="institution_select">
                  </v-flex>
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
    <v-data-table hide-actions v-bind:headers="headers" :items="this.dataUsers" class="elevation-1">
      <template slot="headerCell" slot-scope="props">
        <span slot="activator">
          {{ props.header.text }}
        </span>
      </template>
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.institution.name }}</td>
        <td class="text-xs-left">{{ props.item.email }}</td>
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
        institution_select: null,
        headers:[
          { text: 'Nombre del Docente', align: 'left', value: 'name'},
          { text: 'Institución', align: 'left', value: 'institution.name'},
          { text: 'Email', align: 'left', value: 'email'},
          { text: 'Acciones', align: 'center', value: ''}
        ]
      }
    },
    methods: {
      //
    },
    props: {
      dataUsers: Array,
      dataInstitutions : Array,
      actionNewUser: String,
      csrfToken: String
    },
    mounted: function() {
      console.log(this.dataUsers);
    }
  }
</script>
