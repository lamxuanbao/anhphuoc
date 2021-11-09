<template>
<div class="container">
    <a-carousel arrows autoplay dots-class="slick-dots slick-thumb">
        <div slot="prevArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-left"/>
        </div>
        <div slot="nextArrow" slot-scope="props" class="custom-slick-arrow">
            <font-awesome-icon icon="caret-right"/>
        </div>
        <a slot="customPaging" slot-scope="props">
            <font-awesome-icon icon="circle"/>
        </a>
        <div class="item" v-for="item in 10" :key="item">
            <ul>
                <li>
                    <h3>Thuê nhà xưởng</h3>
                </li>
                <li>
                    Khu vực : TP.HCM
                </li>
                <li>
                    Địa chỉ : Khu công nghiệp Nhị Xuân Hóc Môn
                </li>
                <li>
                    Diện tích : 3000m<sup>2</sup>
                </li>
            </ul>
            <div class="item-img">
                <image-zoom :src="require('@/assets/images/image1.png')" />
            </div>
            <a-button class="item-button"> 
                Xem thêm
                <font-awesome-icon icon="long-arrow-alt-right"/>
            </a-button>
        </div>
    </a-carousel>
    <div class="slide-title">
        Tin mới
    </div>
    <div style="clear: both;"></div>
</div>
</template>
<script>
export default {};
</script>
<style scoped>

.ant-carousel h3{
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.slide-title{
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
.ant-carousel >>> .slick-thumb li a{
    color: transparent;
}

.ant-carousel >>> .slick-thumb li svg{
    color: #00a88e;
    padding: 3px;
}
.ant-carousel >>> .slick-thumb li.slick-active svg{
    border: 2px solid #00a88e;
    border-radius: 10px;
}

.ant-carousel .item{
    background: #00a88e;
    position: relative;
}
.ant-carousel .item img{
    width:100%;
    height:350px
}
.ant-carousel .item > button{
    width: 150px;
    color: #00a88e;
    text-align: left
}
.ant-carousel .item > button svg{
    float:right;
    position: relative;
    top: 3px;
}
.ant-carousel .item >>> ul{
    width: 288px;
    float: left;
    list-style: none;
    padding: 30px;
    color: #fff;
}
.ant-carousel .item >>> ul li{
    padding-bottom: 15px;
}
.ant-carousel .item .item-img{
    width: 74%;
    float: right;
}
.ant-carousel .item .item-button{
    position: absolute;
    left: 200px;
    bottom: 50px;
}
.ant-carousel .slick-prev,.ant-carousel .slick-next{
    top: auto;
    font-size: 100px;
    bottom: 0;
    z-index: 99;
}
.ant-carousel .slick-prev{
    left: 200px;
}
.ant-carousel .slick-next{
    left: 320px;
}
/* .ant-carousel >>> .custom-slick-arrow {
  width: 25px;
  height: 25px;
  font-size: 25px;
  color: #fff;
} */
.ant-carousel >>> .custom-slick-arrow > svg {
  color: #00a88e;
}
.ant-carousel >>> .custom-slick-arrow:before {
  display: none;
}
.ant-carousel >>> .custom-slick-arrow:hover {
  opacity: 0.5;
}
</style>