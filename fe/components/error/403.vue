<template>
  <a-result
    status="403"
    title="403"
    sub-title="Sorry, you are not authorized to access this page."
  >
    <template #extra>
      <router-link to="/" custom v-slot="{ href }">
        <a-button type="primary" :href="href">
          {{ $t("back_home") }}
        </a-button>
      </router-link>
    </template>
  </a-result>
</template>
<script>
export default {
  name: "Error403",
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
