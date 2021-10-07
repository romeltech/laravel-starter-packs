<template>
  <div>
    <user-form
      :userdata="userData"
      :pagetitle="'edit'"
      @saved="savedResponse"
    ></user-form>
  </div>
</template>

<script>
import UserForm from "./UserForm.vue";

export default {
  components: { UserForm },
  data() {
    return {
      userData: {},
    };
  },
  methods: {
    getUser() {
      axios
        .get("/d/user/get/" + this.$route.params.id)
        .then((response) => {
          this.userData = Object.assign({}, response.data);
        })
        .catch((err) => {});
    },
    savedResponse() {
      this.getUser();
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>

<style>
</style>
