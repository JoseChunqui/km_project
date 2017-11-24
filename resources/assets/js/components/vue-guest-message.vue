<template>
  <v-container>
    <v-layout>
      <v-flex>
        <v-card>
          <v-card-text>
            {{dataMessage}}
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
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
    console.log(this.dataMessage);
  },
  computed: {
    //
  },
  methods: {
    //
  },
  props: {
    dataMessage: String
  }
}
</script>
