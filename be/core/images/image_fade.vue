<template functional>
  <v-lazy-image
    :src="props.src"
    :src-placeholder="props.srcPlaceholder"
  ></v-lazy-image>
</template>

<style scoped>
.v-lazy-image {
  width: 100%;
  opacity: 0;
  transition: opacity 2s;
}
.v-lazy-image-loaded {
  opacity: 1;
}
</style>
