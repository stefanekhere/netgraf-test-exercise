// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('welcome', require('./Pages/Welcome.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});

