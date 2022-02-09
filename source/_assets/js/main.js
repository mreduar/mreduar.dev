window.axios = require('axios');
import Vue from 'vue';
import Search from './components/Search.vue';
import * as particlesJson from './particles-config'
import {tsParticles} from "tsparticles";

tsParticles.load('body', particlesJson);

Vue.config.productionTip = false;

new Vue({
    components: {
        Search,
    },
}).$mount('#vue-search');

