<template>
  <fieldset>
    <div class="row">
      <div v-if="slug" class="col-12">
        <div class="form-group">
          <label>{{$t('url')}}</label>
          <a-input v-model="item.slug" />
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label>Từ khóa:</label>
          <a-input v-model="item.meta_keywords" />
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label>Mô tả:</label>
          <a-textarea v-model="item.meta_description" :rows="4" />
        </div>
      </div>
    </div>
  </fieldset>
</template>
<script>
export default {
  name: "Seo",
  props: {
    item: {
      type: Object,
      default: () => {},
    },
    slug: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
