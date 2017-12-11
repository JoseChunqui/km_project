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
          <v-snackbar
            :timeout = "Number(3000)"
            color="success"
            top
            v-model="notify_success"
            >
            {{ notifySuccessMessage }}
          </v-snackbar>
          <v-snackbar
            :timeout = "Number(7000)"
            color="error"
            top
            v-model="notify_warning"
            >
            {{ notifyWarningMessage }}
          </v-snackbar>
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
      items: [],
      notify_success : false,
      notify_warning : false
    }),
    mounted: function(){
      if(this.isAdmin == 'true'){
        this.items = [
          { icon: 'home', text: 'Inicio', link: '/home'},
          { icon: 'domain', text: 'Instituciones', link: '/instituciones' },
          { icon: 'people', text: 'Docentes', link: '/docentes' },
          { icon: 'import_contacts', text: 'Cursos', link: '/cursos' },
          { icon: 'layers', text: 'Cuestionarios', link: '/cuestionarios' }
        ]
      }else{
        this.items = [
          { icon: 'home', text: 'Inicio', link: '/home'},
          { icon: 'layers', text: 'Cuestionarios', link: '/cuestionarios' }
        ]
      }

      if(this.notifySuccessKey == 'true'){
        this.notify_success = true;
      }
      if(this.notifyWarningKey == 'true'){
        this.notify_warning = true;
      }


    },

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
      cursosLink: String,
      isAdmin: String,
      notifySuccessKey: String,
      notifySuccessMessage: String,
      notifyWarningKey: String,
      notifyWarningMessage: String
    }
  }
</script>
