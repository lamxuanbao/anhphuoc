import Vue from 'vue'
import { wrapFunctional } from './utils'

const components = {
  Logo: () => import('../../components/Logo.vue' /* webpackChunkName: "components/logo" */).then(c => wrapFunctional(c.default || c)),
  Error401: () => import('../../components/error/401.vue' /* webpackChunkName: "components/error401" */).then(c => wrapFunctional(c.default || c)),
  Error403: () => import('../../components/error/403.vue' /* webpackChunkName: "components/error403" */).then(c => wrapFunctional(c.default || c)),
  Error404: () => import('../../components/error/404.vue' /* webpackChunkName: "components/error404" */).then(c => wrapFunctional(c.default || c)),
  Error500: () => import('../../components/error/500.vue' /* webpackChunkName: "components/error500" */).then(c => wrapFunctional(c.default || c)),
  LayoutAside: () => import('../../components/layout/aside.vue' /* webpackChunkName: "components/layout-aside" */).then(c => wrapFunctional(c.default || c)),
  LayoutAsideMenu: () => import('../../components/layout/aside_menu.vue' /* webpackChunkName: "components/layout-aside-menu" */).then(c => wrapFunctional(c.default || c)),
  LayoutAsideQuickUser: () => import('../../components/layout/aside_quick_user.vue' /* webpackChunkName: "components/layout-aside-quick-user" */).then(c => wrapFunctional(c.default || c)),
  LayoutBrand: () => import('../../components/layout/brand.vue' /* webpackChunkName: "components/layout-brand" */).then(c => wrapFunctional(c.default || c)),
  LayoutBreadcrumb: () => import('../../components/layout/breadcrumb.vue' /* webpackChunkName: "components/layout-breadcrumb" */).then(c => wrapFunctional(c.default || c)),
  LayoutFooter: () => import('../../components/layout/footer.vue' /* webpackChunkName: "components/layout-footer" */).then(c => wrapFunctional(c.default || c)),
  LayoutHeader: () => import('../../components/layout/header.vue' /* webpackChunkName: "components/layout-header" */).then(c => wrapFunctional(c.default || c)),
  LayoutTopbar: () => import('../../components/layout/topbar.vue' /* webpackChunkName: "components/layout-topbar" */).then(c => wrapFunctional(c.default || c)),
  PagesRoleGeneral: () => import('../../components/pages/role/role_general.vue' /* webpackChunkName: "components/pages-role-general" */).then(c => wrapFunctional(c.default || c)),
  PagesRolePermission: () => import('../../components/pages/role/role_permission.vue' /* webpackChunkName: "components/pages-role-permission" */).then(c => wrapFunctional(c.default || c)),
  PagesSettingsGeneral: () => import('../../components/pages/settings/general.vue' /* webpackChunkName: "components/pages-settings-general" */).then(c => wrapFunctional(c.default || c)),
  PagesSettingsSettingImage: () => import('../../components/pages/settings/setting_image.vue' /* webpackChunkName: "components/pages-settings-setting-image" */).then(c => wrapFunctional(c.default || c)),
  PagesSettingsSettingStore: () => import('../../components/pages/settings/setting_store.vue' /* webpackChunkName: "components/pages-settings-setting-store" */).then(c => wrapFunctional(c.default || c)),
  PagesUserGeneral: () => import('../../components/pages/user/user_general.vue' /* webpackChunkName: "components/pages-user-general" */).then(c => wrapFunctional(c.default || c)),
  PagesUserPassword: () => import('../../components/pages/user/user_password.vue' /* webpackChunkName: "components/pages-user-password" */).then(c => wrapFunctional(c.default || c))
}

for (const name in components) {
  Vue.component(name, components[name])
  Vue.component('Lazy' + name, components[name])
}
