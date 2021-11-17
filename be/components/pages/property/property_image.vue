<template>
  <div class="w-100">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label>{{ $t("logo") }}:</label>
          {{item}}
          <!-- <image-upload :src="logo" @change="uploadLogo" width="65px" /> -->
          <client-only>
            <image-upload-multi :images="item.images" @change="uploadFile" @remove="removeFile" />
          </client-only>
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
    favicon() {
      if (_.has(this.item.favicon, "url")) {
        return this.item.favicon.url;
      } else {
        return null;
      }
    },
  },
  methods: {
    uploadFile(image) {
      const that = this;
      let files = that.item.files;
      files.push(image);
      that.item.files = files;
    },
    removeFile(image) {
      const that = this;
      let remove_files = that.item.remove_files;
      remove_files.push(image.id);
      that.item.remove_files = remove_files;
      console.log(that.item);
    }
  },
};
</script>