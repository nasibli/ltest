import axios from 'axios'
import config from '../config';

function DepartmentApi(endpoint) {

    return {
        get: get,
        save: save,
        remove: remove,
    };

    function get(id) {
        return axios.get(endpoint + '/departments/' + id, {withCredentials:true});
    }

    function save(department, users, id, file) {
        let url = endpoint + '/departments' + (id ? '/' + id : '');

        let formData = new FormData();

        formData.append('file',  file);
        formData.append('department', JSON.stringify(department));
        formData.append('users', JSON.stringify(users));

        return axios.post(
            url,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                withCredentials:true
            }
        );
    }

    function remove(id) {1
        return axios.delete(endpoint + '/departments/' + id, {withCredentials:true});
    }
}

export default new DepartmentApi(config.endpoint);