export default async ({ store }) => {
  await store.dispatch('auth/get_data')
}
