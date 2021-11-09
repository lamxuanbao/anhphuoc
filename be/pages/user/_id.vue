<template>
  <client-only>
    <accordion ref="accordion">
      <accordion-group :name="$t('user_information')">
        <accordion-item :name="$t('account')">
          <lazy-user-general
            ref="general"
            :item="item"
            :serverErrors="serverErrors"
            :show-password="false"
          />
        </accordion-item>
        <accordion-item :name="$t('new_password')" ref="accordion_new_password">
          <lazy-user-password ref="new_password" :item="item" />
        </accordion-item>
      </accordion-group>
      <template v-slot:footer>
        <div class="w-100 text-right">
          <router-link :to="{ name: 'user' }">
            <a-button type="danger"> {{ $t("cancel") }} </a-button>
          </router-link>
          &nbsp;
          <a-button
            @click="$fetch"
            :loading="$fetchState.pending"
            type="success"
          >
            {{ $t("reset") }}
          </a-button>
          &nbsp;
          <a-button
            type="primary"
            @click.prevent.stop="save"
            :loading="loading"
          >
            {{ $t("save") }}
          </a-button>
        </div>
      </template>
    </accordion>
  </client-only>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { email, minLength, required, sameAs } from "vuelidate/lib/validators";
export default {
  head() {
    return {
      title: this.$i18n.t("user_list"),
    };
  },
  validations() {
    var validation = {
      email: {
        required,
        email,
      },
    };
    return { item: validation };
  },
  computed: {
    ...mapGetters({
      user: "user/data",
    }),
  },
  data: function () {
    return {
      id: null,
      loading: false,
      item: {
        email: null,
        password: null,
        password_confirmation: null,
        is_active: true,
      },
      serverErrors: {},
    };
  },
  async fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("user"), route: { name: "user" } },
      { title: this.$i18n.t("update") },
    ]);
    this.id = this.$route.params.id;
    await this.getData(this.id);
    this.item = this.$options.filters.mergeObject(this.item, this.user);
  },
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
      getData: "user/get_data",
      updateData: "user/update_data",
    }),
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      if (this.$refs.general.$v.$invalid) {
        return;
      }
      this.$refs.new_password.$v.$touch();
      if (this.$refs.new_password.$v.$invalid) {
        $("#accordion-nav-" + this.$refs.accordion_new_password._uid).click();
        return;
      }
      this.loading = true;
      const data = this.$options.filters.data(this.item);
      console.log(this.id, data);
      this.updateData({
        id: this.id,
        params: data,
      })
        .then(() => {
          // this.$router.push({ name: "user" });
        })
        .finally(() => {
          this.loading = false;
        })
        .catch((e) => {
          const { status, data } = e.response;
          this.serverErrors = data.errors;
        });
      // this.$store.dispatch("user/create", data).finally(() => {
      //   this.$router.push({ name: "user" });
      // });
      //   .catch((error) => {
      //     console.log(error.response);
      //     // this.$router.push({ name: "login" });
      //   });
      // this.form.post("setting");
      // this.getSetting();
      // this.$toast.success(this.$t('save_success'));
    },
  },
};
</script>