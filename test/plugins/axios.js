export default ({ store, $axios, redirect }) => {
  $axios.onRequest((config) => {
    const token = store.state.auth.token
    const tokenType = store.state.auth.token_type
    if (token && tokenType) {
      $axios.setHeader('Authorization', `${tokenType} ${token}`)
    }
    $axios.setHeader('Accept-Language', 'vi')
    return config
  })
  // $axios.onResponse((response) => {
  //   return response.data
  // })

  $axios.onError(error => {
    // if(error.response.status === 500) {
      return redirect('/auth/login')
    // }
  })
  // $axios.onError((e) => {
  //   redirect('/sorry')
  //   // const { status, data } = e.response
  //   // console.log(status,data);
  //   // // error(
  //   // //   { statusCode: status, message: data.message }
  //   // // )
  //   // return Promise.resolve(false);
    
  //   // switch (status) {
  //   //   case 401:
  //   //     console.log(data);
  //   //     store.commit('auth/logout')
  //   //     // redirect('/auth/login')
  //   //   case 422:
  //   //     return false
  //   // }
  // })
}
