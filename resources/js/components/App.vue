<template>
      <router-view></router-view>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object
            }
        },
        mounted() {
            this.$store.dispatch('uploadUser',this.user)
            this.$store.dispatch('fetchDoctors');
            this.$store.dispatch('fetchAppointments');
        }
    }
</script>
