<template>
  <v-container grid-list-md>
    <v-layout wrap>
      <!-- <v-flex xs12 sm12 lg8 offset-lg2 class="pl-1">
        <v-btn class="ml-0">Retroceder</v-btn>
      </v-flex> -->
      <v-flex xs12 sm12 lg8 offset-lg2>
        <v-card>
          <v-toolbar color="grey lighten-3" class="elevation-1">
            <v-toolbar-title>Respuestas de <strong>{{dataForm.name}}</strong></v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <v-form id="answersIndexForm" method="post" :action="answersExportUrl">
              <div hidden>
                <input type="hidden" name="_token" :value="csrfToken">
                <input type="text" name="form" :value="dataForm.id">
              </div>
              <v-btn small color="primary" dark type="submit">Exportar a Excel</v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 lg8 offset-lg2>
        <v-data-table hide-actions v-bind:headers="headers" :items="this.dataQuestionnaires" class="elevation-1">
          <template slot="headerCell" slot-scope="props">
            <span slot="activator">
              {{ props.header.text }}
            </span>
          </template>
          <template slot="items" slot-scope="props">
            <td class="text-xs-left">{{ props.item.data[0].questions[0].answer }}</td>
            <td class="text-xs-left">{{ props.item.data[0].questions[1].answer }}</td>
            <td class="text-xs-left">{{ props.item.data[0].questions[2].answer }}</td>
            <td class="text-xs-left">{{ props.item.data[0].questions[3].answer }}</td>
            <td class="text-xs-center">
              <v-form method="get" :action="answersShowUrl">
                <div hidden>
                  <input type="text" name="codigo" :value="props.item.id">
                </div>
                <v-btn type="submit" color="primary">Ver</v-btn>
              </v-form>
            </td>
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
      headers:[
        { text: 'Apellidos', align: 'left', value: 'data[0].questions[0].answer'},
        { text: 'Nombres', align: 'left', value: 'data[0].questions[1].answer'},
        { text: 'Código', align: 'left', value: 'data[0].questions[2].answer'},
        { text: 'Especialidad', align: 'left', value: 'data[0].questions[3].answer'},
        { text: 'Acciones', align: 'center', value: ''}
      ]
    }
  },
  created: function(){
    //
  },
  mounted: function(){
    console.log(this.dataQuestionnaires);
    console.log(this.dataForm);
    console.log(this.answersShowUrl);
  },
  computed: {
    //
  },
  methods: {
    //
  },
  props: {
    dataQuestionnaires: Array,
    dataForm: Object,
    answersShowUrl: String,
    answersExportUrl: String,
    csrfToken: String
  }
}
</script>
