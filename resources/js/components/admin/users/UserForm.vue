<template>
  <v-row>
    <div class="col-12 col-md-8">
      <ValidationObserver ref="user_form_observer" v-slot="{ valid }">
        <v-form ref="form">
          <v-card :loading="loading">
            <v-card-text>
              <div v-if="pagetitle !== 'edit'">
                <h2 class="text-capitalize my-3 primary--text">
                  Profile Settings
                </h2>
                <ValidationProvider
                  v-slot="{ errors }"
                  rules="required"
                  name="Full Name"
                >
                  <v-text-field
                    dense
                    outlined
                    v-model="usersObj.full_name"
                    label="Full Name *"
                    :error-messages="errors"
                    required
                  ></v-text-field>
                </ValidationProvider>
                <ValidationProvider v-slot="{ errors }" rules="" name="Ecode">
                  <v-text-field
                    dense
                    outlined
                    v-model="usersObj.ecode"
                    label="Ecode"
                    :error-messages="errors"
                  ></v-text-field>
                </ValidationProvider>
              </div>

              <div>
                <h2 class="text-capitalize my-3 primary--text">
                  Account Settings
                </h2>
                <v-switch
                  class="mt-0"
                  style="max-width: 120px"
                  v-model="statusSwitch"
                  :color="`${statusSwitch == true ? 'success' : 'grey'}`"
                  :label="`${statusSwitch == true ? 'Active' : 'Disabled'}`"
                ></v-switch>
                <ValidationProvider
                  v-slot="{ errors }"
                  rules="required"
                  name="Username"
                >
                  <v-text-field
                    autofocus
                    dense
                    outlined
                    v-model="usersObj.username"
                    label="Username *"
                    :error-messages="usernameExisted ? usernameExisted : errors"
                    required
                  ></v-text-field>
                </ValidationProvider>
                <ValidationProvider
                  v-slot="{ errors }"
                  rules="email"
                  name="Email"
                >
                  <v-text-field
                    autocomplete="false"
                    dense
                    outlined
                    v-model="usersObj.email"
                    label="Email"
                    :error-messages="emailExisted ? emailExisted : errors"
                    required
                  ></v-text-field>
                </ValidationProvider>
                <ValidationProvider
                  v-slot="{ errors }"
                  rules="required"
                  name="role"
                >
                  <v-autocomplete
                    dense
                    v-model="usersObj.role"
                    :items="rolesArray"
                    label="Role *"
                    outlined
                    required
                    :error-messages="errors"
                  >
                  </v-autocomplete>
                </ValidationProvider>
                <ValidationProvider v-slot="{ errors }" rules="" name="Phone">
                  <v-text-field
                    dense
                    outlined
                    v-model="usersObj.account_phone"
                    label="Phone"
                    :error-messages="errors"
                  ></v-text-field>
                </ValidationProvider>
                <div v-if="pagetitle !== 'edit'">
                  <ValidationProvider
                    v-slot="{ errors }"
                    :rules="`${pagetitle == 'edit' ? '' : 'required|min:9'}`"
                    name="Password"
                  >
                    <v-text-field
                      dense
                      type="password"
                      v-model="usersObj.password"
                      label="Password *"
                      outlined
                      :required="pagetitle == 'edit' ? false : true"
                      name="password"
                      :error-messages="errors"
                    ></v-text-field>
                  </ValidationProvider>
                  <ValidationProvider
                    v-slot="{ errors }"
                    rules="required|confirmed:Password"
                    name="Password Confirmation"
                  >
                    <v-text-field
                      dense
                      type="password"
                      v-model="usersObj.password_confirmation"
                      label="Confirm Password *"
                      name="password_confirmation"
                      required
                      outlined
                      :error-messages="errors"
                    ></v-text-field>
                  </ValidationProvider>
                </div>
              </div>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  v-if="pagetitle == 'edit'"
                  text
                  color="error"
                  @click="deleteUser()"
                  >delete</v-btn
                >
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
    <div v-if="pagetitle === 'edit'" class="col-12 col-md-4">
      <ChangePassword :user="userdata" />
    </div>
    <!-- actions and dialogs -->
    <snack-bar :snackbar-options="sbOptions"></snack-bar>
    <confirmation-dialog
      :conf-options="confOptions"
      @response="confResponse"
    ></confirmation-dialog>
  </v-row>
</template>
<script>
import {
  ValidationObserver,
  ValidationProvider,
} from "vee-validate/dist/vee-validate.full";
import ChangePassword from "./ChangePassword.vue";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    ChangePassword,
  },
  props: {
    userdata: {
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
      statusSwitch: true,
      rolesArray: ["admin", "staff"],
      actionSave: this.pagetitle,
      cardTitle: "New user",
      emailExisted: "",
      usernameExisted: "",
      usersObj: {},
      origUserData: this.userdata,
      newStatus: "",
      // ui
      sbOptions: {},
      confOptions: {},
      loading: this.userdata ? true : false,
    };
  },
  watch: {
    userdata: {
      handler(val, oldVal) {
        if (val != oldVal) {
          this.usersObj = Object.assign({}, val);
          this.origUserData = val;
          this.cardTitle = val.username;
          this.statusSwitch = val.status == "active" ? true : false;
        }
        this.loading = false;
      },
      deep: true,
    },
  },
  methods: {
    submit() {
      this.loading = true;

      // Set status value
      this.usersObj.status = this.statusSwitch == true ? "active" : "disabled";
      console.log(this.usersObj);
      // Send data to save
      axios
        .post("/d/user/save", this.usersObj)
        .then((response) => {
          this.sbOptions = {
            status: true,
            type: "success",
            text: "User has been saved",
          };
          if (this.pagetitle == "edit") {
            this.$emit("saved", true);
          } else {
            this.$nextTick(() => {
              this.loading = false;
              this.usersObj = {};
              this.$refs.user_form_observer.reset();
              this.$router.push({ name: "Users" });
            });
          }
        })
        .catch((err) => {
          console.log(err.response.status);
          console.log(err.response.data);
          let errMsg = "Error saving data";
          if (err.response.status == 422) {
            errMsg = err.response.data.message;
            if (err.response.data.errors.hasOwnProperty("username")) {
              this.usernameExisted = err.response.data.errors.username;
            }
            if (err.response.data.errors.hasOwnProperty("email")) {
              this.emailExisted = err.response.data.errors.email;
            }
          }
          this.sbOptions = {
            status: true,
            type: "error",
            text: errMsg,
          };
          this.loading = false;
        });
    },
    deleteUser() {
      this.confOptions = {
        status: true,
        title: "Confirm",
        msg: "Please confirm that you want to delete this account.",
        btnTitle: "delete",
        action: "delete",
      };
    },
    confResponse(value) {
      if (value == true) {
        axios
          .post("/d/user/delete/" + this.usersObj.id)
          .then((response) => {
            this.$emit("saved", true);
            this.sbOptions = {
              status: true,
              type: "success",
              text: "User has been deleted",
            };
          })
          .catch((err) => {
            console.log(err.response.data);
            this.loading = false;
            this.sbOptions = {
              status: true,
              type: "error",
              text: err.response.data.message,
            };
          });
      }
    },
  },
};
</script>
