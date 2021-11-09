<template>
  <widget-card :title="$t('district_list')">
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
          title: this.$i18n.t("province"),
          dataIndex: "province.display_name",
        },
        {
          title: this.$i18n.t("status"),
          dataIndex: "status",
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
      title: this.$i18n.t("district_list"),
    };
  },
  computed: {
    ...mapGetters({
      datas: "district/list",
    }),
  },
  mounted() {
    this.fetch();
  },
  methods: {
    ...mapActions({
      getDatas: "district/get_list",
      removeData: "district/remove_data",
      updateData: "district/update_data",
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
      this.getDatas({
        length: this.pagination.pageSize,
        pagination: 1,
        ...params,
      }).then(() => {
        const pagination = { ...this.pagination };
        pagination.total = this.datas.recordsTotal ?? 0;
        pagination.length = this.datas.length ?? 0;
        this.data = this.datas.rows ?? [];
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
          this.removeData(id).then(() => {
            this.fetch();
          });
        },
        onCancel: () => {},
      });
    },
    changeActive(active, id) {
      this.loading = true;
      this.updateData({
        id: id,
        params: { is_active: Number(active) },
      }).then(() => {
        this.loading = false;
      });
    },
  },
};
</script>
