<template>
  <div class="w-100">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label>{{ $t("keywords") }}:</label>
          <a-input size="large" v-model="item.keywords" />
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label>{{ $t("description") }}:</label>
          <a-textarea
            v-model="item.description"
            :auto-size="{ minRows: 3, maxRows: 3 }"
          />
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
    },
  },
};
</script>