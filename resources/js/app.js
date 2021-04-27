/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueNoty from 'vuejs-noty'
Vue.use(VueNoty)
import 'vuejs-noty/dist/vuejs-noty.css'

import VueSweetAlert from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
Vue.use(VueSweetAlert)

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,{
    symbol: 'Rp.',
    thousandsSeparator: '.',
    fractionCount: 2,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('navbar-petugas', require('./components/NavbarPetugas.vue').default);
Vue.component('navbar-user', require('./components/NavbarUser.vue').default);
Vue.component('footer-comp', require('./components/FooterComponent.vue').default);
Vue.component('register-admin-component', require('./components/register.vue').default);

const HomePage = require('./component-menu/home.vue').default
const HomePagePetugas = require('./component-menu/home_petugas.vue').default
const spp = require('./component-menu/Spp.vue').default
const kelas = require('./component-menu/kelas.vue').default
const petugas = require('./component-menu/Petugas.vue').default
const siswa = require('./component-menu/Siswa.vue').default
const DetailSiswa = require('./component-menu/DetailSiswa.vue').default
const Siswa = require('./component-menu/SiswaPetugas.vue').default
const DetailSiswaPetugas = require('./component-menu/DetailSiswaPetugas.vue').default
const transaksi = require('./component-menu/Transaksi.vue').default
const bayar = require('./component-menu/Bayar.vue').default
const RegistAdmin = require('./component-menu/registerAdmin.vue').default
const History = require('./component-menu/History.vue').default
const HistoryUser = require('./component-menu/HistoryUser.vue').default
const Laporan = require('./component-menu/Cetak.vue').default
const NotFound = require('./components/NotFound.vue').default


// login
// const NavAdmin = require('./components/NavbarComponent.vue').default
// const NavPetugas = require('./components/NavbarPetugas.vue').default
// const NavUser = require('./components/NavbarUser.vue').default

// body
const rout = [
    {
        name: 'home',
        path: '/home',
        component: HistoryUser
    },
    {
        name: 'home_petugas',
        path: '/home_petugas',
        component: HomePagePetugas
    },
    {
        name: 'home-admin',
        path: '/home-admin',
        component: HomePage
    },
    {
        name: 'spp',
        path: '/spp',
        component: spp
    },
    {
        name: 'kelas',
        path: '/kelas',
        component: kelas
    },
    {
        name: 'petugas',
        path: '/petugas',
        component: petugas
    },
    {
        name: 'siswa',
        path: '/siswa',
        component: siswa
    },
    {
        name: 'DetailSiswa',
        path: '/siswa/detail/:id?',
        component: DetailSiswa,
        props: true
    },
    {
        name: 'Siswa',
        path: '/Siswa',
        component: Siswa
    },
    {
        name: 'SiswaDetail',
        path: '/Siswa/detail/:id',
        component: DetailSiswaPetugas,
        props: true
    },
    {
        name: 'transaksi',
        path: '/transaksi',
        component: transaksi
    },
    {
        name: 'history',
        path: '/history',
        component: History
    },
    {
        name: 'historyPetugas',
        path: '/history-petugas',
        component: HistoryUser
    },
    {
        name: 'bayar',
        path: '/transaksi/:nisn?',
        component: bayar,
        props: true
    },
    {
        name: 'laporan',
        path: '/laporan/:id?',
        component: Laporan,
        props: true
    },
    {
        name: 'registerAdmin',
        path: '/register-admin',
        component: RegistAdmin,
    },
    {
        path: '*',
        component: NotFound
    }
];

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: rout
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
