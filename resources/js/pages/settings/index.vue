<template>
  <v-card class="mt-3 mx-4 card-shadow" style="min-height:660px;" >
    <v-toolbar
      flat
      color="#073c72"
      dark
    >
      <v-toolbar-title > Mi Perfil</v-toolbar-title>
    </v-toolbar>
     <v-divider></v-divider>
    <v-tabs orizontal centered>
      <v-tab>
        <v-icon left>
          mdi-account
        </v-icon>
        Tu información
      </v-tab>
      <v-tab >
        <v-icon left>
          mdi-pencil
        </v-icon>
        Editar Perfil
      </v-tab>
      
     <v-tab >

        <v-icon left >
          mdi-lock
        </v-icon>
        Cambiar Contraseña
      </v-tab >
     
       <!-- Datos Generales -->
      <v-tab-item >
        <v-container >
        <v-card class="pa-10" elevation="0">
          <div class="d-flex flex-wrap mb-5 ">
            <v-avatar size="70" v-if="user.genero =='0'">
              <img src="/img/mujeravatar.png">                
            </v-avatar>
            <v-avatar size="70" v-if="user.genero =='1'">
              <img src="/img/hombreavatar.png">                       
            </v-avatar>
            <div class="ml-3"> 
              <strong class=" text-h6 font-weight-bold">{{user.nombre+' '+ user.apellido1+' '+ user.apellido2}}</strong>
                <p v-if="user.Codigo" ><strong>Codigo: </strong>{{user.Codigo}}</p>
            </div>                     
          </div>
          <hr>
          <div  class="my-3 mx-2" style="display:flex ;justify-content: space-around;  flex-wrap: wrap">
            <div>
            <p class="mb-0"><Strong>E-mail: </Strong></p>
            <p class="mb-2">{{user.email}}</p>
            <p v-if="form.matricula" class="mb-0"><Strong>Ingreso: </Strong></p>
            <p v-if="form.matricula" class="mb-2">{{form.matricula}}</p>          
            <p class="mb-0"><Strong>Fec Nacimiento: </Strong></p>
            <p class="mb-2">{{form.Nacimiento}}</p>
             <p class="mb-0"><Strong>Documento: </Strong></p>
            <p class="mb-2">{{form.Documento}}</p>
            </div>
            <div>
            <p class="mb-0"><Strong>Dirección: </Strong></p>
            <p class="mb-2">{{form.Direccion}}</p>
            <p v-if="user.curricula" class="mb-0"><Strong>Curricula:</Strong></p>
            <p v-if="user.curricula" class="mb-2">{{form.curricula}}</p>
            <p class="mb-0"><Strong>Celular: </Strong></p>
            <p class="mb-2">{{form.Ncelular}}</p>          
            </div>
          </div>
            <hr>
             <div class="my-3 mx-2" style="display:flex ;justify-content: space-around;  flex-wrap: wrap">
             <div>        
            <p class="mb-0" v-if="user.Egreso"><Strong>Año De Egreso: </Strong></p>
            <p class="mb-2" v-if="user.Egreso">{{form.Egreso}}</p>
            <p class="mb-0"><Strong>Abreviatura De Grado: </Strong></p>
            <p class="mb-2">{{form.Abreviatura}}</p>
            </div> 
             <div>
            <p class="mb-0"><Strong>Grado de estudios:</Strong></p>
            <p class="mb-2">{{form.GradoEstudios}}</p>
            </div>
          </div>
        </v-card>
        </v-container>
      </v-tab-item>
       <!-- Editar Perfil -->
      <v-tab-item>        
        <v-container >
        <v-card class="d-flex justify-center " elevation="0">
          <form @submit.prevent="updateper" @keydown="form.onKeydown($event)">
            <v-row style="display:flex ;justify-content: space-around; " class="ma-1">
              <v-bottom-sheet v-model="sheet">
                <v-sheet
                  class="text-center"
                  height="200px"
                >
                  <div class="py-3">
                <alert-success :form="form" :message="$t('info_updated')" />
                  </div>
                </v-sheet>
              </v-bottom-sheet >
              <!-- numero -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.Ncelular"
                  type="numeric"
                  name="Ncelular"
                  label="Numero Celular"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                 
                ></v-text-field>
              </v-col>
              <!-- DIRECCION -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.Direccion"
                  type="text"
                  name="Direccion"
                  label="Direccion"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  
                ></v-text-field>
              </v-col>
                  <!-- Año de egreso-->
              <v-col
                cols="12"
                sm="6"
                md="5"
                v-if="user.role[0]==10"
               >
                <v-text-field
                 v-model="form.Egreso"
                  type="numeric"
                  name="Egreso"
                  label="Año de Egreso"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  
                ></v-text-field>
              </v-col>  
                  <!-- fec nacimiento -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-menu
                  v-model="menufec"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="form.Nacimiento"
                      label="fecha de nacimiento"
                      prepend-icon="mdi-calendar"
                      name="Nacimiento"
                      :rules="[v => !!v || 'El campo es requerido']"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="form.Nacimiento"
                    @input="menufec = false"
                  ></v-date-picker>
                </v-menu>
              </v-col>
                  <!-- Grado de estudios-->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.GradoEstudios"
                  type="text"
                  name="GradoEstudios"
                  label="Grado De estudios"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  
                ></v-text-field>
              </v-col>
                  <!-- ABREVIATURA GRADO -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.Abreviatura"
                  type="tex"
                  name="Abreviatura"
                  label="Abreviatura De Grado"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  
                ></v-text-field>
              </v-col>
                 <!-- documento -->
              <v-col
                cols="12"
                sm="6"
                md="5"
                class="d-flex"
               >
                <v-select
                  v-model="form.tipoDocumento"
                  :items="tipodocs"
                  label='tipo de documento'
                  item-text="nombre"
                  item-value="num"                                
                  return-object
                  elevation="0"
                  style="height:55px; width:150px;"
                  ></v-select>
                <v-text-field
                  v-model="form.Documento"
                  type="numeric"
                  name="Documento"
                  label="Numero De Documento"
                  :rules="[v => !!v || 'El campo es requerido']"
                  hint="DNI o PASAPORTE"
                  required
                  class="ml-2"
                  
                ></v-text-field>
              </v-col>
            </v-row>
                  <!-- Submit Button -->
            <div class="text-center mb-5" row  justify-space-around>
              <v-btn :loading="form.busy" 
              type="success"
                color="cyan darken-1"
                levation="15"
                large
                small
                x-small
                @click="sheet = !sheet"
                >
                <v-icon left>
                  mdi-update
                </v-icon>
                 Actualizar
              </v-btn>     
            </div>
          </form>
        </v-card>
        </v-container>
      </v-tab-item>
      <v-tab-item>
        <v-card flat elevation="0">
          <router-view></router-view>
        </v-card>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>
