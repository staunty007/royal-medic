<template>
    <div>

        <div class="row">
            <div class="col-md-10">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ title }} PATIENT</h6>
                        <router-link class="btn btn-info" to="/patients">
                            <i class="fas fa-caret-left fa-sm fa-fw"></i> PATIENTS
                        </router-link>
                    </div>
                    <div class="card-body">

                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" v-model="form.fname">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" v-model="form.lname">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" v-model="form.email">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Gender</label>
                                    <select name="" id="" class="form-control" v-model="form.gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">Mobile1</label>
                                    <input type="tel" class="form-control" v-model="form.mobile">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Mobile2</label>
                                    <input type="tel" class="form-control" v-model="form.biodata.mobile2">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Blood Group</label>
                                    <select name="" id="" class="form-control" v-model="form.biodata.blood_group">
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Date of Birth</label>
                                    <input type="date" class="form-control" v-model="form.biodata.dob">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">Photo</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Address</label>
                                    <input type="text" class="form-control" v-model="form.biodata.address">
                                </div>
                                <div class="form-group offset-md-1 col-md-2">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" value="1" v-model="form.status">
                                        <label class="form-check-label font-weight-bold">
                                            Status
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <button @click="savePatient" v-if="title=='ADD'" type="button"
                                            class="btn btn-success btn-block">{{ loading ? 'Saving' : 'Save' }}</button>
                                        <button @click="updatePatient" v-if="title=='UPDATE'" type="button"
                                            class="btn btn-success btn-block">{{ loading ? 'Updating' : 'Update' }}</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" @click="clearForm" v-if="title=='ADD'"
                                            class="btn btn-danger btn-block">Cancel</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <h6 v-if="success != ''" class="text-success font-weight-bold text-center">
                                            {{ success.toUpperCase() }}</h6>
                                    </div>
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
        mounted() {

        },
        data() {
            return {
                loading: false,
                error: [],
                success: '',
                title: '',
                form: {
                    fname: '',
                    lname: '',
                    email: '',
                    gender: '',
                    mobile: '',
                    status: '',
                    biodata: {
                        mobile2: '',
                        blood_group: '',
                        address: '',
                        dob: '',
                    }
                }
            }
        },
        methods: {
            savePatient() {
                this.loading = true
                this.error = []
                axios.post('/api/admin/patient/create', this.form)
                    .then((res) => {
                        this.loading = false
                        this.success = res.data.data
                        console.log(res.data)
                    })
                    .catch((err) => {
                        this.loading = false
                        console.log(err.response.data)
                    })
            },
            updatePatient() {
                this.loading = true
                this.error = []
                axios.post(`/api/admin/patient/${this.form.id}/update`, this.form)
                    .then((res) => {
                        this.loading = false
                        this.success = res.data.data
                        setTimeout(() => {
                            this.$router.go(-1);
                        }, 1500);
                    })
                    .catch((err) => {
                        this.loading = false
                        console.log(err.response.data)
                    })
            },
            clearForm() {
                this.form = {
                    fname: '',
                    lname: '',
                    email: '',
                    gender: '',
                    mobile: '',
                    status: '',
                    biodata: {
                        mobile2: '',
                        blood_group: '',
                        address: '',
                        dob: '',
                    }
                }
            }
        },
        created() {
            if (this.$route.params.hasOwnProperty('user')) {
                this.form = this.$route.params.user
                this.title = "UPDATE";
                let fullName = this.form.name.split(' ');
                this.form.fname = fullName[0];
                this.form.lname = fullName[1];
            } else {
                this.title = "ADD";
            }
        }
    }

</script>
