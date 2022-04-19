<template>
    <div class="mt-5 mx-4">
        <v-card  elevation="0">
            <v-card-title>
                <v-toolbar flat>
                    <v-toolbar-title> EXPEDIENTES AGENDADOS</v-toolbar-title>
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
                    color="#0df0d6"
                    ></v-text-field> 
                    <v-spacer></v-spacer>   
                     <template>
                            <v-btn                        
                            color="#0df0d6" 
                            style="color:#fff;" 
                            class="text-capitalize"
                            @click="abrirAgendar()"
                            >Agendar</v-btn>
                    </template>
                    <v-dialog
                        transition="dialog-top-transition"
                        max-width="450"
                        persistent
                        v-model="dialogAgendar"
                     >                      
                        <template>
                            <v-card>
                            <v-toolbar
                                class="text-h6"
                                color="#0df0d6"
                                dark
                                elevation="0"
                            >Agendar expedientes</v-toolbar>
                            <form>
                                <v-card-text>
                                <v-text-field
                                v-model="form.numero"
                                label="Número">
                                </v-text-field>
                                <v-text-field
                                v-model="form.fecha"
                                type="date"
                                label="Fecha">
                                </v-text-field>
                                <v-btn class="mt-3 " 
                                style="color:#fff;" 
                                elevation="0" 
                                color="#42C2FF" 
                                @click="agendar()">
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
                </v-toolbar>
            </v-card-title>
        </v-card>
        <v-data-table
            :headers="headers"
            :items="expedientes"     
            :items-per-page="10"
            :search="search"           
            class="elevation-1"
            >      

        </v-data-table>

    </div>
  
</template>

<script>
import axios from 'axios';
import Form from "vform";
export default {
    data(){
        return{
            dialogAgendar:false,
            
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
    },methods:{
        close(){
            this.dialogAgendar=false;
            this.form.numero='';
            this.form.fecha=null;
        },
        async fetchexpedientes(){
            const {data}= await axios.get('/api/expd-agendados/');
            this.expedientes=data;
            console.log(this.expedientes);
        },
        abrirAgendar(){
            if(this.form.selected.length>0){
                this.dialogAgendar=true;
            }else{
                console.log('no seleecionaste nada')
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
