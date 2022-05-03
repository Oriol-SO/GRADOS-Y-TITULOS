<template>
<v-app-bar app style=" background-color: #051733; " elevation="0">

    <v-toolbar dense elevation="0" style="    background-color: transparent;  color:#fff;">
     <v-img class="ml-10 mr-5" max-height="38" max-width="38" src="/img/u.png" />
      <v-toolbar-title >{{ appName }}</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn v-for="(link, i) in linksVerified" :key="i" text :to="link.path"  style=" color:white;">
        {{ link.name }}
      </v-btn>

      <v-menu v-if="user" bottom min-width="240px" rounded offset-y>
        <template v-slot:activator="{ on }">
          <v-btn  icon elevation="0" color="white" dense x-large v-on="on">
            <v-avatar  size="32" >
              <v-icon color="grey">mdi-account-circle</v-icon>
            </v-avatar>
          </v-btn>
        </template> 
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-auto text-center" >
             
              <h4 class="text-wrap">{{ user.nombre }}</h4>
              <p class="text-caption mt-1">
                {{ user.email }}
              </p>
              <v-divider class="my-3"></v-divider>
               <v-btn depressed rounded text to="/admin">
                Dashboard
              </v-btn>
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
    </v-toolbar>

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
    bgNavbar: "#fff",
  }),
    props: {
      dashboard:'/admin',
    },

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
      //this.changeColor();
    };
  },

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");
      await this.$store.dispatch("admin/dashboard");
      // Redirect to login.
      this.$router.push({ name: "login" });
    },
    
  },
};
</script>
