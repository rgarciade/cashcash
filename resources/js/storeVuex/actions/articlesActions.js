
const {httpRequest} = require('../../functions/httpRequest')
const articlesActions = {
    allArticles( store, args ) {
        //debugger
            const text = (args != undefined && args.hasOwnProperty('textFinder'))? args.textFinder : ""
            try {
                
                store.commit("charging")
                httpRequest.get('articles').then(resp =>{
                    store.commit('articles', resp.data)
                    console.log('okk',resp)
                })
                .catch(err =>{
                    //debugger
                    console.log('okk',err)
                })
              /*   if (text != '' && text) {
                    store.commit('articles', await DB_Articles.findArticles(text))
                } else if ( (findAll && (text == "")) || text == null) {
                    store.commit('articles', await DB_Articles.findAllArticles())
                }else if (text == "") {
                    store.commit('articles', [])
                } */
               // store.commit('charged')
            } catch (error) {
                console.error(error)
            }
    },
    findArticles( store, textFinder ){
        debugger
        console.log(textFinder)
    }
}
module.exports =  articlesActions