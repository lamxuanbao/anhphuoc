<template>
  <client-only>
    <lazy-widget-card>
      <accordion>
        <accordion-group :name="$t('basic_information')">
          <accordion-item :name="$t('general_information')">
            <lazy-role-general ref="general" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('permissions')">
            <lazy-role-permission ref="permissions" :item="item" />
            {{ permissions }}
          </accordion-item>
        </accordion-group>
      </accordion>
      <template v-slot:foot>
        <div class="w-100 text-right">
          <router-link :to="{ name: 'role' }">
            <a-button type="danger"> {{ $t("cancel") }} </a-button>
          </router-link>
          &nbsp;
          <a-button type="primary" @click.prevent.stop="save">
            {{ $t("save") }}
          </a-button>
        </div>
      </template>
    </lazy-widget-card>
  </client-only>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  head() {
    return {
      title: this.$i18n.t("role_list"),
    };
  },
  data: function () {
    return {
      item: {
        name: null,
        permissions: null,
        is_active: true,
      },
    };
  },
  computed: {
    ...mapGetters({
      permissions: "role/permissions",
    }),
  },
  async fetch() {
    await this.getPermissions().then(() => {
      this.item.permissions = { ...this.permissions };
    });
  },
  methods: {
    ...mapActions({
      getPermissions: "role/get_permissions",
      createRole: "role/create_data",
    }),
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      if (this.$refs.general.$v.$invalid) {
        return;
      }
      const data = this.$options.filters.data(this.item);
      this.createRole(data)
        .then(() => {
          this.$router.push({ name: "role" });
        })
        .catch(() => {
          return;
        });
    },
  },
};
</script>