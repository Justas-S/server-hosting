
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
console.log(document.querySelector('#csrf-token').getAttribute('content'));

Vue.component('order-view', require('./components/order/create.vue'));
Vue.component('gameserver-management-form', require('./components/gameserver/management.vue'));
Vue.component('auth-modal', require('./components/auth/auth-modal.vue'));

//Vue.component('example', require('./components/Example.vue'));
//Vue.component('test', require('./components/Test.vue'));
//Vue.component('server-form', require('./components/server/server.vue'));

const app = new Vue({
    el: '#app',
});
