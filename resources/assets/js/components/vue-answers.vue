<template>
  <v-container grid-list-md>
    <v-layout>
      <v-flex xs12>
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
              <v-form method="get" :href="this.answersShowUrl">
                <div hidden>
                  <input type="text" name="" value="">
                </div>
                <v-btn type="submit">Ver</v-btn>
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
  },
  computed: {
    //
  },
  methods: {
    //
  },
  props: {
    dataQuestionnaires: Array,
    answersShowUrl: String,
    csrfToken: String
  }
}
</script>
