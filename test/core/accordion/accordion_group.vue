<template>
  <section>
    <slot />
  </section>
</template>

<script>
export default {
  props: {
    id: { default: null },
    name: { required: true },
    prefix: { default: '' },
    suffix: { default: '' }
  },
  computed: {
    getName () {
      return this.prefix + this.name + this.suffix
    },
    computedId () {
      return 'accordion-group-' + this._uid
    },
    hash () {
      return '#' + this.computedId
    }
  }
}
</script>

<style></style>
