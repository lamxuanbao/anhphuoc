<template>
  <div class="row">
    <div class="col-12">
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.app_title.$error }"
      >
        <label>{{ $t("title") }}:</label>
        <a-input size="large" v-model="$v.item.app_title.$model" />
        <template v-if="$v.item.app_title.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.app_title.required">
              {{ $t("field_is_required") }}
            </template>
          </div>
        </template>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <label>{{ $t("description") }}:</label>
        <a-input size="large" v-model="item.app_description" />
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <label>{{ $t("keywords") }}:</label>
        <a-input size="large" v-model="item.app_keywords" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import { email, minLength, required } from "vuelidate/lib/validators";
export default {
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  validations: {
    item: {
      app_title: {
        required,
      },
    },
  },
  data: () => ({}),
  computed: {},
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.item[name];
      return $dirty ? !$error : null;
    },
  },
};
</script>
