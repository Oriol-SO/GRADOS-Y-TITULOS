<template>
  <v-container
    grid-list-md
  >
<v-layout row wrap>
 <v-card xs12 sm4 class="mt-3 ml-2 mr-3"
    color="#42b883"
    dark

  >
    
      <bar-chart :chart-data="datacollection" ></bar-chart>
    

    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Procesos del Año
      </div>
    </v-card-text>

    <v-divider></v-divider>

    
  </v-card>
  
    <v-spacer></v-spacer>

  <v-card 
    class=" mt-3 ml-2 mr-3"
    xs12 sm4
    color="green"
    dark

  >
    
    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Procesos Iniciados 24h
      </div>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions class="justify-center">
      <v-btn
        block
        text
      >
        Go to Report
      </v-btn>
    </v-card-actions>
  </v-card>

  <v-spacer></v-spacer>

  <v-simple-table xs12 sm4 class="mt-3 ml-2 mr-3"
  dark
  fixed-header
  height="400px">
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left text-h6"
          >
            Proceso
          </th>
          <th class="text-left text-h6">
            Días Promedio
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(proceso,i) in procesos"
          :key="i"
        >
          <td>{{proceso.nombre}}</td>
           <td>{{Math.floor(Math.random() * 40)}} días</td>
        </tr>
        </tbody>
     </template>
    </v-simple-table>

  </v-layout>

 </v-container>

</template>

<script>

import LineChart from '~/components/LineChart.js';
import DoughnutChart from '~/components/DoughnutChart.js';
import BarChart from '~/components/BarChart.js';
import axios from 'axios'

export default {

  components: {
    LineChart,
    DoughnutChart,
    BarChart,
  },
  data(){
    return {
      datacollection: null,
      bachillerIni:[],
      bachillerIniValue:[],
      bachillerFinal:[],
      procesos:[],
      grados:[],
    }
  },
  mounted () {
    this.FetchProceso();
    this.FetchGrados();
    this.FetchBachillerIni();
    this.FetchBachillerFinal();
  },
  methods: {
      async FetchProceso() {
        const { data } = await axios.get("/api/proceso");
        this.procesos = data.tramites;

      },
      async FetchGrados(){
        const { data } = await axios.get("/api/grado");

        this.grados = data;


      },async FetchBachillerIni() {
        const { data } = await axios.get("/api/bachillerIni");
        this.bachillerIni = data.Mes;
        this.bachillerIniValue =data.Valor;
        
        this.fillData ();
        // console.log([this.bachillerIni[0]['Mes'],this.bachillerIni[1]['Mes'],this.bachillerIni[2]['Mes'],this.bachillerIni[3]['Mes']]);
        // console.log(this.bachillerIniValue[0]['Iniciados']);
        
      },async FetchBachillerFinal() {
        const { data } = await axios.get("/api/bachillerFinal");
        this.bachillerFinal = data;
        this.fillData ();
        // console.log(this.bachillerFinal[0]['Finalizados'],this.bachillerFinal[1]['Finalizados'],this.bachillerFinal[2]['Finalizados'],this.bachillerFinal[3]['Finalizados']);
      },
      porFacultad() {
      return {
        labels: this.stats.tramites_por_facultad.map(
          ({ facultad }) => facultad
        ),
        data: this.stats.tramites_por_facultad.map(({ cant }) => cant),
      };
    },
      fillData ()
    {   var valoresIni=[];
        var valoresMes=[];
        var valoresFinal=[];
        for(var i=0;i<  this.bachillerIniValue.length;i++){
         valoresIni.push(this.bachillerIniValue[i]['Iniciados']);
         valoresMes.push(this.bachillerIni[i]['Mes']);
         
          };
        for(var i=0;i<  this.bachillerFinal.length;i++){
         valoresFinal.push(this.bachillerFinal[i]['Finalizados']);
        };
        this.datacollection = {
        axis: 'y',
        labels: valoresMes,
        

        datasets: [
          {
            label: 'Bachiller Iniciado',
            backgroundColor: '#FF0066',
            data: valoresIni,
            
          },
          {
            label: 'Bachiller Finalizados',
            backgroundColor: '##0e75e0',
            data: valoresFinal,
            
          },
          
        ]
      };
    }
  }
}
</script>

<style lang="css">
.small {
  max-width: 300px;
  max-height: 300px; 
  margin:  30px auto;
}
</style>

