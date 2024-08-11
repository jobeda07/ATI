import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';
import DepartmentList from './components/DepartmentList.vue';

const app = createApp({});
app.component('department-list', DepartmentList);
app.mount('#app');



