<template >
    <div class="mt-5 mx-4">
        <v-card  class="card-shadow mb-4 py-2">
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
                        persistent
                     >
                        <template v-slot:activator="{ on, attrs }" >
                        <v-btn
                            color="primary"
                            v-bind="attrs"
                            v-on="on"
                            
                            style="color:#fff; font-weight:650;"
                            class="text-capitalize my-2 btn-shadow"
                        >Agregar Tramite</v-btn>
                        </template>
                        <template>
                           <v-card>
                            <v-toolbar
                                color="primary"
                                dark
                            >Agrega un nuevo tramite</v-toolbar>
                            <form>
                                <v-card-text>
                                    <v-select
                                    v-model="form.grado"
                                     :items="grados"
                                    item-text='graNom'
                                    item-value='id'
                                    return-object
                                    persistent-hint
                                    label="Grado"
                                    @change="FetchProceso()"
                                    >
                                    </v-select>
                                    <div  v-if="form.grado.id==2">
                                    <v-text-field                                   
                                     v-model="form.titulo"
                                     label="Titulo de Investigación"
                                    ></v-text-field>
                                    
                                    <v-select
                                     v-model="form.integrantes"
                                     label="numero de integrantes"
                                     :items="[1,2]"
                                    ></v-select>
                                    </div>                            

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
                                    <v-btn class="mt-3 " style="color:#fff;" elevation="0" color="primary" @click="addtramite()">Guardar</v-btn> 
                                </v-card-text>                                                              
                            </form>

                            <v-card-actions>
                                <v-btn class="ml-auto"
                                    text
                                    @click="close()"
                                >cerrar</v-btn>
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
               
                id="alumno"
                >
                    <template v-slot:item.avance="{ item }">
                        <div style="min-width:120px;">
                            <v-slider
                            :value="Math. round(item.fase_actual*100/item.total_fases)"                        
                            color="#3bfb60"
                            readonly
                            :label="Math. round(item.fase_actual*100/item.total_fases)+'%'"
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
            grados:[],
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
                grado:'',
                titulo:'',
                integrantes:'',
            }),
        }
    },mounted(){
        this.fecthtramitesper();
        this.FetchGrados();
    },methods:{
        close(){
        this.dialog=false;
        this.form.grado='';
      },
        async FetchGrados(){
            const { data } = await axios.get("/api/alu-grados");
            this.grados=data;
        },
      async FetchProceso() {     
        const { data } = await axios.get("/api/alu-proceso/"+this.form.grado.id);
        this.proceso = data.tramites;

      },async addtramite(){
         // console.log(this.form);
          await this.form.post('/api/tramite/').then(response=>{
              console.log(response.data);
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
  font-size: 16px !important;
  color:#304156;
  background:#eaeff3  !important;
}

#alumno, .card-shadow {
     box-shadow: 0 7px 14px rgba(50,50,93,.1),0 3px 6px rgba(0,0,0,.08)!important;
}
.btn-shadow{
     box-shadow: 0 2px 12px -1px rgb(85 85 85 / 8%), 0 4px 12px 0 rgb(85 85 85 / 6%), 0 1px 12px 0 rgb(85 85 85 / 3%) !important;
}

 .v-data-table table tbody tr:not(.v-data-table__selected):hover {
    box-shadow: 0 3px 15px -2px rgb(0 0 0 / 12%) !important;
    transform: translateY(-4px) !important;
     background: #fff !important;
}

.v-data-table table td {
    border-bottom: 0!important;
}
</style> 
