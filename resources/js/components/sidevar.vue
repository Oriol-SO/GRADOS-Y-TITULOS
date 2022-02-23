<template>
  
       <v-navigation-drawer
        height="90vh"
        expand-on-hover
        permanent
        absolute
      >
        <v-divider></v-divider>
        <v-list
          nav
          dense
        >
         
      
         <router-link 
         v-for="(item,i) in items" :key="i" :to="{name: item.to}" link style="text-decoration:none">   
          <v-list-item link>
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
</style>