<template>
    <div class="ml-8 mt-5">
        <v-card  >
        <v-card-title class="py-1 text-h5">{{procesos.nombre}}</v-card-title>
        </v-card> 
     


        <template>
            <v-card class="mt-5">
                <v-tabs
                v-model="tab"
                background-color="primary"
                dark
                >
                <v-tab
                    v-for="item in items"
                    :key="item.tab"
                >
                    {{ item.tab }}
                </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="item in items"
                    :key="item.tab"
                >
                    <v-card flat>
                    <v-card-text>{{ item.content }}</v-card-text>
                    </v-card>
                </v-tab-item>
                </v-tabs-items>
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
        items: [
       /*   { tab: 'One', content: 'Tab 1 Content' },
          { tab: 'Two', content: 'Tab 2 Content' },
          { tab: 'Three', content: 'Tab 3 Content' },
          { tab: 'Four', content: 'Tab 4 Content' },
          { tab: 'Five', content: 'Tab 5 Content' },
          { tab: 'Six', content: 'Tab 6 Content' },
          { tab: 'Seven', content: 'Tab 7 Content' },
          { tab: 'Eight', content: 'Tab 8 Content' },
          { tab: 'Nine', content: 'Tab 9 Content' },
          { tab: 'Ten', content: 'Tab 10 Content' },*/
        ],
     } 
  },mounted(){
      this.FetchTramites();
  },methods:{
      async FetchTramites(){
          const { data } = await axios.get(`/api/proceso/${this.$route.params.id}`);   
          this.procesos = data;
          console.log(data);
      },
      async FetchFases(){
          const {data}=await axios.get(`/api/fases/${this.$route.params.id}`)

      }
  }
}
</script>

<style >
 
</style>
