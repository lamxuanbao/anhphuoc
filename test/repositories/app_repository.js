const resource = '/app'
export default ($axios) => ({
    upload(payload) {
        return $axios.$post(`${resource}/upload-file`, payload)
    },
})