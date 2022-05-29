<template>
  <v-footer  style="background:#000; color:#fff;  ">
  
    <v-col
      cols="12"
      md="6"
      class="text-left"
    >
    <div>
        <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-4"
          dark
          icon
        >
          <v-icon size="24px">
            {{ icon }}
          </v-icon>
        </v-btn>
    </div>

    </v-col>

    <v-col
      class="text-right pr-5 pb-0 mb-0"
      cols="12"
      md="6"
      
    >
    <div>
    Copyright ©  {{ new Date().getFullYear() }}  Grados y Titulos 
    </div>
    </v-col>  


  </v-footer>
</template>

<script>
  export default {
      name:"Piepage",
    data (){
      return{
        icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-linkedin',
        'mdi-instagram',
      ],
      }
    }
  }
</script>