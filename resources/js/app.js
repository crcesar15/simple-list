import "./bootstrap";
import "@fortawesome/fontawesome-free/css/all.css";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue-next/dist/bootstrap-vue-next.css";

import { createApp } from "vue";

import ExampleComponent from "./components/SimpleList.vue";

const app = createApp({});
app.component("SimpleList", ExampleComponent);
app.mount("#app");
