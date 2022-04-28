
<template>
  <v-container class="main"  fluid grid-list-md>
    <v-layout row wrap align-space-between justify-space-between fill-height>
      <v-flex style="text-align:center;">
        <v-layout align-center justify-center fill-height  >
          <div   >      
            <p class=" text-center text-justify"
               style="font-size:70px; font-family: 'Vollkorn', serif; display: contents; ">
                Grados y Títulos <br>
            </p> 
            
            <p style="font-family: 'Bebas Neue', cursive; ">
            <hr>
                 Universidad Nacional Daniel Alcides Carrion
                 <hr>
            </p>
          
          </div>  
        </v-layout> 
      </v-flex>
      <v-flex class=" d-flex align-center">    
        <v-img max-height="800" width="800"
              class=" darken-1" src="/img/home.png" />
      </v-flex >
    </v-layout>
  </v-container>
</template>
<script>
export default {
    middleware: ["auth"],
}
</script>
<style scoped>
.main {
  background-size: cover;
  height: 100%;
  background:#f5f7ff;
}
</style>