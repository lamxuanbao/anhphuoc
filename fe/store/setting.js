export const state = () => ({
    data: []
})
export const getters = {
    data: state => state.data
}

export const actions = {
    async get_data({ commit }, params) {
        await this.$repositories.setting.all(params).then((result) => {
            commit('set_data', result)
        });
    }
}
export const mutations = {
    set_data(state, data) {
        state.data = data
    },
}