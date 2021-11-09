<template>
  <div class="row">
    <div class="col-12">
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.name.$error }"
      >
        <label> {{ $t("name") }} <span class="text-danger">*</span> </label>
        <a-input size="large" v-model="$v.item.name.$model" />
        <template v-if="$v.item.name.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.name.required">
              {{ $t("message_required", { field: $t("name") }) }}
            </template>
          </div>
        </template>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <label>{{ $t("status") }}</label>
        <a-switch v-model="item.is_active" />
      </div>
    </div>
  </div>
</template>
<script>
import { email, minLength, required, sameAs } from "vuelidate/lib/validators";
export default {
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  validations() {
    var validation = {
      name: {
        required,
      },
    };
    return { item: validation };
  },
};
</script>