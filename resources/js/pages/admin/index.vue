<template>
  <div>
   
      <sidevar/>
     <transition name="fade" mode="out-in">
     <h1> hola a todos este es el espacio de dashboard</h1>
      <router-view />
    </transition>
  </div>
</template>

<script>
import Sidevar from '../../components/sidevar.vue';
export default {
  components:{
    Sidevar
    
  }
};
</script>

