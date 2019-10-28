<template>
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Appoitments</h6>
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
                                <th>APPOINT ID</th>
                                <th>PATIENT </th>
                                <th>DOCTOR</th>
                                <th>DEPARTMENT</th>
                                <th>PROBLEM</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                                <th>MODIFY</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>APPOINT ID</th>
                                <th>PATIENT</th>
                                <th>DOCTOR</th>
                                <th>DEPARTMENT</th>
                                <th>PROBLEM</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                                <th>MODIFY</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="(appoint, index) in appointments" :key="appoint.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ appoint.slot }}</td>
                                <td>{{ appoint.patient.name }}</td>
                                <td>{{ appoint.doctor.name }}</td>
                                <td>{{ appoint.department }}</td>
                                <td>{{ appoint.problem.slice(0,30) }}</td>
                                <td>{{ appoint.date }}</td>
                                <td>
                                    <span 
                                    :class="{ 'badge-success': appoint.status == 1,'badge-danger': appoint.status == 0 }" 
                                    class="badge"> {{ appoint.status == 1 ? 'Active' : 'Inactive' }}
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
                    this.$router.push('/appointment');
                } else {
                    this.$router.push({ name: 'appointment', params: { user: user } })
                }
            },

        },
        computed: {
            appointments() {
                return this.$store.getters.appointments;
            }
        }
    }

</script>
