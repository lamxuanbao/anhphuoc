<template>
  <div>
    <div class="row">
      <div class="col-6">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.first_name.$error ? 'has-error' : '',
            serverErrors.email ? 'has-error' : '',
          ]"
        >
          <label>
            {{ $t("first_name") }} <span class="text-danger">*</span>
          </label>
          <a-input size="large" v-model="item.first_name" />
          <div
            class="ant-form-explain"
            v-if="$v.item.first_name.$error || serverErrors.first_name"
          >
            <template v-if="!$v.item.first_name.required">
              {{ $t("message_required", { field: $t("first_name") }) }}
            </template>
            <template v-else-if="serverErrors.first_name">
              {{ serverErrors.first_name[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.last_name.$error ? 'has-error' : '',
            serverErrors.email ? 'has-error' : '',
          ]"
        >
          <label>
            {{ $t("last_name") }} <span class="text-danger">*</span>
          </label>
          <a-input size="large" v-model="item.last_name" />
          <div
            class="ant-form-explain"
            v-if="$v.item.last_name.$error || serverErrors.last_name"
          >
            <template v-if="!$v.item.last_name.required">
              {{ $t("message_required", { field: $t("last_name") }) }}
            </template>
            <template v-else-if="serverErrors.last_name">
              {{ serverErrors.last_name[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.email.$error ? 'has-error' : '',
            serverErrors.email ? 'has-error' : '',
          ]"
        >
          <label> {{ $t("email") }} <span class="text-danger">*</span> </label>
          <a-input size="large" v-model="item.email" />
          <div
            class="ant-form-explain"
            v-if="$v.item.email.$error || serverErrors.email"
          >
            <template v-if="!$v.item.email.required">
              {{ $t("message_required", { field: $t("email") }) }}
            </template>
            <template v-else-if="!$v.item.email.email">
              {{ $t("message_invalid", { field: $t("email") }) }}
            </template>
            <template v-else-if="serverErrors.email">
              {{ serverErrors.email[0] }}
            </template>
          </div>
        </div>
      </div>
    </div>
    <template v-if="showPassword">
      <div class="row">
        <div class="col-6">
          <div
            class="form-group"
            v-bind:class="{ 'has-error': $v.item.password.$error }"
          >
            <label
              >{{ $t("password") }} <span class="text-danger">*</span></label
            >
            <a-input
              size="large"
              type="password"
              v-model="$v.item.password.$model"
            />
            <template v-if="$v.item.password.$error">
              <div class="ant-form-explain">
                <template v-if="!$v.item.password.required">
                  {{ $t("message_required", { field: $t("password") }) }}
                </template>
                <template v-else-if="!$v.item.password.minLength">
                  {{ $t("message_min_length", { min_length: 6 }) }}
                </template>
              </div>
            </template>
          </div>
        </div>
        <div class="col-6">
          <div
            class="form-group"
            v-bind:class="{ 'has-error': $v.item.password_confirmation.$error }"
          >
            <label
              >{{ $t("password_confirmation") }}
              <span class="text-danger">*</span></label
            >
            <a-input
              size="large"
              type="password"
              v-model="$v.item.password_confirmation.$model"
            />
            <template v-if="$v.item.password_confirmation.$error">
              <div class="ant-form-explain">
                <template v-if="!$v.item.password_confirmation.required">
                  {{ $t("message_required", { field: $t("password_confirmation") }) }}
                </template>
                <template v-if="!$v.item.password_confirmation.sameAsPassword">
                  {{ $t("message_identical", { field: $t("password") }) }}
                </template>
              </div>
            </template>
          </div>
        </div>
      </div>
    </template>
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label>{{ $t("status") }}</label>
          <a-switch v-model="item.is_active" />
        </div>
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
      default() {
        return {};
      },
    },
    serverErrors: {
      type: Object,
      default() {
        return {};
      },
    },
    showPassword: {
      type: Boolean,
      default: true,
    },
  },
  validations() {
    var validation = {
      first_name: {
        required,
      },
      last_name: {
        required,
      },
      email: {
        required,
        email,
      },
    };
    if (this.showPassword) {
      validation = {
        ...validation,
        ...{
          password: {
            required,
            minLength: minLength(6),
          },
          password_confirmation: {
            required,
            sameAsPassword: sameAs("password"),
          },
        },
      };
    }
    return { item: validation };
  },
};
</script>