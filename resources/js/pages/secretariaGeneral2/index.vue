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
   middleware: ["auth",'role:12'],
  components:{
    Sidevar,
   
    
  },data: () => ({
       links: [
      {
        title: "Aprobados",
        icon:  "mdi-check-decagram",
        to: "sg2.aprobados",
      }, //se agenda
      {
        title: "Por imprimir",
       icon:  "mdi-printer-alert",
        to: "sg2.imprimir",
      }, //se aprueba
      {
        title: "Programar entrega",
        icon:  "mdi-calendar-range",
         to: "sg2.programar",
      }, //Se asigna n resolucion,consejo y fecha
      {
        title: "Programados para hoy",
        icon:  "mdi-timeline-clock",
       to: "sg2.entregar",
      },
 
    ],
  }),
  
  }
</script>
