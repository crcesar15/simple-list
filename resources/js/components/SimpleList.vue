<template>
  <div class="container">
    <div
      id="filters"
      class="d-flex justify-content-between mb-2"
    >
      <h3>Simple List</h3>
      <BButton
        variant="success"
        style="height: 35px;"
        title="Add new item"
        @click="addItem"
      >
        <i class="fa fa-plus" /> ITEM
      </BButton>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row justify-content-center">
          <div
            id="filters"
            class="d-flex justify-content-between pb-2 mb-2"
          >
            <BFormInput
              v-model="filter"
              placeholder="Filter by name"
              size="sm"
              style="height: 30px; width: 200px;"
            />
            <BFormRadioGroup
              v-model="status"
              button-variant="outline-primary"
              :options="statusFilters"
              size="sm"
              style="height: 30px;"
              buttons
            />
          </div>
          <BTable
            id="items-table"
            :fields="columns"
            :items="items"

            responsive
            bordered
          >
            <template #cell(actions)="data">
              <BButton
                size="sm"
                variant="link"
                title="edit"
                @click="getItem(data.item.id)"
              >
                <i class="fa fa-pencil" />
              </BButton>
              <BButton
                size="sm"
                variant="link"
                title="delete"
                @click="deleteItem(data.item.id)"
              >
                <i class="fa fa-trash" />
              </BButton>
            </template>
          </BTable>
        </div>
      </div>
    </div>
    <ItemEditor
      :item="selectedItem"
      :show-modal="editorToggle"
      @clearSelection="selectedItem = {}; editorToggle = false;"
      @submitted="saveItem"
    />
    <Teleport to="body">
      <div
        class="toast-container position-fixed p-3 top-0 end-0"
      >
        <BToast
          :show="showToast"
          :text-variant="toastVariant"
          @hidden="showToast = false"
        >
          <template #title>
            {{ toastTitle }}
          </template>
          {{ toastMessage }}
        </BToast>
      </div>
    </Teleport>
  </div>
</template>

<script>
import {
  BTable, BButton, BFormRadioGroup, BFormInput, BToast,
} from "bootstrap-vue-next";
import ItemEditor from "./ItemEditor.vue";

export default {
  components: {
    BTable,
    BButton,
    BFormRadioGroup,
    BFormInput,
    BToast,
    ItemEditor,
  },
  data() {
    return {
      columns: [
        { key: "name", sortable: true },
        { key: "description", sortable: true },
        { key: "code", sortable: true },
        { key: "status", sortable: true },
        { key: "actions", label: "Actions" },
      ],
      items: [],
      status: null,
      statusFilters: [
        { text: "All", value: null },
        { text: "Active", value: "active" },
        { text: "Inactive", value: "inactive" },
      ],
      filter: "",
      selectedItem: {},
      editorToggle: false,
      showToast: false,
      toastTitle: "",
      toastMessage: "",
      toastVariant: "",
    };
  },
  watch: {
    status() {
      this.fetch();
    },
    filter() {
      this.fetch();
    },
  },
  mounted() {
    this.fetch();
  },
  methods: {
    fetch() {
      // Fetch data from API
      const params = {};

      if (this.status) {
        params.status = this.status;
      }

      if (this.filter) {
        params.filter = this.filter;
      }

      axios.get(route("api.items.index", params))
        .then((response) => {
          this.items = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getItem(id) {
      axios.get(route("api.items.show", id))
        .then((response) => {
          this.selectedItem = response.data;
          this.editorToggle = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addItem() {
      this.selectedItem = {};
      this.editorToggle = true;
    },
    saveItem(id, data) {
      if (id) {
        this.updateItem(id, data);
      } else {
        this.createItem(data);
      }
    },
    createItem(data) {
      axios.post(route("api.items.store"), data)
        .then(() => {
          this.showToast = true;
          this.toastTitle = "Success";
          this.toastMessage = "Item created successfully";
          this.toastVariant = "success";
          this.editorToggle = false;
          this.fetch();
        })
        .catch((error) => {
          this.showToast = true;
          this.toastTitle = "Error";
          this.toastMessage = error.response.data.message;
          this.toastVariant = "danger";
        });
    },
    updateItem(id, data) {
      axios.put(route("api.items.update", id), data)
        .then(() => {
          this.showToast = true;
          this.toastTitle = "Success";
          this.toastMessage = "Item updated successfully";
          this.toastVariant = "success";
          this.editorToggle = false;
          this.fetch();
        })
        .catch((error) => {
          this.showToast = true;
          this.toastTitle = "Error";
          this.toastMessage = error.response.data.message;
          this.toastVariant = "danger";
        });
    },
    deleteItem(id) {
      if (confirm("Are you sure you want to delete this item?")) {
        axios.delete(route("api.items.destroy", id))
          .then(() => {
            this.showToast = true;
            this.toastTitle = "Success";
            this.toastMessage = "Item deleted successfully";
            this.toastVariant = "success";
            this.fetch();
          })
          .catch((error) => {
            this.showToast = true;
            this.toastTitle = "Error";
            this.toastMessage = error.response.data.message;
            this.toastVariant = "danger";
          });
      }
    },
  },
};
</script>

<style >
#items-table th {
  min-width: 135px;
}
</style>
