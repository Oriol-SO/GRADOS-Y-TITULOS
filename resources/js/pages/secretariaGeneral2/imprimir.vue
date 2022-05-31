<template>
  <v-container fluid>
    <v-card elevation="0">
        <v-toolbar class="mt-3" color="#0df0d6" dark style="color:#000;" elevation="0">
          <v-toolbar-title class="d-flex" style="width:100%;" > POR IMPRIMIR
   
          </v-toolbar-title>
            <template v-slot:extension>
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
            </template>
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
                    show-group-by="consejo_numero"
                    group-by="consejo_numero"
                    
                  >
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                        v-if="item.estado_impri==0"
                        small
                        rounded
                        color="primary"
                        elevation="0"
                        style="color:#fff;"
                        class="text-capitalize"
                        @click="enviar_imprimir(item)"    
                        >  <v-icon left class="ml-1">mdi-printer</v-icon> Imprimir</v-btn>
                      <div class="d-flex" style="align-items: center;">
                           <v-btn
                        v-if="item.estado_impri==1"
                        small
                        rounded
                        color="#19ef6e"
                        elevation="0"
                        style="color:#fff;"
                        class="text-capitalize"
                        @click="enviar_imprimir(item)"    
                        > <v-icon left>mdi-check</v-icon> Imprimido</v-btn>
 
                        <!--v-btn
                        v-if="item.estado_impri==1"
                        x-small
                        class="ml-2"
                        fab
                        color="primary"
                        elevation="0"      
                        @click="enviar_imprimir(item)"    
                        > <v-icon dark>mdi-backup-restore</v-icon></v-btn-->
                      </div>
                       

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
        v-model="dialogenviar"
      >                      
        <template>
            <v-card>
            <v-toolbar
                class="text-h6"
                color="#0df0d6"
                dark
                elevation="0"
            >Detalles de Expediente</v-toolbar>
            <form>
                <v-card-text>
                <div class="text-overline mb-4">
                <p v-for="(dato,i) in datos.data" :key="i"
                >"{{dato.Nombre}}":"{{dato.Valor}}"</p>
                </div>
                <v-btn class="mt-3 " 
                style="color:#fff;" 
                elevation="0" 
                color="#42C2FF" 
                @click="postImprimir()">
                Aceptar</v-btn>

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
          dialogenviar:false,
            tab:null,
            //items:['todos','bachiller','titulos',],
            dialogAgendar:false,
            singleSelect: true,
            tab: null,
            headers: [
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite' },           
            { text: 'Fecha de inicio', value: 'fec_inicio' },
            { text: 'Consejo', value:'consejo_numero'},            
            { text: 'Estado', value: 'estado' },
            { text: 'Acciones', value: 'actions', sortable: false },
            ],
            conresolucion:[],
            items:[],
            form: new Form({
                diploma_id:'',
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
            this.dialogenviar=false;
            //this.dialogAgendar=false;
            this.form.diploma_id='';
            this.form.tramite_id='';
        },
        async tipogrados(){
            const {data}= await axios.get('/api/secre-gen-grado/');
            this.items=data;
            //this.primerTab=data[0].id;
        },async fetchExpedientes(id){
            await axios.get('/api/sg2_datos_internos_imprimir/'+id).then(response=>{
                this.conresolucion=response.data;
            });

        },async enviar_imprimir(item){
            this.form.tramite_id=item.id;
            this.form.diploma_id=item.diploma;
            this.datos=await axios.get('/api/get_60_campos/'+item.id);
            this.dialogenviar=true;
            
        },async postImprimir(){
            console.log(this.form);
            await this.form.post(`/api/imprimir/`).then(response=>{
                console.log(response.data);  
                this.close();
                this.fetchExpedientes(this.primerTab); 
            });
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
