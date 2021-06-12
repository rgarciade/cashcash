const articlesActions = require('./articlesActions')
const createAlert = (store, text) => {
    store.commit('alert', '')
    store.commit('alert', text)
}
const actions = {
    generateAlert(store, text){
		createAlert(store,text)
	},
    ...articlesActions

}
module.exports =  actions