<template>
  <div>
    <LayoutHeaderInfomation :login="login"></LayoutHeaderInfomation>
    <client-only>
      <div class="container">
        <a-carousel arrows autoplay dots-class="slick-dots slick-thumb">
          <div slot="prevArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-left" />
          </div>
          <div slot="nextArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-right" />
          </div>
          <a slot="customPaging" slot-scope="props">
            <font-awesome-icon icon="circle" />
          </a>
          <div
            class="item"
            v-for="(item, index) in items"
            key="index-item-${index}"
          >
            <ul>
              <li>
                <h3>{{ item.name }}</h3>
              </li>
              <li>Khu vực : {{ item.province.name }}</li>
              <li>Địa chỉ : {{ item.address }}</li>
              <li>Diện tích : {{ item.area }} m<sup>2</sup></li>
            </ul>
            <div class="item-img">
              <image-zoom v-if="item.images[0]" :src="item.images[0].url" />
              <image-zoom
                v-else
                src="https://via.placeholder.com/468x300?text=..."
              />
            </div>
            <router-link :to="item.slug" v-slot="{ href }">
              <a-button class="btn item-button" :href="href">
                Xem thêm
                <font-awesome-icon icon="long-arrow-alt-right" />
              </a-button>
            </router-link>
          </div>
        </a-carousel>
        <div class="slide-title">Tin mới</div>
        <div class="clear"></div>
        <div class="row area">
          <div class="col-md-4 text-center">
            <img :src="require('@/assets/images/longan.png')" class="w-100" />
            <div class="name">Long An</div>
          </div>
          <div class="col-md-4 text-center">
            <img
              :src="require('@/assets/images/hochiminh.png')"
              class="w-100 active"
            />
            <div class="name">TP.HCM</div>
          </div>
          <div class="col-md-4 text-center">
            <img :src="require('@/assets/images/dongnai.png')" class="w-100" />
            <div class="name">Biên Hoà</div>
          </div>
          <div class="title">Khu Vực</div>
        </div>
      </div>

      <LayoutFooter></LayoutFooter>
    </client-only>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: function() {
    return {
      login: false,
    };
  },
  computed: {
    ...mapGetters({
      auth: "auth/data",
      items: "property/list",
    }),
  },
  async fetch() {
    const token = this.$store.state.auth.token || null;
    if (token !== null) {
      await this.getAuth()
        .then(() => {
          if (this.auth !== null) {
            this.login = true;
          }
        })
        .catch((e) => {
          this.$store.dispatch("auth/log_out");
        });
    }
    await this.getData({
      length: 10,
      is_active: 1,
    }).then(() => {
      console.log(this.items);
    });
  },
  methods: {
    ...mapActions({
      getAuth: "auth/get_data",
      getData: "property/get_list",
    }),
  },
};
</script>
<style scoped>
.clear {
  clear: both;
}
.ant-carousel h3 {
  color: #fff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.slide-title {
  position: relative;
  float: right;
  width: 180px;
  text-transform: uppercase;
  padding: 30px;
  font-weight: bold;
  color: #fff;
  background: #00a88e;
  font-size: 60px;
  line-height: 60px;
  top: -100px;
  right: 50px;
}

.ant-carousel >>> .slick-dots {
  height: auto;
}
.ant-carousel >>> .slick-slide img {
  display: block;
  margin: auto;
}
.ant-carousel >>> .slick-thumb {
  bottom: -45px;
  text-align: right;
  right: 250px;
}
.ant-carousel >>> .slick-thumb li {
  height: 45px;
}
.ant-carousel >>> .slick-thumb li img {
  width: 100%;
  height: 100%;
  filter: grayscale(100%);
}
.ant-carousel >>> .slick-thumb li.slick-active img {
  filter: grayscale(0%);
}
.ant-carousel >>> .slick-thumb li a {
  color: transparent;
}

.ant-carousel >>> .slick-thumb li svg {
  color: #00a88e;
  padding: 3px;
}
.ant-carousel >>> .slick-thumb li.slick-active svg {
  border: 2px solid #00a88e;
  border-radius: 10px;
}

.ant-carousel .item {
  background: #00a88e;
  position: relative;
}
.ant-carousel .item img {
  width: 100%;
  height: 350px;
}
.ant-carousel .item > .btn {
  width: 150px;
  color: #00a88e;
  text-align: left;
}
.ant-carousel .item > .btn svg {
  float: right;
  position: relative;
  top: 9px;
}
.ant-carousel .item >>> ul {
  width: 30%;
  float: left;
  list-style: none;
  padding: 30px;
  color: #fff;
}
.ant-carousel .item >>> ul li {
  padding-bottom: 15px;
}
.ant-carousel .item .item-img {
  width: 70%;
  float: right;
}
.ant-carousel .item .item-button {
  position: absolute;
  left: 200px;
  bottom: 50px;
}
.ant-carousel .slick-prev,
.ant-carousel .slick-next {
  top: auto;
  font-size: 100px;
  bottom: 0;
  z-index: 99;
}
.ant-carousel .slick-prev {
  left: 200px;
}
.ant-carousel .slick-next {
  left: 320px;
}
.ant-carousel >>> .custom-slick-arrow > svg {
  color: #00a88e;
}
.ant-carousel >>> .custom-slick-arrow:before {
  display: none;
}
.ant-carousel >>> .custom-slick-arrow:hover {
  opacity: 0.5;
}
.area {
  position: relative;
}
.area .name {
  width: 100%;
  font-size: 60px;
  font-weight: bold;
  color: #f0f0f0;
  position: absolute;
  bottom: 100px;
  text-align: center;
}
.area img.active {
  transform: scale(1.1);
}
.area .title {
  position: relative;
  float: right;
  width: 180px;
  text-transform: uppercase;
  padding: 30px;
  font-weight: bold;
  color: #fff;
  background: #00a88e;
  font-size: 60px;
  line-height: 60px;
  bottom: 90px;
  left: 70px;
}
</style>
