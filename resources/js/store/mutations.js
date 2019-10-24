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
    UPLOAD_USER(state, user) {
        return state.user = user
    }

}
export default mutations