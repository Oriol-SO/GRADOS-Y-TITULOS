<template >
<div class="d-flex ml-4 mr-4" style="height:100%; ">
    <v-card class=" my-auto mx-auto">
      <v-card-title>
        <span class="text-h5">Registrate</span>
      </v-card-title>
      <v-card-text>
   
            <v-col
              cols="12"
        
              md="12"
              class="d-flex"
            >
              <v-text-field
              v-model="codigouser"
                label="Codigo de alumno"
                required
                autocomplete="new-text"
                style="max-width:250px;"
                class="my-auto "
              ></v-text-field>

              <v-btn
              color="primary"
              class="ml-4 my-auto text-capitalize"
              @click="searchdatosuser()"
              >
              Procesar
              </v-btn>
            </v-col>
          <v-card-text class="d-flex" style="flex-wrap:wrap"  v-if="form.nombresuser">
         
              <v-row class="mr-5" >
                <v-card elevation="0" width="100%" >
                <v-card-title> Tu información</v-card-title>
                <v-divider class="mb-2"></v-divider>
                    <div class="d-flex flex-wrap mb-5">
                        <v-avatar size="75" v-if="form.genero =='0'">
                          <img
                            src="/img/mujeravatar.png"
                              
                            >                       
                        </v-avatar>
                        <v-avatar size="75" v-if="form.genero =='1'">
                          <img
                               src="/img/hombreavatar.png"
                            >                       
                        </v-avatar>
                        <div class="ml-3"> 
                          <strong class=" text-subtitle-1 font-weight-bold">{{form.nombresuser+' '+ form.apePat+' '+ form.apeMat}}</strong>
                          <p><strong>Codigo: </strong>{{form.codigo}}</p>
                        </div>                     
                    </div>

                    <div>
                      <v-card>
                        <div  class="my-3 mx-2">
                          <p class="mb-0"><Strong>Especialidad:</Strong></p>
                          <p class="mb-2">{{form.programa_facu}}</p>
                          <p class="mb-0"><Strong>Curricula:</Strong></p>
                          <p class="mb-2">{{form.curricula}}</p>
                          <p class="mb-0"><Strong>Ingreso: </Strong></p>
                          <p class="mb-2">{{form.fecha_ingre}}</p>
                          <p class="mb-0"><Strong>Nacimiento: </Strong></p>
                          <p class="mb-2">{{form.nacimiento}}</p>
                          <p class="mb-0"><Strong>dirección: </Strong></p>
                          <p class="mb-2">{{form.direccion}}</p>

                      </div>
                      </v-card>
                    </div>
                </v-card>

              </v-row>
            
            <v-row class="ml-2">
              <v-col
                cols="12"
                md="12"
              >
                <h3>Completa la siguiente informacion</h3>
 

              </v-col>

              <v-col
                cols="12"
                sm="6"
                md="4"
                class="d-flex"
              >
                  <v-select
                  v-model="form.tipodoc"
                  :items="tipodocs"
                  label='tipo de documento'
                  item-text="nombre"
                  item-value="num"
                  solo                                  
                  return-object
                  elevation="0"
                  style="height:55px; width:150px;"
                  ></v-select>
            
                <v-text-field
                  v-model="form.userdoc"
                  class="ml-2"
                  label="N° Documento"
                  autocomplete="new-text"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                v-model="form.correo"
                  label="Correo"
                  
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="2" sm="6">
                <v-text-field
                v-model="form.celular"
                  label="Celular"
                  autocomplete="new-text"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="2" sm="6">
                    <v-text-field
                      v-model="form.fecha_egre"
                      label="Año de egreso"
                      prepend-icon="mdi-calendar"
                    ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="3"
                sm="6">
              
                <v-text-field 
                v-model="form.gradoestu"
                label="Grado de estudios" ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="3"
                sm="6">
              
                <v-text-field
                 v-model="form.gradoabr"
                 label="Abreviatura" ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="3"
              >
                <v-select 
                v-model="form.facultad"
                :items="facultades"
                item-text='FACULTAD'
                item-value='FACULTAD_ID'
                return-object
                label="Facultad"
                @change="mostrarescuelas"
                ></v-select>
              </v-col>
               <v-col
                cols="12"
                sm="6"
                md="3"
              >
                <v-select 
                v-model="form.escuela"
                :items="escuelas"
                item-text='ESCUELA_ESPECIALIDAD'
                item-value='ID_ESC'
                return-object
                label="Escuela"
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                v-model="form.password"
                label="Contraseña"
                type="password"
                autocomplete="new-password"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                v-model="form.password_confirmation"
                label="Confirmar contraseña"
                type="password"
                autocomplete="new-password"
                ></v-text-field>
              </v-col>
            </v-row>
               
          </v-card-text>

     
       <small  style="color:red ">*es indispensable que toda tu informacion este Completa</small>
      </v-card-text>
      <v-card-actions v-if="form.nombresuser">
      
        <v-spacer></v-spacer>
        <v-btn
          color="blue"
          @click="registraruser()"
        >
          Registrar
        </v-btn>
      </v-card-actions>
    </v-card>
    <v-dialog>
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Errores
        </v-card-title>

        <v-card-text>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
          >
            Acepto
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</div>

