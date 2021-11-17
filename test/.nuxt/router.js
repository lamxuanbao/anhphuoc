import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _12cd3dcc = () => interopDefault(import('../pages/setting/index.vue' /* webpackChunkName: "pages/setting/index" */))
const _799baf36 = () => interopDefault(import('../pages/user/index.vue' /* webpackChunkName: "pages/user/index" */))
const _6705cd19 = () => interopDefault(import('../pages/auth/login.vue' /* webpackChunkName: "pages/auth/login" */))
const _6a71a20e = () => interopDefault(import('../pages/user/create.vue' /* webpackChunkName: "pages/user/create" */))
const _5cedffe6 = () => interopDefault(import('../pages/user/_id.vue' /* webpackChunkName: "pages/user/_id" */))
const _57b2ffcb = () => interopDefault(import('../pages/index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/setting",
    component: _12cd3dcc,
    name: "setting"
  }, {
    path: "/user",
    component: _799baf36,
    name: "user"
  }, {
    path: "/auth/login",
    component: _6705cd19,
    name: "auth-login"
  }, {
    path: "/user/create",
    component: _6a71a20e,
    name: "user-create"
  }, {
    path: "/user/:id",
    component: _5cedffe6,
    name: "user-id"
  }, {
    path: "/",
    component: _57b2ffcb,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
