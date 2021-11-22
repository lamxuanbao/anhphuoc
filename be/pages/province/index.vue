<template>
  <a-card :title="$t('province_list')">
    <div class="table-responsive">
      <a-table
        :indent-size="1"
        :columns="columns"
        :row-key="(record) => record.id"
        :pagination="pagination"
        :data-source="data"
        :loading="$fetchState.pending"
        @change="handleTableChange"
      >
        <div slot="status" slot-scope="text, record">
          <a-switch
            :default-checked="record.is_active"
            @change="changeActive($event, record.id)"
          >
            <a-icon slot="checkedChildren" type="check" />
            <a-icon slot="unCheckedChildren" type="close" />
          </a-switch>
        </div>
        <!-- <div slot="action" slot-scope="text, record">
          <router-link :to="{ name: 'role-id', params: { id: record.id } }">
            {{ $t("edit") }}
          </router-link>
          <a-divider type="vertical" />
          <a @click="onRemove(record.id)"> {{ $t("delete") }} </a>
        </div> -->
      </a-table>
    </div>
  </a-card>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data: function () {
    return {
      data: [],
      pagination: {
        pageSize: 15,
      },
      columns: [
        {
          title: this.$i18n.t("name"),
          dataIndex: "display_name",
        },
        {
          title: this.$i18n.t("status"),
          scopedSlots: { customRender: "status" },
        },
        // {
        //   title: this.$i18n.t("action"),
        //   key: "operation",
        //   fixed: "right",
        //   width: 150,
        //   scopedSlots: { customRender: "action" },
        // },
      ],
    };
  },
  head() {
    return {
      title: this.$i18n.t("province_list"),
    };
  },
  computed: {
    ...mapGetters({
      items: "province/list",
    }),
  },
  async fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("province") },
    ]);
    let current = 1;
    if (this.$route.query.page) {
      current = parseInt(this.$route.query.page);
    }
    const pagination = { ...this.pagination };
    pagination.current = current;
    const offset = pagination.pageSize * (pagination.current - 1);
    await this.getProvinces({
      length: pagination.pageSize,
      pagination: true,
      ...this.$route.query,
      offset,
    }).then(() => {
      pagination.total = this.items.recordsTotal;
      pagination.length = this.items.length;
      this.data = this.items.rows;
      this.pagination = pagination;
    });
  },
  watch: {
    "$route.query": "$fetch",
  },
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
      getProvinces: "province/get_list",
      removeProvince: "province/remove_data",
      updateProvince: "province/update_data",
    }),
    handleTableChange(pagination, filters) {
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      this.$router.push({
        name: "province",
        query: {
          page: pagination.current,
          ...filters,
        },
      });
    },
    onRemove(id) {
      this.$confirm({
        title: this.$i18n.t("delete_data"),
        content: this.$i18n.t("are_you_sure_delete_data"),
        okText: this.$i18n.t("delete"),
        okType: "danger",
        cancelText: this.$i18n.t("cancel"),
        cancelType: "",
        zIndex: 10002,
        onOk: () => {
          // this.$axios.$delete("property/" + id).then(() => {
          //   this.fetch();
          // });
        },
        onCancel: () => {},
      });
    },
    // handleTableChange(pagination, filters) {
    //   const pager = { ...this.pagination };
    //   pager.current = pagination.current;
    //   this.pagination = pager;
    //   const start = pagination.pageSize * (pagination.current - 1);
    //   this.fetch({
    //     start,
    //     ...filters,
    //   });
    // },
    // fetch(params = {}) {
    //   this.loading = true;
    //   this.getProvinces({
    //     length: this.pagination.pageSize,
    //     pagination: 1,
    //     ...params,
    //   }).then(() => {
    //     const pagination = { ...this.pagination };
    //     pagination.total = this.provinces.recordsTotal ?? 0;
    //     pagination.length = this.provinces.length ?? 0;
    //     this.data = this.provinces.rows ?? [];
    //     this.pagination = pagination;
    //     this.loading = false;
    //   });
    // },
    // onRemove(id) {
    //   this.$confirm({
    //     title: this.$i18n.t("delete_data"),
    //     content: this.$i18n.t("are_you_sure_delete_data"),
    //     okText: this.$i18n.t("delete"),
    //     okType: "danger",
    //     cancelText: this.$i18n.t("cancel"),
    //     cancelType: "",
    //     zIndex: 10002,
    //     onOk: () => {
    //       this.removeProvince(id).then(() => {
    //         this.fetch();
    //       });
    //     },
    //     onCancel: () => {},
    //   });
    // },
    // changeActive(active, id) {
    //   this.loading = true;
    //   this.updateProvince({
    //     id: id,
    //     params: { is_active: Number(active) },
    //   }).then(() => {
    //     this.loading = false;
    //   });
    // },
  },
};
</script>
