<template>
   <div>
     <sidevar :items="links"/>
    
     <div class="ml-12" >
       <router-view></router-view>
     </div>
     
 
   </div>

  
</template>

<script>
import Sidevar from '../../components/sidevar.vue';

export default {
  components:{
    Sidevar,
   
    
  },
    data: () => ({
    links: [
      { title: "Dashboard", icon: "mdi-view-dashboard", to: "admin.dashboard" },
      { title: "Tramites", icon: "mdi-folder", to: "admin.tramites" },
      { title: "Personas/Usuarios", icon: "mdi-account-multiple",to: "admin.usuarios",
      },
    ],
  }),

};
</script>

