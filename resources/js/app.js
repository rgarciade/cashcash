import Vue from 'vue'
import { router } from './routes.js'
import vuetify from './vuetify'
import App from './App.vue'
import store from "./storeVuex"
import Menu from './components/Menu';
Vue.component('Menu', Menu)

const app = new Vue({
    vuetify,
    store,
    router,
    data:{
        message: "hello vue!"
    },
    render: h => h(App),
    el: '#app',
});