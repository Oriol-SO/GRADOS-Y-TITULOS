<template>

<div class=" ml-4 mt-5">
  <v-card>
    <v-card-title>
          <v-toolbar flat >
            <v-toolbar-title> USUARIOS</v-toolbar-title>
            <v-divider
              class="mx-4"
              inset
              vertical
            ></v-divider>
            
             <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Buscar"
              single-line
              hide-details
              color="rgb(44, 221, 155)"
              ></v-text-field> 
              <v-spacer></v-spacer>
              <v-dialog
                transition="dialog-top-transition"
                max-width="400"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="rgb(44, 221, 155)"
                    v-bind="attrs"
                    v-on="on"
                    style="color:#fff;"
                    class="text-capitalize"
                  >Agregar</v-btn>
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar
                      color="primary"
                      dark
                    >Agregue un nuevo usuario</v-toolbar>
                    <v-card-text class="d-flex mt-3">
                      <v-text-field
                       v-model="usercod" 
                       label="Codigo"   
                       class="my-auto mr-3"                 
                      >
                      </v-text-field>
                      <v-btn color="primary" class="my-auto text-capitalize" style="color:#fff;" elevation="0" @click="buscardni()" >Buscar</v-btn>
                    </v-card-text>                      
                            <v-alert  v-if="erroruser"  dense outlined type="error" >
                               {{erroruser}}
                            </v-alert>                        
                    <v-card-actions class="justify-end">
                      <v-btn
                        text
                        @click="dialog.value = false"
                      >Close</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
          </v-toolbar>         
    </v-card-title>   
    <v-data-table
      :headers="headers"
      :items="personas"     
      :items-per-page="10"
      :search="search"
      class="elevation-1"
    >
  </v-data-table>

  </v-card>

</div>
</template>
<script>
import axios from 'axios';
import Form from "vform";
  export default {
    data () {
      return {
        search:'',
        headers: [
          {
            text: 'Usuarios',
            align: 'start',
            sortable: false,
            value: 'nom',
          
          },
          { text: 'documento', value: 'numDoc' },
          { text: 'Email', value: 'email' },
          { text: 'Acciones', value: 'actions', sortable: false },
        ],
        /*desserts: [
          {
            nomProc: 'KitKat',
            fase: 518,
            requisito: 26.0,
          
          },
        ],*/
        personas:[],

        
        usercod:'',
        
         
        usuario:'',
        erroruser:'',
       
      }
    },
    computed: {
      formTitle () {
        return this.editedIndex === 'New Item' 
      },
    },
    mounted(){
      this.FetchPersonas();
    }, 
    
    methods:{
      async FetchPersonas() {
        const { data } = await axios.get("/api/persona");
        this.personas = data;
        console.log(data);

      },async buscardni(){    
           await axios.get(`/api/buscarcodigouser/${this.usercod}`)
           .then(response =>{                 
              this.usuario=response.data;
              this.erroruser='';
              if(response.data.message){
                 this.erroruser=response.data.message;
              }
          
             console.log(this.usuario);
          })

      }


    
    },
  }
</script>