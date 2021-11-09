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
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '@/core/ssr' },
    { src: '@/plugins/repository' },
    { src: '@/plugins/axios' },
    { src: '@/plugins/antd-ui' },
    { src: '@/plugins/filters', ssr: false },
    { src: '@/plugins/lazy-image', ssr: false },
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
  styleResources: {
    scss: [
      "./scss/*.scss"
    ]
  },
  axios: {
    baseURL: process.env.API_BASE_URL
  },
  env: {
    baseUrl: process.env.API_BASE_URL
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
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
