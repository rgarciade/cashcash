const articlesActions = require('./articlesActions')
const createAlert = (store, text) => {
    store.commit('alert', '')
    store.commit('alert', text)
}
const actions = {
    removeAlert(store, id){
        this.commit('removeAlert', id)
    },
    ...articlesActions

}
module.exports =  actions