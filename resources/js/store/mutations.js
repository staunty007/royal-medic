let mutations = {
    // CREATE_POST(state, post) {
    //     state.posts.unshift(post)
    // },
    // DELETE_POST(state, post) {
    //     let index = state.posts.findIndex(item => item.id === post.id)
    //     state.posts.splice(index, 1)
    // },
    FETCH_USER(state, user) {
        return state.user = user
    },
    FETCH_DOCTORS(state, doctors) {
        return state.doctors = doctors
    },
    FETCH_APPOINTMENTS(state, appointments) {
        return state.appointments = appointments
    },
    UPLOAD_USER(state, user) {
        return state.user = user
    }

}
export default mutations