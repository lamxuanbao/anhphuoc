const resource = '/customer'
export default ($axios) => ({
    data() {
        return $axios.$get(`${resource}`)
    },
    register(payload) {
        return $axios.$post(`${resource}/register`, payload)
    },
    login(payload) {
        return $axios.$post(`${resource}/login`, payload)
    },
})