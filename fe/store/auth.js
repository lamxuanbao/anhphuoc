import Cookies from 'js-cookie'
import _ from "lodash"

export const state = () => ({
    data: null,
    token: null,
    token_type: null,
})
export const getters = {
    data: state => state.data,
    token: state => state.token,
    token_type: state => state.token_type,
}

export const actions = {
    logout({ commit }) {
        commit('logout')
    },
    async get_data({ commit }) {
        await this.$repositories.auth.data().then((result) => {
            commit('set_data', result)
        });
    },
    async login({ commit }, params) {
        await this.$repositories.auth.login(params).then((result) => {
            commit('set_token', result.token)
            commit('set_token_type', result.token_type)
        });
    },
}
export const mutations = {
    set_data(state, data) {
        state.data = data
    },
    set_token(state, token) {
        state.token = token
        Cookies.set(this.$config.tokenKey, token)
    },
    set_token_type(state, token_type) {
        state.token_type = token_type
        Cookies.set(this.$config.tokenType, token_type)
    },
    logout(state) {
        Cookies.remove(this.$config.tokenKey)
        Cookies.remove(this.$config.tokenType)
    },
}