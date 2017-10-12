window.Vue = require('vue');
window.Vuetify = require('vuetify');
Vue.use(Vuetify);
Vue.component('vue-questionnaire', require('../components/vue-questionnaire.vue'));

const app = new Vue({
    el: '#app'
});
