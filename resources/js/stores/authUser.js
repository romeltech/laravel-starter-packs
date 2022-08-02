/**
 * Store for loggedInUser
 */

import { defineStore } from "pinia";

export const useAuthUserStore = defineStore({
    // id is required so that Pinia can connect the store to the devtools
    id: "authUser",
    state: () => {
        return {
            authUserObj: {}
        };
    },
    actions: {
        async fetchAuthUser() {
            if (Object.keys(this.authUserObj).length > 0) {
                return;
            }
            const response = await axios.get("/auth_user");
            this.authUserObj = response.data.user;
            // console.log("fetchAuthUser", this.authUserObj);
        }
    },
    getters: {
        auth_user: state => state.authUserObj
    }
});
