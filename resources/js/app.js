import VueRouter from 'vue-router';

window.Vue = require('vue/dist/vue.js');

Vue.use(VueRouter);

import config from './config.js';

import AppUsers from './components/user/users.vue';
import AppUserForm from './components/user/user-form.vue';
import AppDepartments from './components/department/departments.vue';
import AppDepartmentForm from './components/department/department-form.vue';

const routes = [
    { path: '/users',          component: AppUsers},
    { path: '/user/:id',       component: AppUserForm},
    { path: '/departments',    component: AppDepartments},
    { path: '/department/:id', component: AppDepartmentForm}
];

const router = new VueRouter({ routes })

const app = new Vue({
    router,
    el: '#app',
    data: {
        config: config
    }
});

