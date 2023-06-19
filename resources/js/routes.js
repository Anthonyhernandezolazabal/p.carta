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
        path: "/navegation",
        name: "navegation.index",
        component: require("./components/modulos/Navegation/index.vue").default,
    },
    {
        path: "/sliders",
        name: "sliders.index",
        component: require("./components/modulos/Sliders/index.vue").default,
    },

    //MENÚS
    {
        path: "/menu01",
        name: "menus.menu01",
        component: require("./components/modulos/Menus/menu01.vue").default,
    },
    {
        path: "/menu02",
        name: "menus.menu02",
        component: require("./components/modulos/Menus/menu02.vue").default,
    },
    {
        path: "/menu03",
        name: "menus.menu03",
        component: require("./components/modulos/Menus/menu03.vue").default,
    },
    {
        path: "/menu04",
        name: "menus.menu04",
        component: require("./components/modulos/Menus/menu04.vue").default,
    },
    {
        path: "/menu05",
        name: "menus.menu05",
        component: require("./components/modulos/Menus/menu05.vue").default,
    },


]

export default new VueRouter({
    routes:rutas,
    mode: "history",
    linkExactActiveClass: 'active' //Activar el módulo donde estoy
    // linkActiveClass: 'active' //El módulo se mantenga seleccionado
})
