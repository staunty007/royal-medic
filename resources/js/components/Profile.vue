<template>
    <div>
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bio</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <img src="https://source.unsplash.com/QAB-WJcbgJk/60x60" class="rounded" alt="">
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <div class="col-md-12"><span class="font-weight-bold"> Name </span>: {{ user.name  }}</div>
                                <div class="col-md-12"><span class="font-weight-bold"> Email </span>: {{ user.email  }}</div>
                                <div class="col-md-12"><span class="font-weight-bold"> Mobile </span>: {{ user.mobile  }}</div>
                                <div class="col-md-12 mt-1"><span class="font-weight-bold"> Type
                                     </span>: {{ user.type == 1 ? 'Admin': 'User'   }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            user() {
                return this.$store.getters.user;
            }
        },
        data() {
            return {
            }
        }
    }

</script>
