const articlesActions = require('./articlesActions')
const companysActions = require('./companysActions')
const { router } = require('../../routes')
const { httpRequest } = require('../../functions/httpRequest')
const createAlert = (store, text) => {
	store.commit('alert', '')
	store.commit('alert', text)
}
const actions = {
	removeAlert(store, id) {
		this.commit('removeAlert', id)
	},
	logoutToApi() {
		this.commit('addAccessToken', '')
		router.push('/login')
	},
	loginToApi(store, data) {
		httpRequest
			.post(`auth/login`, {
				email: data.email,
				password: data.password
			})
			.then((resp) => {
				this.commit('addAccessToken', resp.data.data.access_token)
				router.go(-1)
				this.commit('alerts', {
					message: 'logueado',
					type: 'success'
				})
			})
			.catch((err) => {
				let message =
					err.data && err.data.msg
						? err.data.msg
						: err.response &&
						  err.response.data &&
						  err.response.data.message
						? err.response.data.message
						: null
						? err.response.data.message
						: 'Error'
				let type = message ? 'info' : 'error'
				this.commit('alerts', {
					message,
					type
				})
			})
	},
	...articlesActions,
	...companysActions
}
module.exports = actions
