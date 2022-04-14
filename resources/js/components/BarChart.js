
import { Bar,mixins } from 'vue-chartjs'
const { reactiveProp } = mixins
export default {
  extends: Bar,
  mixins: [reactiveProp],
  props: ['options'],
  options: {
    indexAxis: 'y',
    },
    mounted () {
      this.renderChart(this.chartData, this.options)
    }
  }
