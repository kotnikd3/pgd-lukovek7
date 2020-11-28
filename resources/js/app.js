
import './bootstrap';

import VueRouter from 'vue-router';
// import Axios from 'axios';
Vue.use(VueRouter);

let routes = [
    {
        path: '/',
        name: '/home',
        component: require('./views/News').default
    },
    {
        path: '/about',
        component: require('./views/About').default
    }
];

let routesPaths = routes.map(x => x.path); // ['/', '/about', ...]

const router = new VueRouter({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});


// Hack: kompromis med Vue Router in Laravel router.
router.beforeEach((to, from, next) => { 
    // Uporabi Vue Router.    
    next();
    /* 
        Minimal form (AND): !(A && B) && !(C && D)
        (A && B): seznam routesPath vsebuje PATH kamor gremo in PATH iz katerega pridemo
        (C && D): PATH iz katerega pridemo je '/' (npr. ce posljemo zahtevo na streznik) in IME te poti ni '/home' (ce pridemo iz '/' v routes))
    */
    if (!(routesPaths.includes(to.path) && routesPaths.includes(from.path)) && !(from.path == '/' && from.name != '/home')) {
        router.go();
    }
});

Vue.component('confirmbutton', require('./components/ConfirmButton.vue').default);
Vue.component('addimages', require('./components/AddImages.vue').default);
Vue.component('lightbox', require('./components/Lightbox.vue').default);
Vue.component('tag', require('./components/Tag.vue').default);
Vue.component('fileupload', require('./components/FileUpload.vue').default);

const app = new Vue({
    el: '#app',
    router,
    data: {
        tabWeather: 'danes'
    },
    methods: {
        logout() {
            console.log("Logout.");
            axios.post('/logout')
                .then(response => {
                    router.go();
                });
        },
        showLightbox(index) {
            Event.$emit('showLightbox', index);
        },
        changeTagColor(newstype) {
            Event.$emit('changeTagColor', newstype);
        }
    }
});
