<template>
  <fieldset
    class="accordion-group-item d-none"
    :id="computedId"
    :key="computedId"
  >
    <slot />
  </fieldset>
</template>

<script>
export default {
  props: {
    id: { default: null },
    name: { required: true },
  },
  computed: {
    getName() {
      return this.prefix + this.name + this.suffix;
    },
    computedId() {
      return "accordion-group-item-" + this._uid;
    },
    navId() {
      return "accordion-nav-" + this._uid;
    },
  },
};
</script>

<style></style>
