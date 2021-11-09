<template>
  <div class="content">
    <LayoutHeaderSearch></LayoutHeaderSearch>
    <div class="item mt-5" v-for="item in 10" :key="item">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <image-zoom :src="require('@/assets/images/image1.png')" />
          </div>
          <div class="col-md-8 pt-3">
            <ul>
              <li>
                <router-link class="navbar-brand" to="/khu-vuc/1">
                  <a-tag>Tag 1</a-tag>
                </router-link>
              </li>
              <li>
                <router-link class="navbar-brand" to="/khu-vuc/1">
                  <h4>Cho thue nha xuong</h4>
                </router-link>
              </li>
              <li>Diện tích :</li>
              <li>Liên hệ :</li>
              <li>Ngày hết hạn :</li>
              <li>Còn lại :</li>
              <li>Xem tin :</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.content {
  background-color: rgba(229, 230, 236, 0.5);
  height: 100%;
  position: relative;
  .item {
    background: #faf8ee;

    img {
      width: 100%;
      height: 300px;
    }
    ul {
      width: 100%;
      list-style: none;
      padding: 0;
      margin: 0;
      li {
        line-height: 40px;
      }
    }
    .ant-tag {
      cursor: pointer;
      border: 2px solid #00a88e;
      color: #00a88e;
      background: transparent;
      font-size: 20px;
      padding: 5px;
    }
  }
}
</style>