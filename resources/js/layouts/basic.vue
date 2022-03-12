<template>
  <v-app id="inspire" >
    <v-main style="background:rgb(242, 243, 248);">
      <child />
     
    </v-main>
    <!--piepage /-->  
  </v-app>
</template>

<script>
//import Piepage from "~/components/footer.vue";
export default {
  name: "BasicLayout",
  components:{
    // Piepage,
  }
};
</script>

<style lang="scss">
.basic-layout {
  color: #636b6f;
  height: 100vh;
  font-weight: 100;
  position: relative;

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
