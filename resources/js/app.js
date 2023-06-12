require('./bootstrap');

window.Vue = require('vue').default;

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/layouts/Navbar.vue').default);
Vue.component('sidebar-component', require('./components/layouts/Sidebar.vue').default);



import router from './routes';
const app = new Vue({
    el: '#app',
    router
});
