
const {httpRequest} = require('../../functions/httpRequest')
const articlesActions = {
    allArticles( store ) {
            try {
                httpRequest.get('articles').then(resp =>{
                    store.commit('articles', resp.data)
                })
                .catch(err =>{
                    console.log('error',err)
                })               
            } catch (error) {
                console.error(error)
                this.commit('alert', 'error al cargar los articulos')
            }
    },
    findArticles( store, textFinder ){
        if(textFinder == ''){
            this.dispatch('allArticles')
            return true
        }else if(textFinder.length < 3){
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
    saveArticles( store, args ){
        httpRequest.post(`articles`,args).then(resp =>{
            this.commit('alerts', {
                message:'articulo creado',
                type:'success'
            })
        })
        .catch(err =>{
            debugger
            console.log('error',err)
            let message = []
            let messageText = 'error al crear el articulo:'
            //let 
            if(err.data && err.data.msg) message.push(err.data.msg) 
            if(err.data && err.data.data  ){
                for (const key in err.data.data) {
                    message.push(`${key}: ${err.data.data[key]}`);
                }
               
             }
            if(message.length > 0){
                messageText = message.join('/n')
            }
            this.commit('alerts', {
                message:messageText,
                type:'error'
            })
        })
    },
    /**¡
     * args: {
     *  id,
     *  textFinder
     * }
     */
    deleteAndRechargeArticles( store, args ){
        httpRequest.delete(`articles/${args.id}`).then(resp =>{
            this.dispatch('findArticles',args.textFinder)
        })
        .catch(err =>{
            this.dispatch('findArticles',args.textFinder)
        })
    }
}
module.exports =  articlesActions