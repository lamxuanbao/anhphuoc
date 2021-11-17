

export const Constants = {
  COMPONENT_OPTIONS_KEY: "nuxtI18n",
  STRATEGIES: {"PREFIX":"prefix","PREFIX_EXCEPT_DEFAULT":"prefix_except_default","PREFIX_AND_DEFAULT":"prefix_and_default","NO_PREFIX":"no_prefix"},
}
export const nuxtOptions = {
  isUniversalMode: true,
  trailingSlash: undefined,
}
export const options = {
  vueI18n: {},
  vueI18nLoader: false,
  locales: [{"code":"vi","iso":"vi-VN","flag":"vi-VN.svg","file":"vi-VN.js"}],
  defaultLocale: "vi",
  defaultDirection: "ltr",
  routesNameSeparator: "___",
  defaultLocaleRouteNameSuffix: "default",
  sortRoutes: true,
  strategy: "no_prefix",
  lazy: true,
  langDir: "/Users/nhockizi/FireApps/git/anhphuoc/test/i18n",
  rootRedirect: null,
  detectBrowserLanguage: {"alwaysRedirect":false,"cookieCrossOrigin":false,"cookieDomain":null,"cookieKey":"i18n_redirected","cookieSecure":false,"fallbackLocale":"","onlyOnNoPrefix":false,"onlyOnRoot":false,"useCookie":true},
  differentDomains: false,
  seo: true,
  baseUrl: "",
  vuex: {"moduleName":"i18n","syncLocale":false,"syncMessages":false,"syncRouteParams":true},
  parsePages: true,
  pages: {},
  skipSettingLocaleOnNavigate: false,
  beforeLanguageSwitch: () => null,
  onBeforeLanguageSwitch: () => {},
  onLanguageSwitched: () => null,
  normalizedLocales: [{"code":"vi","iso":"vi-VN","flag":"vi-VN.svg","file":"vi-VN.js"}],
  localeCodes: ["vi"],
}

export const localeMessages = {
  'vi-VN.js': () => import('../../i18n/vi-VN.js' /* webpackChunkName: "lang-vi-VN.js" */),
}
