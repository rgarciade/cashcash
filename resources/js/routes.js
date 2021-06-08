import VueRouter from 'vue-router';
import Vue from 'vue'
import Postlist from './components/PostListComponent';
import aaa from './components/aaa';


const routes = [
    { path: '/', component: Postlist },
    { path: '/aaa', name:'aaa', component: aaa },
    { path: '*', component: Postlist }
];
Vue.use(VueRouter);
export default new VueRouter({
    routes,
    mode:'history'
})