import VueRouter from 'vue-router';
import Vue from 'vue'
import Postlist from './components/PostListComponent';
import aaa from './components/aaa';


const routes = [
    { path: '/', component: Postlist },
    { path: '/aaa', name:'aaa', component: aaa },
    { path: '*', component: Postlist }
];
const menuRoutes = [
    { title: 'Punto de venta', icon: 'mdi-basket-fill', route: 'aaa' },
    { title: 'Facturación', icon: 'mdi-archive', route: '/Billing' },
    { title: 'tickets', icon: 'mdi-filmstrip', route: '/tickets' },
    { title: 'Articulos', icon: 'mdi-forklift', route: '/Articles' },
    { title: 'Empresas', icon: 'mdi-briefcase', route: '/Empresas' },
    { title: 'Cierre de caja', icon: 'mdi-sale', route: '/Moneybox' },
    { title: 'Configuración', icon: 'mdi-tune', route: '/ConfigView' },
]
Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    mode:'history'
})
export {
    router,
    menuRoutes
}