<template>
    <div>
      <v-card elevation="0">
        <v-toolbar class="mt-3" color="#0df0d6" dark style="color:#000;" elevation="0">
        <v-toolbar-title > EXPEDIENTES CON RESOLUCIÓN</v-toolbar-title>
            <template v-slot:extension>
              <v-tabs v-model="tab">
              <v-tabs-slider color="#000"></v-tabs-slider>
                <v-tab
                  style="color:#000;"
                  v-for="item in items"
                  :key="item"
               
                >
                  {{ item }}
                </v-tab>
              </v-tabs>        
            </template>
        </v-toolbar>         
            <v-divider class="mt-2"></v-divider>
            <v-tabs-items v-model="tab" class="mt-3" >
              <v-tab-item
                v-for="item in items"
                :key="item"
              >
                <v-card  >

                  <v-card-text > hola atodos</v-card-text>

                </v-card>
              </v-tab-item>
            </v-tabs-items>
      </v-card>
    </div>
</template>

<script>
export default {
  data(){
    return{
      tab:null,
      items:['todos','bachiller','titulos','maestria']
    }
  }
}
</script>