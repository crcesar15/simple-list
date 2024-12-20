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
        @click="create"
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
              >
                <i class="fa fa-pencil" />
              </BButton>
              <BButton
                size="sm"
                variant="link"
                title="delete"
              >
                <i class="fa fa-trash" />
              </BButton>
            </template>
          </BTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  BTable, BButton, BFormRadioGroup, BFormInput,
} from "bootstrap-vue-next";

export default {
  components: {
    BTable,
    BButton,
    BFormRadioGroup,
    BFormInput,
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
  },
};
</script>

<style >
#items-table th {
  min-width: 135px;
}
</style>
