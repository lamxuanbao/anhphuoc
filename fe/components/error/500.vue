<template>
  <a-result status="500" title="500" :sub-title="$t('server_is_wrong')">
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
  name: "Error500",
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
