<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.name.$error ? 'has-error' : '',
            serverErrors.name ? 'has-error' : '',
          ]"
        >
          <label> {{ $t("title") }} <span class="text-danger">*</span> </label>
          <a-input size="large" v-model="item.name" />
          <div
            class="ant-form-explain"
            v-if="$v.item.name.$error || serverErrors.name"
          >
            <template v-if="!$v.item.name.required">
              {{ $t("message_required", { field: $t("name") }) }}
            </template>
            <template v-else-if="serverErrors.name">
              {{ serverErrors.name[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.address.$error ? 'has-error' : '',
            serverErrors.address ? 'has-error' : '',
          ]"
        >
          <label> {{ $t("address") }} <span class="text-danger">*</span> </label>
          <a-input size="large" v-model="item.address" />
          <div
            class="ant-form-explain"
            v-if="$v.item.address.$error || serverErrors.address"
          >
            <template v-if="!$v.item.address.required">
              {{ $t("message_required", { field: $t("address") }) }}
            </template>
            <template v-else-if="serverErrors.address">
              {{ serverErrors.address[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label>Loại</label>
          <a-select size="large" v-model="item.type" style="width: 100%">
            <a-select-option value="buy"> Bán </a-select-option>
            <a-select-option value="rent"> Cho thuê </a-select-option>
          </a-select>
        </div>
      </div>
      <div class="col-6">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.price.$error ? 'has-error' : '',
            serverErrors.price ? 'has-error' : '',
          ]"
        >
          <label>Giá <span class="text-danger">*</span></label>
          <a-input-number
            class="w-100"
            size="large"
            v-model="item.price"
            :min="0"
          />
          <div
            class="ant-form-explain"
            v-if="$v.item.price.$error || serverErrors.price"
          >
            <template v-if="!$v.item.price.required">
              {{ $t("message_required", { field: "Giá" }) }}
            </template>
            <template v-else-if="serverErrors.price">
              {{ serverErrors.name[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.area.$error ? 'has-error' : '',
            serverErrors.area ? 'has-error' : '',
          ]"
        >
          <label>Diện tích <span class="text-danger">*</span></label>
          <a-input size="large" suffix="m²" v-model="item.area" />
          <div
            class="ant-form-explain"
            v-if="$v.item.area.$error || serverErrors.area"
          >
            <template v-if="!$v.item.area.required">
              {{ $t("message_required", { field: "Diện tích" }) }}
            </template>
            <template v-else-if="serverErrors.area">
              {{ serverErrors.area[0] }}
            </template>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label>Tỉnh/Thành</label>
          <a-select
            size="large"
            option-filter-prop="children"
            show-search
            style="width: 100%"
            v-model="item.province_id"
          >
            <a-select-option v-for="province in provinces" :key="province.id">
              {{ province.name }}
            </a-select-option>
          </a-select>
        </div>
      </div>
      <div class="col-12">
        <div
          class="form-group"
          v-bind:class="[
            $v.item.content.$error ? 'has-error' : '',
            serverErrors.content ? 'has-error' : '',
          ]"
        >
          <label>Nội dung <span class="text-danger">*</span></label>
          <ckeditor
            tag-name="textarea"
            v-model="item.content"
            :config="editorConfig"
            :editor-url="editorUrl"
          ></ckeditor>
          <div
            class="ant-form-explain"
            v-if="$v.item.content.$error || serverErrors.content"
          >
            <template v-if="!$v.item.content.required">
              {{ $t("message_required", { field: "Nội dung" }) }}
            </template>
            <template v-else-if="serverErrors.content">
              {{ serverErrors.content[0] }}
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label>{{ $t("status") }}</label>
          <a-switch v-model="item.is_active" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { required, decimal } from "vuelidate/lib/validators";
export default {
  props: {
    item: {
      type: Object,
      default() {
        return {};
      },
    },
    serverErrors: {
      type: Object,
      default() {
        return {};
      },
    },
  },
  validations() {
    var validation = {
      name: {
        required,
      },
      address: {
        required,
      },
      price: {
        required,
      },
      area: {
        required,
      },
      content: {
        required,
      },
    };
    return { item: validation };
  },
  data() {
    return {
      editorUrl: "https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js",
      editorConfig: {
        toolbar: [
          ["Styles", "Format", "Font", "FontSize"],
          ["Bold", "Italic"],
          ["Undo", "Redo"],
          ["About"],
        ],
        // extraPlugins: "uploadimage",
        // filebrowserBrowseUrl: "/filemanager_storage?type=Files",
        // filebrowserUploadUrl: "/filemanager_storage/upload?type=Files&_token=",
      },
    };
  },
  computed: {
    ...mapGetters({
      provinceList: "province/list",
    }),
    provinces() {
      return this.provinceList;
    },
  },
  methods: {
    ...mapActions({
      getProvince: "province/get_list",
    }),
    async fetch() {
      await this.getProvince();
      if (!this.item.province_id) {
        this.item.province_id = this.provinces[0]["id"];
      }
    },
  },
  mounted() {
    this.fetch();
  },
};
</script>
