import api from './base-api.js';

export default {
    get(id) {
        return api.get('/departments/' + id);
    },
    getPaginated(apiUrl, httpOptions) {
        return api.get(apiUrl, httpOptions);
    },
    save(department, users, id, file) {
        let url = '/departments' + (id ? '/' + id : '');

        let formData = new FormData();

        formData.append('file',  file);
        formData.append('department', JSON.stringify(department));
        formData.append('users', JSON.stringify(users));

        return api.post(
            url,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }
        );
    },
    remove(id) {1
        return api.delete('/departments/' + id);
    }
}

