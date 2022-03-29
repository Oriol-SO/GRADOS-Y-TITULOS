

<template>

<div>
  <div> 
          
      <v-col cols="auto">
      <v-dialog
        transition="dialog-top-transition"
        max-width="600"
        v-model="dialog"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="#2cdd9b" class="ml-10 mt-5"
            style="color:#fff;"
            v-bind="attrs"
            v-on="on"
          >Agregar Tramite</v-btn>
        </template>
        <template >
          <v-card>
            <v-toolbar
              color="#2cdd9b"
              dark
            >Agregar Nuevo tramite</v-toolbar>
            <v-card-text>

             <form>
                  <v-text-field
                    v-model="form.nombre"
                    label="Nombre"
                    required
                  ></v-text-field>
                   <div v-if="errores.nombre">
                      <v-alert  dense outlined type="error" >
                        {{errores.nombre[0]}}
                      </v-alert>
                   </div>
                   <v-select
                    v-model="form.grado"                  
                    :items="grados"
                    item-text='graNom'
                    item-value='id'
                    label="grado"
                    persistent-hint
                    return-object
                    single-line
               
                  ></v-select>
                      <div v-if="errores.grado">
                        <v-alert   dense outlined type="error" >
                           {{errores.grado[0]}}
                        </v-alert>
                      </div>
                  <v-select
                    v-model="form.modalidad"                  
                    :items="modalidades"
                    item-text='modNombre'
                    item-value='id'
                    label="Modalidad"
                    persistent-hint
                    return-object
                    single-line
                   
                  ></v-select>
                       <div v-if="errores.modalidad">
                            <v-alert   dense outlined type="error" >
                               {{errores.modalidad[0]}}
                            </v-alert>
                        </div>  
                    <v-btn
                      class="mr-4"
                      color="#2cdd9b"
                      @click="enviar"
                      style="color:#fff;"
                    >
                      submit
                    </v-btn>
                    <v-btn @click="clear" color="#000"  style="color:#fff;">
                      clear
                    </v-btn>
             </form>

            



            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                @click="dialog=false,clear()"
               
              >Close</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </v-col>

  </div>
 <div 
  style="display:flex; flex-wrap:wrap; justify-content: space-evenly;"
 >
 
      <v-alert v-for="(proceso,i) in procesos" :key="i"
    class="mt-5 mb-5 ml-1 mr-1  "    
    width="420"  
    border="top"
    colored-border
    color="rgb(44, 221, 155)"
    
  >
  
    <v-card-text >     
      <p class="text-h6 " style="color:#000; ">
        {{proceso.nombre}}
      </p>
        <div class="text--primary "  >
        Fases :<strong>{{proceso.cantidad_fases}}</strong> <br/>
        Requisitos :<strong>{{proceso.cantidad_requisitos}}</strong>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn  
        color="blue lighten-5"
        style="color:#2196f3;"
        rounded
        elevation="0"
        class="text-capitalize"
        @click=" $router.push({ path: `/admin/tramite/${proceso.id}`, }) "     
      >
        Abrir
      </v-btn>

      <v-switch
      class="ml-2"
      v-model="switch1"
      inset

      color="success"
      @click="cambiarEstado(proceso.id)"
    ></v-switch>
    </v-card-actions>
  </v-alert>
   

 
 </div>
</div>
</template>

<script>
import axios from 'axios'
import Form from "vform";
   export default {
    data () {
       
      return {  
          switch1: [],
          grados:[],
          procesos:[],         
          modalidades:[],
          dialog:false,
          errores:{},
        form: new Form({
            nombre:'',
            grado:'',
            modalidad:'',
            tipo:'1',
          }),
          
      }
    },
      mounted(){
      this.FetchProceso();
      this.FetchGrados();
      this.FetchModalidad();
    }, 
    
    methods:{
      async FetchProceso() {
        const { data } = await axios.get("/api/proceso");
        this.procesos = data.tramites;

        console.log("procesos",data);
      },async FetchGrados(){
        const { data } = await axios.get("/api/grado");
        this.grados = data;

        console.log(data);
      },async FetchModalidad(){
        const { data } = await axios.get("/api/modalidades");
        this.modalidades = data;

        console.log(data);
      }, async enviar(){
             
         console.log(this.form);
          
          const { data } =await this.form.post("/api/proceso")
          .then(response =>{
            this.FetchProceso();
            this.clear();
            this.dialog=false;
          }).catch(error=>{
            if(error.response.status === 422){
              this.errores=error.response.data.errors;
              console.log(this.errors);
            }
          });
        
          

      },async cambiarEstado(id){
        const { data } = await axios.get(`/api/proceso/${id}`);
        this.switch1=data.Estado;
        console.log("Estado",this.switch);
      }, clear() {
         this.form.nombre='';
         this.form.grado=null;
         this.form.modalidad=null;
         this.errores={};
         
      }


    
    },
  }
</script>

<style >
 
</style>
