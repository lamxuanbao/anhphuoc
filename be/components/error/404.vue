<template>
  <a-result
    status="404"
    title="404"
    :sub-title="$t('page_not_exist')"
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
  name: "Error404",
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
