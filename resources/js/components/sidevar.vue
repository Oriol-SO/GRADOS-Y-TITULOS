<template>
<div>
    <v-app-bar
      color="transparent"
      elevation="0"
      fixed
      style="margin-top:0px; margin-left:5px;"                  
    >
      <v-app-bar-nav-icon  color="secondary" style="font-size:50px" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      bottom
      temporary
      fixed        
      color="#111827"
      style="margin-top:70px;"
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
          permanent
        >
        <router-link 
                v-for="(item,i) in items" :key="i" :to="{name: item.to}" link style="text-decoration:none">   
                  <v-list-item link class="iconos" style="color:white;">
                    <v-list-item-icon>
                      <v-icon color="white">{{item.icon}}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>{{item.title}}</v-list-item-title>
                  </v-list-item>
                </router-link>
            
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

  </div>
</template>
<script>
 export default {
   name:"Sidevar",
  props: {
      items: { type: Array, default: [] },
    },
    data: () => ({
      drawer: true,
      group: null,
    }),

    watch: {
      group () {
        this.drawer = false
      },
    },
  }
</script>

