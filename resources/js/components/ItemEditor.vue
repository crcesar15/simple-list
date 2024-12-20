<template>
  <div>
    <BModal
      :show="visible"
      :title="title"
      @hidden="clearSelection"
    >
      <label
        class="mt-2"
        for="name"
      >
        Name:
      </label>
      <BFormInput
        id="name"
        v-model="name"
      />
      <label
        class="mt-2"
        for="description"
      >
        Description:
      </label>
      <BFormTextarea
        id="description"
        v-model="description"
      />
      <label
        class="mt-2"
        for="code"
      >
        Code:
      </label>
      <BFormInput
        id="code"
        v-model="code"
      />
      <label
        class="mt-2"
        for="status"
      >
        Status:
      </label>
      <BFormSelect
        id="status"
        v-model="status"
        :options="statusOptions"
      />
      <template #footer>
        <BButton @click="closeModal">
          Cancel
        </BButton>
        <BButton
          variant="primary"
          @click="submit"
        >
          Save
        </BButton>
      </template>
    </BModal>
  </div>
</template>

<script>
import {
  BModal, BButton, BFormInput, BFormSelect, BFormTextarea,
} from "bootstrap-vue-next";

export default {
  components: {
    BModal,
    BButton,
    BFormInput,
    BFormSelect,
    BFormTextarea,
  },
  props: {
    item: {
      type: Object,
      default: () => ({}),
    },
    showModal: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      name: "",
      description: "",
      code: "",
      status: "Active",
      title: "Add Item",
      visible: false,
      statusOptions: [
        { text: "Active", value: "Active" },
        { text: "Inactive", value: "Inactive" },
      ],
    };
  },
  watch: {
    item: {
      handler() {
        this.name = this.item.name;
        this.description = this.item.description;
        this.code = this.item.code;
        this.status = this.item.status ?? "Active";

        if (this.item.id) {
          this.title = "Edit Item";
        } else {
          this.title = "Add Item";
        }
      },
      immediate: true,
    },
    showModal() {
      this.visible = this.showModal;
    },
  },
  methods: {
    closeModal() {
      this.visible = false;
    },
    submit() {
      this.$emit("submitted", this.item.id, {
        name: this.name,
        description: this.description,
        code: this.code,
        status: this.status,
      });
    },
    clearSelection() {
      this.$emit("clearSelection");
    },
  },
};
</script>
