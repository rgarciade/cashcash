import VueRouter from 'vue-router';
import Vue from 'vue'
import Postlist from './components/PostListComponent';


const routes = [
    { path: '/', component: Postlist },
    { path: '*', component: Postlist }
];
Vue.use(VueRouter);
export default new VueRouter({
    routes,
    mode:'history'
})