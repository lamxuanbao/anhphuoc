<template>
  <div class="clearfix">
    <a-upload
      action=""
      list-type="picture-card"
      :file-list="fileList"
      @preview="handlePreview"
      :before-upload="beforeUpload"
      @change="handleChange"
      :remove="handleRemove"
    >
      <template v-if="fileList">
        <div v-if="fileList.length < 5">
          <a-icon type="plus" />
          <div class="ant-upload-text">Upload</div>
        </div>
      </template>
    </a-upload>
    <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
      <img alt="example" style="width: 100%" :src="previewImage" />
    </a-modal>
  </div>
</template>
<script>
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}
export default {
  props: {
    images: {
      default: function () {
        return [];
      },
    },
  },
  data() {
    return {
      previewVisible: false,
      previewImage: "",
      fileList: [],
    };
  },
  watch: {
    images: function (newVal, oldVal) {
      this.fileList = newVal;
    },
  },
  created(){
    this.fileList = this.images;
  },
  methods: {
    handleCancel() {
      this.previewVisible = false;
    },
    async handlePreview(file) {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
      }
      this.previewImage = file.url || file.preview;
      this.previewVisible = true;
    },
    handleChange({ fileList }) {
      this.fileList = fileList;
      return false;
    },
    handleRemove(file) {
      console.log(file);
      // this.fileList = fileList;
      // return false;
    },
    beforeUpload(file) {
      this.$emit("change", file);
    },
  },
};
</script>
<style>
/* you can make up upload button and sample style by using stylesheets */
.ant-upload-select-picture-card i {
  font-size: 32px;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px;
  color: #666;
}
</style>