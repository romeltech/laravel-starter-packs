<template>
  <v-dialog v-model="status" width="450">
    <v-card>
      <v-card-title class="text-capitalize">{{ title }}</v-card-title>
      <v-card-text class="pt-3">{{ msg }}</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey" text @click="status = false">Cancel</v-btn>
        <v-btn class="error ml-2" @click="confirm">{{ btnTitle }}</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    confOptions: {
      type: Object,
      default: null,
    },
  },
  watch: {
    confOptions: {
      handler(val) {
        this.status = this.confOptions.status;
        this.title = this.confOptions.title;
        this.action = this.confOptions.action;
        this.msg = this.confOptions.msg;
        this.btnTitle = this.confOptions.btnTitle;
      },
      deep: true,
    },
  },
  data() {
    return {
      status: this.confOptions.status ? this.confOptions.status : false,
      title: this.confOptions.title ? this.confOptions : "Confirmation",
      action: this.confOptions.action ? this.confOptions.action : "Confirm",
      msg: this.confOptions.msg ? this.confOptions.msg : "Please confirm",
      btnTitle: this.confOptions.btnTitle
        ? this.confOptions.btnTitle
        : "Confirm",
    };
  },
  methods: {
    confirm() {
      this.status = false;
      this.$emit("response", true);
    },
  },
};
</script>
