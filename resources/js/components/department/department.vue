<template>
    <div class="col col-6">
        <div class="card">
            <div class="card-header">
                Department
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="department.name" type="text" class="form-control">
                        <small
                                v-for="error in errors['department.name']"
                                class="help-block with-errors text-danger">
                            {{error}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea v-model="department.description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input v-on:change="handleFileUpload()" ref="file" type="file" class="form-control-file">
                        <small
                                v-for="error in errors.file"
                                class="help-block with-errors text-danger">
                            {{error}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Users</label>
                        <div v-for="user in department.users" class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="user.checked">
                            <label class="form-check-label">
                                {{ user.name }} {{ user.surname }} ({{user.email}})
                            </label>
                        </div>
                        <small
                                v-for="error in errors.users"
                                class="help-block with-errors text-danger">
                            {{error}}
                        </small>
                    </div>
                    <button v-on:click="submit" type="button" class="btn btn-primary">Submit</button>
                    <button v-on:click="gotoDepartments" type="button" class="btn btn-success pull-right">Go to Departments</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import userApi from '../../api/user-api.js';
    import depApi from '../../api/department-api.js';

    export default {
        data() {
            return {
                department: {
                    name: '',
                    description: '',
                    logo: '',
                    users: []
                },
                departmentId: null,
                errors: {}
            }
        },
        methods: {
            submit () {
                let depData = {
                    name: this.department.name,
                    description: this.department.description,
                }

                let users = this.department.users.filter(user => user.checked === true).map(user=>user.id);
                depApi.save(depData, users, this.departmentId, this.file)
                    .then((resp) => {
                        if (resp.data === true) {
                            this.gotoDepartments();
                        }
                    })
                    .catch((resp)=>{
                        if(resp.response.data.errors) {
                            this.errors = resp.response.data.errors;
                        }
                    });
            },
            gotoDepartments() {
                this.$router.push({name: 'departments'});
            },
            initUsers() {
                userApi.getAll().then((resp)=>{
                    if (this.departmentId && this.department.users) {
                        resp.data.forEach((user) => {
                            if (this.department.users.find(depUser => depUser.id === user.id)) {
                                user.checked = true;
                            }
                        });
                    }
                    this.department.users = resp.data;
                });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        },
        mounted() {
            if (this.$route.params.id) {
                this.departmentId = this.$route.params.id;
                depApi.get(this.departmentId).then((resp) => {
                    this.department = resp.data;
                    this.initUsers();
                });
            } else {
                this.initUsers();
            }
        }
    }
</script>

<style scoped>

</style>