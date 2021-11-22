<template>
  <client-only>
    <accordion>
      <accordion-group :name="$t('property_information')">
        <accordion-item :name="$t('basic_information')">
          {{ item }}
          <lazy-property-general
            ref="general"
            :item="item"
            :serverErrors="serverErrors"
          />
        </accordion-item>
        <accordion-item :name="$t('images')">
          <lazy-property-image
            ref="images"
            :item="item"
            :serverErrors="serverErrors"
          />
        </accordion-item>
        <accordion-item :name="$t('seo')">
          <lazy-property-seo
            ref="seo"
            :item="item"
            :serverErrors="serverErrors"
          />
        </accordion-item>
      </accordion-group>
      <template v-slot:footer>
        <div class="w-100 text-right">
          <router-link :to="{ name: 'property' }">
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
      title: this.$i18n.t("property_list"),
    };
  },
  fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("property"), route: { name: "property" } },
      { title: this.$i18n.t("create") },
    ]);
  },
  data: function () {
    return {
      loading: false,
      item: {
        name: null,
        address: null,
        area: null,
        type: "buy",
        price: null,
        is_active: true,
        province_id: null,
        content: null,
        keywords: null,
        description: null,
        images: [],
        files: [],
        remove_files: [],
      },
      serverErrors: {},
    };
  },
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
      createData: "property/create_data",
    }),
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      if (this.$refs.general.$v.$pending || this.$refs.general.$v.$invalid) {
        return;
      }
      this.loading = true;
      const data = this.$options.filters.data(this.item);

      var form_data = new FormData();
      _.forEach(this.item, function (value, key) {
        if (_.isBoolean(value)) {
          value = value ? 1 : 0;
        }
        if (!!value) {
          if (key == "files") {
            _.forEach(value, function (v, k) {
              form_data.append("files[]", v);
            });
          } else if (key != "images") {
            form_data.append(key, value);
          }
        }
      });

      this.createData(form_data)
        .then(() => {
          this.$router.push({ name: "property" });
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