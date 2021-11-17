import { wrapFunctional } from './utils'

export { default as Logo } from '../../components/Logo.vue'
export { default as Error401 } from '../../components/error/401.vue'
export { default as Error403 } from '../../components/error/403.vue'
export { default as Error404 } from '../../components/error/404.vue'
export { default as Error500 } from '../../components/error/500.vue'
export { default as LayoutAside } from '../../components/layout/aside.vue'
export { default as LayoutAsideMenu } from '../../components/layout/aside_menu.vue'
export { default as LayoutAsideQuickUser } from '../../components/layout/aside_quick_user.vue'
export { default as LayoutBrand } from '../../components/layout/brand.vue'
export { default as LayoutBreadcrumb } from '../../components/layout/breadcrumb.vue'
export { default as LayoutFooter } from '../../components/layout/footer.vue'
export { default as LayoutHeader } from '../../components/layout/header.vue'
export { default as LayoutTopbar } from '../../components/layout/topbar.vue'
export { default as PagesRoleGeneral } from '../../components/pages/role/role_general.vue'
export { default as PagesRolePermission } from '../../components/pages/role/role_permission.vue'
export { default as PagesSettingsGeneral } from '../../components/pages/settings/general.vue'
export { default as PagesSettingsSettingImage } from '../../components/pages/settings/setting_image.vue'
export { default as PagesSettingsSettingStore } from '../../components/pages/settings/setting_store.vue'
export { default as PagesUserGeneral } from '../../components/pages/user/user_general.vue'
export { default as PagesUserPassword } from '../../components/pages/user/user_password.vue'

export const LazyLogo = import('../../components/Logo.vue' /* webpackChunkName: "components/logo" */).then(c => wrapFunctional(c.default || c))
export const LazyError401 = import('../../components/error/401.vue' /* webpackChunkName: "components/error401" */).then(c => wrapFunctional(c.default || c))
export const LazyError403 = import('../../components/error/403.vue' /* webpackChunkName: "components/error403" */).then(c => wrapFunctional(c.default || c))
export const LazyError404 = import('../../components/error/404.vue' /* webpackChunkName: "components/error404" */).then(c => wrapFunctional(c.default || c))
export const LazyError500 = import('../../components/error/500.vue' /* webpackChunkName: "components/error500" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutAside = import('../../components/layout/aside.vue' /* webpackChunkName: "components/layout-aside" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutAsideMenu = import('../../components/layout/aside_menu.vue' /* webpackChunkName: "components/layout-aside-menu" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutAsideQuickUser = import('../../components/layout/aside_quick_user.vue' /* webpackChunkName: "components/layout-aside-quick-user" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutBrand = import('../../components/layout/brand.vue' /* webpackChunkName: "components/layout-brand" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutBreadcrumb = import('../../components/layout/breadcrumb.vue' /* webpackChunkName: "components/layout-breadcrumb" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutFooter = import('../../components/layout/footer.vue' /* webpackChunkName: "components/layout-footer" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutHeader = import('../../components/layout/header.vue' /* webpackChunkName: "components/layout-header" */).then(c => wrapFunctional(c.default || c))
export const LazyLayoutTopbar = import('../../components/layout/topbar.vue' /* webpackChunkName: "components/layout-topbar" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesRoleGeneral = import('../../components/pages/role/role_general.vue' /* webpackChunkName: "components/pages-role-general" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesRolePermission = import('../../components/pages/role/role_permission.vue' /* webpackChunkName: "components/pages-role-permission" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesSettingsGeneral = import('../../components/pages/settings/general.vue' /* webpackChunkName: "components/pages-settings-general" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesSettingsSettingImage = import('../../components/pages/settings/setting_image.vue' /* webpackChunkName: "components/pages-settings-setting-image" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesSettingsSettingStore = import('../../components/pages/settings/setting_store.vue' /* webpackChunkName: "components/pages-settings-setting-store" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesUserGeneral = import('../../components/pages/user/user_general.vue' /* webpackChunkName: "components/pages-user-general" */).then(c => wrapFunctional(c.default || c))
export const LazyPagesUserPassword = import('../../components/pages/user/user_password.vue' /* webpackChunkName: "components/pages-user-password" */).then(c => wrapFunctional(c.default || c))
