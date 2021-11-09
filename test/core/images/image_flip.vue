<template functional>
  <v-lazy-image
    :src="props.src"
    :src-placeholder="props.srcPlaceholder"
  ></v-lazy-image>
</template>

<style scoped>
.v-lazy-image {
  width: 100%;
  transition: transform 1s;
}
.v-lazy-image-loaded {
  transform: rotate3d(1, 0, 0, 360deg);
}
</style>
