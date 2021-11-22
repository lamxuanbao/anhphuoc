<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-light">
          <router-link class="navbar-brand" to="/">
            <img :src="require('@/assets/images/logo.png')" />
          </router-link>
        </nav>
      </div>
    </div>
    <div class="d-flex flex-row position-relative">
      <div class="area">
        <div class="header-dot"></div>
        <div class="title">Khu Vực</div>
      </div>
      <div class="w-100">
        <div class="d-flex flex-row pb-3">
          <div class="col-md-9">
            <a-input size="large" placeholder="Tên" class="w-100" />
          </div>
          <div class="col-md-3">
            <a-select
              class="w-100"
              size="large"
              label-in-value
              placeholder="Loại"
            >
              <a-select-option value="jack"> Jack (100) </a-select-option>
              <a-select-option value="lucy"> Lucy (101) </a-select-option>
            </a-select>
          </div>
        </div>
        <div class="d-flex flex-row pb-3">
          <div class="col-md-4">
            <a-select
              class="w-100"
              size="large"
              label-in-value
              placeholder="Tỉnh/Thành"
            >
              <a-select-option value="jack"> Jack (100) </a-select-option>
              <a-select-option value="lucy"> Lucy (101) </a-select-option>
            </a-select>
          </div>
          <div class="col-md-4">
            <a-select
              class="w-100"
              size="large"
              label-in-value
              placeholder="Diện tích"
            >
              <a-select-option value="jack"> Jack (100) </a-select-option>
              <a-select-option value="lucy"> Lucy (101) </a-select-option>
            </a-select>
          </div>
          <div class="col-md-4">
            <a-select
              class="w-100"
              size="large"
              label-in-value
              placeholder="Giá"
            >
              <a-select-option value="jack"> Jack (100) </a-select-option>
              <a-select-option value="lucy"> Lucy (101) </a-select-option>
            </a-select>
          </div>
        </div>
        <div class="d-flex flex-row-reverse">
          <div class="col-md-4 text-right">
            <a-button>Tìm kiếm</a-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    login: {
      type: Boolean,
      default: () => false,
    },
  },
};
</script>
<style lang="scss" scoped>
.header-dot {
  border-bottom: 2px solid #00a88e;
  width: 200px;
  position: absolute;
  left: -100px;
}
.area {
  width: 200px;
  .title {
    position: relative;
    width: 180px;
    text-transform: uppercase;
    padding: 30px;
    font-weight: bold;
    color: #fff;
    background: #00a88e;
    font-size: 60px;
    line-height: 60px;
  }
}
.ant-btn {
  border: 2px solid #00a88e;
  color: #00a88e;
}
</style>