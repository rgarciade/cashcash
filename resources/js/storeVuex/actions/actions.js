const articlesActions = require('./articlesActions')
const companysActions = require('./companysActions')
const createAlert = (store, text) => {
    store.commit('alert', '')
    store.commit('alert', text)
}
const actions = {
    removeAlert(store, id){
        this.commit('removeAlert', id)
    },
    ...articlesActions,
    ...companysActions

}
module.exports =  actions