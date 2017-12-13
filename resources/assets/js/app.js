
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'vuetify/dist/vuetify.min.css'

import Notifications from 'vue-notification'

require('./libraries');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 window.moment = require('moment');
 window.Vue = require('vue');
 window.Vuetify = require('vuetify');
 // window.VeeValidate = require('vee-validate');
 import VeeValidate, { Validator } from 'vee-validate';
 import m_es from 'vee-validate/dist/locale/es';
 Validator.localize('es',m_es);
 const config = {
  errorBagName: 'vee_errors', // change if property conflicts.
  fieldsBagName: 'fields',
  delay: 0,
  locale: 'es',
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
  aria: true,
};
 Vue.use(Notifications)
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
 Vue.component('vue-users', require('./components/vue-users.vue'));
 Vue.component('vue-forms', require('./components/vue-forms.vue'));
 Vue.component('vue-answers', require('./components/vue-answers.vue'));
 Vue.component('vue-home', require('./components/vue-home.vue'));
 Vue.component('vue-guest-message', require('./components/vue-guest-message.vue'));

 const app = new Vue({
   el: '#app'
 });
