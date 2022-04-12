<template>
<v-container fluid class="fill-height justify-center" style="background :#0D404E" >
  <v-card class="text-center  pt-3" elevation="0" style="background :transparent" >
    
      <v-img width="110vh" src="/img/error.svg" />
      <v-card-text  class="text-center my-5"><h1 style="color:white">La pagina que ha solicitado no se encuentra disponible</h1></v-card-text>
    
    <div class="links" >
    <v-btn
       color="secondary"
        x-large
        dark
      >
      <router-link style="text-decoration:none" :to="{ name: 'home' }">
        {{ $t(" ir al inicio ") }}
      </router-link> 
      
            </v-btn>
    </div>
  </v-card>
</v-container>
</template>
 
<script>
export default {
  layout: "basic",
  name: "NotFound",
};
</script>
