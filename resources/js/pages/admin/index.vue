<template>
  <v-container     class="ml-12">  

   <v-card-text> hola a todos este es el espacio de dashboard</v-card-text>
    
     <transition name="fade" mode="out-in">
       <sidevar/>
     
      <router-view />
    </transition>
  </v-container>
</template>

<script>
import Sidevar from '../../components/sidevar.vue';
export default {
  components:{
    Sidevar
    
  }
};
</script>

