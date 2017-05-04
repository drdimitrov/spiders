
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 

Vue.component('author', require('./components/search/Authors.vue'));
Vue.component('author-select', require('./components/search/ChooseAuth.vue'));
Vue.component('paper-select', require('./components/search/Papers.vue'));
Vue.component('family-select', require('./components/search/Families.vue'));
Vue.component('genus-select', require('./components/search/Genera.vue'));

const app = new Vue({
    el: '#app'
});


