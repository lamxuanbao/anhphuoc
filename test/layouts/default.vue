<template>
  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
      <layout-aside></layout-aside>
      <div class="d-flex flex-column flex-row-fluid wrapper">
        <layout-header></layout-header>
        <div class="content d-flex flex-column flex-column-fluid">
          <layout-breadcrumb></layout-breadcrumb>
          <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
              <Nuxt />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";
export default {
  middleware: "auth",

  head() {
    const i18nHead = this.$nuxtI18nHead({ addSeoAttributes: true });
    const setting = this.$store.getters["setting/data"];
    let favicon_url = null;
    if (_.has(setting.favicon, "url")) {
      favicon_url = setting.favicon.url;
    }
    return {
      htmlAttrs: {
        ...i18nHead.htmlAttrs,
      },
      meta: [...i18nHead.meta],
      link: [
        {
          rel: "icon",
          type: "image/x-icon",
          href: favicon_url,
        },
        {
          hid: "apple-touch-icon",
          rel: "apple-touch-icon",
          sizes: "180x180",
          href: "/apple-touch-icon.png",
        },
        ...i18nHead.link,
      ],
      bodyAttrs: {
        class:
          "quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-fixed subheader-enabled subheader-solid aside-enabled aside-fixed",
      },
    };
  },
  data: function () {
    return {
      asideOverlay: false,
    };
  },
  mounted() {
    this.$nuxt.$on("aside-overlay", (data) => {
      this.asideOverlay = data;
    });
  },
  computed: {
    ...mapGetters({
      breadcrumbs: "app/breadcrumbs",
    }),
  },
};
</script>