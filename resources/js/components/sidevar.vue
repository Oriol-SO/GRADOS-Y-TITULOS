<template>
    
          <v-navigation-drawer
                height="100vh"
                expand-on-hover
                permanent
                fixed
                class='estilos-sidebar'
                
                
              >
                <v-divider></v-divider>
                <v-list
                  nav
                  dense
                  
                >
                
              
                <router-link 
                v-for="(item,i) in items" :key="i" :to="{name: item.to}" link style="text-decoration:none">   
                  <v-list-item link class="iconos">
                    <v-list-item-icon>
                      <v-icon>{{item.icon}}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>{{item.title}}</v-list-item-title>
                  </v-list-item>
                </router-link>
            
                </v-list>
              </v-navigation-drawer>
     
    

      
</template>
<script>
 export default {
   name:"Sidevar",
  props: {
      items: { type: Array, default: [] },
    },
  }
</script>

<style>
  .estilos-sidebar{
    margin-top:70px;
    border-top-right-radius:20px;
  }
  .estilos-sidebar:hover{
 -webkit-box-shadow: 10px -1px 21px -11px rgba(0,0,0,0.56);
  -moz-box-shadow: 10px -1px 21px -11px rgba(0,0,0,0.56);
  box-shadow: 10px -1px 21px -11px rgba(0,0,0,0.56);
  }
 .iconos:hover{
   background: #c6c6cd;
 }


</style>