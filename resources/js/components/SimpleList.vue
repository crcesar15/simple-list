<template>
  <div class="container">
    <div class="row justify-content-center">
      <BTable
        :fields="columns"
        :items="items"
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
</template>

<script>
import axios from "axios";
import { BTable, BButton } from "bootstrap-vue-next";

export default {
  components: {
    BTable,
    BButton,
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
    };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    fetch() {
      // Fetch data from API
      axios.get(route("api.items.index"))
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
