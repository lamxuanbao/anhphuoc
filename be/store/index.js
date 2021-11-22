import _ from "lodash";
const cookieparser = require('cookieparser')
const TOKEN_KEY = process.env.TOKEN_KEY
const TOKEN_TYPE = process.env.TOKEN_TYPE
export const actions = {
    nuxtServerInit({ commit, dispatch }, { req }) {
        if (req.headers.cookie) {
            const cookie = cookieparser.parse(req.headers.cookie)
            commit('auth/set_token', cookie[TOKEN_KEY])
            commit('auth/set_token_type', cookie[TOKEN_TYPE])
        }
        return Promise.all([
            dispatch('setting/get_data'),
            // dispatch('timezones')
        ]);
    }
}