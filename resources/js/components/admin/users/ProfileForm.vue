<template>
  <v-row>
    <div class="col-12 col-md-8">
      <ValidationObserver ref="profile_form_observer" v-slot="{ valid }">
        <v-form ref="form">
          <v-card :loading="loading">
            <v-card-title>
              <h4 class="text-capitalize">Profile Settings</h4>
            </v-card-title>
            <v-card-text>
              <ValidationProvider
                v-slot="{ errors }"
                rules="required"
                name="Full Name"
              >
                <v-text-field
                  dense
                  outlined
                  v-model="profileObj.full_name"
                  label="Full Name *"
                  :error-messages="errors"
                  required
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider v-slot="{ errors }" rules="" name="Ecode">
                <v-text-field
                  dense
                  outlined
                  v-model="profileObj.ecode"
                  label="Ecode"
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  class="ml-2 primary"
                  :loading="loading"
                  :disabled="!valid"
                  @click="submit"
                  >Save</v-btn
                >
              </v-card-actions>
            </v-card-text>
          </v-card>
        </v-form>
      </ValidationObserver>
    </div>
    <!-- <div class="profile col-12 col-md-4"></div> -->

    <!-- actions and dialogs -->
    <snack-bar :snackbar-options="sbOptions"></snack-bar>
  </v-row>
</template>
<script>
import {
  ValidationObserver,
  ValidationProvider,
} from "vee-validate/dist/vee-validate.full";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  props: {
    profiledata: {
      type: Object,
      default: null,
    },
    pagetitle: {
      type: String,
      default: "new",
    },
  },
  data() {
    return {
      actionSave: this.pagetitle,
      profileObj: {},
      newStatus: "",
      // ui
      sbOptions: {},
      confOptions: {},
      loading: this.profiledata ? true : false,
    };
  },
  watch: {
    profiledata: {
      handler(val, oldVal) {
        if (val != oldVal) {
          this.profileObj = Object.assign({}, val);
        }
        this.loading = false;
      },
      deep: true,
    },
  },
  methods: {
    submit() {
      this.loading = true;
      // Send data to save
      axios
        .post("/d/profile/save", this.profileObj)
        .then((response) => {
          this.sbOptions = {
            status: true,
            type: "success",
            text: "Profile has been saved",
          };
          this.$emit("saved", true);
        })
        .catch((err) => {
          console.log(err.response.data);
          this.sbOptions = {
            status: true,
            type: "error",
            text: "Error Saving Profile",
          };
          this.loading = false;
        });
    },
  },
};
</script>
