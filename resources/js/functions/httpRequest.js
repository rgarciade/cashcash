import axios from "axios"
import store from "../storeVuex"
import { router } from "../routes";
class httpRequest {
    static baseUrl = "/api"
    static post (url,data){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.post(`${this.baseUrl}/${url}`, data, getHeaders())
                .then(function (response) {
                   manageGoodResponse(resolver,reject,response)
                })
                .catch(function (error) {
                    checkUnauthorized(error)
                    reject(error)
                    store.commit('charged')
                })
        })
    }
    static path (url,data){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.patch(`${this.baseUrl}/${url}`, data, getHeaders())
                .then(function (response) {
                    manageGoodResponse(resolver,reject,response)
                })
                .catch(function (error) {
                    checkUnauthorized(error)
                    reject(error)
                    store.commit('charged')
                })
        })
    }
    static get(url){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.get(`${this.baseUrl}/${url}`,getHeaders())
                .then(function (response) {
                    manageGoodResponse(resolver,reject,response)
                })
                .catch(function (error,aa) {
                    checkUnauthorized(error)
                    reject(error)
                    store.commit('charged')
                })
        })
    }
    static delete(url){
        return new Promise((resolver, reject) => {
            store.commit('charging')
            axios.delete(`${this.baseUrl}/${url}`,getHeaders())
                .then(function (response) {
                    manageGoodResponse(resolver,reject,response)
                })
                .catch(function (error) {
                    checkUnauthorized(error)
                    reject(error)
                    store.commit('charged')
                })
        })
    }
}
const manageGoodResponse = (resolver,reject,response) => {
    if((response && response.data && response.data.code === 200) || ((!response.data || !response.data.code) && response.status === 200)){
        resolver(response)
        store.commit('charged')
    }
    reject(response)
}
const getHeaders = () =>{
    if(store.state.accessToken === ''){
        return {}
    }
    return {
        headers: {
            "Content-Type": "application/json",
            "Authorization": 'Bearer ' + store.state.accessToken
        }
    }
}
const checkUnauthorized = (error) => {
    if(error && error.response && error.response.statusText === 'Unauthorized'){
        router.push("/login");
    }
}
export  { httpRequest }
