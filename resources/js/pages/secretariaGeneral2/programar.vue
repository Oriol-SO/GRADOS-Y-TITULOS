<template>
  <v-container fluid>
    <v-card elevation="0">
        <v-toolbar class="mt-3" color="#0df0d6" dark style="color:#000;" elevation="0">
          <v-toolbar-title class="d-flex" style="width:100%;" > Programar fecha de entrega
   
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
                    :items="for_entregar" 
                    :items-per-page="10"
                    class="elevation-1"
                    group-by="consejo_numero"
                  >
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                        v-if="item.fecha_entrega==null"
                        small
                        color="black"
                        elevation="0"
                        style="color:#fff;"
                        @click="enviar_fecha(item)" 
                        >  <v-icon  left class="ml-1">mdi-calendar-month</v-icon> Programar</v-btn>
                        <v-btn
                        v-else
                        small                 
                        color="#19ef6e"
                        elevation="0"
                        style="color:#fff;"
                        @click="reprogramar(item)" 
                        >  <v-icon  left class="ml-1">mdi-calendar-month</v-icon> Re-programar</v-btn>

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
              >Fecha y hora de entrega</v-toolbar>
              <v-card elevation="0" v-if="fecha_programada">
                <p><strong class="ml-2">programado para:</strong>{{fecha_programada}}</p>
              </v-card>
              <form>
                  <v-card-text>
                  <v-text-field
                  v-model="form.fecha"
                  type="datetime-local"
                  label="Fecha y Hora">
                  </v-text-field>                  
                  <v-btn class="mt-3 " 
                  style="color:#fff;" 
                  elevation="0" 
                  color="#42C2FF" 
                  @click="AddEntrega()">
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
            { text: 'Consejo', value:'consejo_numero',sortable: false},            
            { text: 'Estado', value: 'estado' },
            { text: 'Acciones', value: 'actions', sortable: false },
            ],
            for_entregar:[],
            items:[],
            form: new Form({
                fecha:'',
                tramite_id:'',
                diploma_id:'',
            }),  
            
            primerTab:0,
            datos:[],
            fecha_programada:'',
        }
    },mounted(){
            this.fetchExpedientes(this.primerTab);
            this.tipogrados();
    },methods:{
        close(){
            this.dialogenviar=false;
            //this.dialogAgendar=false;
            this.form.fecha='';
            this.form.tramite_id='';
            this.form.diploma_id='';
        },
        async tipogrados(){
            const {data}= await axios.get('/api/secre-gen-grado/');
            this.items=data;
            //this.primerTab=data[0].id;
        },async fetchExpedientes(id){
            await axios.get('/api/sg2-get-programar/'+id).then(response=>{
                console.log(response.data);
                this.for_entregar=response.data;
            });

        },async enviar_fecha(item){
            this.form.tramite_id=item.id;
            this.form.diploma_id=item.diploma;           
            this.dialogenviar=true;
            
        },
        async reprogramar(item){
            this.form.tramite_id=item.id;
            this.form.diploma_id=item.diploma;
            this.form.fecha=item.fecha_entrega;
            this.fecha_programada=item.fecha_entrega;
            this.dialogenviar=true;          
        },
        async AddEntrega(){
            //console.log(this.form);
            await this.form.post(`/api/sg2-add-fecha-entrega/`).then(response=>{
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
