<template>
  <v-app id="inspire" style="background:#f8f9fe;">
    <navbar />
    <v-main class="py-0" >
      <transition name="fade" mode="out-in"> <child /> </transition>
    </v-main>
    <piepage />
  </v-app>
</template>

<script>
import Navbar from "~/components/Navbarhome";
import Piepage from "../components/footer_home.vue";
export default {
  name: "MainLayout",

  components: {
    Navbar,
    Piepage,
  },
};
</script>
