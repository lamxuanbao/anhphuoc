export const state = () => ({
    permissions: [],
    list: [],
    data: null
})
export const getters = {
    permissions: state => state.permissions,
    list: state => state.list,
    data: state => state.data
}

export const actions = {
    async get_permissions({ commit }) {
        await this.$repositories.role.permissions().then((result) => {
            commit('set_permissions', result)
        });
    },
    async get_list({ commit }, params) {
        await this.$repositories.role.all(params).then((result) => {
            commit('set_list', result)
        });
    },
    async get_data({ commit }, id) {
        await this.$repositories.role.show(id).then((result) => {
            commit('set_data', result)
        })
    },
    async create_data({ commit }, params) {
        await this.$repositories.role.create(params).then((result) => {
            commit('set_data', result)
        })
    },
    async update_data({ commit }, { id, params }) {
        await this.$repositories.role.update(id, params).then((result) => {
            commit('set_data', result)
        })
    },
    async remove_data({ commit }, id) {
        await this.$repositories.role.delete(id);
    }
}
export const mutations = {
    set_permissions(state, permissions) {
        state.permissions = permissions
    },
    set_list(state, list) {
        state.list = list
    },
    set_data(state, data) {
        state.data = data
    }
}