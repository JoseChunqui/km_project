window.Vue = require('vue');
window.Vuetify = require('vuetify');
Vue.use(Vuetify);
Vue.component('admin-layout', require('../components/admin-layout.vue'));

const app = new Vue({
    el: '#app'
});
