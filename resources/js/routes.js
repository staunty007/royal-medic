window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/appointment', component: require('./components/AppointmentMod.vue').default },
    { path: '/appointments', component: require('./components/Appointments.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/doctors', component: require('./components/Doctors.vue').default },
    { path: '/patients', component: require('./components/Patients.vue').default },
    { path: '/patient', name: 'patient', component: require('./components/PatientMod.vue').default },
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })


  export default router;