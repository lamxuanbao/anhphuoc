<template>
  <ul class="menu-nav">
    <li
      class="menu-item menu-item-submenu menu-item-open"
    >
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon flaticon2-digital-marketing"></i>
        <span class="menu-text">Vue Bootstrap</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="menu-submenu d-block">
        <span class="menu-arrow"></span>
        <ul class="menu-subnav">
          <li aria-haspopup="true" class="menu-item menu-item-parent">
            <span class="menu-link">
              <span class="menu-text">Vue Bootstrap</span>
            </span>
          </li>

          <router-link
            to="/vue-bootstrap/alert"
            v-slot="{ href, navigate, isActive, isExactActive }"
          >
            <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
                isActive && 'menu-item-active',
                isExactActive && 'menu-item-active',
              ]"
            >
              <a :href="href" class="menu-link" @click="navigate">
                <i class="menu-bullet menu-bullet-dot">
                  <span></span>
                </i>
                <span class="menu-text">Alert</span>
              </a>
            </li>
          </router-link>
        </ul>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  name: "Menu",
};
</script>