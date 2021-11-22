import webpack from 'webpack'
module.exports = {
  server: {
    port: process.env.APP_PORT // default: 3000
  },
  
  /*
  ** Headers of the page
  */
  head: {
    htmlAttrs: {
      lang: 'vi'
    },
    meta: [
      { charset: 'utf-8' },
    ]
  },
  /*
  ** Customize the progress bar color
  */
  loading: '~/core/loading.vue',
  /*
  ** Build configuration
  */
  build: {
    plugins: [
      new webpack.ProvidePlugin({
        // global modules
        $: 'jquery',
        _: 'lodash'
      })
    ],
    /*
    ** Run ESLint on save
    */
    extend(config, { isDev, isClient }) {
      config.performance.hints = false
    },
  },

  /*
   ** Global CSS
   */
  css: [
    'ant-design-vue/dist/antd.css',
    '@/assets/sass/style.scss',
    '@/assets/sass/themes/layout/header/base/light.scss',
    '@/assets/sass/themes/layout/header/menu/light.scss',
    '@/assets/sass/themes/layout/brand/dark.scss',
    '@/assets/sass/themes/layout/aside/dark.scss',
    '@/assets/css/main.css',
    'assets/plugins/flaticon/flaticon.css',
    'assets/plugins/flaticon2/flaticon.css',
    'assets/plugins/keenthemes-icons/font/ki.css',
  ],
  /*
   ** Plugins to load before mounting the App
   ** https://nuxtjs.org/guide/plugins
   */
  plugins: [
    { src: '@/core/ssr' },
    { src: '@/plugins/repository' },
    { src: '@/plugins/axios' },
    { src: '@/plugins/filters', ssr: false },
    { src: '@/plugins/antd-ui' },
    { src: '@/plugins/bootstrap' },
    { src: '@/plugins/perfect-scrollbar' },
    { src: '@/plugins/vuelidate' },
    { src: '@/plugins/vue-cropper', ssr: false },
    { src: '@/plugins/lazy-image', ssr: false },
    { src: '@/plugins/ckeditor', ssr: false },

  ],
  /*
   ** Auto import components
   ** See https://nuxtjs.org/api/configuration-components
   */
  components: true,
  /*
   ** Nuxt.js modules
   */
  modules: [
    [
      'nuxt-i18n',
      {
        seo: true,
        locales: [
          // {
          //   code: 'en',
          //   iso: 'en-US',
          //   flag: 'en-US.svg',
          //   file: 'en-US.js',
          // },
          {
            code: 'vi',
            iso: 'vi-VN',
            flag: 'vi-VN.svg',
            file: 'vi-VN.js',
          },
        ],
        lazy: true,
        langDir: 'i18n/',
        defaultLocale: 'vi',
        // detectBrowserLanguage: {
        //   useCookie: true,
        //   cookieKey: 'i18n_redirected',
        //   onlyOnRoot: true,  // recommended
        // },
        strategy: 'no_prefix',
        // strategy: 'prefix_except_default',
      }
    ],
    '@nuxtjs/svg',
    '@nuxtjs/axios',
    '@nuxtjs/toast',
    [
      'bootstrap-vue/nuxt', {
        icons: true
      }
    ],
    [
      'nuxt-fontawesome',
      {
        imports: [
          {
            set: '@fortawesome/free-solid-svg-icons',
            icons: ['fas']
          },
          {
            set: '@fortawesome/free-brands-svg-icons',
            icons: ['fab']
          }
        ]
      }
    ],
  ],
  publicRuntimeConfig: {
    baseURL: process.env.API_BASE_URL,
    tokenKey: process.env.TOKEN_KEY,
    tokenType: process.env.TOKEN_TYPE
  },
  axios: {
    baseURL: process.env.API_BASE_URL
  },
  toast: {
    position: 'top-right',
    duration: 2000
  }
}

