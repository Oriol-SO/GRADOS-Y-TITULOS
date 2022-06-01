<template>
  <v-container fluid>
    <v-card elevation="0">
        <v-toolbar class="mt-3" color="#0df0d6" dark style="color:#000;" elevation="0">
          <v-toolbar-title class="d-flex" style="width:100%;" > Programdos para Hoy
   
          </v-toolbar-title>
              <v-tabs v-model="tab">
              <v-tabs-slider color="#000"></v-tabs-slider>
                <v-tab
                  style="color:#000;"
                  v-for="item in items"
                  :key="item.id"
               
                >
                  {{ item.graNom }}
                </v-tab>
              </v-tabs>        
        </v-toolbar>         
            <v-divider class="mt-2"></v-divider>
            <v-tabs-items v-model="tab" >
              <v-tab-item
                v-for="item in items"
                :key="item.id"
              >
                <v-card elevation="0" style="background:rgb(242 243 248);" >
                
                  <v-data-table
                    :headers="headers"
                    :items="conresolucion" 
                    :items-per-page="10"
                    class="elevation-1"
                    group-by="consejo_numero"
                  >

                    <template v-slot:item.estado="{ item }">
                     
                          <v-avatar  v-if="item.estado"                          
                          size="25">
                            <v-icon color="teal">mdi-checkbox-marked-circle</v-icon>
                          </v-avatar>
                       

                      </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                        small
                        rounded
                        color="primary"
                        elevation="0"
                        style="color:#fff;"                      
                        @click="entregar(item)" 

                        >{{item.estado?'entregado':'entregar'}}  </v-btn>

                    </template>
                  </v-data-table>
                </v-card>
              </v-tab-item>
            </v-tabs-items>
      </v-card>
  <template>
      <v-dialog
        transition="dialog-top-transition"
        max-width="450"
        persistent
        v-model="dialogentregar"
      >                      
        <template>
            <v-card>
            <v-toolbar
                class="text-h6"
                color="#0df0d6"
                dark
                elevation="0"
            >Realizar entrega</v-toolbar>
            <form>
                <v-card-text>
                  <v-card elevation="0" class="d-flex justify-center" style="flex-direction:column;">
                      <v-card-title class="d-flex justify-center">¿Estas seguro de realizar esta accion?</v-card-title>
                      <v-btn 
                        class="mt-3 mx-8" 
                        style="color:#fff;" 
                        elevation="0" 
                        color="#42C2FF" 
                        @click="realizar_entrega()">
                        Entregar
                      </v-btn>
                  </v-card>             
                </v-card-text>                                                              
            </form>

            <v-card-actions>
                <v-btn class="ml-auto"
                    text
                    @click  ="close()"
                >Cancelar</v-btn>
            </v-card-actions>
            </v-card>
        </template>
      </v-dialog>
  </template>
  </v-container>
</template>

<script>
import axios from 'axios';
import Form from "vform";
export default {
    data(){
        return{
          //singleSelect: true,
            dialogentregar:false,
            tab:null,
            //items:['todos','bachiller','titulos',],
            dialogAgendar:false,
            singleSelect: true,
            tab: null,
            headers: [
            { text: '', value: 'estado' },
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite' },           
            { text: 'Fecha de inicio', value: 'fec_inicio' },
            { text: 'Consejo', value:'consejo_numero',sortable: false},            
            //{ text: 'Estado', value: 'estado' },
            { text: 'hora', value: 'hora' },
            { text: 'Acciones', value: 'actions', sortable: false },
            ],
            conresolucion:[],
            items:[],
            form: new Form({
                entregar:'',
                tramite_id:'',
            }),  
            
            primerTab:0,
            datos:[],
            
        }
    },mounted(){
            this.fetchExpedientes(this.primerTab);
            this.tipogrados();
    },methods:{
        close(){
            this.dialogentregar=false;
            //this.dialogAgendar=false;
            this.form.sticker='';
            this.form.tramite_id='';
            this.form.diploma_id='';
        },
        async tipogrados(){
            const {data}= await axios.get('/api/secre-gen-grado/');
            this.items=data;
            //this.primerTab=data[0].id;
        },async fetchExpedientes(id){
            await axios.get('/api/sg2-get-programados/'+id).then(response=>{
                this.conresolucion=response.data;
                console.log(this.conresolucion);
            });

        },async entregar(item){
           this.dialogentregar=true;
           this.form.tramite_id=item.id;
        },realizar_entrega(){
          this.form.entregar='ENTREGAR';
            this.form.post('/api/sg2-entregar/'+this.form.tramite_id).then(response=>{
              this.dialogentregar=false;
              this.fetchExpedientes(this.primerTab);
            })
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
