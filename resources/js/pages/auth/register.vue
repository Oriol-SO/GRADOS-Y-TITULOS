<template >
<v-container fluid class="fill-height main" style="justify-content:center; padding-top: 85px;">
  <div class="d-flex ml-4 mr-4 " style="height:100%; ">
      <v-card class=" my-auto mx-auto">
        <v-card-title class="d-flex">
          <span class="text-h5">Registrate</span>    

 
  
        </v-card-title>
        <v-card-text>
              <v-col>
                 <v-alert color="#2778c4" text style="max-width:450px;">
                  <small class="text-subtitle-2" > <strong>¡IMPORTANTE! </strong> <br>
                    Antes de registrarte debes de tener actualizado tu correo institucional y tus datos personales 
                    en tu cuenta de extranet, ya que se usara ese correo para enviarte el enlace de verificacion de tu cuenta <br>
                    ¡Evita inconvenientes al registrarte!.
                  </small>
                  </v-alert> 
              </v-col>
            
              <v-col
                cols="12"
                md="12"
                class="d-flex"
              >
               
                <v-text-field
                  v-model="form.codigo"
                  label="Codigo de alumno"                  
                  autocomplete="new-text"
                  class="my-auto"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
          
                md="12"
                class="d-flex"
              >
                <v-text-field
                  v-model="form.password"
                  label="Contraseña"
                  type="password"                  
                  autocomplete="new-text"
                  class="my-auto "
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"          
                md="12"
                class="d-flex"
              >
                <v-text-field
                  v-model="form.password_confirmation"
                  label="Cofirmar Contraseña"                  
                  type="password"
                  autocomplete="new-text"
                  class="my-auto "
                ></v-text-field>

              </v-col>
              <v-col
                cols="12"          
                md="12"
                class="d-flex"
                
                >
                <v-btn
                color="primary"
                class="mx-auto my-auto text-capitalize"
                @click="register(),dialog_load=true"
                >
                Registrar
                </v-btn>
              </v-col>

              <v-col cols="12" md="12">
  
       
                <router-link :to="{name:'login'}" class="d-flex mt-4 align-center justify-center text-subtitle-2">
                  Iniciar Sesion
                </router-link>
              </v-col>
      
        
        </v-card-text>
    </v-card>

      <template>
        <div class="text-center">
          <v-dialog
            v-model="mustVerifyEmail" 
            width="400" 
            persistent
            >   
            <v-card class="pt-3 px-3">
                <v-alert
                  outlined
                  type="success"
                  text
                >
                    Registro exitoso <v-icon color="#49FF00">mdi-checkbox-marked-circle</v-icon> 
                    <v-divider></v-divider>
                    Hemos enviado un enlace de verificacion a <strong>{{correo}}</strong>  
                </v-alert>
                <v-card-actions class="px-0 py-0">              
                  <v-btn
                    color="primary"
                    text
                    class="mx-auto mb-1"
                    @click="mustVerifyEmail = false"
                  >
                  Cerrar
                  </v-btn>
                </v-card-actions>
            </v-card>



          </v-dialog>
        </div>
      </template>   

      <template>
        <div class="text-center">

          <v-dialog
            v-model="dialog_load"
            persistent
            width="300"
            elevation="0"
          >
            <v-card
              class="px-3 py-3"            
            >
              <v-card-text elevation="0"> 
                Procesando....

                        <v-progress-linear
                        height="7"
                        indeterminate
                        rounded
                        color="primary"
                      ></v-progress-linear>
              </v-card-text>

            </v-card>
          </v-dialog>
        </div>
      </template>


      <template>
        <div class="text-center">
          <v-dialog
            v-model="dialogerror"
            width="500"
            persistent
          >
            <v-card>
            <v-divider></v-divider>
              <v-card-text class="py-0 px-3">
                  <v-alert v-if="errores"
                  outlined
                  color="red"
                  class="mt-3"
                  type="error"
                  
                  >
            
                    <div>
                      <p v-for="(error,i) in errores" :key="i">
                        {{error[0]}}
                      </p> 
                        
                    </div>
                  </v-alert>

                  <v-alert v-if="errores_api_codigo"
                    border="right"
                    colored-border
                    class="mt-3"
                    type="info"
                    elevation="0"
                  >
                    {{errores_api_codigo}}
                  </v-alert>

                  <v-alert v-if="errores_api_email_title"
                    border="right"
                    elevation="0"
                    text
                    class="mt-3"
                    type="warning"
                  >
                  <strong>{{errores_api_email_title}}</strong> <v-divider></v-divider>
                  {{errores_correo}}
                    
                  </v-alert>

                  <v-alert
                    v-if="errores_api"
                    class="mt-3"
                    text
                    prominent
                    type="error"
                    icon="mdi-cloud-alert"
                  >
                    {{errores_api}}
                  </v-alert>
              </v-card-text>

              <v-card-actions class="px-0 py-0">
                
                <v-btn
                  color="primary"
                  text
                  class="mx-auto mb-1"
                  @click="dialogerror = false"
                >
                Cerrar
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
      </template>

  </div>
</v-container>
</template>

<script>
import Form from "vform";
import axios from 'axios';
import { resolve } from 'url';
//import { response } from 'express';

export default {
  layout: "home_layout",

  data(){
    return{

    
      form:new Form({
          codigo: "",
          password: "",
          password_confirmation: "", 
      }),

      mustVerifyEmail: false,
      message: "",
      correo: "",

      errores:'',
      errores_api:'',
      errores_api_codigo:'',
      errores_api_email_title:'',
      errores_correo:'',
      dialogerror:false,
      dialog_load:false,
      //dialogconfirm:false,
    }
  },mounted(){
   // this.datosuser();
   this.fecthfacultad();
  },  
  methods:{
    async register() {
          this.errores='';
          this.errores_api_codigo='';
          this.errores_api_email_title='';
          this.errores_correo='';
          this.errores_api='';

       await this.form.post("/api/register").then(response=>{
            console.log(response.data);
            // Must verify email fist.
            if(response.data=='ERROR_1'){
              this.errores_api_codigo='el codigo ingresado no existe'
              this.dialogerror=true;
            }else if(response.data=='ERROR_CORREO'){
               this.errores_api_email_title='No se econtro un correo institucional asociado a este codigo'
               this.errores_correo='Te recomendamos ir a tu cuenta de extranet y actualizar tu correo institucional '
               this.dialogerror=true;
            }else if(response.data=='ERROR_API'){
                this.errores_api='algo salio mal intentalo mas tarde o comunicate con el soporte tecnico'
                this.dialogerror=true;
            }
            if (response.data.status) {
              // this.loading=false;
              this.mustVerifyEmail = true;
              this.message = response.data.status;
              this.correo = response.data.correo;
            } 
           this.dialog_load=false;
       }).catch(error=>{
            if(error.response.status === 422){
                  this.errores=error.response.data.errors;                      
                  //console.log(this.errores);
                  this.dialogerror=true;

                }
                this.dialog_load=false;
        });

    },
    
  }

  
};
</script>
<style scoped>
.main {
 /* background-image: url("/img/bg-login.jpg");*/
  background-image:linear-gradient(rgba(11, 28, 61, 0.9), rgba(0, 0, 0, 0.4)), url("/img/fondo_grados.jpg");
  background-size: cover;
}

.img {
  height: 7.5rem;
  width: 7.5rem;
  padding: 0.5rem;
}
</style>
