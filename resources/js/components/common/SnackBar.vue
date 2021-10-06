<template>
  <v-snackbar v-model="snackbar" :color="`${type ? type : 'primary'}`">
    {{ text }}
    <template v-slot:action="{ attrs }">
      <v-btn text v-bind="attrs" @click="snackbar = false"> Close </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  props: {
    snackbarOptions: {
      type: Object,
      default: null,
    },
  },
  watch: {
    snackbarOptions: {
      handler(val) {
        this.snackbar = this.snackbarOptions.status;
        this.type = this.snackbarOptions.type;
        this.text = this.snackbarOptions.text;
      },
      deep: true,
    },
  },
  data() {
    return {
      snackbar: this.snackbarOptions.status,
      type: this.snackbarOptions.type,
      text: this.snackbarOptions.text,
    };
  }
};
</script>
