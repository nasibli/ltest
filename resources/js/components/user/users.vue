<template>
    <div class="card">
        <div class="card-header">
            Users
            <button v-on:click="create" type="button" class="btn btn-success pull-right">Create</button>
        </div>
        <div class="card-body">
            <br />
            <vuetable ref="vuetable"
                      v-bind:api-url="endpoint"
                      :fields="fields"
                      :per-page="6"
                      pagination-path=""
                      @vuetable:pagination-data="onPaginationData">

                <template slot="actions" scope="props">
                    <div class="custom-actions">
                        <button @click="edit(props.rowData.id)" class="btn btn-xs">
                            <i class="edit icon"></i>
                        </button>
                        <button @click="remove(props.rowData)" class="btn btn-xs">
                            <i class="delete icon"></i>
                        </button>
                    </div>
                </template>

            </vuetable>
            <br />
        </div>
        <div class="card-footer">
            <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage">
            </vuetable-pagination>
        </div>
        <div class="modal fade" id="delete-window" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Удаление</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Удалить пользователя <strong>{{ deleteUser.email }}</strong> ?
                    </div>
                    <div class="modal-footer">
                        <button @click="confirmRemove" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import config from '../../config.js';
    import userApi from '../../api/user-api.js';

    import 'bootstrap/js/dist/modal.js';
    export default {
        data () {
            return {
                endpoint: config.endpoint + '/users?page=1',
                deleteUser: {},
                fields: [
                    'name', 'surname', 'email',
                    {
                        name: 'created_at',
                        title: 'Created',
                        dataClass: 'text-center'
                    },
                    {
                        name: 'updated_at',
                        title: 'Updated',
                        dataClass: 'text-center'
                    },
                    {
                        name: '__slot:actions',
                        title: 'Actions',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                    }
                ]
            }
        },
        methods: {
            create() {
                this.$router.push({'name': 'users.create'});
            },
            edit(id) {
                this.$router.push({'name': 'users.edit', params: {id: id}});
            },
            remove(user) {
                this.deleteUser = user;
                $('#delete-window').modal('show');
            },
            confirmRemove() {
                userApi.remove(this.deleteUser.id).then((resp)=>{
                    if (resp.data === true) {
                        $('#delete-window').modal('hide');
                        this.$refs.vuetable.reload();
                    }
                });
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            }
        }
    }
</script>
<style scoped>
    .card {
        margin-rop: 10px;
    }
</style>
