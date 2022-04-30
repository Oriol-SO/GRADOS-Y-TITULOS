<template>
  <v-container fluid>
    <v-data-iterator
      :items="gruposexpedientes"
      :items-per-page.sync="itemsPerPage"
      hide-default-footer
    >
      <template v-slot:header>
        <v-toolbar
          class="mb-2 rounded"
          flat
          color="#2B5683"
        >
          <v-toolbar-title class="white--text " >EXPEDIENTES AGENDADOS</v-toolbar-title>
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
              <td></td> 
              </tfoot>
              </div>
              </v-row>
                <v-btn color="#5bc0de " class="ml-auto white--text" @click="enviar(gruposexpediente.consejo)">Enviar</v-btn>
              </v-card-title>
              
              <v-divider></v-divider>
                
                  <v-card>
                 <v-data-table
                   :headers="headers"
                   :items="gruposexpediente.tramite"
                   hide-default-footer
                   id="color_table"
                 ></v-data-table>

              </v-card>
            </v-card>
          </v-spacer>
       
      </template>
    </v-data-iterator>

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
            >Aprobación</v-toolbar>
            <form>
                <v-card-text>
                <v-text-field
                v-model="form.numero"
                label="Número de oficio">
                </v-text-field>
                <!--v-text-field
                v-model="form.consejo"            
                label="Número de consejo">
                </v-text-field>                
                <v-text-field
                v-model="form.fecha"
                type="date"
                label="Fecha de consejo">
                </v-text-field-->

                <v-btn class="mt-3 " 
                style="color:#fff;" 
                elevation="0" 
                color="#42C2FF" 
                @click="aprobar()">
                Guardar</v-btn> 
                </v-card-text>                                                              
            </form>

            <v-card-actions>
                <v-btn class="ml-auto"
                    text
                    @click="close()"
                >Cerrar</v-btn>
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
          headers: [
          {
            text: 'nombre',
            align: 'start',
            filterable: false,
            value: 'per_nom' ,
          },
          { text: 'Tramite', value: 'tramite'},
          { text: 'Fecha de inicio', value: 'fec_inicio'},
          { text: 'Estado', value: 'estado'},
        ],

            id_consejo:null,
            itemsPerPage: 4,
            dialogenviar:false,
            gruposexpedientes:[],
            search:'',
            form: new Form({
               // selected: [],
                numero:'',
            })
        }
    },mounted(){
           // this.fetchexpedientes();
            this.grupoexpedientes();
    },methods:{
        close(){
            this.dialogenviar=false;
            this.form.numero='';
            this.form.consejo='';
            this.form.fecha=null;
        },async grupoexpedientes(){
            const {data}= await axios.get('/api/sg1-resoluciones/');
            this.gruposexpedientes=data;  
            console.log("grupo",this.gruposexpedientes);
        },enviar(id_cose){
            console.log(id_cose); 
            this.id_consejo=id_cose;
            console.log("fecha",this.form.fecha);
            this.dialogenviar=true;
           
        },
        async aprobar(){
            //console.log(this.form)
            //aprobar
            await this.form.post(`/api/aprobar-consejo/`+this.id_consejo).then(response=>{
                console.log(response.data);  
                this.close();
                this.grupoexpedientes();
            });
        },
    }
}
</script>
<style>
 #color_table .v-data-table-header th[role=columnheader] {
  font-size: 14px !important;
  color:white;
  background-color: #337ab7 !important;
}
</style>
