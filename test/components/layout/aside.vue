<template>
  <!-- begin:: Aside -->
  <div
    class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
    id="kt_aside"
    ref="kt_aside"
    @mouseover="mouseEnter"
    @mouseleave="mouseLeave"
  >
    <!-- begin:: Aside -->
    <LayoutBrand></LayoutBrand>
    <div
      class="aside-menu-wrapper flex-column-fluid"
    >
      <div
        ref="kt_aside_menu"
        id="kt_aside_menu"
        class="aside-menu"
        data-menu-vertical="1"
        data-menu-dropdown-timeout="500"
      >
        <!-- example static menu here -->
        <perfect-scrollbar
          class="aside-menu scroll"
          style="max-height: 90vh; position: relative"
        >
        <layout-aside-menu></layout-aside-menu>
        </perfect-scrollbar>
      </div>
    </div>
  </div>
  <!-- end:: Aside -->
</template>

<script>
// aside-on
export default {
  data() {
    return {
      insideTm: 0,
      outsideTm: 0,
    };
  },
  mounted() {
    this.$nuxt.$on("my-custom-event", () => {
      this.asideOn();
    });
  },
  methods: {
    asideOn() {
      $("#kt_aside").addClass("aside-on");
      $nuxt.$emit("aside-overlay", true);
    },
    /**
     * Use for fixed left aside menu, to show menu on mouseenter event.
     */
    mouseEnter() {
      if (document.body.classList.contains("aside-fixed")) {
        if (this.outsideTm) {
          clearTimeout(this.outsideTm);
          this.outsideTm = null;
        }

        // if the left aside menu is minimized
        if (document.body.classList.contains("aside-minimize")) {
          document.body.classList.add("aside-minimize-hover");

          // show the left aside menu
          document.body.classList.remove("aside-minimize");
        }
      }
    },

    /**
     * Use for fixed left aside menu, to show menu on mouseenter event.
     */
    mouseLeave() {
      if (document.body.classList.contains("aside-fixed")) {
        if (this.insideTm) {
          clearTimeout(this.insideTm);
          this.insideTm = null;
        }

        if (document.querySelector(".aside-menu .scroll")) {
          document.querySelector(".aside-menu .scroll").scrollTop = 0;
        }

        // if the left aside menu is expand
        if (document.body.classList.contains("aside-minimize-hover")) {
          // hide back the left aside menu
          document.body.classList.remove("aside-minimize-hover");
          document.body.classList.add("aside-minimize");
        }
      }
    },
  },
};
</script>
