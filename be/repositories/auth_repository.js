const resource = '/auth'
export default ($axios) => ({
    data() {
        return $axios.$get(`${resource}`)
    },
    login(payload) {
        return $axios.$post(`${resource}/login`, payload)
    },
})