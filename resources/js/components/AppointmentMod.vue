<template>
    <div>

        <div class="row">
            <div class="col-md-10">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ADD APPOINTMENT
                        </h6>
                        <router-link class="btn btn-info" to="/appointments" >
                            <i class="fas fa-caret-left fa-sm fa-fw"></i> APPOINTMENTS
                        </router-link>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label text-dark font-weight-bold">Patient
                                    Code</label>
                                <div class="col-sm-5">
                                    <input type="text" v-if="!p_name" v-model="form.p_code" class="form-control">
                                    <input type="text" v-if="p_name" v-model="p_name" readonly class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <button v-if="!p_name" @click="findPatient" :disabled="form.p_code.trim()==''" type="button" class="btn btn-info"><i
                                            class="fas fa-fw fa-cog"></i></button>
                                    <button v-if="p_name" @click="p_name = ''" type="button" class="btn btn-danger"><i
                                            class="fas fa-fw fa-cog"></i></button>
                                </div>
                                <div class="col-sm-3">
                                    <small class="text-danger font-weight-bold" v-if="error.p_code">{{ error.p_code }}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for=""
                                    class="col-sm-2 col-form-label text-dark font-weight-bold">Department</label>
                                <div class="col-sm-7">
                                    <select v-model="form.department" class="form-control">
                                        <option value="dentist">Dentist</option>
                                        <option value="optician">Optician</option>
                                        <option value="surgeon">Surgeon</option>
                                        <option value="radiotherapy">Radiotherapy</option>
                                        <option value="gynaecology">Gynaecology</option>
                                        <option value="oncology">Oncology</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label text-dark font-weight-bold">Doctor
                                    Name</label>
                                <div class="col-sm-7">
                                    <select v-model="form.doctor_id" id="" class="form-control">
                                        <option :value="doctor.id" v-for="doctor in doctors" :key="doctor.id">{{ doctor.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label text-dark font-weight-bold">Appointment
                                    Date</label>
                                <div class="col-sm-7">
                                    <date-picker v-model="form.date" :config="options"></date-picker>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label text-dark font-weight-bold">Problem</label>
                                <div class="col-sm-7">
                                    <textarea v-model="form.problem" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-dark font-weight-bold">Status</label>
                                <div class="col-sm-7">
                                    <div class="form-check">
                                        <label class="radio-inline mr-1">
                                            <input type="radio" name="status" value="1" v-model="form.status" checked="checked">
                                            <span class="font-weight-bold">Active</span> </label>
                                        <label class="radio-inline ml-1">
                                            <input type="radio" name="status" value="0" v-model="form.status"> <span
                                                class="font-weight-bold">Inactive</span> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <button type="button" @click="makeAppointment" :disabled="!patientFound" 
                                    class="btn btn-primary">{{ loading ? 'Adding...' : 'Add New' }}</button>
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </div>
                                <div class="col-sm-7">
                                    <h5 class="text-success font-weight-bold" v-if="success"> {{ success.toUpperCase() }}</h5>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>
</template>

<script>
    export default {
        mounted() {},
        data() {
            return {
                loading: false,
                error: [],
                success: '',
                title: '',
                p_name: '',
                patientFound: false,
                form: {
                    p_code: '',
                    department: '',
                    doctor_id: '',
                    date: '',
                    problem:'',
                    status: 0,
                },
                options: {
                    format: 'DD/MM/YYYY h:mm:ss',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                },
                doctors: [],
            }
        },
        methods: {
            async findPatient() {
                this.error = [];
                await axios.get(`/api/find-patient/${this.form.p_code}`)
                    .then((res) => {
                        this.p_name = res.data;
                        console.log(res.data);
                        this.patientFound = true
                    })
                    .catch((err) => {
                        console.log(err.response.data.message);
                        this.error = { 'p_code': err.response.data.message };
                    })
            },
            makeAppointment() {
                this.loading = true
                this.error = [];
                axios.post('/api/appointment', this.form)
                    .then((res) => {
                        this.loading = false
                        console.log(res.data)
                        this.success = res.data.data
                        this.$store.dispatch('fetchAppointments');
                        this.form = {}
                    })
                    .catch((err) => {
                        this.loading = false
                        console.log(err.response.data)
                    })
            },
            updatePatient() {
                // this.loading = true
                // this.error = []
                // axios.post(`/api/admin/patient/${this.form.id}/update`, this.form)
                //     .then((res) => {
                //         this.loading = false
                //         console.log(res.data); return;
                //         this.success = res.data.data
                //         setTimeout(() => {
                //             this.$router.go(-1);
                //         }, 1500);
                //     })
                //     .catch((err) => {
                //         this.loading = false
                //         console.log(err.response.data)
                //     })
            },
        },
        watch: {
            'form.department'(value) {
                console.log(value);
                if (value) {
                    this.doctors = this.alldoctors.filter((ele) => ele.type.toLowerCase() === value.toLowerCase())
                }
            }
        },
        computed: {
            alldoctors() {
                return this.$store.getters.doctors;
            }
        }
    }

</script>
