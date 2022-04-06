<template >
<div class="d-flex ml-4 mr-4" style="height:100%; ">
    <v-card class=" my-auto mx-auto">
      <v-card-title class="d-flex">
        <span class="text-h5">Registrate</span>     
            <v-btn
              right
              color="warning"
              @click=" $router.push({ path: `/login`, }) "  
              class="ml-2"
            >
              Atras
            </v-btn>
      </v-card-title>
      <v-card-text>
   
            <v-col
              cols="15"
              md="8"
              class="d-flex"
            >
              <v-text-field
                v-model="form.codAlu"
                label="Codigo de alumno"
                required
                autocomplete="new-text"
                style="max-width:250px;"
                class="my-auto"
              ></v-text-field>
            </v-col>
            <v-col
              cols="15"
        
              md="8"
              class="d-flex"
            >
              <v-text-field
                v-model="form.password"
                label="Contraseña"
                type="password"
                required
                autocomplete="new-text"
                style="max-width:250px;"
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
                required
                type="password"
                autocomplete="new-text"
                style="max-width:250px;"
                class="my-auto "
              ></v-text-field>
              <v-btn
              color="primary"
              class="ml-4 my-auto text-capitalize"
              @click="register()"
              >
              Registrar
              </v-btn>
            </v-col>


     
       <small class="text-subtitle-2" style="color:#2778c4;">*es indispensable que toda tu informacion este Completa</small>
      </v-card-text>
  </v-card>
<template>
  <div class="text-center">
    <v-bottom-sheet
      v-model="dialogconfirm"
      persistent
      inset
    >
      <v-sheet
        class="text-center"
        height="130px"
        rounded
      >
        <v-btn
          class="mt-6"
          text
          color="error"
          @click="dialogconfirm = !dialogconfirm"
        >
         Cerrar
        </v-btn>
        <div class="py-3 text-h6">
          Te registraste exitosamente <v-icon color="#49FF00">mdi-checkbox-marked-circle</v-icon>
        </div>
      </v-sheet>
    </v-bottom-sheet>
  </div>
</template>

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
          codAlu: "",
          password: "",
          password_confirmation: "", 
      }),

      mustVerifyEmail: false,
      message: "",
      correo: "",


      facultades:[],
      escuelas:[],
      errores:'',
      dialogerror:false,
      dialogconfirm:false,
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
    async register() {
      // Register the user.
      const { data } = await this.form.post("/api/register");
      console.log(data);
      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
        this.message = data.status;
        this.correo = data.correo;
      } else {
        // Log in the user.
        const {
          data: { token },
        } = await this.form.post("/api/login");

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        await this.$store.dispatch("auth/updateUser", { user: data });

        // Redirect home.
        this.$router.push({ name: "home" });
      }
    },
    
  }

  
};
</script>
