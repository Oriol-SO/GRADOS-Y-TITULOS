<template>
  <v-container fluid>
    <v-data-iterator
      :items="gruposexpedientes"
      :items-per-page.sync="itemsPerPage"
      hide-default-footer
    >
      <template v-slot:header>
        <v-toolbar
          class="mb-2"
          flat
        >
        
          <v-toolbar-title class="black--text ">PARA SUNEDU</v-toolbar-title>
        </v-toolbar>
      </template>
      <template >
        
          <v-spacer
            v-for="gruposexpediente in gruposexpedientes"
            :key="gruposexpediente.id"
            cols="12"
            sm="12"
            md="12"
  
            class="py-2"
          >
            <v-card >
              <v-card-title>
                <v-row >
                  <div>
                    Consejo Nro:{{ gruposexpediente.consejo_numero }} 
                    
                    <tfoot>
                      <td colspan="4" class="pl-4 #515252--text text-md-body-1 text-right">
                      <em> Fecha de Consejo: {{ gruposexpediente.consejo_fecha }}</em></td> 
                    </tfoot>
                  </div>
                </v-row>
                  <v-btn
                    color="green darken-3"
                    depressed
                    @click="exporExcel(gruposexpediente.consejo)"
                  >
                    <v-icon  left>
                      mdi-microsoft-excel
                    </v-icon>
                    Excel
                  </v-btn>
              </v-card-title>
              
              <v-divider></v-divider>
                
                  <v-card>
                 <v-data-table
                   :headers="headers"
                   :items="gruposexpediente.tramite"
                   hide-default-footer
                 ></v-data-table>
              </v-card>
            </v-card>
          </v-spacer>
       
      </template>
    </v-data-iterator>

  </v-container>
</template>

<script>
import axios from 'axios';
import Form from "vform";
export default {
    data(){
        return{
          singleSelect: true,
          dialogenviar:false,
            tab:null,
            //items:['todos','bachiller','titulos',],
            dialogAgendar:false,
            singleSelect: true,
            tab: null,
            headers: [
            { text: 'Tramite', value: 'tramite' },
            { text: 'Fecha de inicio', value: 'fec_inicio' },
            { text: 'Estado', value: 'estado' },
            ],
            aprobados:[],
            items:[],
            search:'',
            gruposexpedientes:[],
  

        }
    },mounted(){
            this.fetchExpedientes();
    },methods:{

        async fetchExpedientes(){
            await axios.get('/api/sg1-get-sunedu/').then(response=>{
                this.gruposexpedientes=response.data;
                console.log("sunedu",this.gruposexpedientes);
            });

        },exporExcel(id){
          console.log("id del item",id);
        }
    }
}
</script>
<style>
 thead.v-data-table-header th[role=columnheader] {
  font-size: 14px !important;
  color:#000;
  background:#0df0d6 !important;
}
</style>
