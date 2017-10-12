<template>
<v-app id="inspire">
  <v-container>
    <v-layout row wrap>
      <v-flex xs12 sm12 md6 lg4 offset-md3 offset-lg4>
        <v-form :method="this.methodForm" id="login-form" autocomplete="off" class="container" :action="this.actionForm">
          <div>
            <input type="hidden" name="_token" :value="this.csrfToken">
          </div>
          <v-card color="blue-grey darken-2" class="white--text">
            <v-card-title primary-title>
              <div class="headline">Recuperar Contraseña</div>
            </v-card-title>
            <v-card-text v-if="this.errorsForm != ''">
              <v-alert color="error" icon="warning" value="true">
                {{this.errorsForm}}
              </v-alert>
            </v-card-text>
            <v-card-text v-if="this.statusForm != ''">
              <v-alert color="success" icon="check_circle" value="true">
                {{this.statusForm}}
              </v-alert>
            </v-card-text>
            <v-card-text>
              <div>
                Ingrese su correo electrónico
              </div>
              <div class="mt-4">
                <v-text-field
                label="E-mail"
                v-model="email"
                name="email"
                :error-messages="emailErrors"
                @input="$v.email.$touch()"
                @blur="$v.email.$touch()"
                required
                dark
                >
                </v-text-field>
              </div>
            </v-card-text>
            <v-card-actions>
              <v-btn flat dark @click="submit">Enviar link</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</v-app>
</template>
<script>
import { validationMixin } from 'vuelidate'
import { required, email } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  validations: {
    email: { required, email }
  },
  data () {
    return {
      email: this.oldEmail
    }
  },
  methods: {
    submit () {
      this.$v.$touch()
      if(! this.$v.$invalid){
        console.log("enviado");
        document.getElementById("login-form").submit()
      }
    }
  },
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.email.$dirty) return errors
      !this.$v.email.email && errors.push('El E-Mail ingresado no es válido')
      !this.$v.email.required && errors.push('Ingrese su E-Mail')
      return errors
    }
  },
  props: {
    actionForm: String,
    csrfToken : String,
    methodForm: String,
    errorsForm: String,
    statusForm: String,
    oldEmail: String
  },
  mounted () {
    console.log(this.errorsForm);
  }
}
</script>
