<template>
  <div class="row">
    <div class="col-12">
      <div class="form-group">
        <label>{{ $t("default_timezone") }}:</label>
        <a-select
          size="large"
          v-model="item.default_timezone"
          show-search
          placeholder="Select a timezone"
          option-filter-prop="children"
          class="w-100"
          :filter-option="filterOption"
          @change="chooseTimezone"
        >
          <a-select-option
            v-for="(item, i) in $store.state.timezones"
            :key="`timezone_${i}`"
            :value="item"
          >
            {{ item }}
          </a-select-option>
        </a-select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      default: () => {},
    },
  },
  validations: {
    item: {},
  },
  data: () => ({}),
  computed: {},
  methods: {
    filterOption(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
    chooseTimezone(value) {
      const data = this.item;
      this.item.fill({
        ...data,
        default_timezone: value,
      });
    },
  },
};
</script>
