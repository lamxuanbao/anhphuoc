<template>
  <ul class="ant-list-items">
    <template v-for="(i, k) of item.permissions">
      <li
        class="ant-list-item border-bottom border-dark"
        :key="`permission-${k}`"
      >
        <h1 class="mb-0">{{ $t(k) }}</h1>
        <a-button-group class="ant-list-item-action">
          <a-button @click.prevent.stop="checkAll(k, 'allow')">{{
            $t("allow_all")
          }}</a-button>
          <a-button @click.prevent.stop="checkAll(k, 'owner')">{{
            $t("owner")
          }}</a-button>
          <a-button @click.prevent.stop="checkAll(k, 'deny')">{{
            $t("deny_all")
          }}</a-button>
        </a-button-group>
      </li>
      <ul class="ant-list-items" :key="`permission-group-${k}`">
        <template v-for="(i1, k1) of i">
          <li class="ant-list-item" :key="`permission-item-${k1}`">
            {{ $t(`${k}_${k1}`) }}
            <a-radio-group name="radioGroup" v-model="item.permissions[k][k1]">
              <a-radio value="allow"> {{ $t("allow_all") }} </a-radio>
              <a-radio value="owner"> {{ $t("owner") }} </a-radio>
              <a-radio value="deny"> {{ $t("deny_all") }} </a-radio>
            </a-radio-group>
          </li>
        </template>
      </ul>
    </template>
  </ul>
</template>
<script>
import _ from "lodash";
export default {
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  methods: {
    checkAll(module, value) {
      this.item.permissions[module] = _.mapValues(this.item.permissions[module], () => value);
    },
  },
};
</script>