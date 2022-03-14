import Vue from 'vue'
import Child from './Child.vue'
import { HasError, AlertError, AlertSuccess } from 'vform/components/bootstrap5'
import LineChart from '~/components/LineChart.js'
import DoughnutChart from '~/components/DoughnutChart.js'
export { LineChart, DoughnutChart }
// Components that are registered globaly.
[
  Child,
  HasError,
  AlertError,
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
})
