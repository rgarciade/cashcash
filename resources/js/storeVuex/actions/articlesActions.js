
const {httpRequest} = require('../../functions/httpRequest')
const articlesActions = {
    allArticles( store ) {
            try {
        
                httpRequest.get('articles').then(resp =>{
                    store.commit('articles', resp.data)
                    console.log('okk',resp)
                })
                .catch(err =>{
                    //debugger
                    console.log('error',err)
                })               
            } catch (error) {
                console.error(error)
            }
    },
    findArticles( store, textFinder ){
        console.log(textFinder)
        if(textFinder == ''){
            store.dispatch('allArticles', textFinder)
            return;
        }
        httpRequest.get(`articles/find=${textFinder}`).then(resp =>{
            store.commit('articles', resp.data)
            console.log('okk',resp)
        })
        .catch(err =>{
            console.log('error',err)
        })
       
    }
}
module.exports =  articlesActions