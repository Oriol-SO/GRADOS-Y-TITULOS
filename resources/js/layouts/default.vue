<template>
  <v-app id="inspire" class="grey lighten-3">
    <navbar />

    <v-main class="grey lighten-3">
      <transition name="fade" mode="out-in"> <child /> </transition>
    </v-main>
  </v-app>
</template>

<script>
import Navbar from "~/components/Navbar";

export default {
  name: "MainLayout",

  components: {
    Navbar,
  },
};
</script>
