const moment = require('moment');

moment.locale('es');
const mutations = {
    charging(state) {
        state.progresActive = true
    },
    charged(state) {
        state.progresActive = false
    },
    articles(state, articlesResponse) {
		let temporalState = []
/*         finded.forEach(function(element) {
            element.price_without_vat = addIvaToPrice(element.purchase_price, state.config.vat)
            element.public_price_without_vat = basePrice(element.public_price, state.config.vat)
            temporalState.push(element)
        }); */
        
        state.articles.data = articlesResponse.data.data
        state.articles.articlesPerPage = articlesResponse.data.per_page
        state.articles.currentPage = articlesResponse.data.current_page
        state.articles.lastPage = articlesResponse.data.last_page
    },
}

module.exports = mutations