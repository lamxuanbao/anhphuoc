import webpack from 'webpack'
export default {
  server: {
    port: process.env.APP_PORT // default: 3000
  },
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'datnhaxuong',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
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

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '@/core/ssr' },
    { src: '@/plugins/repository' },
    { src: '@/plugins/axios' },
    { src: '@/plugins/antd-ui' },
    { src: '@/plugins/filters', ssr: false },
    { src: '@/plugins/lazy-image', ssr: false },
    { src: '@/plugins/perfect-scrollbar' },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  target: 'static',
  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxt/image',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    'bootstrap-vue/nuxt',
    '@nuxt/image',
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
      },
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
      '@nuxtjs/axios',
  ],
  axios: {
    baseURL: process.env.API_BASE_URL
  },
  env: {
    baseUrl: process.env.API_BASE_URL
  },
  loading: '~/core/loading.vue',
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    plugins: [
      new webpack.ProvidePlugin({
        // global modules
        $: 'jquery',
        _: 'lodash'
      })
    ],
    extractCSS: {
      ignoreOrder: true
    },
    optimization: {
      splitChunks: {
        cacheGroups: {
          styles: {
            name: 'styles',
            test: /\.(css|vue)$/,
            chunks: 'all',
            enforce: true
          }
        }
      }
    }
  }
}
