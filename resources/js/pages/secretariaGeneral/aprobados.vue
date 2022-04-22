<template>
  <v-container fluid>
  <v-tabs
        v-model="tab"
          align-with-title
        >
          <v-tabs-slider color="yellow"></v-tabs-slider>

          <v-tab
            v-for="grado in grados"
            :key="grado.id"
          >
            {{ grado.graNom }}
          </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
        <v-tab-item
        v-for="grado in grados"
        :key="grado.id"
        >
        <v-card flat>
          <v-data-iterator
      :items="aprobados"
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
          <v-toolbar-title class="black--text ">EXPEDIENTES APROBADOS</v-toolbar-title>
        </v-toolbar>
      </template>
      <template >
        <v-row>
          <v-spacer
            v-for="aprobado in aprobados"
            :key="aprobado.id"
            
            cols="12"
            sm="12"
            md="12"
  
            class="pa-4"
          >
            <v-card >
              <v-card-title>
                Consejo Nro:{{ aprobado.consejo_id }}
                <v-btn color="primary" class="ml-auto" >N° Resolucion</v-btn>
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
                        v-for="(tramite,i) in aprobado.tramite"
                        :key="i"
                        v-if="grado.id==tramite.grado"
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
              <em> Fecha de Resolucion: {{ aprobado.consejo_fecha }}</em></td>
              <td></td>
              </tfoot>
            </v-card>
          </v-spacer>
        </v-row>
      </template>
    </v-data-iterator>
        </v-card>
      </v-tab-item>
     </v-tabs-items>
    

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
            dialogAgendar:false,
            singleSelect: true,
            tab: null,
            headers: [
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite' },           
            { text: 'Fecha de inicio', value: 'fec_inicio' },
            { text: 'Consejo id', value:'consejo_id',sortable: false},            
            { text: 'Estado', value: 'estado' },
            ],
            aprobados:[],
            grados:[],
            search:'',

            form: new Form({
                selected: [],
                numero:'',
                fecha:'',
            })
        }
    },mounted(){
            this.aprobexpedientes();
            this.tipogrados();
    },methods:{
        close(){
            this.dialogAgendar=false;
            this.form.numero='';
            this.form.fecha=null;
        },
        async tipogrados(){
            const {data}= await axios.get('/api/grado/');
            this.grados=data;
            console.log("grados",this.grados);
        },
        async aprobexpedientes(){
            const {data}= await axios.get('/api/expd_aprobados/');
            this.aprobados=data;
            console.log("aprobados",this.aprobados);
        },
        abrirAgendar(){
            if(this.form.selected.length>0){
                this.dialogAgendar=true;
            }else{
                console.log('no seleccionaste nada')
            }
        },
        async agendar(){
            console.log(this.form)
            await this.form.post(`/api/agendarExpediente/`).then(response=>{
                console.log(response.data)
                this.fetchexpedientes();
                this.close();
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
