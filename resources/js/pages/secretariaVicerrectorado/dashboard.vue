<template>
        <div class="mt-5 mx-4">
        <v-card  class="pb-2">
            <v-card-title class="ma-1 " >   

                <v-row >
                    <h4 >EXPEDIENTES </h4><h4 class="ml-2 " > DE</h4><h4  class="ml-2 "> GRADUADOD </h4><h4  class="ml-2 ">POR</h4><h4  class="ml-1 "> FACULTADES</h4>

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
                    color="#FFD93D"
                    ></v-text-field> 
                    <v-spacer></v-spacer>
                </v-row>    
            </v-card-title>
        </v-card>
            <v-data-table
                :headers="headers"
                :items="expedientes"     
                :items-per-page="10"
                :search="search"
                class="elevation-1"
                id="secre_vice"
                >
                <template v-slot:item.notify="{ item }">
                    <v-chip
                    v-if="item.notificacion==true"
                    class="ma-2"
                    color="deep-purple accent-4"
                    outlined
                    >
                    <v-icon left>
                        mdi-bell-ring
                    </v-icon>
                    </v-chip>
                </template>
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
                @click=" $router.push({ path: `/secretaria-vicerrectorado/tramite/${item.id}`, }) "    
                > Ir</v-btn>

                </template>
            

            </v-data-table>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
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
        }
    },mounted(){
            this.fetchexpedientes();
    },methods:{
        async fetchexpedientes(){
            const {data}= await axios.get('/api/sv-expedientes/');
            this.expedientes=data;
            console.log(this.expedientes);
        }
    }
}
</script>
<style>
#secre_vice .v-data-table-header th[role=columnheader] {
  font-size: 14px !important;
  color:#000;
  background:#FFD93D !important;
}
</style>