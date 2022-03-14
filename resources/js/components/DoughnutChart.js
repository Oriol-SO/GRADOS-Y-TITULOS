
import { Doughnut, mixins } from "vue-chartjs";

export default {
  extends: Doughnut,

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
    /*[0, 1, 2].forEach((element, i) => {
      this.gradients[i] = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
    });*/
 //  this.gradients[0].addColorStop(1, "rgba(3, 105, 161, 0r])");

    this.renderChart({
      labels: this.data.labels,
      datasets: [{
        data: this.data.data,
        backgroundColor: this.data.data.map((d,i)=>`${this.colors[i]}`),
      }],
    }, { responsive: true, maintainAspectRatio: false });
  },
};
