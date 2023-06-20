require('./bootstrap');

window.Vue = require('vue').default;

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import CKEditor from 'ckeditor4-vue'

Vue.use(ElementUI);
Vue.use(CKEditor);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/layouts/Navbar.vue').default);
Vue.component('sidebar-component', require('./components/layouts/Sidebar.vue').default);


Vue.component('NavegationMenu-component', require('./components/modulos/Navegation/menu.vue').default);
Vue.component('NavegationLogo-component', require('./components/modulos/Navegation/logo.vue').default);



import router from './routes';
const app = new Vue({
    el: '#app',
    router
});
