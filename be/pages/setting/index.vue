<template>
  <client-only>
    <a-card>
      <accordion>
        <accordion-group :name="$t('basic_information')">
          <accordion-item :name="$t('general_information')">
            <lazy-setting-general ref="general" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('store')">
            <lazy-setting-store ref="store" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('image')">
            <lazy-setting-image ref="seo" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('seo')">
            <!-- <lazy-widget-seo ref="seo" :item="item" /> -->
          </accordion-item>
        </accordion-group>
      </accordion>
      <template v-slot:foot>
        <div class="w-100 text-right">
          {{ item }}
          <a-button type="success"> {{ $t("reset") }} </a-button>
          &nbsp;
          <a-button type="primary" @click.prevent.stop="save">
            {{ $t("save") }}
          </a-button>
        </div>
      </template>
    </a-card>
  </client-only>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";

export default {
  data: function () {
    return {
      item: {
        company_name: null,
        company_address: null,
        company_email: null,
        company_hotline: null,
        image_default: null,
        app_title: null,
        meta_keywords: null,
        meta_description: null,
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
      // await this.getSetting();
      this.item = this.$options.filters.mergeObject(this.item, this.setting);
    },
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      // if (this.$refs.general.$v.$invalid) {
      //   return;
      // }
      // this.$refs.store.$v.$touch();
      // if (this.$refs.store.$v.$invalid) {
      //   return;
      // }
      const data = this.$options.filters.convertJsonToFormData(this.item);
      data.append('_method', 'PUT')
      this.updateSetting(data)
        .then(() => {
          this.getSetting();
          this.$toast.success(this.$t("save_success"));
        })
        .catch(() => {
          return;
        });
    },
  },
};
</script>