<template>
  <v-container fluid>
      <template >
        <v-toolbar
          class="mb-2 rounded"
          flat
          color="#2B5683"
        >
          <v-toolbar-title class="white--text " >EXPEDIENTES APROBADOS</v-toolbar-title>
          <v-spacer></v-spacer> 
            <v-btn class="text-capitalize" color="primary" @click="abrirReso()">Nro Resolución</v-btn>
       </v-toolbar>
     </template>
    <v-card elevation="0">
        <v-toolbar float class="mt-3" color=" blue lighten-3" elevation="0">
            
              <v-tabs v-model="tab">
              <v-tabs-slider color="primary"></v-tabs-slider>
                <v-tab
                  style="color:#000;"
                  v-for="item in items"
                  :key="item.id"
               active-class="#E3F2FD"
                >
                  {{ item.graNom }}
                </v-tab>
              </v-tabs>        
            
        </v-toolbar>         

            <v-tabs-items v-model="tab" >
              <v-tab-item
                v-for="item in items"
                :key="item.id"
              >
                <v-card elevation="0" color="red" >
                
                  <v-data-table
                    :headers="headers"
                    :items="aprobados" 
                    :items-per-page="10"
                    :single-select="singleSelect"
                     v-model="form.selected"
                    show-select
                    class="elevation-1"
                    id="color_table"
                  >
                     <template v-slot:top>
                        <v-switch
                            v-model="singleSelect"
                            label="seleccion individual"
                            class="pa-3"
                            
                        ></v-switch>
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
            >Resolución</v-toolbar>
            <form>
                <v-card-text>
                <v-text-field
                v-model="form.numero"
                label="Número de Resolucion">
                </v-text-field>                
                <v-text-field
                v-model="form.fecha"
                type="date"
                label="Fecha de Resolucion">
                </v-text-field>

                <v-btn class="mt-3 " 
                style="color:#fff;" 
                elevation="0" 
                color="#42C2FF" 
                @click="Addresolucion()">
                Guardar</v-btn> 
                </v-card-text>                                                              
            </form>

            <v-card-actions>
                <v-btn class="ml-auto"
                    text
                    @click  ="close()"
                >Close</v-btn>
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
          singleSelect: true,
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
            ],
            aprobados:[],
            items:[],
            search:'',

            form: new Form({
                selected: [],
                numero:'',
                fecha:'',
                //consejo:'',
            }),
            primerTab:0,

        }
    },mounted(){
            this.fetchExpedientes(this.primerTab);
            this.tipogrados();
    },methods:{
        close(){
            this.dialogenviar=false;
            //this.dialogAgendar=false;
            this.form.numero='';
            this.form.fecha=null;
            this.form.selected=[];
        },
        async tipogrados(){
            const {data}= await axios.get('/api/secre-gen-grado/');
            this.items=data;
            //this.primerTab=data[0].id;
        },
        async fetchExpedientes(id){
            await axios.get('/api/expd_aprobados/'+id).then(response=>{
                this.aprobados=response.data;
                console.log("aprobados",this.aprobados);
            });

        },
        abrirReso(){  
            if(this.form.selected.length>0){
                this.dialogenviar=true; 
            }else{
                console.log('no seleccionaste nada')
            }
        },
        async Addresolucion(){
            //console.log(this.form)
            await this.form.post(`/api/aprobar-resolucion`).then(response=>{
                console.log(response.data)  
                this.close();
                this.fetchExpedientes(this.primerTab); 
            });


        },
    }
}
</script>
