<template>
<div>
    <v-app-bar
      color="trasparend"
      elevation="0"
      fixed
      width="45"
      style="margin-top:0px; margin-left:5px ; background-color:transparent;  "                  
    >
      <v-app-bar-nav-icon  color="white" style="font-size:50px" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      left
      temporary
      fixed        
      color="#111827"
      style="margin-top:65px;"
    >
      <v-list
        nav
        dense
        >
        <v-list-item-group
          v-model="group"
          active-class="deep-lead--text text--accent-4"
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
      drawer: false,
      group: null,
    }),

    watch: {
      group () {
        this.drawer = false
      },
    },
  }
</script>

