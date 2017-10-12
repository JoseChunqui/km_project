window.Vue = require('vue');
window.Vuetify = require('vuetify');
Vue.use(Vuetify);
Vue.component('login-form', require('../components/login/login-form.vue'));

const app = new Vue({
    el: '#app'
});
