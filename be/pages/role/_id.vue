<template>
  <client-only>
    <lazy-widget-card>
      <accordion ref="accordion">
        <accordion-group :name="$t('basic_information')">
          <accordion-item :name="$t('general_information')">
            <lazy-role-general ref="general" :item="item" />
          </accordion-item>
          <accordion-item :name="$t('permission')">
            <lazy-role-permission ref="permission" :item="item" />
          </accordion-item>
        </accordion-group>
      </accordion>
      <template v-slot:foot>
        <div class="w-100 text-right">
          <router-link :to="{ name: 'role' }">
            <a-button type="danger"> {{ $t("cancel") }} </a-button>
          </router-link>
          &nbsp;
          <a-button type="success"> {{ $t("reset") }} </a-button>
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
import _ from "lodash";
export default {
  head() {
    return {
      title: this.$i18n.t("role_list"),
    };
  },
  asyncData({ route }) {
    return {
      id: route.params.id,
    };
  },

  computed: {
    ...mapGetters({
      permissions: "role/permissions",
      role: "role/data",
    }),
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
  mounted() {
    this.getData();
  },
  methods: {
    ...mapActions({
      getPermissions: "role/get_permissions",
      getRole: "role/get_data",
      updateRole: "role/update_data",
    }),
    async getData() {
      await this.getRole(this.id);
      await this.getPermissions();
      this.item = this.$options.filters.mergeObject(this.item, this.role);
      const that = this;
      let permissions = {};
      _.forEach(this.permissions, function (value, key) {
        permissions[key] = {};
        _.forEach(value, function (v, k) {
          if (_.isNil(that.role.permissions[key][k])) {
            permissions[key][k] = v;
          } else {
            permissions[key][k] = that.role.permissions[key][k];
          }
        });
      });
      this.item.permissions = permissions;
    },
    save(e) {
      e.preventDefault();
      this.$refs.general.$v.$touch();
      if (this.$refs.general.$v.$invalid) {
        return;
      }
      const data = this.$options.filters.data(this.item);
      this.updateRole({
        id: this.id,
        params: data,
      })
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