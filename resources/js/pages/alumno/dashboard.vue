<template >
    <div class="mt-5 mx-4">
        <v-card  >
            <v-card-title class="ma-1">
                <v-row >
                    <v-toolbar-title class="my-2"> TUS TRAMITES</v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    
                    <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Buscar"
                    single-line
                    hide-details
                    color="#42C2FF"
                    ></v-text-field> 
                    <v-spacer></v-spacer>
                    <v-dialog
                        transition="dialog-top-transition"
                        max-width="450"
                        v-model="dialog"
                     >
                        <template v-slot:activator="{ on, attrs }" >
                        <v-btn
                            color="#42C2FF"
                            v-bind="attrs"
                            v-on="on"
                            style="color:#fff;"
                            class="text-capitalize; my-2"
                        >Agregar Tramite</v-btn>
                        </template>
                        <template>
                           <v-card>
                            <v-toolbar
                                color="#42C2FF"
                                dark
                            >Agrega un nuevo tramite</v-toolbar>
                            <form>
                                <v-card-text>
                                 <v-select 
                                v-model="form.tipotramite" 
                                :hint="`${form.tipotramite.nombre}`" 
                                :items="proceso"
                                item-text='nombre'
                                item-value='id'
                                return-object
                                persistent-hint
                                label="Tramite" 
                                color="#42C2FF"
                                ></v-select>
                                <v-btn class="mt-3 " style="color:#fff;" elevation="0" color="#42C2FF" @click="addtramite()">Guardar</v-btn> 
                                </v-card-text>                                                              
                            </form>

                            <v-card-actions>
                                <v-btn class="ml-auto"
                                    text
                                    @click="close()"
                                >Close</v-btn>
                            </v-card-actions>
                           </v-card>
                        </template>
                    </v-dialog>
                    </v-row>
            </v-card-title>
        </v-card>
            <v-data-table 
                :headers="headers"
                :items="tramitesuser"     
                :items-per-page="10"
                :search="search"
                class="elevation-1"
                id="alumno"
                >
                    <template v-slot:item.avance="{ item }">
                        <div style="min-width:120px;">
                            <v-slider
                            :value="Math. round(item.requisitos_aprovados*100/item.total_requisitos)"                        
                            color="#3bfb60"
                            readonly
                            :label="Math. round(item.requisitos_aprovados*100/item.total_requisitos )+'%'"
                            ></v-slider>
                        </div>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                        small
                        rounded
                        color="#45EBA5"
                        elevation="0"
                        style="color:#fff;"
                        class="text-capitalize"
                        @click=" $router.push({ path: `/alumno/tramite/${item.id}`, }) "    
                        > Abrir</v-btn>

                    </template>                

            </v-data-table>
    </div>
</template>
<script>
import axios from 'axios';
import Form from "vform";
export default {
    data(){
        return{
            search:'',
            dialog:false,
            proceso:[],
            tramitesuser:[],
            headers: [
            {
                text: 'Tramite',
                align: 'start',
                sortable: false,
                value: 'tipo_tramite',
            
            },
            { text: 'Fecha', value: 'fec_inicio' },
            { text: 'Modalidad', value: 'modo_obtencion' },
            //{ text: 'telefono', value: 'numcel' },
            { text: 'Avance', value: 'avance',sortable:false },
            { text: 'Actions', value: 'actions', sortable: false },
            ],
           
            form :new Form({
                tipotramite:'',
            }),
        }
    },mounted(){
        this.fecthtramitesper();
        this.FetchProceso();
    },methods:{
        close(){
        this.dialog=false;
      },async FetchProceso() {
        const { data } = await axios.get("/api/alu-proceso");
        this.proceso = data.tramites;

        //console.log(data);
      },async addtramite(){
          console.log(this.form);
          await this.form.post('/api/tramite/').then(response=>{
              //console.log(response.data);
                this.fecthtramitesper();
                this.close();
          })
      }, async fecthtramitesper(){
         await axios.get("/api/tramite/").then(
             response=>{
                this.tramitesuser = response.data;

                //console.log(this.tramitesuser[0].tipo_tramite);
             });



      }
    }
}
</script>
<style>
 #alumno .v-data-table-header th[role=columnheader] {
  font-size: 14px !important;
  color:#000;
  background:#42C2FF !important;
}
</style> 