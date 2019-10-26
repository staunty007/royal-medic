<template>
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Patient Records</h6>
                <button class="btn btn-primary" @click="openModal('add')">
                    Add New <i class="fas fa-user-plus fa-sm fa-fw"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Status</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Status</th>
                                <th>Modify</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.mobile }}</td>
                                <td>{{ user.gender }}</td>
                                <td>{{ user.biodata.blood_group.toUpperCase() }}</td>
                                <td> 
                                    <span 
                                    :class="{ 'badge-success': user.status == 1,'badge-danger': user.status == 0 }" 
                                    class="badge"> {{ user.status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <button @click="openModal('edit', user)" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                users: [],
                resp: '',
                selectedUser: {}
            }
        },
        methods: {
            openModal(value, user = null) {
                if (value == 'add') {
                    this.$router.push('/patient');
                } else {
                    this.$router.push({ name: 'patient', params: { user: user } })
                }
            },

            async fetchUsers() {
                await axios.get('/api/admin/patients')
                .then((res) => {
                   // console.log(res.data);
                    this.users = res.data.data
                })  
            }

        },
        mounted() {
            this.fetchUsers();
        }
    }

</script>
