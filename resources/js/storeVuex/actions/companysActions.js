
const {httpRequest} = require('../../functions/httpRequest')
const companysActions = {
    findCompany( store, textFinder ){
        if(textFinder.length < 3){
            return false
        }
        httpRequest.get(`articles/find=${textFinder}`).then(resp =>{
            store.commit('articles', resp.data)
        })
        .catch(err =>{
            console.log('error',err)
            let message = (err.data.msg)? err.data.msg : 'error al cargar los articulos'
            let type = (err.data.msg)? 'info': 'error'
            this.commit('alerts', {
                message,
                type
            })
        })
    },
}
module.exports =  companysActions