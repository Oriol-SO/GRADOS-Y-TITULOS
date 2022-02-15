<template>
  <v-container>
    <v-row align="center" justify="space-around">
      <v-btn depressed> Normal </v-btn>
      <v-btn depressed color="primary" rounded> Primary </v-btn>
      <v-btn depressed color="error"> Error </v-btn>
      <v-btn depressed disabled> Disabled </v-btn>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  layout: "basic",

  metaInfo() {
    return { title: this.$t("home") };
  },

  data: () => ({
    title: window.config.appName,
  }),

  computed: mapGetters({
    authenticated: "auth/check",
  }),
};
</script>

<style scoped>
</style>
