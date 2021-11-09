<template>
  <div class="topbar">
    <div class="topbar-item">
      <b-dropdown
        size="sm"
        variant="link"
        toggle-class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 text-decoration-none"
        no-caret
        right
        no-flip
      >
        <template v-slot:button-content>
          <img
            class="h-20px w-20px rounded-sm"
            :src="languageFlag($i18n.locale)"
          />
        </template>
        <template v-for="(locale, i) in $i18n.locales">
          <b-dropdown-item
            :key="i"
            @click.prevent.stop="$i18n.setLocale(locale.code)"
            :class="{ 'navi-item-active': checkLocale(locale.code) }"
          >
            <span class="symbol symbol-20 mr-3">
              <img :src="require(`@/assets/svg/flags/` + locale.flag)" />
            </span>
            <span class="navi-text">{{ $t(locale.iso) }}</span>
          </b-dropdown-item>
        </template>
      </b-dropdown>
    </div>
    <lazy-aside-quick-user></lazy-aside-quick-user>
  </div>
</template>

<style lang="scss">
.topbar {
  .dropdown-toggle {
    padding: 0;
    &:hover {
      text-decoration: none;
    }

    &.dropdown-toggle-no-caret {
      &:after {
        content: none;
      }
    }
  }

  .dropdown-menu {
    margin: 0;
    padding: 0;
    outline: none;
    .b-dropdown-text {
      padding: 0;
    }
  }
}
</style>

<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";
export default {
  computed: {},
  methods: {
    ...mapActions({
      setLanguage: "defaultLanguage",
    }),
    checkLocale(locale) {
      return this.$i18n.locale === locale;
    },
    languageFlag(code) {
      const localeData = _.find(this.$i18n.locales, function (locale) {
        return locale.code == code;
      });
      return require(`@/assets/svg/flags/` + localeData.flag);
    },
  },
  mounted() {
  },
};
</script>
