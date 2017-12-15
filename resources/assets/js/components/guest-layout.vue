<template>
  <v-app id="inspire">
    <v-card color="grey lighten-5" flat>
      <v-toolbar dark color="primary" flat extended>
        <!-- <v-toolbar-title style="width: 400px" class="ml-0 pl-3 mt-5">
          Administración del conocimiento
        </v-toolbar-title> -->
      </v-toolbar>
      <v-layout row>
        <v-flex xs12 md10 xl10 offset-xl1 offset-md1>
          <slot>
            <!--Content-->
          </slot>
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
