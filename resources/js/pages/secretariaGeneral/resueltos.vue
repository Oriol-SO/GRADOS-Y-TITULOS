<template>
  <v-container fluid>
    <v-card elevation="0">
     <v-card elevation="0">
      <v-card-title class="px-0 py-1 ml-3 text-h6">EXPEDIENTES CON RESOLUCIÓN</v-card-title>
     </v-card>
        <v-toolbar float class="mt-3" color="#E3F2FD" elevation="0"> 
            
              <v-tabs v-model="tab">
              <v-tabs-slider ></v-tabs-slider>
                <v-tab
                
               
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
                  >
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                        small
                        rounded
                        color="#45EBA5"
                        elevation="0"
                        style="color:#fff;"
                        class="text-capitalize"
                        @click="enviar_expe(item)"    
                        >  <v-icon left class="ml-1">mdi-send</v-icon> Enviar</v-btn>

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
                <v-text-field
                v-model="form.folio"
                label="Número de Folio">
                </v-text-field>                
                <v-text-field
                v-model="form.libro"
                label="Número de Libro">
                </v-text-field>
                <v-text-field
                v-model="form.registro"
                label="Número de Registro">
                </v-text-field>
                <v-btn class="mt-3 " 
                style="color:#fff;" 
                elevation="0" 
                color="#42C2FF" 
                @click="Addresolucion()">
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
            { text: 'Nombres y apellidos', value: 'per_nom',class: 'indigo darken-4 white--text' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite',class: 'indigo darken- white--text' },           
            { text: 'Fecha de inicio', value: 'fec_inicio',class: 'indigo darken-4 white--text' },
            { text: 'Consejo', value:'consejo_numero',sortable: false,class: 'indigo darken-4 white--text'},            
            { text: 'Estado', value: 'estado',class: 'indigo darken-4 white--text' },
            { text: 'Acciones', value: 'actions', sortable: false,class: 'indigo darken-4 white--text' },
            ],
            conresolucion:[],
            items:[],
            form: new Form({
                folio:'',
                libro:'',
                registro:'',
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
            this.form.folio='';
            this.form.libro='';
            this.form.registro='';
            this.form.tramite_id='';
        },
        async tipogrados(){
            const {data}= await axios.get('/api/secre-gen-grado/');
            this.items=data;
            //this.primerTab=data[0].id;
        },async fetchExpedientes(id){
            await axios.get('/api/expd_con_resolu/'+id).then(response=>{
                this.conresolucion=response.data;
            });

        },async enviar_expe(item){
            this.form.tramite_id=item.id;
            this.datos=await axios.get('/api/enviar_resolu/'+item.id);
            this.dialogenviar=true;
            
        },async Addresolucion(){
            //console.log(this.form);
            await this.form.post(`/api/enviar-datos-reso-interno/`).then(response=>{
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
