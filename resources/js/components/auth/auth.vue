<template>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="card">
                <h4 class="card-header">Login</h4>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" v-if="credentialsError">
                        Incorrect password or email
                    </div>
                    <form data-toggle="validator" role="form" method="post" action="#">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
                                        </div>
                                        <input v-model="user.email" type="text" class="form-control" name="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                                        </div>
                                        <input v-model="user.password" type="password" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input v-on:click="login" v-bind:disabled="! isValidCredentials()" type="button" class="btn btn-primary btn-lg btn-block" value="Login" >
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import authApi from '../../api/auth-api.js';

    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                },
                credentialsError: false
            };
        },
        methods: {
            login() {
                authApi.login(this.user).then((resp) => {
                    if (resp.data === true) {
                        window.location.replace("http://"+window.location.hostname);
                    } else {
                        this.credentialsError = true;
                    }
                })
            },
            isValidCredentials() {
                if (this.user.email.length === 0 ||  ! /\S+@\S+\.\S+/.test(this.user.email)) {
                    return false;
                }
                if (this.user.password.length === 0) {
                    return false;
                }
                return true;
            }
        }
    }
</script>

<style scoped>
    .card {
        margin-top: 50px;
    }
</style>
