import Vue from 'vue'
import { router } from './routes.js'
import vuetify from './vuetify'
import App from './App.vue'
import store from './storeVuex'
import Menu from './components/Menu'
import progressBar from './components/progressBar'
import alertsList from './components/alertsList'
import newCompany from './components/newCompany'

Vue.component('Menu', Menu)
Vue.component('ProgressBar', progressBar)
Vue.component('AlertsList', alertsList)
Vue.component('NewCompany', newCompany)

new Vue({
	vuetify,
	store,
	router,
	data: {
		message: 'hello vue!'
	},
	render: (h) => h(App),
	el: '#app'
})
