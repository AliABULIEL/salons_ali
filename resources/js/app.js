/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
Vue.use(VueAwesomeSwiper, /* { default options with global component } */)

import PortalVue from 'portal-vue'
Vue.use(PortalVue)

import AudioVisual from 'vue-audio-visual'
Vue.use(AudioVisual)

import VueWeather from "vue-weather-widget";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('navigation', require('./components/Navigation.vue').default);
Vue.component('slider', require('./components/Slider.vue').default);
Vue.component('brands', require('./components/Brands.vue').default);
Vue.component('slide-over', require('./components/SlideOver.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('player', require('./components/Player.vue').default);
Vue.component('bars', require('./components/Bars.vue').default);
Vue.component('categories', require('./components/Categories.vue').default);

Vue.prototype.__ = (key) => {
	return window.translations[key] || key;
}

const app = new Vue({
    components: {
      VueWeather,
    },
    el: '#app',
    data() {
        return {
            locale: window.locale,
            activePrestenter: false,
        }
    },

    methods: {
        showPrestenter(name, image) {
            this.activePrestenter = {
                name: name,
                image: image
            }
        }
    }

});