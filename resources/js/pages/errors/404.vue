<template>
<!-- <v-container fluid class="fill-height justify-center"  >
<v-row style="flex-wrap: wrap-reverse ; justify-content:space-around ; align-items:center">
  <v-card class="text-center " style="background :transparent" >
    <h1  style="font-size:43vh ; color:white">404 </h1>   
    <v-card-title style="justify-content ;  " class=" mb-5 text-xl-h4">
     
     404
      
     
    </v-card-title>
    <v-card-text style="justify-content ; " class=" mb-5">
    La pagina que ha solicitado asdasdasno se encuentra disponible
    </v-card-text>
    <div class="links" >
      <v-btn
        color="blue"
        x-large
       >
        <router-link style="text-decoration:none ; color:white" :to="{ name: 'home' }">
          {{ $t(" ir al inicio ") }}
        </router-link> 
      </v-btn>
    </div>
  </v-card>
  <v-card  style="background :transparent" >
   <v-img width="80vh" src="/img/error3.png  " />
  </v-card>
</v-row>
</v-container>-->

<!--
  <v-container class="grey lighten-5 ">
    <v-row height="100" style="flex-wrap: wrap-reverse ; justify-content:space-around ; align-items:center ; justify-center">
      <v-col
        cols="12"
        sm="6"
        md="8"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          <v-card-title>404</v-card-title>
          <v-card-text>La pagina que ha solicitado asdasdasno se encuentra disponible</v-card-text>
            <v-btn
             color="blue"
             x-large
            >
            <router-link style="text-decoration:none ; color:white" :to="{ name: 'home' }">
             {{ $t(" ir al inicio ") }}
            </router-link> 
      </v-btn>
        </v-card>
      </v-col>
      <v-col
        cols="6"
        md="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          <v-img width="80vh" src="/img/error3.png  " />
        </v-card>
      </v-col>
    </v-row>
  </v-container>-->

<v-container >
 <!--  <container  style="align-self: center ; background: rebeccapurple ; align-items: center ;" height="100vh" > -->
      <v-card style=" display:flex ; align-items: center ; height:70vh ; justify-content: center ; background-color: transparent;" elevation="0">
  
          <div >      
            <p 
               style="font-size:40px; font-family: 'Vollkorn', serif; display:flex ;">
              
               <v-img class="mr-5" max-height="60" max-width="60"  src="/img/u.png" />
                UNDAC 
           
            </p>
            <p>
                Ops un error! <b>--error.404</b>
            </p>
            <p >
                La pagina que ha solicitado no existe
            </p>
               <v-btn
                 color="accent"
                 depressed
                 elevation="3"
                 small
               >regresar al inicio</v-btn>
          </div>  
           <div class="ml-10 mb-10">    
             <v-img  class="hidden-sm-and-down darken-1" max-width="30vh" src="/img/error3.png " />
          </div>  

      </v-card >

  </v-container>

</template>

 
<script>
export default {
  layout: "basic",
  name: "NotFound",
};

</script>
<style>

</style>