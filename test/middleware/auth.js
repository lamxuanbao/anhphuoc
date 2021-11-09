export default async ({ store , redirect }) => {
  // return redirect('/auth/login')
  await store.dispatch('auth/get_data')
}
