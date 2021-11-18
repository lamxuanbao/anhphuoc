<template>
  <client-only>
    <accordion>
      <accordion-group :name="$t('customer_information')">
        <accordion-item :name="$t('account')">
          <lazy-customer-general
            ref="general"
            :item="item"
            :serverErrors="serverErrors"
          />
        </accordion-item>
      </accordion-group>
      <template v-slot:footer>
        <div class="w-100 text-right">
          <router-link :to="{ name: 'customer' }">
            <a-button type="danger"> {{ $t("cancel") }} </a-button>
          </router-link>
          &nbsp;
          <a-button type="success"> {{ $t("reset") }} </a-button>
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

export default {
  head() {
    return {
      title: this.$i18n.t("customer_list"),
    };
  },
  fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("customer"), route: { name: "customer" } },
      { title: this.$i18n.t("create") },
    ]);
  },
  data: function () {
    return {
      loading: false,
      item: {
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        password_confirmation: null,
        is_active: true,
      },
      serverErrors: {},
    };
  },
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
      createData: "customer/create_data",
    }),
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      if (this.$refs.general.$v.$pending || this.$refs.general.$v.$invalid) {
        return;
      }
      this.loading = true;
      const data = this.$options.filters.data(this.item);
      this.createData(data)
        .then(() => {
          this.$router.push({ name: "customer" });
        })
        .finally(() => {
          this.loading = false;
        })
        .catch((e) => {
          const { status, data } = e.response;
          this.serverErrors = data.errors;
        });
    },
  },
};
</script>