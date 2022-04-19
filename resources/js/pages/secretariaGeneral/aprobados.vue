<template>
  <v-container fluid>
    <v-data-iterator
      :items="resoluciones"
      :items-per-page.sync="itemsPerPage"
    >
      <template v-slot:header>
        <v-toolbar
          class="mb-2"
          flat
        >
          <v-toolbar-title class="text-h6">EXPEDIENTES APROVADOS</v-toolbar-title>
        </v-toolbar>
      </template>

      <template v-slot:default="props">
        <v-row>
          <v-col
            v-for="resolucion in props.resoluciones"
            :key="resolucion.id"
            cols="12"
            sm="12"
            md="12"          
          >
            <v-card>
              <template>
                <v-data-table
                  :headers="headers"
                  :items="tramites_por_resolucion"                 
                  hide-default-footer
                  class="elevation-1"
                ></v-data-table>
              </template>
            </v-card>
          </v-col>
        </v-row>
      </template>

    </v-data-iterator>
  </v-container>
</template>

<script>
import axios from 'axios';
  export default {
    data(){
      return{
          itemsPerPage: 4,
         headers: [
            { text: 'Nombres y apellidos', value: 'per_nom' },
            //{text: 'Facultad',align: 'start', value: '',},
            { text: 'Tramite', value: 'tramite_nombre' },           
            { text: 'fecha de inicio', value: 'fec_inicio' },
            { text: 'avance', value:'avance',sortable: false},            
            { text: 'estado', value: 'estado' },
            ],
        items: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            sodium: 87,
            calcium: '14%',
            iron: '1%',
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            sodium: 129,
            calcium: '8%',
            iron: '1%',
          },
          {
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            sodium: 337,
            calcium: '6%',
            iron: '7%',
          },
          {
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            sodium: 413,
            calcium: '3%',
            iron: '8%',
          },
        ],
        resoluciones:[],
        tramites_por_resolucion:[],
      }

    },
    mounted(){
      this.fetchAgendados();
    },
    methods:{
      async fetchAgendados(){
       // console.log('hola');
         await axios.get('/api/sg1-resoluciones/').then(response=>{
             console.log(response.data);
             this.resoluciones=response.data.resolucion_grupo;
             this.tramites_por_resolucion=response.data.tramites_por_grupo;
             console.log(this.tramites_por_resolucion)
         }).catch(error=>{
          if(error.response.status === 422){
                const errores=error.response.data.errors;
                console.log(errores);               
              }
          });
      }
    },
  }
</script>