<template>
  <div id="kt_header_mobile" class="header-mobile align-items-center">
    <!--begin::Logo-->
    <a href="/">
      <img alt="Logo" src="assets/media/logos/logo-light.png" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <!--begin::Aside Mobile Toggle-->
      <button
        class="btn p-0 burger-icon burger-icon-left"
        @click="mobileMenuShow"
      >
        <span></span>
      </button>
      <!--end::Aside Mobile Toggle-->
      <!--begin::Header Menu Mobile Toggle-->
      <button
        class="btn p-0 burger-icon ml-4"
        id="kt_header_mobile_toggle"
        ref="kt_header_mobile_toggle"
      >
        <span></span>
      </button>
      <!--end::Header Menu Mobile Toggle-->
      <!--begin::Topbar Mobile Toggle-->
      <button
        class="btn btn-hover-text-primary p-0 ml-2"
        id="kt_header_mobile_topbar_toggle"
        ref="kt_header_mobile_topbar_toggle"
      >
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:svg/icons/General/User.svg-->
          <!-- <inline-svg class="svg-icon" src="media/svg/icons/General/User.svg" /> -->
          <!--end::Svg Icon-->
        </span>
      </button>
      <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  components: {},
  methods: {
    mobileMenuShow() {
      $nuxt.$emit("my-custom-event", "data");
      // this.$bus.$emit('name-of-event', 'your-data')
    },
  },
};
</script>
