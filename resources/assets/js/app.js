
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'vuetify/dist/vuetify.min.css'

require('./libraries');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 window.Vue = require('vue');
 window.Vuetify = require('vuetify');
 window.VeeValidate = require('vee-validate');
 const config = {
  errorBagName: 'vee_errors', // change if property conflicts.
  fieldsBagName: 'fields',
  delay: 0,
  locale: 'en',
  dictionary: null,
  strict: true,
  classes: false,
  classNames: {
    touched: 'touched', // the control has been blurred
    untouched: 'untouched', // the control hasn't been blurred
    valid: 'valid', // model is valid
    invalid: 'invalid', // model is invalid
    pristine: 'pristine', // control has not been interacted with
    dirty: 'dirty' // control has been interacted with
  },
  events: 'input|blur',
  inject: true,
  validity: false,
  aria: true
};

 Vue.use(VeeValidate, config);
 Vue.use(Vuetify);

 Vue.component('login-form', require('./components/login/login-form.vue'));
 Vue.component('email-form', require('./components/login/email-form.vue'));
 Vue.component('reset-form', require('./components/login/reset-form.vue'));
 Vue.component('vue-questionnaire', require('./components/vue-questionnaire.vue'));
 Vue.component('admin-layout', require('./components/admin-layout.vue'));
 Vue.component('guest-layout', require('./components/guest-layout.vue'));

 Vue.component('vue-institutions', require('./components/vue-institutions.vue'));
 Vue.component('vue-courses', require('./components/vue-courses.vue'));

 const app = new Vue({
   el: '#app'
 });
