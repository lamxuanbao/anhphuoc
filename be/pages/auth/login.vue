<template>
  <div class="d-flex flex-column flex-root h-100">
    <div
      class="
        login login-1 login-signin-on
        d-flex
        flex-column flex-lg-row flex-row-fluid
        bg-white
      "
    >
      <div
        class="
          login-aside
          d-flex
          flex-row-auto
          bgi-size-cover bgi-no-repeat
          p-10 p-lg-15
        "
        :style="{ backgroundImage: `url(${backgroundUrl})` }"
      >
        <div class="d-flex flex-row-fluid flex-column justify-content-between">
          <a href="#" class="flex-column-auto">
            <image-zoom
              :src="require('@/assets/media/logos/logo-letter-1.png')"
            />
          </a>
          <div
            class="flex-column-fluid d-flex flex-column justify-content-center"
          >
            <h3 class="font-size-h1 mt-10 mb-5 text-white">
              Welcome to Metronic!
            </h3>
            <p class="font-weight-lighter text-white opacity-80">
              The ultimate Bootstrap, Angular 8, React &amp; VueJS admin theme
              framework for next generation web apps.
            </p>
          </div>
          <div
            class="
              d-none
              flex-column-auto
              d-lg-flex
              justify-content-between
              mt-15
            "
          >
            <div class="opacity-70 font-weight-bold text-white">
              © 2020 Metronic
            </div>
            <div class="d-flex">
              <a href="#" class="text-white">Privacy</a>
              <a href="#" class="text-white ml-10">Legal</a>
              <a href="#" class="text-white ml-10">Contact</a>
            </div>
          </div>
        </div>
      </div>
      <div
        class="
          flex-row-fluid
          d-flex
          flex-column
          position-relative
          p-7
          overflow-hidden
        "
      >
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
          <div class="login-form login-signin login-content">
            <div class="text-center mb-10 mb-lg-20">
              <h3 class="font-size-h1">
                {{ $t("signin") }}
              </h3>
            </div>
            <div
              class="form-group"
              v-bind:class="[
                $v.item.email.$error ? 'has-error' : '',
                serverErrors.email ? 'has-error' : '',
              ]"
            >
              <a-input
                size="large"
                class="form-control form-control-solid h-auto py-5 px-6"
                v-model="$v.item.email.$model"
                @pressEnter="onLogin"
                @change="setErrors('email')"
                :placeholder='$t("email")'
              />
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
            <div
              class="form-group"
              v-bind:class="[
                $v.item.password.$error ? 'has-error' : '',
                serverErrors.password ? 'has-error' : '',
              ]"
            >
              <a-input
                type="password"
                size="large"
                class="form-control form-control-solid h-auto py-5 px-6"
                v-model="$v.item.password.$model"
                @pressEnter="onLogin"
                @change="setErrors('password')"
                :placeholder='$t("password")'
              />
              <div
                class="ant-form-explain"
                v-if="$v.item.password.$error || serverErrors.password"
              >
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
            </div>
            <div
              class="
                form-group
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
              "
            >
              <a href="#" class="text-dark-60 text-hover-primary my-3 mr-2">
                {{ $t("forgot_password") }}
              </a>
              <a-button
                type="primary"
                size="large"
                @click="onLogin"
                :loading="loading"
                :disabled="loading"
              >
                {{ $t("signin") }}
              </a-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.spinner.spinner-right {
  padding-right: 3.5rem !important;
}
</style>

<style lang="scss">
@import "@/assets/sass/pages/login/login-1.scss";
</style>
<script>
import { mapGetters } from "vuex";
import { validationMixin } from "vuelidate";
import { email, minLength, required } from "vuelidate/lib/validators";
import backgroundUrl from "~/assets/media/bg/bg-4.jpg";
export default {
  layout: "login",
  mixins: [validationMixin],
  data: function () {
    return {
      loading: false,
      item: {
        email: null,
        password: null,
      },
      backgroundUrl,
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
      token: "token",
    }),
  },
  methods: {
    setErrors(type) {
      delete this.serverErrors[type];
    },
    onLogin(e) {
      e.preventDefault();
      this.$v.item.$touch();
      if (this.$v.item.$anyError) {
        return;
      }
      this.loading = true;
      this.$store
        .dispatch("auth/login", this.item)
        .then(() => {
          this.$router.push({ name: "index" });
        })
        .catch((error) => {
          const data = error.response.data || {};
          this.serverErrors = data.errors || {};
          this.loading = false;
        });
    },
  },
};
</script>
