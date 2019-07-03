<template>
    <div class="col col-6">
        <div class="card">
            <div class="card-header">
                User
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Surname</label>
                        <input v-model="user.surname" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="user.name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="user.email" type="email" class="form-control">
                        <small
                            v-for="error in errors.email"
                            class="help-block with-errors text-danger">
                            {{error}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input v-model="user.password" type="password" class="form-control">
                        <small
                                v-for="error in errors.password"
                                class="help-block with-errors text-danger">
                            {{error}}
                        </small>
                    </div>
                    <button v-on:click="submit" type="button" class="btn btn-primary">Submit</button>
                    <button v-on:click="goToUsers" type="button" class="btn btn-success pull-right">Go to Users</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import userApi from '../../api/user-api.js';

    export default {
        data() {
            return {
                userId: null,
                user: {
                    name: '',
                    surname: '',
                    email: '',
                    password: ''
                },
                errors: {}
            }
        },
        mounted() {
            if (this.$route.params.id) {
                userApi.get(this.$route.params.id).then((resp) => {
                    this.user = resp.data;
                    this.userId = this.$route.params.id;
                });
            }
        },
        methods: {
            submit() {
                userApi.save(this.user, this.userId)
                    .then((resp)=>{
                        if (resp.data === true) {
                            this.$router.push({name: 'users'});
                        }
                    })
                    .catch((resp)=>{
                        if(resp.response.data.errors) {
                            this.errors = resp.response.data.errors;
                        }
                    });
            },
            goToUsers() {
                this.$router.push({name: 'users'});
            }
        }
    }
</script>
