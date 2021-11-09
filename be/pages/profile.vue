<template>
  <client-only>
    <lazy-widget-card>
      <accordion ref="accordion">
        <accordion-group :name="$t('user.information')">
          <accordion-item :name="$t('account')">
            <lazy-user-general
              ref="general"
              :item="item"
              :show_password="false"
            />
          </accordion-item>
          <accordion-item
            :name="$t('new_password')"
            ref="accordion_new_password"
          >
            <lazy-user-password ref="new_password" :item="item" />
          </accordion-item>
        </accordion-group>
      </accordion>
      <template v-slot:foot>
        <div class="w-100 text-right">
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
export default {
  computed: {
    ...mapGetters({
      user: "user/data",
    }),
  },
  data: function () {
    return {
      item: {
        email: null,
        password: null,
        confirm_password: null,
        is_active: true,
      },
    };
  },
  mounted() {
    //   console.log()
    // this.getData();
  },
  methods: {
    ...mapActions({
      getAuth: "auth",
    }),
    async getData() {
      //   try {
      //     await this.getUser(this.id);
      //   } finally {
      //     this.item = this.$options.filters.mergeObject(this.item, this.user);
      //   }
    },
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
      const data = this.$options.filters.data(this.item);
      // const item = this.item;
      const res = this.$repositories.user.show(this.id);
      console.log(res);
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