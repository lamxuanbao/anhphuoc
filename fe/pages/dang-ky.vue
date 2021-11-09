<template>
  <div>
    <LayoutHeaderInfomation :view="false"></LayoutHeaderInfomation>
    <article class="register mx-auto">
      <h4 class="title mt-3 text-center">Đăng Ký</h4>
      <div
        class="form-group"
        v-bind:class="[
          $v.item.email.$error ? 'has-error' : '',
          serverErrors.email ? 'has-error' : '',
        ]"
      >
        <a-input placeholder="Email" v-model="$v.item.email.$model" />
        <template v-if="$v.item.email.$error || serverErrors.email">
          <div class="ant-form-explain">
            <template v-if="!$v.item.email.required">
              {{ $t("message_required", { field: $t("email") }) }}
            </template>
            <template v-if="!$v.item.email.email">
              {{ $t("message_invalid", { field: $t("email") }) }}
            </template>
            <template v-else-if="serverErrors.email">
              Email đã tồn tại
            </template>
          </div>
        </template>
      </div>
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.password.$error }"
      >
        <a-input
          type="password"
          placeholder="Mật khẩu"
          v-model="$v.item.password.$model"
        />
        <template v-if="$v.item.password.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.password.required">
              {{ $t("message_required", { field: $t("password") }) }}
            </template>
            <template v-if="!$v.item.password.minLength">
              {{ $t("message_min_length", { min_length: 6 }) }}
            </template>
          </div>
        </template>
      </div>
      <div
        class="form-group"
        v-bind:class="{ 'has-error': $v.item.phone.$error }"
      >
        <a-input placeholder="Số điện thoại" v-model="$v.item.phone.$model" />

        <template v-if="$v.item.phone.$error">
          <div class="ant-form-explain">
            <template v-if="!$v.item.phone.required">
              {{ $t("message_required", { field: $t("phone") }) }}
            </template>
          </div>
        </template>
      </div>
      <p class="text-center">
        Bạn đã có tài khoản.
        <router-link to="/dang-nhap"> Đăng nhập </router-link>
      </p>
      <div class="form-group text-center">
        <a-button @click="onSave">Xác nhận</a-button>
      </div>
    </article>
    <LayoutFooter></LayoutFooter>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { validationMixin } from "vuelidate";
import { email, minLength, required } from "vuelidate/lib/validators";
export default {
  mixins: [validationMixin],
  data: function () {
    return {
      item: {
        email: null,
        password: null,
        phone: null,
      },
      serverErrors: {},
    };
  },
  validations: {
    item: {
      email: {
        required,
        email,
      },
      password: {
        required,
        minLength: minLength(6),
      },
      phone: {
        required,
      },
    },
  },
  methods: {
    ...mapActions({
      register: "auth/register",
    }),
    onSave(e) {
      e.preventDefault();
      this.$v.item.$touch();
      if (this.$v.item.$anyError) {
        return;
      }
      // const submitButton = this.$refs["kt_login_signin_submit"];
      // submitButton.classList.add("spinner", "spinner-light", "spinner-right");
      const data = this.$options.filters.data(this.item);
      this.register(data)
        .then(() => {
          // this.$router.push({ name: "user" });
        })
        .catch((e) => {
          const { status, data } = e.response;
          this.serverErrors = data.errors;
        });
    },
  },
};
</script>
<style lang="scss" scoped>
.register {
  max-width: 400px;
  a {
    color: #00a88e;
  }
  .title {
    color: #00a88e;
  }
  button {
    background: #00a88e;
    color: #ffffff;
  }
}
</style>