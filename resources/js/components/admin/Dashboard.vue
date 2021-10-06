<template>
  <div>
    <v-app-bar color="white" dense class="elevation-0">
      <v-toolbar-title class="overline">Dashboard</v-toolbar-title>
    </v-app-bar>
    <v-container v-if="loading == true">
      <v-row>
        <div class="col-12">
          <v-skeleton-loader
            class="mx-auto"
            max-width="100%"
            type="list-item-avatar-three-line, image, article"
          ></v-skeleton-loader>
        </div>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
    };
  },
  methods: {

  },
  created() {
  },
};
</script>
