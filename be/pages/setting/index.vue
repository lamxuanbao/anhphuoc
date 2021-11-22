<template>
  <client-only>
    <a-card>
      <accordion>
        <accordion-group :name="$t('basic_information')">
          <accordion-item :name="$t('seo')">
            <lazy-setting-store ref="store" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('image')">
            <lazy-setting-image ref="image" :item="item" />
          </accordion-item>
        </accordion-group>
        <template v-slot:footer>
          <div class="w-100 text-right">
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
    </a-card>
  </client-only>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";

export default {
  data: function() {
    return {
      loading: false,
      item: {
        company_name: null,
        company_address: null,
        company_email: null,
        company_hotline: null,
        image_default: null,
        app_title: null,
        app_keywords: null,
        app_description: null,
        supported_locales: [],
        default_locale: null,
        default_timezone: null,
        logo: null,
        favicon: null,
      },
    };
  },
  head() {
    return {
      title: this.$i18n.t("setting"),
    };
  },
  fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("setting") },
    ]);
  },
  computed: {
    ...mapGetters({
      setting: "setting/data",
    }),
  },
  mounted() {
    this.getData();
  },
  methods: {
    ...mapActions({
      getSetting: "setting/get_data",
      updateSetting: "setting/update_data",
    }),
    async getData() {
      await this.getSetting();
      this.item = this.$options.filters.mergeObject(this.item, this.setting);
    },
    save(e) {
      e.preventDefault();
      this.$refs.store.$v.$touch();
      // if (this.$refs.general.$v.$invalid) {
      //   return;
      // }
      // this.$refs.store.$v.$touch();
      // if (this.$refs.store.$v.$invalid) {
      //   return;
      // }
      this.loading = true;
      const data = this.$options.filters.convertJsonToFormData(this.item);
      data.append("_method", "PUT");
      this.updateSetting(data)
        .then(() => {
          // this.getSetting();
          this.$toast.success(this.$t("save_success"));
          this.loading = false;
        })
        .catch((e) => {
          this.serverErrors = data.errors;
        });
    },
  },
};
</script>
