<template>
<v-app-bar app style=" background-color: rgb(25, 46, 79); " elevation="0">

    <v-toolbar dense elevation="0" style="    background-color: transparent;  color:#fff;">
     <v-img class="ml-10 mr-5" max-height="38" max-width="38" src="/img/u.png" />
      <v-toolbar-title >{{ appName }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn v-for="(link, i) in linksVerified" :key="i"  plain :to="{name:link.path}" color="#fff"  >
        {{ link.name }}
      </v-btn>
     


     <!--v-btn small depresed > {{rol.nombre}}</v-btn-->

        <v-menu v-if="user" bottom min-width="220px" rounded offset-y :close-on-content-click="false" v-model="menu_user">
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
                      <v-list>
                        <v-list-group >
                          <template v-slot:activator>
                            <v-list-item-content >
                                <v-list-item-title> Cambiar de rol</v-list-item-title>
                            </v-list-item-content>
                          </template>
                          <v-list-item v-for="(rol,i) in user.Roles" :key="i" link @click="cambiar_rol(rol.id)" >
                            <v-list-item-title  class="d-flex"> 
                            {{rol.nombre}}
                             
                             <v-btn class="ml-auto" v-if="rol.rol_id==rolseleccion" v-for="(link, i) in linksVerified" :key="i" small :to="{name:link.path}" color="primary" @click="menu_user=false"  >
                                  Ir
                             </v-btn> 
                          </v-list-item-title>
                          <img src="" alt="">
                          </v-list-item>
                          
                        </v-list-group>
                      </v-list>                    
                      <v-btn width="200" depressed rounded text  style="justify-content: flex-start ; margin:3px"  :to="{name:firstRoute}" @click="menu_user=false">
                      <v-icon left>mdi-view-dashboard</v-icon>
                        Dashboard
                      </v-btn>
                
                      <v-btn  width="200" depressed rounded text   style=" justify-content: flex-start ; margin:3px" to="/settings" @click="menu_user=false">
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
import Form from "vform";
export default {
  data: () => ({
    appName: window.config.appName,
    // links: [
    //   { name: "Inicio", path: "/home", notUser: false },
    // { name: "Iniciar sesión", path: "/login", notUser: true },
    // { name: "Registrarme", path: "/registro", notUser: true },
    //],
    //roles:[],
    bgNavbar: "#fff",
    letra_color:"#fff",
    menu_user:false,
    form: new Form({
      id_role:'',
    }),
    rolseleccion:0
  
  }),
   /* props: {
      dashboard:'/admin',
    },*/

  computed: {
    ...mapGetters({
      user: "auth/user",
      firstRoute :"auth/firstRoute",
      //Ruta:"auth/Ruta",
          //this.$router.push({ name: "admin.dashboard" });
       // this.$router.push({name: firstRoute}),
    }),
    linksVerified: function () {
      return [{ name: "Dashboard", path:this.firstRoute }];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
    RutaRedireccion: function(){
      return this.firstRoute
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
     // await this.$store.dispatch("admin/dashboard");
      // Redirect to login.
        this.$router.push({ name: "home" });
    },cambiar_rol(id){
        this.form.id_role=id;
        this.form.post('/api/cambiar-rol/'+id).then(response=>{
          this.rolseleccion=response.data
          this.$store.dispatch("auth/fetchUser");     
          //this.$router.push({ name: 'login'}).catch(() => {})
          //console.log(this.linksVerified)
        });
        
        
    },
    
  },
};
//#051733;
</script>

