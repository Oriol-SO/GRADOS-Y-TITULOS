<template>
<v-container
grid-list-md
>
<v-layout row wrap>
 <v-card xs12 sm6
    
    color="#42b883"
    dark
    max-width="400"
    max-height="400"
    v-bind="attrs"
    v-on="on"
  >
    <v-card-text>
      <line-chart :chart-data="datacollection" :height="300"   ></line-chart>
    </v-card-text>

    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Procesos del Año
      </div>
    </v-card-text>

    <v-divider></v-divider>

    
  </v-card>
  
  <v-spacer></v-spacer>

  <v-card
    class="mx-auto text-center mt-3 ml-2 mr-3"
    color="green"
    dark
    max-width="600"
  >
    <v-card-text>
      <v-sheet color="rgba(0, 0, 0, .12)">
        <v-sparkline
          :value="value"
          color="rgba(255, 255, 255, .7)"
          height="100"
          padding="24"
          stroke-linecap="round"
          smooth
        >
          <template v-slot:label="item">
            ${{ item.value }}
          </template>
        </v-sparkline>
      </v-sheet>
    </v-card-text>

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

  <v-simple-table class="mt-3 ml-2 mr-3"
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
import axios from 'axios'

export default {

  components: {
    LineChart

  },
  data(){
    return {
      datacollection: null,
      bachillerIni:[],
      bachillerIniValue:[],
      bachillerFinal:[],
      value:[],
      procesos:[],
      grados:[],
      nombregrado:[],
    }
  },
  mounted () {
    this.FetchProceso();
    this.FetchGrados();
    this.FetchBachillerIni();
    this.FetchBachillerFinal();
    this.renderChart(this.chartData, this.options)
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
      fillData ()
    {
      this.datacollection = {
        labels: ['Enero','Febrero','Marzo','Abril'],

        datasets: [
          {
            label: 'Bachiller Iniciado',
            backgroundColor: '#FF0066',
            data: [this.bachillerIniValue[0]['Iniciados'],this.bachillerIniValue[1]['Iniciados'],this.bachillerIniValue[2]['Iniciados'],this.bachillerIniValue[3]['Iniciados']]
          },
          {
            label: 'Bachiller Finalizado',
            backgroundColor: '#8467ad',
            data: [this.bachillerFinal[0]['Finalizados'],this.bachillerFinal[1]['Finalizados'],this.bachillerFinal[2]['Finalizados'],this.bachillerFinal[3]['Finalizados']]
          },
        ]
      };
    }
  }
}
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>