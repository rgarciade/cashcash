import Vue from 'vue'
import router from './routes.js'
import vuetify from './vuetify'
import App from './App.vue'


const app = new Vue({
    vuetify,
    router,
    data:{
        message: "hello vue!"
    },
    render: h => h(App),
    el: '#app',
});