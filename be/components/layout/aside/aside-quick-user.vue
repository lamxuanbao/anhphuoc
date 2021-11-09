<template>
  <div class="topbar-item">
    <div
      class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2"
      @click="showDrawer"
    >
      <span
        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"
      >
        Hi,
      </span>
      <span
        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"
      >
        Sean 1
      </span>
      <span class="symbol symbol-35 symbol-light-success">
        <img v-if="false" alt="Pic" :src="picture" />
        <span v-if="true" class="symbol-label font-size-h5 font-weight-bold">
          S
        </span>
      </span>
    </div>

    <a-drawer
      placement="right"
      :closable="false"
      :visible="visible"
      @close="onClose"
    >
      <!--begin::Header-->
      <div
        class="offcanvas-header d-flex align-items-center justify-content-between pb-5"
      >
        <h3 class="font-weight-bold m-0">
          User Profile
          <small class="text-muted font-size-sm ml-2">12 messages</small>
        </h3>
        <span
          class="btn btn-xs btn-icon btn-light btn-hover-primary"
          @click="onClose"
        >
          <i class="ki ki-close icon-xs text-muted"></i>
        </span>
      </div>
      <!--end::Header-->

      <!--begin::Content-->
      <perfect-scrollbar
        class="offcanvas-content pr-5 mr-n5 scroll"
        style="position: relative"
      >
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5" style="min-width: 320px">
          <div class="symbol symbol-100 mr-5">
            <img class="symbol-label" :src="picture" alt="" />
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <a
              href="#"
              class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"
            >
              James Jones
            </a>
            <div class="text-muted mt-1">Application Developer</div>
            <div class="navi mt-2">
              <a href="#" class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-icon mr-1">
                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                      <!--begin::Svg Icon-->
                      <!-- <inline-svg
                        src="media/svg/icons/Communication/Mail-notification.svg"
                      /> -->
                      <!--end::Svg Icon-->
                    </span>
                  </span>
                  <span class="navi-text text-muted text-hover-primary">
                    jm@softplus.com
                  </span>
                </span>
              </a>
            </div>
            <button class="btn btn-light-primary btn-bold" @click="onLogout">
              Sign out
            </button>
          </div>
        </div>
        <!--end::Header-->
      </perfect-scrollbar>
      <!--end::Content-->
    </a-drawer>
  </div>
</template>

<style lang="scss" scoped>
#kt_quick_user {
  overflow: hidden;
}
</style>

<script>
export default {
  data() {
    return {
      visible: false,
    };
  },
  computed: {
    picture() {
      return "https://picsum.photos/200/300";
    },
  },
  methods: {
    showDrawer() {
      this.visible = true;
    },
    onClose() {
      this.visible = false;
    },
    onLogout() {
      this.$store.dispatch("auth/logout").finally(() => {
        this.$router.push({ name: "auth-login" });
      });
    },
    closeOffcanvas() {},
  },
};
</script>