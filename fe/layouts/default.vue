<template>
  <Nuxt />
</template>
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
</style>