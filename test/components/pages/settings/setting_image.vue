<template>
  <div class="w-100">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label>{{ $t("logo") }}:</label>
          <image-upload :src="logo" @change="uploadLogo" width="65px" />
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label>{{ $t("favicon") }}:</label>
          <image-upload :src="favicon" @change="uploadFavicon" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";
export default {
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  computed: {
    logo() {
      if (_.has(this.item.logo, "url")) {
        return this.item.logo.url;
      } else {
        return null;
      }
    },
    favicon() {
      if (_.has(this.item.favicon, "url")) {
        return this.item.favicon.url;
      } else {
        return null;
      }
    },
  },
  methods: {
    ...mapActions({
      uploadFile: "app/upload",
    }),
    uploadLogo(image) {
      this.item.logo = image;
    },
    uploadFavicon(image) {
      this.item.favicon = image;
    },
  },
};
</script>