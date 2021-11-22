const resource = '/setting'
export default ($axios) => ({
    all(payload) {
        return $axios.$get(`${resource}`, payload)
    }
})