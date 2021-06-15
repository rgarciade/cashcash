const moment = require('moment');

moment.locale('es');
const mutations = {
    charging(state) {
        state.progresActive = true
    },
    charged(state) {
        state.progresActive = false
    },
    alert(state, msg) {
        state.alert = ''
        setTimeout(function(){  state.alert = msg }, 100);
       
    },
    /* 
        msg : {message,type}
     */
    alerts(state, msg) {
        if(!msg.type) msg.type = "success" 
        state.alerts.push({
            id: (Math.random().toString(36) + Date.now().toString(36)).substr(2),
            type: msg.type,
            message:msg.message
        })
    },
    removeAlert(state,id){
        state.alerts = state.alerts.filter(alet => {
            return alet.id != id
        })
    },
    articles(state, articlesResponse) {       
        state.articles = articlesResponse
    }
}

module.exports = mutations