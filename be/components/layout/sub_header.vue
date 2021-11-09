<template>
  <div class="subheader py-2 py-lg-4 solid bg-white border-top">
    <div
      class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid"
    >
      <div class="d-flex align-items-center flex-wrap mr-1">
        <h5 class="text-dark font-weight-bold my-2 mr-5">
          {{ title }}
        </h5>
      </div>

      <div class="d-flex align-items-center">
        <a href="#" class="btn btn-light font-weight-bold btn-sm"> Actions </a>
        <b-dropdown id="dropdown-text" text="Dropdown with text" class="m-2">
          <b-dropdown-text style="width: 240px">
            Some example text that's free-flowing within the dropdown menu.
          </b-dropdown-text>
          <b-dropdown-text>And this is more example text.</b-dropdown-text>
          <b-dropdown-divider></b-dropdown-divider>
          <b-dropdown-item-button>First item</b-dropdown-item-button>
          <b-dropdown-item-button>Second Item</b-dropdown-item-button>
        </b-dropdown>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.custom-v-dropdown {
  &.dropdown-toggle {
    padding: 0;
    &:hover {
      text-decoration: none;
    }

    &.dropdown-toggle-no-caret {
      &:after {
        content: none;
      }
    }
  }

  &.dropdown-menu {
    margin: 0;
    padding: 0;
    outline: none;
    .b-dropdown-text {
      padding: 0;
    }
  }
}
</style>

<script>
export default {
  props: {
    breadcrumbs: Array,
    title: String,
  },
};
</script>
