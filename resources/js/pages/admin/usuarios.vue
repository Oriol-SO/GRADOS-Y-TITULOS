<template>

<div class=" ml-4 mt-5">
  <v-card elevation="0">
    <v-card-title elevation="0">
         
          <v-row class=" ma-1">
            <v-toolbar-title class="text-h6"> Usuarios</v-toolbar-title>
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
                max-width="800"
                v-model="dialog"
                persistent
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="rgb(44, 221, 155)"
                    v-bind="attrs"
                    v-on="on"
                    style="color:#fff;"
                    class="text-capitalize mt-2"
                    elevation="0"
                  > <v-icon dark left>mdi-account-plus</v-icon> Agregar</v-btn>
                </template>
                <template >
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
                                 <v-select
                                  v-model="formus.tipodoc"
                                  :items="tipodocs"
                                  label='tipo de documento'
                                  item-text="nombre"
                                  item-value="num"
                                  solo                                  
                                  return-object
                                  height="35"
                                  style="height:55px;"
                                 ></v-select>
                                  <div class="d-flex" >
                                      <v-text-field
                                        v-model="formus.userdoc" 
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
                                  <!--v-text-field
                                    v-model="formus.direccion"
                                    label="Dirección"
                                    autocomplete="new-text"
                                    
                                  ></v-text-field-->
                                 
                                </v-col>
                                <v-col cols="12" md="6"  >
                                  <v-text-field
                                    v-model="formus.correo"
                                    label="Correo"
                                    autocomplete="new-text"
                                    type="email"
                                  ></v-text-field> 
                                  <!--div>
           
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
                                  </div-->
                                  <!--v-text-field
                                    v-model="formus.celular"
                                    label="Celular"
                                    autocomplete="new-text"
                                  ></v-text-field-->
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
                                  <!--v-text-field
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
                                  ></v-text-field-->
                                 <v-text-field
                                    v-model="formus.codalum"
                                    label="Codigo"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                </v-col>
                                </div>
                              </v-card-text>   
                            </v-expand-transition>                        
                         
                            <v-expand-transition>
                            <v-card-text class="mt-3" style="text-align: center;!important" v-model="paginaform2" v-show="paginaform2">
                              <div class="d-flex" style="flex-wrap:wrap;">
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
                                    v-model="formus.rol"
                                    :items="roles1"
                                    label="roles"
                                    item-text="rolNombre"
                                    item-value="id"                                   
                                    chips
                                    hint="roles disponibles"                                    
                                    return-object
                                    
                                  ></v-select>
                                 
                                  <v-btn color="green" text @click="addRol()">añadir Rol</v-btn>
                                </v-col>

                                <v-col cols="12" md="6" >
                                    <v-list >
                                      <v-list-item v-for="(role,i) in this.formus.roles" :key="i" class="mb-1" style="background: #dddddd; border-radius: 20px; text-align: justify;">
                                            <v-list-item-content>
                                              <v-list-item-title>{{role.roles.rolNombre}}</v-list-item-title>
                                              <v-list-item-subtitle v-if="role.escuela.ESCUELA_ESPECIALIDAD">{{role.escuela.ESCUELA_ESPECIALIDAD}}</v-list-item-subtitle>
                                              <v-list-item-subtitle v-else-if="role.facultad.FACULTAD">{{role.facultad.FACULTAD}}</v-list-item-subtitle>                                              
                                              <v-list-item-subtitle v-else>UNDAC</v-list-item-subtitle>                                              
                                            </v-list-item-content>                                     

                                              <v-list-item-action>
                                                <v-btn icon>
                                                  <v-icon color="red lighten-1" @click="deleteRol(role)">mdi-delete</v-icon>
                                                </v-btn>
                                              </v-list-item-action>     
                                        </v-list-item>
                                    </v-list>
                                    
                                </v-col>

                                                                 
                                      <v-alert  v-if="erroresuser"   text prominent color="red"  class="px-0 py-0" >
                                              <p v-for="(error,i ) in erroresuser" :key="i" class="my-1">{{error}}</p>
                                      </v-alert> 
                                      <v-alert v-if="errorexist" text outlined color="deep-orange" icon="mdi-cloud-alert">
                                                {{errorexist}}
                                      </v-alert>                              
                               
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
                        @click="close(),clear()"
                      >Close</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
              </v-row >       
    </v-card-title>   
    <v-data-table 
   
      :headers="headers"
      :items="personas"     
      :items-per-page="10"
      :search="search"
      class="elevation-0 "
      id="usuario"
    >
    <template v-slot:item.avatar="{ item }">
      <v-avatar
        size="26px"
      >
        <img 
          v-if="item.gen==1"
          alt="Avatar"
          src="/img/avatar_varones.svg"
        >
        <img 
          v-else
          alt="Avatar"
          src="/img/avatar mujeres.svg"
        >
      </v-avatar>        
    </template>
      <template v-slot:item.actions="{ item }">

          <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              @click="editItem(item)"  
              v-bind="attrs"
              v-on="on"
            >
               mdi-pencil-box-outline
            </v-icon>
          </template>
          <span>Editar</span>
        </v-tooltip>
      

      </template>
    </v-data-table>
                <v-dialog
                transition="dialog-top-transition"
                max-width="800"
                v-model="dialogedit"
                persistent

              >
                <template >
                  <v-card>
                    <v-toolbar
                      color="primary"
                      dark
                    >Editar este usuario</v-toolbar>
                    
                    <form >
                      <v-card-text>
                            <v-expand-transition>
                              <v-card-text class="mt-3" v-model="paginaform1" v-show="paginaform1">
                                <div class=" d-flex" style="flex-wrap:wrap;">
                                <v-col cols="12" md="6" >
                                  <v-select
                                  v-model="formusE.tipodoc"
                                  :items="tipodocs"
                                  label='tipo de documento'
                                  item-text="nombre"
                                  item-value="num"
                                  solo                                  
                                  return-object
                                  height="35"
                                  style="height:55px;"
                                 ></v-select>
                                  <div class="d-flex" >
                                      <v-text-field
                                        v-model="formusE.userdoc" 
                                        label="DNI"   
                                        class="my-auto mr-3"                 
                                        >
                                        </v-text-field>
                                        <v-btn color="primary" small class="my-auto text-capitalize" style="color:#fff;" elevation="0" @click="buscardni()" >Buscar</v-btn>                              
                                  </div>
                                  <v-text-field
                                    v-model="formusE.apePat"
                                    label="Apellido Paterno"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formusE.apeMat"
                                    label="Apellido Materno"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formusE.nombresuser"
                                    label="Nombres"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-radio-group v-model="formusE.genero" row >
                                      <v-radio
                                        label="Masculino"
                                        :value="1"
                                      ></v-radio>
                                      <v-radio
                                        label="Femenino"
                                        :value="0"
                                      ></v-radio>
                                  </v-radio-group>
                                  <!--v-text-field
                                    v-model="formusE.direccion"
                                    label="Dirección"
                                    autocomplete="new-text"
                                    
                                  ></v-text-field-->
                                   
                                </v-col>
                                <v-col cols="12" md="6"  >

                                <v-text-field
                                    v-model="formusE.correo"
                                    label="Correo"
                                    autocomplete="new-text"
                                    
                                  ></v-text-field> 

                                  <v-text-field
                                    v-model="formusE.gradoestu"
                                    label="Grado de estudios"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                  <v-text-field
                                    v-model="formusE.gradoabr"
                                    label="Abrebiatura"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                    <v-text-field
                                    v-model="formusE.codalum"
                                    label="Codigo"
                                    autocomplete="new-text"
                                  ></v-text-field>
                                </v-col>
                                </div>
                              </v-card-text>   
                            </v-expand-transition>                        
                         
                            <v-expand-transition>
                            <v-card-text class="mt-3"  v-model="paginaform2" v-show="paginaform2">
                              <div class="d-flex" style="flex-wrap:wrap;">
                                <v-col  cols="12" md="6"  >
                                    <v-select                                   
                                    v-model="formusE.facultad"
                                    :items="facultades"
                                    item-text='FACULTAD'
                                    item-value='FACULTAD_ID'
                                    return-object
                                    label="Facultad"
                                    @change="mostrarescuelasedit"
                                    ></v-select>
                                    <v-select 
                                    v-model="formusE.escuela"
                                    :items="escuelas"
                                    item-text='ESCUELA_ESPECIALIDAD'
                                    item-value='ID_ESC'
                                    return-object
                                    label="Escuela"
                                     @change="mostrarrolesedit"
                                    
                                    ></v-select>
                                    <v-select
                                    v-model="formusE.rol"
                                    :items="roles"
                                    label="roles"
                                    item-text="rolNombre"
                                    item-value="id"                                    
                                    chips
                                    hint="roles disponibles"                                 
                                    return-object                                    
                                  ></v-select>
                                  <v-btn elevation="3"  color="green" small  @click="addRolEdit()">añadir Rol</v-btn>
                                  
                                </v-col>
                                  <v-col cols="12" md="6" >
                                    <v-list >
                                    <v-subheader style="height: 20px;">ROLES ACTUALES</v-subheader>
                                      <v-list-item v-for="(role,i) in formusE.oldroles" :key="i" class="mb-1" style="background: #ededed; height: 25px; text-align: justify;">
                                            <v-list-item-content>
                                              <v-list-item-title>{{role.roles}}</v-list-item-title>
                                              <v-list-item-subtitle v-if="role.escuela">{{role.escuela}}</v-list-item-subtitle>
                                              <v-list-item-subtitle v-else-if="role.facultad">{{role.facultad}}</v-list-item-subtitle>                                              
                                              <v-list-item-subtitle v-else>UNDAC</v-list-item-subtitle>                                              
                                            </v-list-item-content>                                     

                                              <v-list-item-action>
                                                <v-switch
                                                  color="green"
                                                  v-model="role.estado"
                                                  :value="role.estado"  
                                                  @click="disableRol(role.id)"                                        
                                                ></v-switch>
                                              </v-list-item-action>     
                                        </v-list-item>
                                    </v-list> 

                                    <v-list >
                                      <v-list-item v-for="(roleE,i) in formusE.roles" :key="i" class="mb-1" style="background: #dddddd; height: 25px; border-radius: 20px; text-align: justify;">
                                            <v-list-item-content>
                                              <v-list-item-title>{{roleE.roles.rolNombre}}</v-list-item-title>
                                              <v-list-item-subtitle v-if="roleE.escuela.ESCUELA_ESPECIALIDAD">{{roleE.escuela.ESCUELA_ESPECIALIDAD}}</v-list-item-subtitle>
                                              <v-list-item-subtitle v-else-if="roleE.facultad.FACULTAD">{{roleE.facultad.FACULTAD}}</v-list-item-subtitle>                                              
                                              <v-list-item-subtitle v-else>UNDAC</v-list-item-subtitle>                                              
                                            </v-list-item-content>                                     

                                              <v-list-item-action>
                                                <v-btn icon>
                                                  <v-icon color="red lighten-1" @click="deleteRolEdit(roleE)">mdi-delete</v-icon>
                                                </v-btn>
                                              </v-list-item-action>     
                                        </v-list-item>
                                    </v-list>                                    
                                  </v-col>
                                                                 
                                      <v-alert  v-if="erroresuseredit"   text prominent color="red"  class="px-0 py-0" >
                                              <p v-for="(error,i ) in erroresuseredit" :key="i" class="my-1">{{error}}</p>
                                      </v-alert> 
                                      <v-alert v-if="errorexistedit" text outlined color="deep-orange" icon="mdi-cloud-alert">
                                                {{errorexistedit}}
                                      </v-alert>                              
                               
                              </div>
                              <div style="text-align: center">
                              <v-btn color="primary" elevation="0" @click="actualizaruser()">Actualizar </v-btn>
                              </div> 
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
                        @click="closedialogedit(),clear()"
                      >Close</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
  </v-card>

  <template>
        <div class="text-center ma-2">

            <v-snackbar
                v-model="boxerrorRol"
                tile
                color="red accent-2"
                top
            >
            {{ msg_ERROR_ROL }}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="boxerrorRol = false"
                >
                Close
                </v-btn>
            </template>
            </v-snackbar>
        </div>
    </template>
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
          {text: '',value: 'avatar', sortable: false, width:'20px' },
          {text: 'Usuarios', value: 'nom', },
          { text: 'documento', value: 'numDoc', sortable: false },
          { text: 'Email', value: 'email', sortable: false },
          //{ text: 'telefono', value: 'numcel' },
          { text: 'Escuela', value: 'espe' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        personas:[],
        dialog:false,
        dialogedit:false,
        
       // userdni:'',
        
         
        usuario:{},
        erroruser:'',
        tipodocs:[{nombre:'DNI',num:1},{nombre:'PASAPORTE',num:2}],
        formus: new Form({
          tipodoc:{nombre:'DNI', num:1},
          userdoc:'',
          apePat:'',
          apeMat:'',
          nombresuser:'',
          genero:'',
          //nacimiento:null,
          correo:'',
          //direccion:'',
          //celular:'',
          gradoestu:'',
          gradoabr:'',
          //password:'',
          //password_confirmation:'',
          facultad:'',
          escuela:'',
          roles:[],
          rol:[],
          codalum:'',

          //roles2:[],
        }),

        formusE: new Form({
          tipodoc:{nombre:'DNI', num:1},
          userdoc:'',
          apePat:'',
          apeMat:'',
          nombresuser:'',
          genero:'',
          //nacimiento:null,
          correo:'',
          //direccion:'',
          //celular:'',
          gradoestu:'',
          gradoabr:'',
          //password:'',
          //password_confirmation:'',
          facultad:'',
          escuela:'',
          roles:[],
          oldroles:[],
          rol:'',
          codalum:'',
        }),

        //activePicker: null,
        //activePicker2:null,
        //date: null,
        //menu: false,
       // menu2:false,

        paginaform1:true,
        paginaform2:false,
        
        btnnext:true,
        btnback:false,
        facultades:[],
        escuelas:[],
        roles1:[],
        roles:[],

        variable:'',
        erroresuser:'',
        errorexist:'',
        erroresuseredit:'',
        errorexistedit:'', 
      
       boxerrorRol:false,
       msg_ERROR_ROL:'',
      }
    },
    mounted(){
      this.FetchPersonas();
    }, 
   /* watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },*/
    methods:{
      async addRol(){
         var facu= this.formus.facultad;
         var escu=this.formus.escuela;
         var rol=this.formus.rol;

         if(rol==''){
           this.msg_ERROR_ROL='selecciona un rol';
           this.boxerrorRol=true;
         }else{
          this.formus.roles.push({'facultad':facu,'escuela':escu,'roles':rol});
          //console.log(this.formus.roles2);
         }         
      }, async addRolEdit(){
         var facu= this.formusE.facultad;
         var escu=this.formusE.escuela;
         var rol=this.formusE.rol;

         if(rol==''){
           this.msg_ERROR_ROL='selecciona un rol';
           this.boxerrorRol=true;
         }else{
          this.formusE.roles.push({'facultad':facu,'escuela':escu,'roles':rol});
          console.log(this.formusE.roles);
         }         
      },deleteRol(role){          
          var delIndex =this.formus.roles.indexOf(role);
          this.formus.roles.splice(delIndex, 1)
          console.log(del);
      },deleteRolEdit(role){          
          var delIndex =this.formusE.roles.indexOf(role);
          this.formusE.roles.splice(delIndex, 1)
          console.log(del);
      },
      async FetchPersonas() {
        const { data } = await axios.get("/api/persona");
        this.personas = data;
        //console.log(data);

      },async buscardni(){    
           await axios.get(`/api/buscardni/${this.formus.userdoc}`)
           .then(response =>{                 
             this.usuario=response.data;
             // this.erroruser=
             this.formus.apePat=this.usuario.apellidoPaterno;
             this.formus.apeMat=this.usuario.apellidoMaterno;
             this.formus.nombresuser=this.usuario.nombres;
            // console.log(this.usuario);
          })

      },async fecthfacultad(){
          if(this.facultades==''){

          await axios.get(`/api/facuescuela/`)
          .then(response=>{
            this.facultades=response.data;
          });
          
          }
          this.mostrarroles();
      },mostrarescuelas(){
        this.formus.escuela='';
        this.mostrarroles();        
         axios.get(`/api/mostrarescuela/${this.formus.facultad.FACULTAD_ID}`)
        .then(response=>{
            //this.facultades=response.data.facultades;
           // this.escuelas=response.data.escuelas;
            this.escuelas=response.data;
            //console.log(response.data);
            //console.log(this.escuelas);
          });
         //console.log(this.formus);
      },mostrarescuelasedit(){
                this.formusE.escuela='';
                this.mostrarrolesedit();        
                axios.get(`/api/mostrarescuela/${this.formusE.facultad.FACULTAD_ID}`)
                .then(response=>{
                    //this.facultades=response.data.facultades;
                  // this.escuelas=response.data.escuelas;
                    this.escuelas=response.data;
                    //console.log(response.data);
                    //console.log(this.escuelas);
                  });
                //console.log(this.formus);
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
              //console.log(response.data);
            if(response.data==2){
                this.errorexist='¡UPS! algo salió mal, comunicate con el soporte técnico'
            }else{
                if(response.data==1){
                this.errorexist='ya existe un usuario con este correo';
                }else{
                  this.FetchPersonas();
                  this.clear();
                  this.close();
                }
            }
        }).catch(error=>{
            if(error.response.status === 422){
              this.erroresuser=error.response.data.errors;
              console.log(this.erroresuser);
            }
          });  


      },async mostrarroles(){
        this.formus.rol='';
            if(this.formus.facultad==''){
              await axios.get(`/api/rolesgenerales/${1}`).then(response=>{
              //console.log(response.data);
              this.roles1=response.data;
              })
            }else{
              await axios.get(`/api/rolesgenerales/${2}`).then(response=>{
               this.roles1=response.data;
              })
              if(this.formus.escuela!=''  ){
                await axios.get(`/api/rolesgenerales/${3}`).then(response=>{
               this.roles1=response.data;
                })
              }
            }
            
           
      },
      async mostrarrolesedit(){
        this.formusE.rol='';
            if(this.formusE.facultad==''){
              await axios.get(`/api/rolesgenerales/${1}`).then(response=>{
              //console.log(response.data);
              this.roles=response.data;
              })
            }else{
              await axios.get(`/api/rolesgenerales/${2}`).then(response=>{
               this.roles=response.data;
              })
              if(this.formusE.escuela!=''){
                await axios.get(`/api/rolesgenerales/${3}`).then(response=>{
                this.roles=response.data;
                })
              }
            }               
      }
      ,clear(){
          this.formusE.iduser='';

          this.formus.apePat='';
          this.formus.userdoc='';
          this.formus.apeMat='';
          this.formus.nombresuser='';
          this.formus.genero='';
         // this.formus.nacimiento=null;
          this.formus.correo='';
          //this.formus.direccion='';
          //this.formus.celular='';
          this.formus.gradoestu='';
          this.formus.gradoabr='';
          //this.formus.password='';
          //this.formus.password_confirmation='';
          this.formus.facultad='';
          this.formus.escuela='';
          this.formus.roles=[];
          //this.formus.rol=[];

          this.formus.codalum='';


          this.erroresuser='';
          this.errorexist='';
          this.erroresuseredit='';
          this.errorexistedit='';
          this.roles1=[];
          this.escuelas=[];
          this.anteriore();
         
      },close(){
        this.dialog=false;
      },
      closedialogedit(){
        this.dialogedit=false;
      },
      editItem(item){
          //console.log(item);

          this.dialogedit=true;
          this.formusE.iduser=item.id;
          this.formusE.apePat=item.apePat;
          this.formusE.userdoc=item.numDoc;
          this.formusE.apeMat=item.apeMat;
          this.formusE.nombresuser=item.nom;
          this.formusE.genero=item.gen;
          //this.formusE.nacimiento=item.fecNac;
          this.formusE.correo=item.email;
          //this.formusE.direccion=item.dom;
          //this.formusE.celular=item.numcel;
          this.formusE.gradoestu=item.grad_estud;
          this.formusE.gradoabr=item.abre_grad;
          //this.formusE.password='';
          //this.formusE.password_confirmation='';
          this.formusE.facultad='',
          this.formusE.escuela='';
          this.formusE.roles=[];
          this.formusE.oldroles=item.roles;          
          this.formusE.codalum=item.cod_alum;

          this.mostrarrolesedit();
         
      },async actualizaruser(){
        //  console.log(this.formusE)
            await this.formusE.put(`/api/adminuser/${this.formusE.iduser}`).then(response=>{
            //console.log(response.data);
            if(response.data==2){
              this.errorexistedit='¡UPS! algo salió mal, comunicate con el soporte técnico'
            }else{
                if(response.data==1){
                  this.errorexistedit='ya existe un usuario con este correo';
                }else{
                    //console.log(response.data);
                    this.FetchPersonas();
                    this.clear();
                    this.closedialogedit();
                }
            }
            
            }).catch(error=>{
                if(error.response.status === 422){
                      this.erroresuseredit=error.response.data.errors;                      
                      //console.log(this.erroresuseredit);
                    }
              }); 
      },async disableRol(rol_id){
       // console.log(rol_id);
        await axios.get(`/api/disableRol/${rol_id}`).then(response=>{
          if(response.data==true){
            this.FetchPersonas();
          }
        })
      }
 
    
    },
  }

</script> 

<style>
 #usuario .v-data-table-header th[role=columnheader] {
  font-size: 16px !important;
  color:#304156;
  background:#f2f3f8 !important;
}

 #usuario .v-data-table-header tr:hover {
    background-color: red !important;
}
</style>