<template>
  <v-app id="inspire">
    <v-card color="grey lighten-5" flat>
      <v-toolbar dark color="primary" flat extended>
        <!-- <v-toolbar-title style="width: 400px" class="ml-0 pl-3">
          Administración del conocimiento
        </v-toolbar-title> -->
      </v-toolbar>
      <v-layout row>
        <v-flex xs12 md8 offset-md2>
          <slot>
            <!--Content-->
          </slot>
          <!-- <v-card class="card--flex-toolbar">
            <v-toolbar card color="white" prominent>
              <v-toolbar-title class="body-2 grey--text">Title</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon>
                <v-icon>search</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>apps</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>more_vert</v-icon>
              </v-btn>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
            </v-card-text>
          </v-card> -->
        </v-flex>
      </v-layout>
    </v-card>
  </v-app>
</template>

<style>
  .card--flex-toolbar {
    margin-top: -64px;
  }
</style>
