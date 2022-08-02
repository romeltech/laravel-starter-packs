<template>
  <div>
    <v-app-bar color="white" dense class="elevation-0">
      <v-toolbar-title class="overline"
        >New User</v-toolbar-title
      >
    </v-app-bar>
    <v-container class="py-8">
      <v-row>
        <div class="col-12">
          <user-form></user-form>
        </div>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import userForm from "./UserForm";
export default {
  components: { userForm },
  data() {
    return {
      //   pagetitle: 'Create New' ,
    };
  },
};
</script>

<style>
</style>
