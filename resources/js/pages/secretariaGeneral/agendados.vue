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
          color="rgb(13, 240, 214)"
          dark
          flat
          text-color="rgb(0, 0, 0, 0.87)"
        >
          <v-toolbar-title class="black--text ">EXPEDIENTES AGENDADOS</v-toolbar-title>
        </v-toolbar>
      </template>
      <template >
        <v-row>
          <v-spacer
            v-for="gruposexpediente in gruposexpedientes"
            :key="gruposexpediente.id"
            cols="12"
            sm="6"
            md="4"
            lg="3"
            class="pa-4"
          >
            <v-card >
              <v-card-title >
                Resolucion Numero:{{ gruposexpediente.resolucion_numero }}
              </v-card-title>
              <v-btn>Enviar</v-btn>
              <v-divider></v-divider>

              <v-list dense>
                
                <v-simple-table
                :items-per-page="2">
                    <template v-slot:default>
                    <thead>
                        <tr>
                        <th class="text-left text-h6" >
                            Nombre
                        </th>
                        <th class="text-left text-h6">
                            Tramite
                        </th>
                        <th class="text-left text-h6">
                            Fecha de inicio
                        </th>
                        <th class="text-left text-h6">
                            Estado
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(tramite,i) in gruposexpediente.tramite"
                        :key="i"
                        >
                        <td>{{ tramite.per_nom }}</td>
                        <td>{{ tramite.tramite }}</td>
                        <td>{{ tramite.fec_inicio }}</td>
                        <td>{{ tramite.estado }}</td>
                        </tr>
                    </tbody>
                    </template>
                </v-simple-table>
              </v-list>
              <tfoot>
              <td colspan="4" class="pl-4 #515252--text text-md-body-1 text-right">
              <em> Fecha de Resolucion: {{ gruposexpediente.resolucion_fecha }}</em></td>
              <td></td>
              </tfoot>
            </v-card>
          </v-spacer>
        </v-row>
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
            itemsPerPage: 4,
            dialogAgendar:false,
            expedientes:[],
            gruposexpedientes:[],
            headers: [
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite' },           
            { text: 'fecha de inicio', value: 'fec_inicio' },
            { text: 'avance', value:'avance',sortable: false},            
            { text: 'estado', value: 'estado' },
            ],
            expedientes:[],
            search:'',

            form: new Form({
                selected: [],
                numero:'',
                fecha:'',
            })
        }
    },mounted(){
            this.fetchexpedientes();
            this.grupoexpedientes();
    },methods:{
        close(){
            this.dialogAgendar=false;
            this.form.numero='';
            this.form.fecha=null;
        },async grupoexpedientes(){
            const {data}= await axios.get('/api/sg1-resoluciones/');
            this.gruposexpedientes=data;
            console.log("grupo",this.gruposexpedientes);
        },async fetchexpedientes(){
            const {data}= await axios.get('/api/expd-agendados/');
            this.expedientes=data;
            console.log(this.expedientes);
        },
        abrirAgendar(){
            
            if(this.form.selected.length>0){
                this.dialogAgendar=true;

            }else{
                console.log('no seleccionaste nada')
            }
        },
        async agendar(){
            //console.log(this.form)
            await this.form.post(`/api/agendarExpediente/`).then(response=>{
                console.log(response.data)  
            });
        },
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
