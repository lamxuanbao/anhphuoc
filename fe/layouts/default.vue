<template>
  <Nuxt />
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      setting: "setting/data",
    }),
  },
  head() {
    let head = {};
    if (this.setting.app_title) {
      head.title = this.setting.app_title;
    }
    return head;
  },
};
</script>

<style lang="scss">
#__nuxt,
#__layout {
  width: 100%;
  height: 100%;
}
body {
  background-image: url("~assets/images/bg.png");
  background-repeat: no-repeat;
  background-size: 100%;
}
.ant-modal-footer {
  display: none;
}
.ant-modal-body {
  padding: 0px;
}
.ant-modal-content {
  background: transparent;
  .ant-modal-close-x {
    color: #fff;
  }
}
.item-button {
  position: relative;
  z-index: 9999;
}
</style>
