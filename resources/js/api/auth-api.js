import axios from 'axios'
import config from '../config';

function AuthAapi(endpoint) {

    return {
        login: login,
        logout: logout,
        getUser: getUser
    };

    function login(credentials) {
        return axios.post(
            endpoint + '/auth/login',
            credentials,
            {withCredentials: true}
        );
    }

    function logout() {
        return axios.get(endpoint + '/auth/logout',  {withCredentials: true});
    }
    
    function getUser() {
        return axios.get(endpoint + '/auth/user',  {withCredentials: true});
    }
}

export default new AuthAapi(config.endpoint);