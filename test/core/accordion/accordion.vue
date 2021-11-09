<template>
  <div class="w-100">
    <div class="row">
      <div class="col-md-3 col-12">
        <div class="form-group">
          <div class="card">
            <div class="card-body p-0">
              <a-menu
                :default-selected-keys="defaultSelectedKeys"
                :default-open-keys="defaultOpenKeys"
                mode="inline"
              >
                <a-sub-menu v-for="tab in tabs" :key="tab.computedId">
                  <template slot="title">
                    {{ tab.name }}
                  </template>
                  <a-menu-item
                    :id="item.navId"
                    v-for="item in tab.$children"
                    :key="item.computedId"
                    @click="active(item.computedId)"
                  >
                    {{ item.name }}
                  </a-menu-item>
                </a-sub-menu>
              </a-menu>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-12">
        <div class="form-group">
          <div class="card">
            <div class="card-body">
              <slot />
            </div>
            <div v-if="!!$slots.footer" class="card-footer">
              <slot name="footer" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cacheLifetime: {
      default: 5,
    },
    options: {
      type: Object,
      required: false,
      default: () => ({
        useUrlFragment: true,
        defaultTabHash: null,
      }),
    },
  },
  data: () => ({
    tabs: [],
    defaultSelectedKeys: [],
    defaultOpenKeys: [],
  }),
  mounted() {
    try {
      this.tabs = this.$children.filter(
        (comp) => comp.$options.name === "AccordionGroup"
      );
      if (this.tabs[0]) {
        this.defaultOpenKeys.push(this.tabs[0].computedId);
        if (this.tabs[0].$children[0].computedId) {
          this.defaultSelectedKeys.push(this.tabs[0].$children[0].computedId);
          this.active(this.tabs[0].$children[0].computedId);
        }
      }
    } catch (error) {}
  },
  methods: {
    active(selectedTabHash) {
      $(".accordion-group-item").removeClass("d-block");
      $("#" + selectedTabHash).addClass("d-block");
    },
  },
  destroy() {
    this.$destroy();
  },
};
</script>