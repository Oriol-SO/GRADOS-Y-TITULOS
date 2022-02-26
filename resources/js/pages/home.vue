<template>
<h1> INICIO</h1>  
</template>

<script>
// import axios from 'axios'
export default { 
  data () {
      return {
        drawer: true,
        items: [
          { title: 'dashboard', icon: 'mdi-account' },
          { title: 'tramites', icon: 'mdi-account' },
          { title: 'personas/usuarios ', icon: 'mdi-account' },
        ],
        mini: true,
      }
    },
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
