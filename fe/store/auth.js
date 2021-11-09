import Cookies from 'js-cookie'
import _ from "lodash"
export const state = () => ({
    data: null,
    token: Cookies.get('token'),
    token_type: Cookies.get('token_type'),
})
export const getters = {
    data: state => state.data,
    token: state => state.token,
    token_type: state => state.token_type,
}

export const actions = {
    log_out({ commit }) {
        commit('log_out')
    },
    async register({ commit }, params) {
        await this.$repositories.auth.register(params).then((result) => {
            commit('set_token', result.token)
            commit('set_token_type', result.token_type)
        })
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
        Cookies.set('token', token)
    },
    set_token_type(state, token_type) {
        state.token_type = token_type
        Cookies.set('token_type', token_type)
    },
    log_out(state) {
        Cookies.remove('token')
        Cookies.remove('token_type')
    },
}