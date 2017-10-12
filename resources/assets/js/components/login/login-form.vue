<template>
    <v-card class="elevation-20">
      <v-form :method="this.methodForm" id="login-form" autocomplete="off" class="container" :action="this.actionForm">
        <v-card-text>
          <div>
            <h3 class="headline mb-0 text-md-center  indigo--text darken-2" >INGRESO AL SISTEMA</h3>
          </div>
          <div class="">
            <span class="text-md-center red--text darken-2"> {{this.errorsForm}} </span>
          </div>
        </v-card-text>
        <v-card-text>
          <div>
            <input type="hidden" name="_token" :value="this.csrfToken">
          </div>
          <div>
            <v-text-field
            label="E-mail"
            v-model="email"
            name="email"
            :error-messages="emailErrors"
            @input="$v.email.$touch()"
            @blur="$v.email.$touch()"
            required
            ></v-text-field>
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
          </div>
        </v-card-text>

        <v-card-text>
          <div>
            <v-btn :href="this.linkResetPassword"flat color="primary">Recordar contraseña</v-btn>
          </div>
          <div>
            <v-btn @click="submit">Ingresar</v-btn>
          </div>
        </v-card-text>
      </v-form>
    </v-card>

</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, email } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],
    validations: {
      email: { required, email },
      password: { required }
    },
    data () {
      return {
        password: '',
        email: this.oldEmail
      }
    },
    methods: {
      submit () {
        this.$v.$touch()
        if(! this.$v.$invalid){
          document.getElementById("login-form").submit()
        }
      },
      clear () {
        this.$v.$reset()
        this.password = ''
        this.email = ''
      }
    },
    computed: {

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
      csrfToken : String,
      methodForm: String,
      errorsForm: String,
      oldEmail: String,
      linkResetPassword: String
    },
    mounted () {
      console.log(this.errorsForm);
    }
  }
</script>
