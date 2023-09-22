import {createWebHistory, createRouter} from "vue-router";
import List from '../../components/List.vue';
import Detalles from "../../components/Detalles.vue";
import Home from "../../components/Home.vue"

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/list",
        name: "List",
        component: List,
    },
    {
        path: "/detalle/:id",
        name: "Detalles",
        component: Detalles,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;