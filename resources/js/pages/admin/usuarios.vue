

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
            color="teal" class="ml-10 mt-5"
           
            v-bind="attrs"
            v-on="on"
          >Agregar Tramite</v-btn>
        </template>
        <template >
          <v-card>
            <v-toolbar
              color="teal"
              dark
            >Agregar Nuevo tramite</v-toolbar>
            <v-card-text>

             <form>
                  <v-text-field
                    v-model="form.nombre"
                    :error-messages="nameErrors"
                    label="Nombre"
                    required
                  ></v-text-field>
                   <div v-if="errors.nombre">
                      <v-alert  dense outlined type="error" >
                        {{errors.nombre[0]}}
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
                      <div v-if="errors.grado">
                        <v-alert   dense outlined type="error" >
                           {{errors.grado[0]}}
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
                       <div v-if="errors.modalidad">
                            <v-alert   dense outlined type="error" >
                               {{errors.modalidad[0]}}
                            </v-alert>
                        </div>  
                    <v-btn
                      class="mr-4"
                      @click="enviar"
                    >
                      submit
                    </v-btn>
                    <v-btn @click="clear">
                      clear
                    </v-btn>
             </form>

            



            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                @click="dialog=false"
               
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
 
      <v-card v-for="(proceso,i) in procesos" :key="i"
    class="mt-5 mb-5 ml-1 mr-1 "    
    width="420"
     
  >
  
    <v-card-text >     
      <p class="text-h6 indigo--text " >
        {{proceso.procNom}}
      </p>
        <div class="text--primary "  >
        Fases :<strong>15</strong> <br/>
        Requisitos :<strong>10</strong>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn  
          
        color="teal"
        tile
        outlined
        elevation="2"
     
      >
        Abrir
      </v-btn>
      <v-btn
        
        tile
        color="blue-grey"
        outlined
       elevation="2"
      >
        Desactivar
      </v-btn>
    </v-card-actions>
  </v-card>
   

 
 </div>
</div>
</template>

<script>
import axios from 'axios'
import Form from "vform";
   export default {
    data () {
       
      return {  
          //select:{graNom:'',id:''} ,
          grados:[],
          procesos:[],         
          modalidades:[],
          dialog:false,
          errors:{},
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
        this.procesos = data;

        console.log(data);
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
              this.errors=error.response.data.errors;
              console.log(this.errors);
            }
          });
        
          

      }, clear() {
         this.form.nombre='';
         this.form.grado=null;
         this.form.modalidad=null;
         
      }


    
    },
  }
</script>

<style >
 
</style>
