<template >
<div class="d-flex" style="height:100vh; ">
    <v-card class=" my-auto mx-auto">
      <v-card-title>
        <span class="text-h5">Registrate</span>
      </v-card-title>
      <v-card-text>
        <v-container>
            <v-col
              cols="12"
              sm="6"
              md="12"
              class="d-flex"
            >
              <v-text-field
                label="Codigo de alumno"
                required
                autocomplete="new-text"
                style="max-width:250px;"
                class="my-auto "
              ></v-text-field>

              <v-btn
              color="primary"
              class="ml-4 my-auto"
              >
              Buscar
              </v-btn>
            </v-col>
          <v-card-text class="d-flex">
              <v-row class="mr-5" >
                <v-card elevation="0" width="400">
                <v-card-title> Tu informacion</v-card-title>
                <v-divider class="mb-2"></v-divider>
                    <div class="d-flex flex-wrap mb-5">
                        <v-avatar size="75">
                          <img
                              src="/img/hombreavatar.png"
                            >                       
                        </v-avatar>
                        <div class="ml-3"> 
                          <strong class=" text-subtitle-1 font-weight-bold">Oriol Nelson Simon Orneta</strong>
                          <p><strong>Codigo: </strong>1824403021</p>
                        </div>                     
                    </div>

                    <div>
                      <v-card>
                        <div  class="my-3 mx-2">
                          <p class="mb-0"><Strong>Especialidad:</Strong></p>
                          <p class="mb-2">Ingenieria de sistemas y computacion</p>
                          <p class="mb-0"><Strong>Curricula:</Strong></p>
                          <p class="mb-2">17A4SI</p>
                          <p class="mb-0"><Strong>Ingreso: </Strong></p>
                          <p class="mb-2">26-04-2018</p>
                      </div>
                      </v-card>
                    </div>
                </v-card>

              </v-row>
            <form>
            <v-row class="ml-2">
              <v-col
                cols="12"
                sm="6"
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
                  style="height:55px; width:200px;"
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
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
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
                      v-model="form.nacimiento"
                      label="fecha de nacimiento"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="form.nacimiento"
                    :active-picker.sync="activePicker"
                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                    min="1950-01-01"
                   
                  ></v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                v-model="form.celular"
                  label="Celular"
                  autocomplete="new-text"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-menu
                  ref="menu2"
                  v-model="menu2"
                  :close-on-content-click="false"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="form.egreso"
                      label="fecha de egreso"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="form.egreso"
                    :active-picker.sync="activePicker2"
                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                    min="1950-01-01"
                   
                  ></v-date-picker>
                </v-menu>
              </v-col>
              <v-col
                cols="12"
                md="3"
              >
                <v-text-field 
                v-model="form.gradoestu"
                label="Grado de estudios" ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="3"
              >
                <v-text-field
                 v-model="form.gradoabr"
                 label="Abreviatura" ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                v-model="form.direccion"
                label="Dirección"
                autocomplete="new-text"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                v-model="password"
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
                v-model="password_confirmation"
                label="Confirmar contraseña"
                type="password"
                autocomplete="new-password"
                ></v-text-field>
              </v-col>
            </v-row>
            </form>
          </v-card-text>

        </v-container>
        <small>*es indispensable que toda tu informacion este Completa</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="blue darken-1"
          text
          @click="dialog = false"
        >
          Registrar
        </v-btn>
      </v-card-actions>
    </v-card>
</div>

</template>

<script>
import Form from "vform";

export default {
  layout: "basic",

  data(){
    return{
      activePicker: null,
     // date: null,
      menu: false,

      activePicker2: null,
     // date2: null,
      menu2: false,

      tipodocs:[{nombre:'DNI',num:1},{nombre:'PASAPORTE',num:2}],
      form:new Form({
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
          roles:[],
          codalum:'',

      }),
    }
  }, watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
      menu2(val){
        val && setTimeout(() => (this.activePicker2 = 'YEAR'))
      }
    },

  
};
</script>
