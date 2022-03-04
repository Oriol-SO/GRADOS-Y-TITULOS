<template>
<div
style="display:flex; flex-wrap:wrap; justify-content: spacy;"
>

 <v-card
    class="mt-2 ml-4 mr-2"
    color="white"
    dark
    max-width="500"
    max-height="500"
    v-bind="attrs"
    v-on="on"
  >
    <v-card-text>
      <line-chart :chart-data="datacollection" :height="300"  ></line-chart>
    </v-card-text>

    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Sales Last 24h
      </div>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions class="justify-center">
      <v-btn
        block
        text
        color='#131313'
      >
        Go to Report
      </v-btn>
    </v-card-actions>
  </v-card>
  
  <v-spacer></v-spacer>

<v-card
    class="mt-2 ml-4 mr-2"
    color="white"
    dark
    max-width="500"
    max-height="500"
    v-bind="attrs"
    v-on="on"
  >
    <v-card-text>
      <line-chart :chart-data="datacollection" :height="300"  ></line-chart>
    </v-card-text>

    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Sales Last 24h
      </div>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions class="mt-2 ml-4 mr-2r">
      <v-btn
        block
        text
        color='#131313'
      >
        Go to Report
      </v-btn>
    </v-card-actions>
  </v-card>
  <v-spacer></v-spacer>
  <v-card
    class="mt-2 ml-4 mr-2r"
    max-width="344"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="text-overline mb-4">
          OVERLINE
        </div>
        <v-list-item-title class="text-h5 mb-1">
          Headline 5
        </v-list-item-title>
        <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
        color="grey"
      ></v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn
        outlined
        rounded
        text
      >
        Button
      </v-btn>
    </v-card-actions>
  </v-card>
 </div>

</template>

<script>

import LineChart from '~/components/LineChart.js'


export default {

  components: {
    LineChart,

  },
  data(){
    return {
      datacollection: null,

    }
  },
  mounted () {
    this.fillData();
    this.renderChart(this.chartData, this.options)
  },
  methods: {

    fillData ()
    {
      this.datacollection = {
        labels: ['Lunes','Martes','Miercoles','Jueves','Viernes', 'Sabado' , 'Domingo'],
        datasets: [
          {
            label: 'Ventas Junio',
            backgroundColor: '#FF0066',
            data: [ 20, 40, 50, 20, 50, 40,10]
          },
          {
            label: 'Ventas Agosto',
            backgroundColor: '#8467ad',
            data: [ 12, 45, 46, 45, 20, 54,15]
          },
        ]
      }
    }
  }
}
</script>

<style >

</style>