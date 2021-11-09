<template functional>
  <div>
    <style>
      :root {
        --width: {{ props.width || '100%' }};
      }
    </style>
    <v-lazy-image
      :src="props.src"
      :src-placeholder="props.srcPlaceholder"
    ></v-lazy-image>
  </div>
</template>
<script>
import _ from "lodash";
export default {
  mounted() {
    console.log(this.width);
  },
};
</script>
<style scoped>
.v-lazy-image {
  width: var(--width);
  opacity: 0;
  transform: scale3d(0.3, 0.3, 0.3);
  transition: opacity 0.5s, transform 0.5s;
}
.v-lazy-image-loaded {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}
</style>
