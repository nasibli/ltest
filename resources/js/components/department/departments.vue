<template>
    <div class="card">
        <div class="card-header">
            Departments
            <button v-on:click="create" type="button" class="btn btn-success pull-right">Create</button>
        </div>
        <div class="card-body">
            <br />
            <vuetable ref="vuetable"
                      v-bind:api-url="endpoint"
                      :per-page="6"
                      :fields="fields"
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
                        Удалить отдел <strong>{{ deleteDepartment ? deleteDepartment.name : ''}} </strong>
                        ({{ getUsersCount() }} пользователей)?
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
    import departmentApi from '../../api/department-api.js';

    import 'bootstrap/js/dist/modal.js';

    export default {
        data () {
            return {
                endpoint: config.endpoint + '/departments?page=1&per_page=5',
                deleteDepartment: {},
                fields: [
                    {
                        title: 'Logo',
                        titleClass: 'text-center',
                        name: 'logo',
                        callback: this.renderLogo
                    },
                    {
                        title: 'Info',
                        titleClass: 'text-center',
                        name: 'info',
                        callback: this.renderInfo
                    },
                    {
                        title: 'Users',
                        titleClass: 'text-center',
                        name: 'users',
                        callback: this.renderUsers
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
                this.$router.push({'name': 'departments.create'});
            },
            edit(id) {
                this.$router.push({'name': 'departments.edit', params: {id: id}});
            },
            remove(department) {
                this.deleteDepartment = department;
                $('#delete-window').modal('show');
            },
            confirmRemove() {
                departmentApi.remove(this.deleteDepartment.id).then((resp)=>{
                    if (resp.data === true) {
                        $('#delete-window').modal('hide');
                        this.$refs.vuetable.reload();
                    }
                });
            },
            getUsersCount(){
                return this.deleteDepartment && this.deleteDepartment.users ? this.deleteDepartment.users.length : 0;
            },
            transform(pagination){
                for (let i = 0; i < pagination.data.length; i++) {
                    pagination.data[i].info = {
                        name: pagination.data[i].name,
                        description: pagination.data[i].description
                    }
                }

                return pagination;
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            renderLogo(value) {
                return `<img src="${config.logoPath +'/' + value}" />`;
            },
            renderInfo(value) {
                return `<div style="width: 250px"><strong>${value.name}</strong> <br /> ${value.description}</div>`;
            },
            renderUsers(users) {
                let html = '<strong>Users</strong> <br />';
                if (users) {
                    for (let i=0; i < users.length; i++) {
                        html += `${i+1}. ${users[i].name ? users[i].name : ''} ${users[i].surname ? users[i].surname : ''} <br />`
                    }
                }
                return html;
            },
        }
    }
</script>