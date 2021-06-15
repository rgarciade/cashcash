
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
        if(textFinder == '') return
        httpRequest.get(`articles/find=${textFinder}`).then(resp =>{
            store.commit('articles', resp.data)
        })
        .catch(err =>{
            console.log('error',err)
            this.commit('alerts', 'error al cargar los articulos')
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
            console.log('error',err)
            this.commit('alerts', {
                message:`error al crear el articulo`,
                type:'error'
            })
        })
    }
}
module.exports =  articlesActions