<script>

import Form from "vform";
import { mapGetters } from "vuex";

export default {
  middleware: "auth",
  scrollToTop: false,
 
  data: () => ({
      menufec: false,
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail no es valido',
      ],
    form: new Form({
      email: "",
      curricula:"",
      matricula:"",
      Direccion:"",
      Ncelular:"",
      Nacimiento:"",
      GradoEstudios:"",
      Abreviatura:"",
      Egreso:"",
      Documento:"",
      tipoDocumento:'',
    }),
    tipodocs:[{nombre:'DNI',num:1},{nombre:'PASAPORTE',num:2}],

    
  }),
computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    linksVerified: function () {
      return [{ name: "Inicio", path: "/home" }];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
     mostrarRol:function(){
       return this.user;
     }
  },
linksVerified: function () {
      return [{ name: "Inicio", path: "/home" }];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
  created() {
    // Fill the form with user data.
    this.form.keys().forEach((key) => {
      this.form[key] = this.user[key];
    });
  },

    methods: {
    async updateper() {
      const { data } = await this.form.patch("/api/settings/profile");

      this.$store.dispatch("auth/updateUser", { user: data });
    },
  },
};
</script>
<style>
.card-shadow{
    box-shadow: 0 2px 12px -1px rgb(85 85 85 / 8%), 0 4px 12px 0 rgb(85 85 85 / 6%), 0 1px 12px 0 rgb(85 85 85 / 3%) !important;
}
</style>
