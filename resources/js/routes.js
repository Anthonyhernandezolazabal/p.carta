import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export const rutas = [
    {
        path: "/home",
        name: "dashboard.index",
        component: require("./components/modulos/Dashboard/index.vue").default,
    },
    {
        path: "/usuarios",
        name: "usuarios.index",
        component: require("./components/modulos/Usuarios/index.vue").default,
    },
    {
        path: "/sliders",
        name: "sliders.index",
        component: require("./components/modulos/Sliders/index.vue").default,
    },

]

export default new VueRouter({
    routes:rutas,
    mode: "history",
    linkExactActiveClass: 'active' //Activar el módulo donde estoy
    // linkActiveClass: 'active' //El módulo se mantenga seleccionado
})
