<template>
  <div class="row">
    <div class="col-12">
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.password.$error }"
      >
        <label>{{ $t("new_password") }}:</label>
        <a-input
          size="large"
          type="password"
          v-model="$v.item.password.$model"
        />
        <template v-if="$v.item.password.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.password.required">
              {{ $t("message_required", { field: $t("new_password") }) }}
            </template>
            <template v-if="!$v.item.password.minLength">
              {{ $t("message_min_length", { min_length: 6 }) }}
            </template>
          </div>
        </template>
      </div>
    </div>
    <div class="col-12">
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.password_confirmation.$error }"
      >
        <label>{{ $t("confirm_new_password") }}:</label>
        <a-input
          size="large"
          type="password"
          v-model="$v.item.password_confirmation.$model"
        />
        <template v-if="$v.item.password_confirmation.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.password_confirmation.sameAsPassword">
              {{ $t("message_identical", { field: $t("new_password") }) }}
            </template>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
<script>
import { email, minLength, required, sameAs } from "vuelidate/lib/validators";
import _ from "lodash";
export default {
  props: {
    item: {
      type: Object,
      default() {
        return {};
      },
    },
  },
  validations() {
    var validation = {
      password: {},
      password_confirmation: {},
    };
    if (
      !_.isEmpty(this.item.password) ||
      !_.isEmpty(this.item.password_confirmation)
    ) {
      validation = {
        ...validation,
        ...{
          password: {
            required,
            minLength: minLength(6),
          },
          password_confirmation: {
            sameAsPassword: sameAs("password"),
          },
        },
      };
    }
    return { item: validation };
  },
};
</script>