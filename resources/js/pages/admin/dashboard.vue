<template>

    <div>
        <h1> hola </h1>

        <ul>
            <li v-for="(grado,i) in grados" :key="i"> {{grado.graNom}}</li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios'
export default {    
    data(){
        return{
            grados:[],
            procesos:[],
        }
        
    },mounted() {
        
        this.FetchProceso();
        this.FetchGrados();
    },
    methods: {
        async FetchGrados(){
        const { data } = await axios.get("/api/grado");
        this.grados = data;
        console.log(data);
      },async FetchProceso() {
        const { data } = await axios.get("/api/proceso");
        this.procesos = data;
        console.log(data);
      },
    },
}
</script>