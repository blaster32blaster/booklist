const state = {
    comics: [],
    loading: false,
    mainList: [],
}
const mutations = {
    update (state, payload) {
        state[payload.item] = payload.value
    },
    addItem (state, payload) {
        state.comics.push(payload.value);
    },
    removeItem (state, payload) {
        state.comics.splice(state.comics.indexOf(payload.value), 1);
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
