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
        state.articles.data = articlesResponse.data.data
        state.articles.articlesPerPage = articlesResponse.data.per_page
        state.articles.currentPage = articlesResponse.data.current_page
        state.articles.lastPage = articlesResponse.data.last_page
    },
}

module.exports = mutations