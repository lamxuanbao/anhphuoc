const resource = '/property'
export default ($axios) => ({
    all(payload) {
        return $axios.$get(`${resource}`, { params: payload })
    },

    show(id) {
        return $axios.$get(`${resource}/${id}`)
    },

    create(payload) {
        return $axios.$post(`${resource}/create`, payload)
    },

    update(id, payload) {
        return $axios.$post(`${resource}/${id}`, payload)
    },

    delete(id) {
        return $axios.$delete(`${resource}/${id}`)
    }
})