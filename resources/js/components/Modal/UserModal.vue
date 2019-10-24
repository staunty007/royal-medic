<template>
    <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="openModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-weight-bold" id="openModalLabel">{{ info.toUpperCase() }} USER</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" class="form-control" v-model="form.name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control" v-model="form.email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Mobile</label>
                                <input type="tel" class="form-control" v-model="form.mobile">
                            </div>
                             <div class="form-group col-md-6">
                                <label for="inputState">Type</label>
                                <select class="form-control" v-model="form.type">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <template v-if="info == 'add'">
                                <div class="form-group col-md-6">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" v-model="form.password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Cofirm Password</label>
                                    <input type="password" class="form-control" v-model="form.password_confirmation">
                                </div>
                            </template>
                            <div class="form-group col-md-5">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="form.status" value="1" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Activate Account
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-center text-success font-weight-bold" v-if="success">{{ success }}</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createNew" v-if="info=='add'">{{ loading ? 'Creating...' : 'Create' }}</button>
                    <button type="button" class="btn btn-primary" @click="updateUser" v-if="info=='edit'">{{ loading ? 'Updating...' : 'Update' }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'Joe',
                loading: false,
                success: '',
                error: [],
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    mobile: '',
                    type:'',
                    status: 0,
                }
            }
        },
        props: {
            info: {
                type: String,
                required: true
            },
            user: {
                type: Object
            }
        },
        methods: {
            async createNew() {
                this.loading = true;
                this.success = '',
                this.error = []
                await axios.post('api/admin/user-create', this.form)
                .then((res) => {
                    this.loading = false
                    console.log(res.data);
                    this.success = res.data.data
                    this.$emit('closeModal');
                })
                .catch((err) => {
                    this.loading = false
                    console.log(err.response.data.data);
                    this.error = err.response.data.data
                });
            },
            async updateUser() {
                this.loading = true;
                this.success = '',
                this.error = []
                await axios.post(`api/admin/user/${this.user.id}/update`, this.form)
                .then((res) => {
                    this.loading = false
                    console.log(res.data.data);
                    this.success= res.data.data[0]
                    //let resp = resp.data[1];
                    setTimeout(() => {
                        this.$emit('closeModal');
                    }, 2000);
                })
                .catch((err) => {
                    this.loading = false
                    console.log(err.response.data.data);
                    this.error = err.response.data.data
                })
            }
        },
        watch: {
            user(value) {
                if (value) {
                    this.form = value
                }
                console.log(value);return;
            }
        }
    }

</script>
