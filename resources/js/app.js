import VueRouter from 'vue-router';

window.Vue = require('vue/dist/vue.js');

Vue.use(VueRouter);
Vue.use(Vuetable);

import AppUsers from './components/user/users.vue';
import AppUserForm from './components/user/user.vue';
import AppDepartments from './components/department/departments.vue';
import AppDepartmentForm from './components/department/department-form.vue';
import authApi from './api/auth-api.js';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'font-awesome/css/font-awesome.min.css';
import 'bootstrap/js/dist/dropdown.js';

const routes = [
    {
        path: '/',
        component: AppUsers,
        name: 'main'
    },
    {
        path: '/users',
        component: AppUsers,
        name: 'users'
    },
    {
        path: '/user/:id',
        component: AppUserForm,
        name: 'users.edit'
    },
    {
        path: '/user',
        component: AppUserForm,
        name: 'users.create'
    },
    {
        path: '/departments',
        component: AppDepartments,
        name: 'departments'
    },
    {
        path: '/department/:id',
        component: AppDepartmentForm,
        name: 'department'
    }
];

const router = new VueRouter({ routes })

const app = new Vue({
    router,
    el: '#app',
    components:{
        'vuetable-pagination': Vuetable.VuetablePagination,
        'custome-actions'    : Vuetable.CustomActions
    },
    data() {
         return {
             user: {}
         }
    },
    methods: {
        logout() {
            authApi.logout().then((resp)=>{
                if (resp.data === true) {
                   window.location.replace("http://"+window.location.hostname);
                }
            });
        }
    },
    mounted(){
        authApi.getUser().then((resp)=>{
            this.user = resp.data;
        });
    }
});

