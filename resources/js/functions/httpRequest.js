import axios from "axios"
import store from "../storeVuex"
class httpRequest {
    static baseUrl = "/api"
    static post (url,data){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.post(`${this.baseUrl}/${url}`, data)
                .then(function (response) {
                    if(response.data.code != 200) reject(response)
                    resolver(response)
                    store.commit('charged')
                })
                .catch(function (error) {
                    reject(error)
                    store.commit('charged')
                })
        })
    }
    static get(url){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.get(`${this.baseUrl}/${url}`)
                .then(function (response) {
                    if(response.data.code != 200) reject(response)
                    resolver(response)
                    store.commit('charged')
                })
                .catch(function (error) {
                    reject(error)
                    store.commit('charged')
                })
        })
    }
}
export  { httpRequest }
