<template>
<v-data-table
    :headers="headers"
    :items="personas"
    :items-per-page="10"
    class="elevation-1 ml-4 mt-5"
  >
  <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>USUARIOS</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Agregar Persona
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                    
                      label="Nombre Proceso"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                     
                      label="Grado"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      
                      label="Modalidad"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      
                      label="fase"
                    ></v-text-field>
                  </v-col>
                  
                
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text               
              >
                Cancelar
              </v-btn>
              <v-btn
                color="blue darken-1"
                text                
              >
                Guardar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog >
    
      </v-toolbar>
  </template>


  </v-data-table>
</template>
<script>
import axios from 'axios'
  export default {
    data () {
      return {
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
      },


    
    },
  }
</script>