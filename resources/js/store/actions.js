let actions = {
    // createPost({commit}, post) {
    //     axios.post('/api/posts', post)
    //         .then(res => {
    //             commit('CREATE_POST', res.data)
    //         }).catch(err => {
    //         console.log(err)
    //     })

    // },
    fetchDoctors({commit}) {
        axios.get('/api/admin/doctors')
            .then(res => {
                commit('FETCH_DOCTORS', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },
    fetchAppointments({commit}) {
        axios.get('/api/appointment')
            .then(res => {
                commit('FETCH_APPOINTMENTS', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },
    // deletePost({commit}, post) {
    //     axios.delete(`/api/posts/${post.id}`)
    //         .then(res => {
    //             if (res.data === 'ok')
    //                 commit('DELETE_POST', post)
    //         }).catch(err => {
    //         console.log(err)
    //     })
    // },

    uploadUser({commit}, data) {
        commit('FETCH_USER', data)
    },
}

export default actions