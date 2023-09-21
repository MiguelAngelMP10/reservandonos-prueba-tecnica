import './bootstrap';
import { createApp } from 'vue'
import List from '../components/List.vue'

window.app = createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
        List
    },
}).mount('#app');