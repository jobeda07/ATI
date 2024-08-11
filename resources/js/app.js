import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Vue from 'vue';
import DepartmentList from './components/DepartmentList.vue';

new Vue({
    el: '#app',
    components: { DepartmentList }
});


