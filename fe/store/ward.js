export const state = () => ({
    list: [],
    data: null
})
export const getters = {
    list: state => state.list,
    data: state => state.data
}

export const actions = {
    async get_list({ commit }, params) {
        await this.$repositories.ward.all(params).then((result) => {
            commit('set_list', result)
        });
    },
    async create_data({ commit }, params) {
        await this.$repositories.ward.create(params).then((result) => {
            commit('set_data', result)
        })
    },
    async get_data({ commit }, id) {
        await this.$repositories.ward.show(id).then((result) => {
            commit('set_data', result)
        })
    },
    async remove_data({ commit }, id) {
        await this.$repositories.ward.delete(id);
    }
}
export const mutations = {
    set_list(state, list) {
        state.list = list
    },
    set_data(state, data) {
        state.data = data
    }
}