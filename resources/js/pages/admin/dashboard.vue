<template>
  <v-container

  >
<v-layout row wrap>
 <v-card  class="mt-3 ml-2 mr-3"
    
  >
    <v-card-text>
      <bar-chart :chart-data="datacollection" ></bar-chart>
    </v-card-text>
    
    <v-divider></v-divider>
    <v-card-text class="text-h4 font-weight-thin">
        Procesos del Año
    </v-card-text>

  </v-card>
  
    <v-spacer></v-spacer>

  <v-card 
    class=" mt-3 ml-2 mr-3"

    color="white"

  >
    <v-card-text>
      <doughnut-chart :data="porFacultad"></doughnut-chart>
    </v-card-text>
    <v-divider></v-divider>

    <v-card-text class="text-h4 font-weight-thin">
        Bachilleres iniciados
      </v-btn>
    </v-card-text>
  </v-card>
  <v-spacer></v-spacer>

  <v-card 
    class=" mt-3 ml-2 mr-3"
    color="white"

  >
    <v-card-text>
      <area-chart :data="porFacultadx" :options="yearsOptions"></area-chart>
    </v-card-text>
    <v-divider></v-divider>

    <v-card-text class="text-h4 font-weight-thin">
        Bachilleres iniciados
      </v-btn>
    </v-card-text>
  </v-card>
  <v-spacer></v-spacer>

  <v-simple-table  class="mt-3 ml-2 mr-3"
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
import AreaChart from '~/components/AreaChart.js';
import axios from 'axios'

export default {

  components: {
    LineChart,
    DoughnutChart,
    BarChart,
    AreaChart,
  },
  data(){
    return {
      yearsOptions: {
      hoverBorderWidth: 20,
      },
      datacollection: null,
      bachillerIni:null,
      bachillerIniValue:null,
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
  },methods: {
      async FetchProceso() {
        const { data } = await axios.get("/api/proceso");
        this.procesos = data.tramites;

      },
      async FetchProceso() {
        const { data } = await axios.get("/api/pdf");
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
      
      fillData ()
    {   
      var valoresIni=[];
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
  },computed: {
    porFacultad() {

      var valoresInix=[];
        var valoresMesx=[];
        var valoresFinalx=[];
        for(var i=0;i<this.bachillerIniValue.length;i++){
         valoresInix.push(this.bachillerIniValue[i]['Iniciados']);
         valoresMesx.push(this.bachillerIni[i]['Mes']);
         
          };
        for(var i=0;i<this.bachillerFinal.length;i++){
         valoresFinalx.push(this.bachillerFinal[i]['Finalizados']);
        };
      return {
        labels: valoresMesx,
        data: valoresInix,
      };
    },
    porFacultadx() {
        let datasets = [];
        var valoresInix=[];
        var valoresMesx=[];
        var valoresFinalx=[];
        for(var i=0;i<  this.bachillerIniValue.length;i++){
         valoresInix.push(this.bachillerIniValue[i]['Iniciados']);
         valoresMesx.push(this.bachillerIni[i]['Mes']);
         
          };
        for(var i=0;i< valoresMesx.length;i++){
        datasets.push({
          
        label:valoresMesx[i],
        data:[12,43,54,76,4,32,54,56,76,54,76,87],
         });
        };
      return {
        labels:valoresMesx,
        datasets:datasets,
        };
    },
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

