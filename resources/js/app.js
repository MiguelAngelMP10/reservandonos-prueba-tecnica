import './bootstrap';

import {createApp} from 'vue'
import router from './router/index.js' // <---


import List from '../components/List.vue';
import Detalles from "../components/Detalles.vue";
import App from "../components/App.vue";


window.app = createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
        List,
        Detalles,
        App
    },
}).use(router).mount('#app');