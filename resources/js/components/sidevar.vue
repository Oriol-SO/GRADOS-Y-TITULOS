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
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-folder</v-icon>
            </v-list-item-icon>
            <v-list-item-title>dashboard</v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-folder</v-icon>
            </v-list-item-icon>
            <v-list-item-title>tramites</v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-folder</v-icon>
            </v-list-item-icon>
            <v-list-item-title>personas/usuarios </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
</template>
<script>
 export default {
   name:"Sidevar"
  }
</script>

<style>
</style>