import Vue from "vue";
import Vuex from "vuex";
import authUser from "./modules/authUser";
Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        authUser
    }
});

export default store;
