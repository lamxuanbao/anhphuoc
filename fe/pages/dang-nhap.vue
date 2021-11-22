<template>
  <div>
    <LayoutHeaderInfomation :view="false"></LayoutHeaderInfomation>
    <article class="register mx-auto">
      <h4 class="title mt-3 text-center">Đăng nhập</h4>
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
            <template v-else-if="!$v.item.email.email">
              {{ $t("message_invalid", { field: $t("email") }) }}
            </template>
            <template v-else-if="serverErrors.email">
              {{ serverErrors.email[0] }}
            </template>
          </div>
        </template>
      </div>
      <div
        class="form-group"
        v-bind:class="[
          $v.item.password.$error ? 'has-error' : '',
          serverErrors.password ? 'has-error' : '',
        ]"
      >
        <a-input
          type="password"
          placeholder="Mật khẩu"
          v-model="$v.item.password.$model"
        />
        <template v-if="$v.item.password.$error || serverErrors.password">
          <div class="ant-form-explain">
            <template v-if="!$v.item.password.required">
              {{ $t("message_required", { field: $t("password") }) }}
            </template>
            <template v-else-if="!$v.item.password.minLength">
              {{ $t("message_min_length", { min_length: 6 }) }}
            </template>
            <template v-else-if="serverErrors.password">
              {{ serverErrors.password[0] }}
            </template>
          </div>
        </template>
      </div>
      <div class="form-group">
        {{ serverErrors }}
        <router-link class="text-secondary" to="/quen-mat-khau">
          Quên mật khẩu
        </router-link>
      </div>
      <p class="text-center">
        Bạn chưa có tài khoản.
        <router-link to="/dang-ky"> Đăng ký </router-link>
      </p>
      <div class="form-group text-center">
        <a-button @click="onLogin">Xác nhận</a-button>
      </div>
    </article>
    <!-- <LayoutFooter></LayoutFooter> -->
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { validationMixin } from "vuelidate";
import { email, minLength, required } from "vuelidate/lib/validators";
export default {
  mixins: [validationMixin],
  data: function() {
    return {
      item: {
        email: null,
        password: null,
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
    },
  },
  computed: {
    ...mapGetters({
      auth: "auth/data",
    }),
  },
  async fetch() {
    const token = this.$store.state.auth.token || null;
    if (token !== null) {
      await this.getAuth()
        .then(() => {
          if (this.auth !== null) {
            this.$router.push({ name: "index" });
          }
        })
        .catch((e) => {
          this.$store.dispatch("auth/log_out");
        });
    }
  },
  methods: {
    ...mapActions({
      getAuth: "auth/get_data",
      login: "auth/login",
    }),
    onLogin(e) {
      e.preventDefault();
      this.$v.item.$touch();
      if (this.$v.item.$anyError) {
        return;
      }
      const data = this.$options.filters.data(this.item);
      this.login(data)
        .then(() => {
          this.$router.push({ name: "index" });
          // this.getAuth().then(() => {
          //   this.$router.push({ name: "index" });
          // });
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
