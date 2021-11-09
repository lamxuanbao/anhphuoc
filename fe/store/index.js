const cookieparser = require('cookieparser')
export const actions = {
    nuxtServerInit({ commit, dispatch }, { req }) {
        if (req.headers.cookie) {
            const cookie = cookieparser.parse(req.headers.cookie)
            console.log(cookie);
            commit('auth/set_token', cookie.token)
            commit('auth/set_token_type', cookie.token_type)
        }
        return Promise.all([
            dispatch('setting/get_data'),
            // dispatch('timezones')
        ]);
    }
}