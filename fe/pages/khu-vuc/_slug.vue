<template>
  <div class="content">
    <LayoutHeaderSearch></LayoutHeaderSearch>
    <div class="item mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <client-only>
              <a-carousel arrows autoplay :dots="false">
                <div
                  slot="prevArrow"
                  slot-scope="props"
                  class="custom-slick-arrow"
                >
                  <font-awesome-icon icon="caret-left" />
                </div>
                <div
                  slot="nextArrow"
                  slot-scope="props"
                  class="custom-slick-arrow"
                >
                  <font-awesome-icon icon="caret-right" />
                </div>
                <a slot="customPaging" slot-scope="props">
                  <font-awesome-icon icon="circle" />
                </a>
                <div class="item" v-for="item in 10" :key="item">
                  <div class="item-img">
                    <img
                      :src="require('@/assets/images/image1.png')"
                      @click="showModal"
                    />
                  </div>
                </div>
              </a-carousel>
            </client-only>
          </div>
          <div class="col-md-8 pt-3">
            <ul>
              <li>
                <router-link class="navbar-brand" to="/">
                  <a-tag>Tag 1</a-tag>
                </router-link>
              </li>
              <li>
                <h4>Cho thue nha xuong</h4>
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
    <client-only>
      <a-modal
        :dialog-style="{ top: '0px' }"
        :visible="visible"
        :confirm-loading="confirmLoading"
        @ok="handleOk"
        @cancel="handleCancel"
        maskClosable
        width="100%"
      >
        <a-carousel arrows dots-class="slick-dots slick-thumb">
          <div slot="prevArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-left" />
          </div>
          <div slot="nextArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-right" />
          </div>
          <a slot="customPaging" slot-scope="props">
            <font-awesome-icon icon="circle" />
          </a>
          <div class="item" v-for="item in 10" :key="item">
            <div class="item-img">
              <img :src="require('@/assets/images/image1.png')" />
            </div>
          </div>
        </a-carousel>
      </a-modal>
    </client-only>
  </div>
</template>
<script>
export default {
  data() {
    return {
      visible: false,
      confirmLoading: false,
    };
  },
  methods: {
    showModal() {
      this.visible = true;
    },
    handleOk(e) {
      this.confirmLoading = true;
      setTimeout(() => {
        this.visible = false;
        this.confirmLoading = false;
      }, 2000);
    },
    handleCancel(e) {
      console.log("Clicked cancel button");
      this.visible = false;
    },
  },
};
</script>
<style lang="scss">
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
.ant-carousel .item > button {
  width: 150px;
  color: #00a88e;
  text-align: left;
}
.ant-carousel .item > button svg {
  float: right;
  position: relative;
  top: 3px;
}
.ant-carousel .item >>> ul {
  width: 288px;
  float: left;
  list-style: none;
  padding: 30px;
  color: #fff;
}
.ant-carousel .item >>> ul li {
  padding-bottom: 15px;
}
.ant-carousel .item .item-button {
  position: absolute;
  left: 200px;
  bottom: 50px;
}
.ant-carousel .slick-prev,
.ant-carousel .slick-next {
  font-size: 60px;
  z-index: 99;
  bottom: 50px;
  top: auto;
}
.ant-carousel .slick-prev {
  left: 40%;
}
.ant-carousel .slick-next {
  left: 55%;
}
.ant-carousel .custom-slick-arrow > svg {
  color: #00a88e;
}
.ant-carousel .custom-slick-arrow:before {
  display: none;
}
.ant-carousel .custom-slick-arrow:hover {
  opacity: 0.5;
}

.ant-modal-content {
  background: transparent;
  .ant-modal-close-x {
    color: #fff;
  }
  .ant-modal-body {
    .ant-carousel {
      .slick-dots {
        height: auto;
      }
      .slick-slide {
        img {
          display: block;
          margin: auto;
        }
      }
      .slick-thumb {
        bottom: -45px;
        text-align: center;
        li {
          height: 45px;
          a {
            color: transparent;
          }
          img {
            width: 100%;
            height: 100%;
            filter: grayscale(100%);
          }

          svg {
            color: #00a88e;
            padding: 3px;
          }
          &.slick-active {
            img {
              filter: grayscale(0%);
            }
            svg {
              border: 2px solid #00a88e;
              border-radius: 10px;
            }
          }
        }
      }
      .slick-prev {
        left: 45%;
      }
      .slick-next {
        left: 50%;
      }
      .custom-slick-arrow {
        svg {
          color: #00a88e;
        }
        &::before {
          display: none;
        }
        &:hover {
          opacity: 0.5;
        }
      }
    }
    img {
      width: 100%;
    }
  }
}
</style>