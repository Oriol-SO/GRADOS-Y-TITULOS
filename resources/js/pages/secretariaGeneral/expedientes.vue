<template>
    <div class="mt-5 mx-4">
        <v-card id="toolbar">
            <v-card-title>
                <v-toolbar flat>
                    <v-toolbar-title> AGENDAR EXPEDIENTES</v-toolbar-title>
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
                    color="primary"
                    ></v-text-field> 
                    <v-spacer></v-spacer>   
                     <template>
                            <v-btn  
                                                 
                            color="rgb(45, 206, 137)"
                            style="color:#fff; font-weight: 600;" 
                            class="text-capitalize btn-shadow"
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
            :single-select="singleSelect"
            :search="search"
            show-select
            id="expedientes"
            
            v-model="form.selected"
           
            >
            <template v-slot:top>
                <v-switch
                    v-model="singleSelect"
                    label="seleccion individual"
                    class="pa-3"
                    
                ></v-switch>
            </template>
            <template v-slot:item.actions="{ item }">
            <v-btn
            small
            rounded
            color="#45EBA5"
            elevation="0"
            style="color:#fff;"
            class="text-capitalize"
            @click=" $router.push({ path: `/secretaria-general1/tramite/${item.id}`, }) "    
            > ver</v-btn>

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
            dialogAgendar:false,
            singleSelect: true,
            
            headers: [
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite' },           
            { text: 'fecha de inicio', value: 'fec_inicio' },
            { text: 'avance', value:'avance',sortable: false},            
            { text: 'estado', value: 'estado' },
             { text: '', value:'notify',sortable: false},
            { text: 'Actions', value: 'actions', sortable: false },
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
            const {data}= await axios.get('/api/sg1-expedientes/');
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
            console.log(this.form)
            await this.form.post(`/api/agendarExpediente`).then(response=>{
                console.log(response.data)
                this.fetchexpedientes();
                this.close();
            });
        },
    }
}
</script>
<style>
 #expedientes .v-data-table-header th[role=columnheader] {
  font-size: 16px !important;
  color:#304156;
  background-color:rgb(231 235 243) !important; 
 }

#expedientes ,#toolbar {
 -webkit-box-shadow: 0 2px 12px -1px rgb(85 85 85 / 8%), 0 4px 12px 0 rgb(85 85 85 / 6%), 0 1px 12px 0 rgb(85 85 85 / 3%);
 box-shadow: 0 2px 12px -1px rgb(85 85 85 / 8%), 0 4px 12px 0 rgb(85 85 85 / 6%), 0 1px 12px 0 rgb(85 85 85 / 3%);
-moz-box-shadow:0 2px 12px -1px rgb(85 85 85 / 8%), 0 4px 12px 0 rgb(85 85 85 / 6%), 0 1px 12px 0 rgb(85 85 85 / 3%);
/*-moz-box-shadow: 0px 2px 15px -4px rgb(0 0 0 / 15%);*/

}

.btn-shadow{
  box-shadow: 0 7px 14px rgba(50,50,93,.1),0 3px 6px rgba(0,0,0,.08)!important;
}
</style>

