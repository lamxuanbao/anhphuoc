<template>
  <a-card class="w-100" :title="$t('role_list')">
    <template slot="extra">
      <router-link
        class="btn btn-primary font-weight-bolder"
        :to="{ name: 'role-create' }"
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
          <router-link :to="{ name: 'role-id', params: { id: record.id } }">
            {{ $t("edit") }}
          </router-link>
          <a-divider type="vertical" />
          <a @click="onRemove(record.id)"> {{ $t("delete") }} </a>
        </div>
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
          width: 150,
          scopedSlots: { customRender: "action" },
        },
      ],
    };
  },
  head() {
    return {
      title: this.$i18n.t("role_list"),
    };
  },
  computed: {
    ...mapGetters({
      items: "role/list",
    }),
  },
  watch: {
    "$route.query": "$fetch",
  },
  async fetch() {
    let current = 1;
    if (this.$route.query.page) {
      current = parseInt(this.$route.query.page);
    }
    const pagination = { ...this.pagination };
    pagination.current = current;
    const offset = pagination.pageSize * (pagination.current - 1);
    await this.getItems({
      length: pagination.pageSize,
      pagination: true,
      ...this.$route.query,
      offset,
    }).then((result) => {
      pagination.total = this.items.recordsTotal;
      pagination.length = this.items.length;
      this.data = this.items.rows;
      this.pagination = pagination;
    });
  },
  methods: {
    ...mapActions({
      getItems: "role/get_list",
      removeRole: "role/remove_data",
      updateRole: "role/update_data",
    }),
    handleTableChange(pagination, filters) {
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      this.$router.push({
        name: "user",
        query: {
          page: pagination.current,
          ...filters,
        },
      });
    },
    fetch(params = {}) {
      this.loading = true;
      this.getItems({
        length: this.pagination.pageSize,
        pagination: 1,
        ...params,
      }).then(() => {
        const pagination = { ...this.pagination };
        pagination.total = this.items.recordsTotal ?? 0;
        pagination.length = this.items.length ?? 0;
        this.data = this.items.rows ?? [];
        this.pagination = pagination;
        this.loading = false;
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
          this.removeRole(id).then(() => {
            this.$fetch();
          });
        },
        onCancel: () => {},
      });
    },
    changeActive(active, id) {
      this.updateRole({
        id: id,
        params: { is_active: active },
      });
    },
  },
};
</script>
