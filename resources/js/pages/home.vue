<template>
  <v-container>
    <h3>Bienvenido</h3>
  </v-container>
</template>

<script>
// import axios from 'axios'
export default {
  middleware: "auth",

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },

  metaInfo() {
    return { title: this.$t("home") };
  },
};
</script>
