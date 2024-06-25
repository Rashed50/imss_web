require('./bootstrap');

//require('alpinejs');

//import { createApp } from 'vue';
 
//import homeTemp from "./components/App.vue";
//Vue.component('inv_item_details',require("./components/inventory/ItemDetails.vue").default);

//createApp(homeTemp).mount("#home_temp");

// import { createApp } from 'vue'
// //import App from './App.vue'
// import App from "./components/App.vue";

// //import router from './router'

// const app = createApp(App)

// //app.use(router)

// app.mount('#app')

// import "./bootstrap";
 
// import { createApp } from "vue";

// import homeTemplate from "./components/HomeTemplate.vue";

// const app = createApp({});

// app.component("home_vue", homeTemplate);

// const mountedApp = app.mount("#app");

window.Vue = require("vue").default;

import VModal from 'vue-js-modal';

/* ========================= Components Loaded ========================= */
 Vue.component('inv_item_details',require("./components/HomeTemplate.vue").default);
 

const app = new Vue({

}).$mount("#vue_app");
