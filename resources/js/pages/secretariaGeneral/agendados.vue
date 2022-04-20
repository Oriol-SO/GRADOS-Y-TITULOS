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
            sm="12"
            md="12"
  
            class="pa-4"
          >
            <v-card >
              <v-card-title>
                Consejo Nro:{{ gruposexpediente.resolucion_numero }}
                <v-btn color="primary" class="ml-auto" @click="enviar(gruposexpediente.resolucion)">Enviar</v-btn>
              </v-card-title>
              
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
                <v-text-field
                v-model="form.consejo"            
                label="número de consejo">
                </v-text-field>                
                <v-text-field
                v-model="form.fecha"
                type="date"
                label="Fecha de consejo">
                </v-text-field>

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
            itemsPerPage: 4,
            dialogenviar:false,
            expedientes:[],
            gruposexpedientes:[],
  
            expedientes:[],
            search:'',

            form: new Form({
               // selected: [],
                resolucion:'',
                numero:'',
                consejo:'',
                fecha:'',
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
            this.form.resolucion='';
            this.form.fecha=null;
        },async grupoexpedientes(){
            const {data}= await axios.get('/api/sg1-resoluciones/');
            this.gruposexpedientes=data;
            console.log("grupo",this.gruposexpedientes);
        },enviar(id_reso){
            console.log(id_reso);
            this.form.resolucion=id_reso;
            this.dialogenviar=true;
            
        },
        async aprobar(){
            //console.log(this.form)
            await this.form.post(`/api/aprobar-consejo/`).then(response=>{
                console.log(response.data)  
                this.close();
                this.gruposexpedientes();
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
