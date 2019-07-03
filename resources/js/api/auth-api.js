import api from './base-api.js';

export default {
    login (credentials) {
        return api.post('/auth/login', credentials);
    },
    logout () {
        return api.get('/auth/logout');
    },
    getUser() {
        return api.get('/auth/user');
    }
}
