<template>
  <v-dialog v-model="loaderObj.status" persistent width="300">
    <v-card color="secondary" dark>
      <v-card-text class="pt-3 white--text">
        {{ loaderObj.text }}
        <v-progress-linear
          indeterminate
          color="white"
          class="mb-0"
        ></v-progress-linear>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    loaderOptions: {
      type: Object,
      default: null,
    },
  },
  watch: {
    loaderOptions: {
      handler(val) {
        this.loaderObj.status = val.status;
        if (val.text) {
          this.loaderObj.text = val.text;
        }
      },
      deep: true,
    },
  },
  data() {
    return {
      loaderObj: {
        status: false,
        text: this.loaderOptions.text
          ? this.loaderOptions.text
          : "Please stand by",
      },
    };
  },
};
</script>
