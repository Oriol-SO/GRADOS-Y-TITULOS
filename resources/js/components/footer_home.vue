<template>
  <v-footer padless style="background:#000; color:#fff; min-height:60px;">
  <v-row>
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
      class="text-right pr-5"
      cols="12"
      md="6"
      
    >
    Copyright ©  {{ new Date().getFullYear() }}  Grados y Titulos 
    </v-col>  
  </v-row>

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