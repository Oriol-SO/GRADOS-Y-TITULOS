<template>
  <v-card>
    <v-toolbar
      flat
      color="primary"
      dark
    >
      <v-toolbar-title> Mi Perfil</v-toolbar-title>
    </v-toolbar>
    <v-tabs orizontal align-center  >
      <v-tab>
        <v-icon left>
          mdi-account
        </v-icon>
        Datos Generales
      </v-tab>
      <v-tab >
        <v-icon left>
          mdi-account
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
        <v-card class="pa-10" style="font-size:17px">
          <div class="d-flex flex-wrap mb-5 ">
            <v-avatar size="75" v-if="form.genero =='0'">
              <img src="/img/mujeravatar.png">                
            </v-avatar>
            <v-avatar size="75" v-if="form.genero =='1'">
              <img src="/img/hombreavatar.png">                       
            </v-avatar>
            <div class="ml-3"> 
              <strong class=" text-subtitle-1 font-weight-bold">{{form.nombre+' '+ form.apellido1+' '+ form.apellido2}}</strong>
                <p><strong>Codigo: </strong>{{form.Codigo}}</p>
            </div>                     
          </div>
          <hr>
          <div  class="my-3 mx-2" style="display:flex ;justify-content: space-around;  flex-wrap: wrap">
            <div>
            <p class="mb-0"><Strong>Grado de estudios:</Strong></p>
            <p class="mb-2">{{form.GradoEstudios}}</p>
            <p class="mb-0"><Strong>Curricula:</Strong></p>
            <p class="mb-2">{{form.curricula}}</p>
            <p class="mb-0"><Strong>Ingreso: </Strong></p>
            <p class="mb-2">{{form.matricula}}</p>
            <p class="mb-0"><Strong>Nacimiento: </Strong></p>
            <p class="mb-2">{{form.Nacimiento}}</p>
            </div>
            <div>
            <p class="mb-0"><Strong>Dirección: </Strong></p>
            <p class="mb-2">{{form.Direccion}}</p>
            <p class="mb-0"><Strong>E-mail: </Strong></p>
            <p class="mb-2">{{form.email}}</p>
            <p class="mb-0"><Strong>Celular: </Strong></p>
            <p class="mb-2">{{form.Ncelular}}</p>
            </div>
          </div>
        </v-card>
        </v-container>
      </v-tab-item>
       <!-- Editar Perfil -->
      <v-tab-item>        
        <v-container >
        <v-card class="d-flex justify-center ">
          <form @submit.prevent="updateper" @keydown="form.onKeydown($event)">
            <v-row style="display:flex ;justify-content: space-around; " class="ma-5">
              <v-bottom-sheet v-model="sheet">
                <v-sheet
                  class="text-center"
                  height="200px"
                >
                  <div class="py-3">
                <alert-success :form="form" :message="$t('info_updated')" />
                  </div>
                </v-sheet>
              </v-bottom-sheet justify-start>
                  <!-- Name -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                 v-model="form.nombre"
                  type="text"
                  name="name"
                  label="nombre"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  filled
                ></v-text-field>
              </v-col>  
                  <!-- Apellido pat -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.apellido1"
                  type="text"
                  name="apellido1"
                  label="Apellido Paterno"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  filled
                ></v-text-field>
              </v-col>
                  <!-- Apellido Mat-->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.apellido2"
                  type="text"
                  name="apellido2"
                  label="Apellido Materno"
                  :rules="[v => !!v || 'El campo es requerido']"
                  required
                  filled
                ></v-text-field>
              </v-col>
                  <!-- Email -->
              <v-col
                cols="12"
                sm="6"
                md="5"
               >
                <v-text-field
                  v-model="form.email"
                  type="email"
                  name="email"
                  :rules="emailRules"
                  label="E-mail"
                  required
                  filled
                ></v-text-field>
              </v-col>
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
                  required
                  filled
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
                  required
                  filled
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
        <v-card flat>
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
    emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail no es valido',
      ],
    form: new Form({
      nombre: "",
      email: "",
      apellido1:"",
      apellido2:"",
      genero:"",
      curricula:"",
      matricula:"",
      Direccion:"",
      Codigo:"",
      Ncelular:"",
      Nacimiento:"",
      GradoEstudios:"",

    }),

  }),
computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    linksVerified: function () {
      return [{ name: "Inicio", path: "/home" }];
      //return this.links.filter((link) => !(link.notUser && this.user));
    },
  },


  computed: mapGetters({
    user: "auth/user",
  }),
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