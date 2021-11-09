<template>
  <widget-card :title="$t('contract_type_list')">
    <template v-slot:toolbar>
      <router-link
        class="btn btn-primary font-weight-bolder"
        :to="{ name: 'contract-type-create' }"
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
        :loading="loading"
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
  </widget-card>
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
      loading: true,
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
      title: this.$i18n.t("contract_type_list"),
    };
  },
  computed: {
    ...mapGetters({
      contract_types: "contract_type/list",
    }),
  },
  mounted() {
    this.fetch();
  },
  methods: {
    ...mapActions({
      getContractTypes: "contract_type/get_list",
      removeContractType: "contract_type/remove_data",
      updateContractType: "contract_type/update_data",
    }),
    handleTableChange(pagination, filters) {
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      const start = pagination.pageSize * (pagination.current - 1);
      this.fetch({
        start,
        ...filters,
      });
    },
    fetch(params = {}) {
      this.loading = true;
      this.getContractTypes({
        length: this.pagination.pageSize,
        pagination: 1,
        ...params,
      }).then(() => {
        const pagination = { ...this.pagination };
        pagination.total = this.contract_types.recordsTotal ?? 0;
        pagination.length = this.contract_types.length ?? 0;
        this.data = this.contract_types.rows ?? [];
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
          this.removeContractType(id).then(() => {
            this.fetch();
          });
        },
        onCancel: () => {},
      });
    },
    changeActive(active, id) {
      this.loading = true;
      this.updateContractType({
        id: id,
        params: { is_active: Number(active) },
      }).then(() => {
        this.loading = false;
      });
    },
  },
};
</script>
