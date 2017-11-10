<template>
  <v-app id="inspire">
    <v-navigation-drawer
      persistent
      clipped
      app
      v-model="drawer"
    >
      <v-list dense>
        <template v-for="(item, i) in items">
          <v-list-tile :href="item.link">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="blue darken-3" dark app clipped-left fixed>
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        Cuestionario
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-form id="logout-form" :action="this.logoutLink" method="POST">
        <input type="hidden" name="_token" :value="this.lCsrfToken">
        <v-btn color="red" dark @click="logout">Salir
          <v-icon dark right>block</v-icon>
        </v-btn>
      </v-form>
    </v-toolbar>
    <main>
      <v-content>
        <v-container fluid>
          <slot>
            <!-- Content -->
          </slot>
        </v-container>
      </v-content>
    </main>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      drawer: true,
      items: [
        { icon: 'domain', text: 'Instituciones', link: '/instituciones' },
        { icon: 'import_contacts', text: 'Cursos', link: '/cursos' },
        { icon: 'contacts', text: 'Respuestas', link: '/respuestas' }
      ]
    }),


    methods: {
      logout() {
          document.getElementById("logout-form").submit()
      },
      move(link){
        window.location.replace(link);
      }
    },
    props: {
      source: String,
      logoutLink: String,
      lCsrfToken: String,
      respuestasLink: String,
      institucionesLink: String,
      cursosLink: String
    }
  }
</script>
