const state = {
    comics: [],
    loading: false
}
const mutations = {
    update (state, payload) {
        state[payload.item] = payload.value
    }
}
const actions = {
}
const getters = {

}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
