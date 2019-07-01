import axios from 'axios'
import config from '../config';

function AuthAapi(endpoint) {

    return {
        login: login
    };

    function login(credentials) {
        return axios.post(
            endpoint + '/auth/login',
            credentials,
            {withCredentials: true}
        );
    }
}

export default new AuthAapi(config.endpoint);