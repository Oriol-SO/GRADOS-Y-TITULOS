

<template>

<div>
  <div>
  <v-btn color="teal" class="ml-10 mt-5">
    Agregar Tramite
  </v-btn>
  </div>
 <div 
  style="display:flex; flex-wrap:wrap; justify-content: space-evenly;"
 >
 
      <v-card v-for="(proceso,i) in procesos" :key="i"
    class="mt-5 mb-5 ml-1 mr-1 "    
    width="420"
     
  >
  
    <v-card-text >     
      <p class="text-h6 indigo--text " >
        {{proceso.procNom}}
      </p>
        <div class="text--primary "  >
        Fases :<strong>15</strong> <br/>
        Requisitos :<strong>10</strong>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn  
          
        color="teal"
        tile
        outlined
        elevation="2"
     
      >
        Abrir
      </v-btn>
      <v-btn
        
        tile
        color="blue-grey"
        outlined
       elevation="2"
      >
        Desactivar
      </v-btn>
    </v-card-actions>
  </v-card>
  

 
 </div>
</div>
</template>

<script>
import axios from 'axios'
   export default {
    data () {
      return {
          procesos:[],
       
      }
    },
      mounted(){
      this.FetchProceso();
    }, 
    
    methods:{
      async FetchProceso() {
        const { data } = await axios.get("/api/proceso");
        this.procesos = data;

        //console.log(data);
      },


    
    },
  }
</script>

<style >
 
</style>