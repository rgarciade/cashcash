import axios from "axios"

class httpRequest {
    static baseUrl = "/api"
    static post (url,data){
        return new Promise((resolver, reject) => {
            axios.post(`${this.baseUrl}/${url}`, data)
                .then(function (response) {
                    resolver(response)
                })
                .catch(function (error) {
                    reject(error)
                })
        })
    }
    static get(url){
        return new Promise((resolver, reject) => {
            axios.get(`${this.baseUrl}/${url}`)
                .then(function (response) {
                    resolver(response)
                })
                .catch(function (error) {
                    reject(error)
                })
        })
    }
}
export  { httpRequest }
