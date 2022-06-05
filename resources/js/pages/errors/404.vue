<template>

<v-container >
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
                La pagina que ha solicitado no existe o no tienes permiso de acceso 
            </p>
               <v-btn
                 color="accent"
                 depressed
                 elevation="3"
                 small
                  to="/home"
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