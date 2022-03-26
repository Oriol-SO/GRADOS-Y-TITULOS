<template>
        <div class="mt-5 mx-4">
        <v-card  elevation="0">
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
                    color="#FFD93D"
                    ></v-text-field> 
                    <v-spacer></v-spacer>
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
export default {
    data(){
        return{
            headers: [
            {text: 'Facultad',align: 'start', value: 'tipo_tramite',},
            { text: 'Escuela', value: 'fec-inicio' },
            { text: 'Nombres y apellidos', value: 'modo_obtencion' },
            { text: 'fecha de inicio', value: 'fec-inicio' },
            { text: 'avance', value: '' },
            { text: 'estado', value: 'estado' },
            { text: 'Actions', value: 'actions', sortable: false },
            ],
            expedientes:[],
            search:'',
        }
    },mounted(){
            this.fetchexpedientes();
    },methods:{
        async fetchexpedientes(){
            const {data}= await axios.get('/api/expedientes/');
            this.expedientes=data;
            console.log(this.expedientes);
        }
    }
}
</script>
<style>
 thead.v-data-table-header th[role=columnheader] {
  font-size: 14px !important;
  color:#000;
  background:#FFD93D;
}
</style>
