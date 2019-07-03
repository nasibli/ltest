import api from './base-api.js';

export default {
    getPaginated(apiUrl, httpOptions) {
        return api.get(apiUrl, httpOptions);
    },
    getAll() {
        return api.get('/users');
    },
    get(id) {
        return api.get('/users/' + id);
    },
    save(user, id) {
        return api.post('/users' + (id ? '/' + id : ''), user);
    },
    remove(id) {
        return api.delete('/users/' + id);
    }
}
