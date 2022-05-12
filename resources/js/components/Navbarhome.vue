<template>
<v-app-bar id="home-app-bar" app style=" background-color: transparent; position: absolute;" elevation="0" elevate-on-escroll height="80">

    <v-toolbar dense elevation="0" style=" background-color: transparent;  ">
     <v-img class="ml-1" max-height="68" max-width="68" src="/img/u.png" />
      <!--v-toolbar-title class="text-h6" >{{ appName }}</v-toolbar-title-->
      <v-spacer></v-spacer>
      <div>
        <v-tabs
          class="hidden-sm-and-down"        
          color="#42a5f6"
          optional
          background-color="transparent"
          dark
        >
          <v-tab
            v-for="(link, i) in linksVerified" :key="i"
            :to="link.path"
            :ripple="false"  
            class="font-weight-bold"         
            text
            
          >
            {{ link.name }}
          </v-tab>
        </v-tabs>
      </div>
        
      <!--v-btn v-for="(link, i) in linksVerified" :key="i" size="42"  :to="link.path" :color="letra_color"  class="mr-3">
        {{ link.name }}
      </v-btn-->

     
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
    letra_color:'#fff',
  }),
    props: {
      dashboard:'/admin',
    },

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    linksVerified: function () {
      return [{ name: "Inicio", path: "/home" },{name:'Iniciar Sesión', path:"/login"},{name:'Registrate', path:"/register"}];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
  },

  mounted() {
    window.onscroll = () => {
      //this.changeColor();
    };
  },


};

//background-color: rgba(25, 46, 79,0.84);
</script>

<style>
#home-app-bar .v-tabs-slider {
    max-width: 24px;
    margin: 0 auto;
}

#home-app-bar .theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active), .theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon, .theme--dark.v-tabs > .v-tabs-bar .v-tab:not(.v-tab--active) > .v-btn, .theme--dark.v-tabs > .v-tabs-bar .v-tab--disabled {
    color: rgb(255 255 255) !important;
}
</style>
