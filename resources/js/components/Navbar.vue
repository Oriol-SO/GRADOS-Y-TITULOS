<template>
  <v-app-bar app :color="bgNavbar" elevate-on-scroll elevation="2" flat rounded>
    <v-container class="py-0 fill-height" fluid>
      <v-app-bar-nav-icon>
        <v-img max-height="40" max-width="40" src="/img/u.png" />
      </v-app-bar-nav-icon>
      <v-app-bar-title>{{ appName }}</v-app-bar-title>

      <v-spacer></v-spacer>

      <v-btn v-for="(link, i) in linksVerified" :key="i" text :to="link.path">
        {{ link.name }}
      </v-btn>

      <v-menu v-if="user" bottom min-width="240px" rounded offset-y>
        <template v-slot:activator="{ on }">
          <v-btn icon elevation="0" color="transparent" dense x-large v-on="on">
            <v-avatar color="secondary" size="32">
              <v-img :src="user.foto_url"></v-img>
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-auto text-center">
              <v-avatar color="primary" size="32">
                <v-img :src="user.foto_url"></v-img>
              </v-avatar>
              <h4 class="text-wrap">{{ user.name }}</h4>
              <p class="text-caption mt-1">
                {{ user.email }}
              </p>
              <v-divider class="my-3"></v-divider>
              <v-btn depressed rounded text to="/settings">
                Editar perfil
              </v-btn>
              <v-divider class="my-3"></v-divider>
              <v-btn depressed rounded text @click="logout">
                Cerrar sesión
              </v-btn>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>
    </v-container>
  </v-app-bar>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data: () => ({
    appName: window.config.appName,
    // links: [
    //   { name: "Inicio", path: "/home", notUser: false },
    // { name: "Iniciar sesión", path: "/login", notUser: true },
    // { name: "Registrarme", path: "/registro", notUser: true },
    //],
    bgNavbar: "transparent",
  }),

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    linksVerified: function () {
      return [{ name: "Inicio", path: "/home" }];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
  },

  mounted() {
    window.onscroll = () => {
      this.changeColor();
    };
  },

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
    changeColor() {
      if (
        document.body.scrollTop > 10 ||
        document.documentElement.scrollTop > 10
      ) {
        this.bgNavbar = "white";
      } else {
        this.bgNavbar = "transparent";
      }
    },
  },
};
</script>

<style scoped>
.cristal {
  backdrop-filter: blur(10px) !important;
}
</style>