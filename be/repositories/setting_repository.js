const resource = '/setting'
export default ($axios) => ({
    all(payload) {
        return $axios.$get(`${resource}`, payload)
    },
    update(payload) {
        return $axios.$post(`${resource}`, payload)
    },

    // show(id) {
    //     return $axios.get(`${resource}/${id}`)
    // },

    // create(payload) {
    //     return $axios.post(`${resource}`, payload)
    // },


    // delete(id) {
    //     return $axios.delete(`${resource}/${id}`)
    // }
})