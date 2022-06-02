<template>
   <div>   
   <sidevar :items="links"/>
     <div class="mx-2" >
       <router-view></router-view>
     </div>     
   </div>  
</template> 

<script>
import Sidevar from '../../components/sidevar.vue';
export default {
  middleware: ["auth"],
  components:{
    Sidevar,
   
    
  },data: () => ({
       links: [
      {
        title: "Expedientes por agendar",
        icon:  "mdi-playlist-plus",
        to: "sg.expedientes",
      }, //se agenda
      {
        title: "Expedientes agendados",
        icon:  "mdi-playlist-check",
        to: "sg.agendados",
      }, //se aprueba
      {
        title: "Expedientes aprobados",
        icon:  "mdi-check-decagram",
        to: "sg.aprobados",
      }, //Se asigna n resolucion,consejo y fecha
      {
        title: "Datos internos",
        icon:  "mdi-table",
        to: "sg.resueltos",
      }, //se asigna libro, reg unico y folio
      {
        title: "Control de sticker",
        icon:  "mdi-sticker-plus",
        to: "sg.sticker",
      },
      {
        title: "Para sunedu",
        icon:  "mdi-license",
        to: "sg.sunedu",
      },
    ],
  }),
  
  }
</script>

