const articlesActions = require('./articlesActions')
const companysActions = require('./companysActions')
const { router }  = require('../../routes')
const {httpRequest} = require("../../functions/httpRequest");
const createAlert = (store, text) => {
    store.commit('alert', '')
    store.commit('alert', text)
}
const actions = {
    removeAlert(store, id){
        this.commit('removeAlert', id)
    },
    loginToApi(store,data){
        httpRequest.post(`auth/login`,
        {
            "email": data.email,
            "password": data.password
        }).then(resp =>{
            this.commit('addAccessToken', resp.data.access_token)
            router.push("/");
            this.commit('alerts', {
                message:'logueado',
                type:'success'
            })
        }).catch(err =>{
                console.log('error',err)
                let message = (err.data.msg)? err.data.msg : 'Authenticated Error'
                let type = (err.data.msg)? 'info': 'error'
                this.commit('alerts', {
                    message,
                    type
                })
            })
    },
    ...articlesActions,
    ...companysActions

}
module.exports =  actions
