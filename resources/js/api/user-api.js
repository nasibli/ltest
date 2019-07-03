import axios from 'axios'
import config from '../config';

function UserApi(endpoint) {

    return {
        get: get,
        save: save,
        remove: remove,
        getAll: getAll
    };

    function getAll() {
        return axios.get(endpoint + '/users', {withCredentials:true});
    }

    function get(id) {
        return axios.get(endpoint + '/users/' + id, {withCredentials:true});
    }

    function save(user, id) {
        let url = endpoint + '/users' + (id ? '/' + id : '');
        return axios.post(url, user, {withCredentials:true})
    }

    function remove(id) {
        return axios.delete(endpoint + '/users/' + id, {withCredentials:true});
    }
}

export default new UserApi(config.endpoint);