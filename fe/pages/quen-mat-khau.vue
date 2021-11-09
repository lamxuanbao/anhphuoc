<template>
  <div>
    <LayoutHeaderInfomation login="true"></LayoutHeaderInfomation>
    <article class="register mx-auto">
      <h4 class="title mt-3 text-center">Quên mật khẩu</h4>
      <div class="form-group">
        <a-input placeholder="Email" />
      </div>
      <p class="text-center">
        Vui lòng xác nhận Email của bạn để tiến hành cung cấp mật khẩu mới
      </p>
      <div class="form-group text-center">
        <a-button>Xác nhận</a-button>
      </div>
    </article>
    <LayoutFooter></LayoutFooter>
  </div>
</template>

<style lang="scss" scoped>
.register {
  max-width: 400px;
  a{
    color: #000000;
  }
  .title {
    color: #00a88e;
  }
  button {
    background: #00a88e;
    color: #ffffff;
  }
}
</style>