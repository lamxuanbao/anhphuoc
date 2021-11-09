export default ({ store, $axios, $toast, redirect, error }) => {
  $axios.onRequest((config) => {
    const token = store.state.auth.token
    const tokenType = store.state.auth.token_type
    if (token && tokenType) {
      $axios.setHeader('Authorization', `${tokenType} ${token}`)
    }
    $axios.setHeader('Accept-Language', 'vi')
    return config
  })
  $axios.onResponse((response) => {
    return response.data
  })

  $axios.onError((e) => {
    const { status, data } = e.response
    switch (status) {
      case 401:
        store.commit('auth/logout')
        return redirect('/auth/login')
      case 422:
        return false
      default:
        return error(
          { statusCode: status, message: data.message }
        )
    }
  })
}
