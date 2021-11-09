<template functional>
  <v-lazy-image
    :src="props.src"
    :src-placeholder="props.srcPlaceholder"
  ></v-lazy-image>
</template>

<style scoped>
.v-lazy-image {
  width: 100%;
  filter: blur(5px);
  transition: filter 1.6s;
  will-change: filter;
}
.v-lazy-image-loaded {
  filter: blur(0);
}
</style>
