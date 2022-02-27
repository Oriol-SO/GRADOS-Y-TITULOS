<template>
    <div class="ml-8 mt-5">
        <v-card  >
        <v-card-title class="py-1 text-h5">{{procesos.nombre}}</v-card-title>
        </v-card>     

        <template>
            <v-card class="mt-5">
                <v-tabs
                v-model="tab"
                background-color="blue lighten-1"
                dark
            
                >
                <v-tab
                    v-for="(fase,i) in fases"
                    :key="i"
                    style="color:#fff;"
                    class="text-h7"
                    active-class="blue darken-4 "

                >
                    {{ i+1 }}
                </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="(fase,i) in fases"
                    :key="i"
                >
                    <v-card flat  >
                        
                    <v-card-text class="text-md-body-1 font-weight-medium" >{{ fase.nombre }} </v-card-text>
                    </v-card>
                </v-tab-item>
                </v-tabs-items>
            </v-card>
            </template>
            
            <template>
                <v-card
                    class="mx-auto mt-2"
                    tile
                >
                    <v-list dense>
                    <v-subheader class="font-weight-medium text-md-body-1">REQUISITOS {{faseid}}</v-subheader>
                    <v-list-item-group
                        v-model="selectedItem"
                        color="primary"
                    >
                        <v-list-item
                        v-for="(item, i) in items"
                        :key="i"
                        >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                    </v-list>
                </v-card>
                </template> 


    </div>
    
</template>

<script>
import axios from 'axios'
export default{

  data(){     
     return{
        procesos:[],
         tab: null,
       
        fases: [],
        selectedItem: 1,
        items: [
            { text: 'Real-Time', icon: 'mdi-check-outline' },
            { text: 'Audience', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
            { text: 'Conversions', icon: 'mdi-check-outline' },
        ],
        faseid:'',
        
     } 
  },mounted(){
      this.FetchTramites();
      this.FetchFases();
      console.log(this.faseid);
  },methods:{
      async FetchTramites(){
          const { data } = await axios.get(`/api/proceso/${this.$route.params.id}`);   
          this.procesos = data;
          console.log(data);
      },
      async FetchFases(){
          const {data}=await axios.get(`/api/fase/${this.$route.params.id}`);
          this.fases=data;
          this.faseid=data[0].id;        
      }
  }
}
</script>

<style >
 
</style>
