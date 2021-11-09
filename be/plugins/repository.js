import createRepository from '~/repositories/repository'
export default (ctx, inject) => {
    inject('repositories', createRepository(ctx.$axios))
    // inject the repository in the context (ctx.app.$repository)
    // And in the Vue instances (this.$repository in your components)
    // const repositoryWithAxios = createRepository(ctx.$axios)
    // inject('userRepository', repositoryWithAxios('/user'))

    // You can reuse the repositoryWithAxios object:
    // inject("userRepository", repositoryWithAxios('/users'));
}