</template>

<script>
import Form from "vform";
import axios from 'axios';
import { resolve } from 'url';
//import { response } from 'express';

export default {
  layout: "basic",

  data(){
    return{


      activePicker2: null,
     // date2: null,
      menu2: false,

      tipodocs:[{nombre:'DNI',num:1},{nombre:'PASAPORTE',num:2}],
      codigouser:'',
      form:new Form({
          codigo:'',
          tipodoc:{nombre:'DNI', num:1},
          userdoc:'',
          apePat:'',
          apeMat:'',
          nombresuser:'',
          genero:'',
          nacimiento:null,
          correo:'',
          direccion:'',
          celular:'',
          egreso:'',
          gradoestu:'',
          gradoabr:'',
          password:'',
          password_confirmation:'',
          facultad:'',
          escuela:'',
         // roles:[],
          programa_facu:'',
          fecha_ingre:'',
          fecha_egre:'',
          curricula:'',
          
      }),
      facultades:[],
      escuelas:[],
      errores:'',
    }
  }, watch: {

      menu2(val){
        val && setTimeout(() => (this.activePicker2 = 'YEAR'))
      }
  },mounted(){
   // this.datosuser();
   this.fecthfacultad();
  },  
  methods:{
    async searchdatosuser(){
      await axios.get(`api/datauser/${this.codigouser}`).then(response=>{
          var user=response.data;
          this.form.nombresuser=user['Nombres'];
          this.form.apePat=user['Apellido paterno'];
          this.form.apeMat=user['Apellido materno'];
          this.form.programa_facu=user['Programa facultad'];
          this.form.direccion=user['Domicilio'];
          this.form.nacimiento=user['Fecha de nacimiento'];
          this.form.fecha_ingre=user['Fecha de Ingreso'];
          this.form.curricula=user['Curricula'];
          if(user['Genero']=='M'){
            this.form.genero='1';
          }else{this.form.genero='0';}
          
          this.form.codigo=this.codigouser;
         // console.log(this.nombresuser);
      });

    },async fecthfacultad(){
          if(this.facultades==''){

          await axios.get(`/api/facuescuela/`)
          .then(response=>{
            this.facultades=response.data;
          });
          
          }
          
      },mostrarescuelas(){
        this.form.escuela='';
        //this.mostrarroles();        
         axios.get(`/api/mostrarescuela/${this.form.facultad.FACULTAD_ID}`)
        .then(response=>{
            //this.facultades=response.data.facultades;
           // this.escuelas=response.data.escuelas;
            this.escuelas=response.data;
            //console.log(response.data);
            //console.log(this.escuelas);
          });
         //console.log(this.formus);
      },registraruser(){
        console.log(this.form);
        this.form.post('/api/register').then(response=>{
          console.log(response.data);
        }).catch(error=>{
                if(error.response.status === 422){
                      this.errores=error.response.data.errors;                      
                      console.log(this.errores);
                    
                    }
        });
      }
  }

  
};
</script>
