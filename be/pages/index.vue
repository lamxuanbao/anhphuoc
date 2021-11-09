<template>
  <a-spin :spinning="loading">
    <a-card :loading="loading">
      <logo />
      {{ mountains }}
    </a-card>
    <!-- <card>
      <logo />

      <!-- <client-only>
        <image-zoom :src="require('@/assets/media/logos/logo-letter-1.png')" />
      </client-only> -->
    <!-- <ckeditor
        tag-name="textarea"
        value="<p>Content of the editor</p>"
        :config="editorConfig"
        :editor-url="editorUrl"
      ></ckeditor> -->
    <!-- 123
      {{ $i18n.locales }}
      {{ $i18n.locale }}
      {{ $t("wellcome") }}
      {{ $t("vi-VN") }}
      123
      <a
        v-for="locale in availableLocales"
        :key="locale.code"
        @click.prevent.stop="$i18n.setLocale(locale.code)"
      >
        {{ locale.code }}
      </a>
      
      <h1>Example of Lazy Image with a Placeholder <small>(scroll down 👇)</small></h1>
    
    <div class="image-wrap">
      <p>Blur</p>
      <image-blur
        :src="require('@/assets/media/logos/logo-letter-1.png')"
      />
    </div>
    <div class="image-wrap">
      <p>Zoom in</p>
      <image-zoom
        :src="require('@/assets/media/logos/logo-letter-1.png')"
      />
    </div> -->
  </a-spin>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      mountains: [],
      loading: false,
      editorUrl: "https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js",
      editorConfig: {
        toolbar: [
          ["Source"],
          ["Styles", "Format", "Font", "FontSize"],
          ["Bold", "Italic"],
          ["Image", "Table", "HorizontalRule", "SpecialChar", "Iframe"],
          ["Undo", "Redo"],
          ["About"],
        ],
        // extraPlugins: "uploadimage",
        // filebrowserBrowseUrl: "/filemanager_storage?type=Files",
        // filebrowserUploadUrl: "/filemanager_storage/upload?type=Files&_token=",
      },
    };
  },
  computed: {
    availableLocales() {
      return this.$i18n.locales.filter((i) => i.code !== this.$i18n.locale);
    },
  },
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
    }),
  },
  created() {
    this.setBreadcrumb([{ title: "Dashboard" }]);
  },
};
</script>

<style>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont,
    "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>

