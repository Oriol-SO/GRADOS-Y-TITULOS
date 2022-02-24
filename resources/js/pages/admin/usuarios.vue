<template>
 <div 
  style="display:flex; flex-wrap:wrap; justify-content: space-evenly;"
 >
 
      <v-card v-for="i in 10"
    class="mt-5 mb-5 ml-1 mr-1 "    
    max-width="400"
    min-width="200"   
  >
  
    <v-card-text >     
      <p class="text-h4 text--primary">
        BACHILLER AUTOMATICO VIRTUAL 
      </p>
        <div class="text--primary">
        Fases :<strong>15</strong><br>
        Rquisitos :<strong>10</strong>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn
        text
        color="deep-purple accent-4"
      >
        Abrir
      </v-btn>
      <v-btn
        text
        color="deep-purple accent-4"
      >
        Desactivar
      </v-btn>
    </v-card-actions>
  </v-card>
  

 
 </div>
  
</template>

<script>

</script>

