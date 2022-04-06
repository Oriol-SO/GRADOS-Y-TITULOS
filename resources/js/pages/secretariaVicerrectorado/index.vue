
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
  middleware: "auth",
  components:{
    Sidevar,
   
    
  },data: () => ({
       links: [
      {
        title: "Expedientes",
        icon:  "mdi-playlist-plus",
        to: "sg.expedientes",
      }, 

    ],
  }),
  
  }
</script>


