<template>
  <div>
    <v-app-bar color="white" dense class="elevation-0">
      <v-toolbar-title class="overline"
        >Edit {{ userData.username }}</v-toolbar-title
      >
    </v-app-bar>
    <v-container class="py-8">
      <v-row>
        <div class="col-12">
          <v-btn
            :class="`${
              component === 'account' ? 'primary' : 'grey lighten-4'
            } mr-2`"
            large
            @click="() => openPage('account')"
          >
            Account
          </v-btn>
          <v-btn
            :class="`${
              component === 'profile' ? 'primary' : 'grey lighten-4'
            } mr-2`"
            large
            @click="() => openPage('profile')"
          >
            Profile
          </v-btn>
        </div>
      </v-row>
      <user-form
        v-show="component == 'account'"
        :userdata="userData"
        :pagetitle="'edit'"
        @saved="savedResponse"
      ></user-form>

      <profile-form
        v-show="component == 'profile'"
        :profiledata="userData.profile"
        :pagetitle="'edit'"
        @saved="savedResponse"
      ></profile-form>
    </v-container>
  </div>
</template>

<script>
import UserForm from "./UserForm.vue";
import ProfileForm from "./ProfileForm.vue";

export default {
  components: { UserForm, ProfileForm },
  data() {
    return {
      component: "account",
      userData: {},
    };
  },
  methods: {
    openPage(val) {
      this.component = val;
    },
    async getUser() {
      await axios
        .get("/d/user/get/" + this.$route.params.id)
        .then((response) => {
          this.userData = Object.assign({}, response.data);
          //   console.log("this.userData", this.userData);
        })
        .catch((err) => {});
    },
    savedResponse(value) {
      console.log(value);
      if (value == true) {
        this.getUser();
      }
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>

<style>
</style>
