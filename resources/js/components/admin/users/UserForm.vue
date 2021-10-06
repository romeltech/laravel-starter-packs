<template>
  <div>
    <v-app-bar color="white" dense class="elevation-0">
      <v-toolbar-title class="overline">{{ pagetitle }} User</v-toolbar-title>
    </v-app-bar>
    <v-container class="py-8">
      <v-row>
        <div class="col-8">
          <ValidationObserver ref="user_form_validation" v-slot="{ valid }">
            <v-form ref="form">
              <v-card>
                <v-card-title>
                  <h4>Edit {{ usersObj ? usersObj.first_name : "" }}</h4>
                </v-card-title>
                <v-card-text>
                  <v-switch
                    v-model="usersObj.status"
                    :color="`${
                      usersObj.status == 'active' ? 'success' : 'grey'
                    }`"
                    :label="`${
                      usersObj.status == 'active' ? 'Active' : 'Disabled'
                    }`"
                  ></v-switch>
                  <ValidationProvider
                    v-slot="{ errors }"
                    rules="required"
                    name="First Name"
                  >
                    <v-text-field
                      dense
                      outlined
                      v-model="usersObj.first_name"
                      label="First Name"
                      :error-messages="errors"
                      required
                    ></v-text-field>
                  </ValidationProvider>
                  <ValidationProvider
                    v-slot="{ errors }"
                    rules="required"
                    name="Last Name"
                  >
                    <v-text-field
                      dense
                      outlined
                      v-model="usersObj.last_name"
                      label="Last Name"
                      :error-messages="errors"
                      required
                    ></v-text-field>
                  </ValidationProvider>
                  <ValidationProvider
                    v-slot="{ errors }"
                    rules="required"
                    name="Role"
                  >
                    <v-text-field
                      dense
                      outlined
                      v-model="usersObj.role"
                      label="Role"
                      :error-messages="errors"
                      required
                    ></v-text-field>
                  </ValidationProvider>
                  <ValidationProvider
                    v-slot="{ errors }"
                    rules="required|email"
                    name="Email"
                  >
                    <v-text-field
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
                    rules="numeric|min:7|max:15"
                    name="Phone Number"
                  >
                    <v-text-field
                      dense
                      type="number"
                      v-model="usersObj.phone"
                      label="Phone Number"
                      outlined
                      :error-messages="errors"
                    ></v-text-field>
                  </ValidationProvider>
                  <v-card-actions>
                    <v-btn text color="error" @click="deleteRestoreUser()">{{
                      usersObj.status == "trashed" ? "restore" : "delete"
                    }}</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                      class="primary"
                      :disabled="!valid"
                      @click="submit(actionSave)"
                      >Save</v-btn
                    >
                  </v-card-actions>
                </v-card-text>
              </v-card>
            </v-form>
          </ValidationObserver>
        </div>
      </v-row>
    </v-container>
    <!-- actions and dialogs -->
    <snack-bar :snackbar-options="sbOptions"></snack-bar>
    <dialog-loader :loader-options="loaderOptions"></dialog-loader>
    <confirmation-dialog
      :conf-options="confOptions"
      @response="confResponse"
    ></confirmation-dialog>
  </div>
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
    userdata: {
      type: Object,
      default: null,
    },
    pagetitle: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      emailExisted: "",
      curStatus: "",
      submitBtn: "Submit",
      actionSave: "add",
      emailError: "",
      newLineManager: [],
      editPage: false,
      usersObj: {},
      propsObj: {},
      companies: [],
      departments: [],
      users: [],
      people: 0,
      approvalCnt: "None",
      // ui
      loaderOptions: {},
      sbOptions: {},
      confOptions: {},
      dialogDelete: false,
      origEmail: "",
      newStatus: "",
    };
  },
  methods: {
    confResponse(value) {
      if (value == true) {
        this.updateUserStatus();
      }
    },
    submit(i) {
      // if(this.usersObj.email == this.origEmail){
      //    delete this.usersObj['email'];
      // }
      axios
        .post("/v/users/add-update-data", this.usersObj)
        .then((response) => {
          console.log(response);
          this.loaderOptions = {
            status: true,
            text: "Please wait...",
          };

          this.$refs.form.reset();

          setTimeout(() => {
            this.loaderOptions = {
              status: false,
            };

            this.sbOptions = {
              status: true,
              type: "success",
              text: "Add/Updated Successfully!",
            };

            if (this.pagetitle == "Create New") {
              this.$router.push({
                name: "EditUser",
                params: { id: response.data.company.id },
              });
            }

            this.$emit("saved", true);
          }, 1000);
        })
        .catch((err) => {
          console.log(err);
          this.emailExisted = "Email already registered";
          this.loading = false;
          this.sbOptions = {
            status: true,
            type: "error",
            text: "Email already registered",
          };
        });
    },

    deleteRestoreUser() {
      let action = this.usersObj.status == "trashed" ? "active" : "trashed";
      let btnText = this.usersObj.status == "trashed" ? "restore" : "delete";
      this.newStatus = this.usersObj.status == "trashed" ? "active" : "trashed";
      this.confOptions = {
        status: true,
        title: "Confirm",
        msg: "Please confirm that you want to " + btnText + " this account.",
        btnTitle: btnText,
        action: action,
      };
      // run delete
    },
    closeDelete() {
      this.dialogDelete = false;
    },
    updateUserStatus() {
      this.loaderOptions = {
        status: true,
      };
      let data = {
        id: this.usersObj.id,
        status: this.newStatus,
      };
      axios.post("/d/user/status/update", data).then((response) => {
        this.$emit("saved", true);
        this.loaderOptions = {
          status: false,
        };
        this.sbOptions = {
          status: true,
          type: "success",
          text: "User has been updated",
        };
      });
    },
  },
  created() {
    console.log(this.pagetitle);
    // this.getCompanies().then(() => {
    //   this.getDepartments().then(() => {
    //     this.getUsers().then(() => {
    //       if (
    //         typeof this.usersObj.approvers != "undefined" &&
    //         this.usersObj.approvers.length > 0
    //       ) {
    //         this.approvalCnt = "Yes";
    //       }
    //     });

    //     if (this.pagetitle == "Edit") {
    //       this.curStatus = this.usersObj.status;

    //       this.usersObj = Object.assign({}, this.userdata);
    //       this.origEmail = this.usersObj.email;

    //       this.getPeople(this.usersObj.id);

    //       if (this.curStatus == "approved") {
    //         this.editPage = true;
    //       } else {
    //         this.submitBtn = "Enable Account";
    //       }

    //       if (typeof this.usersObj.departments[0] !== "undefined") {
    //         this.usersObj.approver = true;
    //       }
    //     }
    //   });
    // });
  },
  watch: {
    userdata: {
      handler(val) {
        this.usersObj = Object.assign({}, this.userdata);
      },
      deep: true,
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
};
</script>

<style>
</style>
