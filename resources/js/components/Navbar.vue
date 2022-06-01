<template>
<v-app-bar app style=" background-color: rgb(25, 46, 79); " elevation="0">

    <v-toolbar dense elevation="0" style="    background-color: transparent;  color:#fff;">
     <v-img class="ml-10 mr-5" max-height="38" max-width="38" src="/img/u.png" />
      <v-toolbar-title >{{ appName }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn v-for="(link, i) in linksVerified" :key="i"  plain :to="{name:link.path}" color="#fff"  >
        {{ link.name }}
      </v-btn>

        <v-menu v-if="user" bottom min-width="220px" rounded offset-y>
          <template v-slot:activator="{ on }">
            <v-btn  icon elevation="0" :color="letra_color" dense x-large v-on="on">
              <v-avatar  size="42" >
                <v-icon :color="letra_color">mdi-account-school</v-icon>
              </v-avatar>
            </v-btn>
          </template> 
          <v-card>
            <v-list-item-content >
              <div >
                  <div class="text-center">
                      <h4 class="text-wrap">{{ user.nombre }}</h4>
                      <p class="text-caption mt-1">
                        {{ user.email }}
                      </p>
                  </div>     
                  <v-divider class="my-1" ></v-divider>   
                    <div style="display:flex; flex-direction:column; " >
                      <v-btn width="200" depressed rounded text   style="justify-content: flex-start ; margin:3px"  :to="{name:firstRoute}">
                      <v-icon left>mdi-view-dashboard</v-icon>
                        Dashboard
                      </v-btn>
                
                      <v-btn  width="200" depressed rounded text   style=" justify-content: flex-start ; margin:3px" to="/settings">
                      <v-icon left>mdi-account-box-outline</v-icon>
                        Perfil
                      </v-btn>
                    
                      <v-btn  width="200" depressed rounded text   style="  justify-content: flex-start; margin:3px" @click="logout">
                      <v-icon left>mdi-logout</v-icon>
                        Salir
                      </v-btn>
                    </div>             
                
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
    letra_color:"#fff",
  }),
   /* props: {
      dashboard:'/admin',
    },*/

  computed: {
    ...mapGetters({
      user: "auth/user",
      firstRoute :"auth/firstRoute",
        //this.$router.push({ name: "admin.dashboard" });
       // this.$router.push({name: firstRoute}),
    }),
    linksVerified: function () {
      return [{ name: "Dashboard", path:this.firstRoute }];
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
      this.$router.push({ name: "home" });
    },
    
  },
};
//#051733;
</script>

