let state = {
    userObject: {},
};
let getters = {
    auth_user: state => state.userObject
};
const actions = {
    async fetchAuthUser({ commit }) {
        const response = await axios.get("/auth_user");
        commit("setAuthUser", response.data.user);
        console.log("auth_user", response.data.user);
    }
};
const mutations = {
    setAuthUser: (state, fetchAuthUser) => (state.userObject = fetchAuthUser)
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};