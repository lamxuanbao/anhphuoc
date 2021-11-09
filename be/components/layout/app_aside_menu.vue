<template>
  <ul class="menu-nav">
    <template v-for="(item, index) in menu">
      <li
        class="menu-item menu-item-submenu"
        :key="`menu-${index}`"
        :class="[item.active && 'menu-item-open']"
      >
        <template v-if="!item.children">
          <router-link :to="item.url" class="menu-link">
            <span class="svg-icon menu-icon">
              <font-awesome-icon :icon="item.icon" />
            </span>
            <span class="menu-text">
              {{ $t(item.i18n) }}
            </span>
          </router-link>
        </template>
        <template v-else>
          <a @click="toggleActive(index, 'menu')" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
              <font-awesome-icon :icon="item.icon" />
            </span>
            <span class="menu-text">
              {{ $t(item.i18n) }}
            </span>
            <i class="menu-arrow"></i>
          </a>
          <div class="menu-submenu" :class="{ 'd-block': item.active }">
            <span class="menu-arrow"></span>
            <ul class="menu-subnav">
              <template v-for="(child, index_child) in item.children">
                <router-link
                  :key="`menu-${index}-${index_child}`"
                  :to="child.url"
                  v-slot="{ href, navigate, isActive, isExactActive }"
                >
                  <li
                    class="menu-item"
                    :class="[
                      isActive && 'menu-item-active',
                      isExactActive && 'menu-item-active',
                    ]"
                  >
                    <router-link :to="child.url" class="menu-link">
                      <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                      </i>
                      <span class="menu-text">
                        {{ $t(child.i18n) }}
                      </span>
                    </router-link>
                  </li>
                </router-link>
              </template>
            </ul>
          </div>
        </template>
      </li>
    </template>
    <li class="menu-section m-0">
      <h4 class="menu-text">{{ $t("system") }}</h4>
    </li>
    <template v-for="(item, index) in system">
      <li
        class="menu-item menu-item-submenu"
        :key="`menu-system-${index}`"
        :class="[item.active && 'menu-item-open']"
      >
        <template v-if="!item.children">
          <router-link :to="item.url" class="menu-link">
            <span class="svg-icon menu-icon">
              <font-awesome-icon :icon="item.icon" />
            </span>
            <span class="menu-text">
              {{ $t(item.i18n) }}
            </span>
          </router-link>
        </template>
        <template v-else>
          <a
            @click="toggleActive(index, 'system')"
            class="menu-link menu-toggle"
          >
            <span class="svg-icon menu-icon">
              <font-awesome-icon :icon="item.icon" />
            </span>
            <span class="menu-text">
              {{ $t(item.i18n) }}
            </span>
            <i class="menu-arrow"></i>
          </a>
          <div class="menu-submenu" :class="{ 'd-block': item.active }">
            <span class="menu-arrow"></span>
            <ul class="menu-subnav">
              <template v-for="(child, index_child) in item.children">
                <router-link
                  :key="`menu-system-${index}-${index_child}`"
                  :to="child.url"
                  v-slot="{ href, navigate, isActive, isExactActive }"
                >
                  <li
                    class="menu-item"
                    :class="[
                      isActive && 'menu-item-active',
                      isExactActive && 'menu-item-active',
                    ]"
                  >
                    <router-link :to="child.url" class="menu-link">
                      <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                      </i>
                      <span class="menu-text">
                        {{ $t(child.i18n) }}
                      </span>
                    </router-link>
                  </li>
                </router-link>
              </template>
            </ul>
          </div>
        </template>
      </li>
    </template>
  </ul>
</template>
<script>
import { menu, system } from "@/js/menu.js";
import _ from "lodash";
export default {
  data: function () {
    return {
      menu,
      system,
    };
  },
  mounted() {
    this.fetch();
  },
  watch: {
    $route() {
      this.fetch();
    },
  },
  methods: {
    fetch() {
      const routeName = this.$route.name;
      const vm = this;
      _.findIndex(this.system, function (item, index) {
        let check = -1;
        if (item.children) {
          check = _.findIndex(item.children, function (i) {
            return i.url.name == routeName;
          });
        } else {
          if (item.url.name == routeName) {
            check = 0;
          }
        }
        if (check < 0) {
          check = false;
        } else {
          check = true;
        }
        item.active = check;
        vm.$set(vm.system, index, item);
      });
      _.findIndex(this.menu, function (item, index) {
        let check = -1;
        if (item.children) {
          check = _.findIndex(item.children, function (i) {
            return i.url.name == routeName;
          });
        } else {
          if (item.url.name == routeName) {
            check = 0;
          }
        }
        if (check < 0) {
          check = false;
        } else {
          check = true;
        }
        item.active = check;
        vm.$set(vm.menu, index, item);
      });
    },
    toggleActive(index, type) {
      let item = {};
      if (type == "system") {
        item = this.system[index];
      } else if (type == "menu") {
        item = this.menu[index];
      }

      item.active = !item.active;

      if (type == "system") {
        this.$set(this.system, index, item);
      } else if (type == "menu") {
        this.$set(this.menu, index, item);
      }
    },
  },
};
</script>
