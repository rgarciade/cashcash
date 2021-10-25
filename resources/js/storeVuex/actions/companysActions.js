const { httpRequest } = require('../../functions/httpRequest')
const companysActions = {
	findCompanys(store, textFinder) {
		if (textFinder.length < 3) {
			store.commit('companys', {})
			return false
		}

		httpRequest
			.get(`companys/someField/${textFinder}`)
			.then((resp) => {
				store.commit('companys', resp.data.data)
			})
			.catch((err) => {
				console.log('error', err)
				let message = err.data.msg
					? err.data.msg
					: 'error al cargar las compañias'
				let type = err.data.msg ? 'info' : 'error'
				this.commit('alerts', {
					message,
					type
				})
			})
	},
	createCompany(store, companyData) {
		httpRequest
			.post(`companys`, companyData)
			.then((resp) => {
				this.commit('alerts', {
					message: 'compañia creada',
					type: 'success'
				})
			})
			.catch((err) => {
				console.log('error', err)
				let message = err.data.msg
					? err.data.msg
					: 'error al crear la compañia'
				let type = err.data.msg ? 'info' : 'error'
				this.commit('alerts', {
					message,
					type
				})
			})
	}
}
module.exports = companysActions
