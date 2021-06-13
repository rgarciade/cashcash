import Vue from 'vue'
import { router } from './routes.js'
import vuetify from './vuetify'
import App from './App.vue'
import store from "./storeVuex"
import Menu from './components/Menu';
import progress from './components/progress';
import Alerts from './components/alerts';

Vue.component('Menu', Menu)
Vue.component('Progress', progress)
Vue.component('Alerts', Alerts)

new Vue({
    vuetify,
    store,
    router,
    data:{
        message: "hello vue!"
    },
    render: h => h(App),
    el: '#app',
});