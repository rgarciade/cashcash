import Vue from 'vue'
import router from './routes.js'

require('./bootstrap');

const app = new Vue({
    el: '#app',
    router,
    data:{
        message: "hello vue!"
    }
});