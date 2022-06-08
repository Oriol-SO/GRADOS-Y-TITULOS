<template>
   <div>   
   <sidevar :items="links"/>
     <div class="ml-3" >
       <router-view></router-view>
     </div>     
   </div>  
</template> 

<script>
import Sidevar from '../../components/sidevar.vue';
export default {
  middleware:["auth", "role:11"],
  components:{
    Sidevar,
   
    
  },data: () => ({
       links: [
      {
        title: "Expedientes",
        icon:  "mdi-table-of-contents",
        to: "dashboardvice",
      }, 

    ],
  }),
  
  }
</script>