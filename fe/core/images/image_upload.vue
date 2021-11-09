<template>
  <a-upload
    list-type="picture-card"
    class="avatar-uploader"
    :show-upload-list="false"
    :before-upload="beforeUpload"
    @change="handleChange"
  >
    <image-zoom v-if="imageUrl" :src="imageUrl"/>
    <div v-else>
      <a-icon type="plus" />
      <div class="ant-upload-text">{{ $t("upload") }}</div>
    </div>
  </a-upload>
</template>

<script>
function getBase64(src, callback) {
  const reader = new FileReader();
  reader.addEventListener("load", () => callback(reader.result));
  reader.readAsDataURL(src);
}

export default {
  props: {
    src: {
      type: String,
      default: null,
    },
  },
  data: () => ({
    imageUrl: null,
  }),
  watch: {
    img(src) {
      this.imageUrl = src;
    },
  },
  created() {
    this.imageUrl = this.src;
  },
  methods: {
    handleChange(info) {
      getBase64(info.file, (imageUrl) => {
        this.imageUrl = imageUrl;
        this.$emit("change", info.file);
      });
      return false;
    },
    beforeUpload(file) {
      this.$emit("beforeChange", file);
      return false;
    },
  },
};
</script>
