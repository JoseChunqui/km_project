<template>
  <v-layout justify-center column>
    <v-subheader>Panel de Control</v-subheader>
    <v-card>
      <v-card-text>
        <v-layout align-center row spacer>
          <v-flex xs1>
            <v-avatar class="red">
              <span class="white--text headline">J</span>
            </v-avatar>
          </v-flex>
          <v-flex xs3>
            <strong>{{dataUser.name}}</strong>
          </v-flex>
          <v-flex no-wrap>
            <strong> {{ this.dataInstitution }} </strong>
          </v-flex>
          <v-flex
            class="grey--text"
            ellipsis
            >
            {{dataUser.email}}
          </v-flex>
        </v-layout>
      </v-card-text>
    </v-card>
    <v-layout wrap>
      <v-flex xs12 sm6>
        <v-card class="mt-4">
          <v-card-text>
            <v-subheader>Cursos Registrados</v-subheader>
            <v-list>
              <v-list-tile v-for="course in dataCourses" v-bind:key="course.id" href="/cuestionarios">
                <v-list-tile-content>
                  <v-list-tile-title v-text="course.name"></v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-layout>
</template>

<script>
export default {
  data () {
    return {
      //
    }
  },
  created: function(){
    //
  },
  mounted: function(){
    console.log(this.dataInstitution);
  },
  computed: {
    //
  },
  methods: {
    //
  },
  props: {
    dataUser: Object,
    dataInstitution: String,
    dataCourses: Array
  }
}
</script>
