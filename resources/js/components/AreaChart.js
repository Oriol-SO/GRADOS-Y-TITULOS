
import { Bar,mixins } from "vue-chartjs";
export default {
  extends: Bar,
  data: () => ({
    gradients: [],
    colors: [
      "#053767",//
      "#054B67",
      "#055867",
      "#05675C",
      "0F8000",
      "#488000",
      "#805E00",
      "#008063",//
      "#800002",
      "#A4494A",//
      "#053767",//
      "#054B67",
      "#055867",
      "#05675C",
      "0F8000",
      "#488000",
      "#805E00",
      "#008063",//
      "#800002",
      "#A4494A",//
    ]
  }),
  props: ["data", "options"],
  mounted() {
    [0, 1, 2].forEach((element, i) => {
      this.gradients[i] = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
    });



    this.renderChart({
      datasets: this.data.datasets.map((dataset, i) => ({
        borderColor: this.colors[i],
        pointBackgroundColor: this.colors[i],
        borderWidth: 1,
        pointBorderColor: this.colors[i],
        backgroundColor: this.colors[i],
        ...dataset
      })),
      labels: this.data.labels
    }, { responsive: true, maintainAspectRatio: false });
  },
};