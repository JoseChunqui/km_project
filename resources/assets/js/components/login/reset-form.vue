<template>
<v-app id="inspire">
  <v-container>
    <v-layout row wrap>
      <v-flex xs12 sm12 md6 lg4 offset-md3 offset-lg4>
        <v-form :method="this.methodForm" id="login-form" autocomplete="off" class="container" :action="this.actionForm">
          <div>
            <input type="hidden" name="_token" :value="this.csrfToken">
            <input type="token" name="" :value="this.token">
          </div>
          <v-card color="blue-grey darken-2" class="white--text">
            <v-card-title primary-title>
              <div class="headline">Recuperar Contraseña</div>
            </v-card-title>
            <v-card-text v-if="this.errorEmailForm != ''">
              <v-alert color="error" icon="warning" value="true">
                {{this.errorEmailForm}}
              </v-alert>
            </v-card-text>
            <v-card-text v-if="this.errorPasswordForm != ''">
              <v-alert color="error" icon="warning" value="true">
                {{this.errorPasswordForm}}
              </v-alert>
            </v-card-text>
            <v-card-text v-if="this.errorPasswordConfirmForm != ''">
              <v-alert color="error" icon="warning" value="true">
                {{this.errorPasswordConfirmForm}}
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
            <v-card-text>
              <v-text-field
              label="Contraseña"
              v-model="password"
              name="password"
              :error-messages="passwordErrors"
              @input="$v.password.$touch()"
              @blur="$v.password.$touch()"
              required
              type="password"
              ></v-text-field>
            </v-card-text>
            <v-card-text>
              <v-text-field
              label="Confirmar Contraseña"
              v-model="confirmPassword"
              name="password_confirmation"
              :error-messages="confirmPasswordErrors"
              @input="$v.password.$touch()"
              @blur="$v.password.$touch()"
              required
              type="password"
              ></v-text-field>
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
    email: { required, email },
    password: { required },
    confirmPassword: { required }
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
    confirmPasswordErrors () {
      const errors = []
      if (!this.$v.confirmPassword.$dirty) return errors
      !this.$v.confirmPassword.required && errors.push('Vuelva a ingresar su contraseña')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('Ingrese su contraseña')
      return errors
    },
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
    tokenForm: String,
    csrfToken : String,
    methodForm: String,
    errorEmailForm: String,
    errorPasswordForm: String,
    errorPasswordConfirmForm: String,
    statusForm: String,
    oldEmail: String
  },
  mounted () {
    console.log(this.errorsForm);
  }
}
</script>
