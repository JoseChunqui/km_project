
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
 Vue.use(Vuetify);

 Vue.component('login-form', require('./components/login/login-form.vue'));
 Vue.component('email-form', require('./components/login/email-form.vue'));
 Vue.component('reset-form', require('./components/login/reset-form.vue'));
 Vue.component('vue-questionnaire', require('./components/vue-questionnaire.vue'));
 Vue.component('admin-layout', require('./components/admin-layout.vue'));


 const app = new Vue({
   el: '#app'
 });
