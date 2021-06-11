import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
//import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'
import '../../css/app.css'

Vue.use(Vuetify)
Vue.use(Vuetify, {
    iconfont: 'md',
    theme: {
        primary: "#37474F",
        secondary: "#424242",
        accent: "#F57C00",
        error: "#FF5252",
        warning: "#FDD835",
        info: "#82B1FF",
        success: "#81C784"
    }
})
const opts = {}

export default new Vuetify(opts)