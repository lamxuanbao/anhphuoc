export const state = () => ({
    breadcrumbs: []
})
export const getters = {
    breadcrumbs: state => state.breadcrumbs,
}

export const actions = {
    async upload({ commit }, payload) {
        return await this.$repositories.app.upload(payload);
    },
    async set_breadcrumb({ commit }, payload) {
        commit('set_breadcrumb', payload)
    },
}
export const mutations = {
    set_breadcrumb(state, payload) {
        state.breadcrumbs = payload
    },
}