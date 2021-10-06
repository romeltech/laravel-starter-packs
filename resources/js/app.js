/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// window.Vue = require('vue').default;
import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store";
import { routes } from "./plugins/routes";
import vuetify from "./plugins/vuetify";

Vue.use(VueRouter);
const router = new VueRouter({
    routes,
    mode: "history"
});

const helpers_plugin = {
    install(Vue, options) {
        // Date format
        Vue.prototype.formatDateHelper = date => {
            return new Date(date).toLocaleString("en-US", {
                day: "2-digit",
                year: "numeric",
                month: "long"
            });
        };
        // Base URL
        Vue.prototype.$baseUrl = window.location.origin;
    }
};
Vue.use(helpers_plugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Global Components
 */
Vue.component(
    "dashboard-nav",
    require("./components/admin/ui/navigation/DashboardNav.vue").default
);
Vue.component("snack-bar", require("./components/common/SnackBar.vue").default);
Vue.component("dialog-loader", require("./components/common/DialogLoader.vue").default);
Vue.component("confirmation-dialog", require("./components/common/ConfirmationDialog.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
store.dispatch("fetchAuthUser").then(() => {
    const app = new Vue({
        vuetify,
        store,
        router,
        data() {
            return {
                isLoading: true,
                // Login
                loginValid: true,
                loginEmail: "",
                loginEmailrules: [
                    value => !!value || "Required",
                    value => /.+@.+\..+/.test(value) || "E-mail must be valid"
                ],
                loginPassword: "",
                loginPasswordrules: [
                    value => !!value || "Required",
                    value =>
                        (value && value.length > 8) ||
                        "Password must be atleast 8 characters"
                ]
            };
        },
        watch: {
            isLoading: function(newVal, oldVal){
                this.isLoading = newVal;
            }
        },
        methods: {
            loginValidate() {
                if (this.$refs.form.validate()) {
                    this.snackbar = true;
                }
            },
            logout: function(event) {
                event.preventDefault();
                document.getElementById("logout-form").submit();
            }
        },
        created() {
            this.isLoading = false;
        }
    }).$mount("#app");
});
