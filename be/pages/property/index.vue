<template>
  <a-card class="w-100" :title="$t('property_list')">
    <template slot="extra">
      <router-link
        class="btn btn-primary font-weight-bolder"
        :to="{ name: 'property-create' }"
      >
        <span class="svg-icon svg-icon-md">
          <font-awesome-icon :icon="['fas', 'plus']" />
        </span>
        {{ $t("create") }}
      </router-link>
    </template>
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
        <div slot="action" slot-scope="text, record">
          <router-link :to="{ name: 'property-id', params: { id: record.id } }">
            {{ $t("edit") }}
          </router-link>
          <a-divider type="vertical" />
          <a @click="onRemove(record.id)"> Xóa </a>
        </div>
      </a-table>
    </div>
  </a-card>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      data: [],
      pagination: {
        pageSize: 15,
      },
      columns: [
        {
          title: this.$i18n.t("title"),
          dataIndex: "name",
        },
        {
          title: this.$i18n.t("status"),
          scopedSlots: { customRender: "status" },
        },
        {
          title: this.$i18n.t("action"),
          key: "operation",
          fixed: "right",
          width: 200,
          scopedSlots: { customRender: "action" },
        },
      ],
    };
  },
  head() {
    return {
      title: this.$i18n.t("property_list"),
    };
  },
  computed: {
    ...mapGetters({
      items: "property/list",
    }),
  },
  watch: {
    "$route.query": "$fetch",
  },
  async fetch() {
    this.setBreadcrumb([
      { title: this.$i18n.t("dashboard"), route: "/" },
      { title: this.$i18n.t("property") },
    ]);
    let current = 1;
    if (this.$route.query.page) {
      current = parseInt(this.$route.query.page);
    }
    const pagination = { ...this.pagination };
    pagination.current = current;
    const offset = pagination.pageSize * (pagination.current - 1);
    await this.getData({
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
  methods: {
    ...mapActions({
      setBreadcrumb: "app/set_breadcrumb",
      getData: "property/get_list",
    }),
    handleTableChange(pagination, filters) {
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      this.$router.push({
        name: "property",
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
  },
};
</script>
