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
import { BTable, BButton } from "bootstrap-vue-next";

export default {
  components: {
    BTable,
    BButton,
  },
  data() {
    return {
      columns: [
        { key: "uuid", sortable: true },
        { key: "name", sortable: true },
        { key: "description", sortable: true },
        { key: "code", sortable: true },
        { key: "status", sortable: true },
        { key: "actions", label: "Actions" },
      ],
      items: [
        {
          uuid: "1",
          name: "Item 1",
          description: "Description 1",
          code: "Code 1",
          status: "Active",
        },
        {
          uuid: "2",
          name: "Item 2",
          description: "Description 2",
          code: "Code 2",
          status: "Inactive",
        },
        {
          uuid: "3",
          name: "Item 3",
          description: "Description 3",
          code: "Code 3",
          status: "Active",
        },
        {
          uuid: "4",
          name: "Item 4",
          description: "Description 4",
          code: "Code 4",
          status: "Inactive",
        },
        {
          uuid: "5",
          name: "Item 5",
          description: "Description 5",
          code: "Code 5",
          status: "Active",
        },
      ],
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
