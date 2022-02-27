<template>
  <v-app id="inspire" class="grey lighten-3">
    <navbar />

    <v-main style="background:rgb(242, 243, 248);" >
      <transition name="fade" mode="out-in"> <child /> </transition>
    </v-main>
    <piepage />
      </v-app>
</template>

<script>
import Navbar from "~/components/Navbar";
import Piepage from "../components/footer.vue";
export default {
  name: "MainLayout",

  components: {
    Navbar,
   Piepage,
  },
};
</script>
