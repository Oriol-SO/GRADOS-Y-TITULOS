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
                max-width="650"
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
                    
                    <form >
                      <v-card-text>
                            <v-expand-transition>
                              <v-card-text class="mt-3" v-model="paginaform1" v-show="paginaform1">
                                <div class=" d-flex" style="flex-wrap:wrap;">
                                <v-col cols="12" md="6" >
                                  <div class="d-flex" >
                                      <v-text-field
                                        v-model="formus.userdni" 
                                        label="DNI"   
                                        class="my-auto mr-3"                 
                                        >
                                        </v-text-field>
                                        <v-btn color="primary" small class="my-auto text-capitalize" style="color:#fff;" elevation="0" @click="buscardni()" >Buscar</v-btn>                              
                                  </div>
                                  <v-text-field
                                    v-model="formus.apePat"
                                    label="Apellido Paterno"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.apeMat"
                                    label="Apellido Materno"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.nombresuser"
                                    label="Nombres"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-radio-group v-model="formus.genero" row >
                                      <v-radio
                                        label="Masculino"
                                        value="1"
                                      ></v-radio>
                                      <v-radio
                                        label="Femenino"
                                        value="0"
                                      ></v-radio>
                                  </v-radio-group>
                                  <v-text-field
                                    v-model="formus.direccion"
                                    label="Dirección"
                                    autocomplete="new-text"
                                    
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.correo"
                                    label="Correo"
                                    autocomplete="new-text"
                                    
                                  ></v-text-field>  
                                </v-col>
                                <v-col cols="12" md="6"  >
                                  <div>
                                    <!--div class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div-->
                                    <v-menu
                                      ref="menu"
                                      v-model="menu"
                                      :close-on-content-click="false"
                                      transition="scale-transition"
                                      offset-y
                                      min-width="auto"
                                    >
                                      <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                          v-model="formus.nacimiento"
                                          label="Fecha de nacimiento"
                                          prepend-icon="mdi-calendar"
                                          readonly
                                          v-bind="attrs"
                                          v-on="on"
                                        ></v-text-field>
                                      </template>
                                      <v-date-picker
                                        v-model="formus.nacimiento"
                                        :active-picker.sync="activePicker"
                                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                        min="1950-01-01"
                                        @change="save"
                                      ></v-date-picker>
                                    </v-menu>
                                  </div>
                                  <v-text-field
                                    v-model="formus.celular"
                                    label="Celular"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.gradoestu"
                                    label="Grado de estudios"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.gradoabr"
                                    label="Abrebiatura"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.password"
                                    label="Contraseña"
                                    type="password"
                                    autocomplete="new-password"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formus.password_confirmation"
                                    label="Confirmar contraseña"
                                    type="password"
                                    autocomplete="new-password"
                                  ></v-text-field>
                                </v-col>
                                </div>
                              </v-card-text>   
                            </v-expand-transition>                        
                         
                            <v-expand-transition>
                            <v-card-text class="mt-3"  v-model="paginaform2" v-show="paginaform2">
                              <div class="d-flex">
                                <v-col  cols="12" md="6"  >
                                    <v-select                                   
                                    v-model="formus.facultad"
                                    :items="facultades"
                                    item-text='FACULTAD'
                                    item-value='FACULTAD_ID'
                                    return-object
                                    label="Facultad"
                                    @change="mostrarescuelas"
                                    ></v-select>
                                    <v-select 
                                    v-model="formus.escuela"
                                    :items="escuelas"
                                    item-text='ESCUELA_ESPECIALIDAD'
                                    item-value='ID_ESC'
                                    return-object
                                    label="Escuela"
                                     @change="mostrarroles"
                                    
                                    ></v-select>
                                    <v-select
                                    v-model="formus.roles"
                                    :items="roles"
                                    label="roles"
                                    item-text="rolNombre"
                                    item-value="id"
                                    multiple
                                    chips
                                    hint="roles disponibles"
                                    persistent-hint
                                    return-object
                                    
                                  ></v-select>
                                </v-col>
                              </div>
                              <v-btn color="primary" elevation="0" @click="enviaruser()">Registrar Usuario</v-btn>
                            </v-card-text>  
                            </v-expand-transition> 
                        
                      
                       </v-card-text>                      
                    </form>
                   

                    <v-card-actions class="justify-end">
                      <div v-if="btnnext">
                        <v-btn 
                          text
                          color="success"
                          @click="siguiente(),fecthfacultad()"                        
                        >Siguiente</v-btn>                        
                      </div>
                      <div v-if="btnback">
                        <v-btn
                        text
                        color="warning"
                        @click="anteriore()"                        
                        >Anterior</v-btn>  
                      </div>
     

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

        
       // userdni:'',
        
         
        usuario:{},
        erroruser:'',

        formus: new Form({
          userdni:'',
          apePat:'',
          apeMat:'',
          nombresuser:'',
          genero:'',
          nacimiento:null,
          correo:'',
          direccion:'',
          celular:'',
          gradoestu:'',
          gradoabr:'',
          password:'',
          password_confirmation:'',
          facultad:'',
          escuela:'',
          roles:[],
        }),

        activePicker: null,
        //date: null,
        menu: false,

        paginaform1:true,
        paginaform2:false,
        
        btnnext:true,
        btnback:false,
        facultades:[],
        escuelas:[],
        roles:[],

        variable:'',
        erroresuser:'',
      }
    },
    mounted(){
      this.FetchPersonas();
      //this.fecthfacultad();
    }, 
    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
    methods:{

      async FetchPersonas() {
        const { data } = await axios.get("/api/persona");
        this.personas = data;
       // console.log(data);

      },async buscardni(){    
           await axios.get(`/api/buscardni/${this.formus.userdni}`)
           .then(response =>{                 
             this.usuario=response.data;
             // this.erroruser='';
             this.formus.apePat=this.usuario.apellidoPaterno;
             this.formus.apeMat=this.usuario.apellidoMaterno;
             this.formus.nombresuser=this.usuario.nombres;
            // console.log(this.usuario);
          })

      },async fecthfacultad(){
          if(this.facultades==''){
          await axios.get(`/api/facuescuela/`)
          .then(response=>{
            //this.facultades=response.data.facultades;
           // this.escuelas=response.data.escuelas;
            this.facultades=response.data;
            console.log(response.data);
            console.log(this.escuelas);

            this.mostrarroles();


          });
          }
        
      },mostrarescuelas(){
        //console.log(this.variable);
        this.mostrarroles();        
         axios.get(`/api/mostrarescuela/${this.formus.facultad.FACULTAD_ID}`)
        .then(response=>{
            //this.facultades=response.data.facultades;
           // this.escuelas=response.data.escuelas;
            this.escuelas=response.data;
            //console.log(response.data);
            console.log(this.escuelas);
          });
         console.log(this.formus);
      },
      save (date) {
        this.$refs.menu.save(date)
      },siguiente(){
        this.paginaform1=false;
        this.paginaform2=true;  
        this.btnnext=false;
        this.btnback=true;    
      
      },anteriore(){
        this.paginaform1=true;
        this.paginaform2=false;            
        this.btnnext=true;
        this.btnback=false;    
      },async enviaruser(){
        console.log(this.formus);
        await this.formus.post('/api/adminuser/').then(response=>{
              console.log(response.data);
        }).catch(error=>{
            if(error.response.status === 422){
              this.erroresuser=error.response.data.errors;
              console.log(this.erroresuser);
            }
          });  


      },async mostrarroles(){
            if(this.formus.facultad==''){
              await axios.get(`/api/rolesgenerales/${1}`).then(response=>{
              //console.log(response.data);
              this.roles=response.data;
              })
            }else{
              await axios.get(`/api/rolesgenerales/${2}`).then(response=>{
               this.roles=response.data;
              })
              if(this.formus.escuela!=''){
                await axios.get(`/api/rolesgenerales/${3}`).then(response=>{
               this.roles=response.data;
                })
              }
            }
            
           
      }


    
    },
  }
</script>