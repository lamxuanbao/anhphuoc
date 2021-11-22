<template>
  <div class="content">
    <template v-if="property !== 'undefined'">
      {{property}}
      <!-- <LayoutHeaderSearch></LayoutHeaderSearch>
      <div class="item mt-5">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
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
                <template v-if="property.images">
                  <div
                    class="item"
                    v-for="(image, index) in property.images"
                    key="image-${index}"
                  >
                    <div class="item-img" @click="showModal">
                      <image-zoom v-if="image.url" :src="image.url" />
                      <image-zoom
                        v-else
                        src="https://via.placeholder.com/468x300?text=..."
                      />
                    </div>
                  </div>
                </template>
              </a-carousel>
            </div>
            <div class="col-md-8 pt-3">
              <ul>
                <li>
                  <h4>{{ property.name }}</h4>
                </li>
                <li>Khu vực : {{ property.province.name }}</li>
                <li>Địa chỉ : {{ property.address }}</li>
                <li>Diện tích : {{ property.area }} m<sup>2</sup></li>
                <li>Ngày hết hạn :</li>
                <li>Xem tin : {{ property.view }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <a-modal
        :dialog-style="{ top: '0px' }"
        :visible="visible"
        :confirm-loading="confirmLoading"
        @ok="handleOk"
        @cancel="handleCancel"
        maskClosable
        width="80%"
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
          <template v-if="property.images">
            <div
              class="item"
              v-for="(image, index) in property.images"
              key="modal-image-${index}"
            >
              <div class="item-img">
                <img v-if="image.url" :src="image.url" />
                <img
                  v-else
                  src="https://via.placeholder.com/468x300?text=..."
                />
              </div>
            </div>
          </template>
        </a-carousel>
      </a-modal> -->
    </template>
    <template v-else>
      asdasd
    </template>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      slug: null,
      visible: false,
      confirmLoading: false,
    };
  },
  computed: {
    ...mapGetters({
      property: "property/data",
    }),
  },
  async fetch() {
    this.slug = this.$route.params.slug;
    await this.getData(this.slug).catch((e) => {
      const { status, data } = e.response;
      console.log(status, data);
      // this.serverErrors = data.errors;
    });
  },
  methods: {
    ...mapActions({
      getData: "property/get_data_by_slug",
    }),
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
        right: 30px;
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
