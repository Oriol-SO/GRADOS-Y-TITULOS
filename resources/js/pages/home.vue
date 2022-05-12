
<template>
  <v-container class="main px-0 py-0"  fluid grid-list-md>

    
      <section id="hero">
        <v-img
          :min-height="minHeight"
          src="/img/fondo_grados.jpg"
          class="white--text"
          gradient="to bottom, rgba(11, 28, 61, .9), rgba(0,0,0,.4)"
        >
          <v-container class="fill-height px-4 py-12">
            <v-responsive
              class="d-flex align-center mx-auto"
              height="100%"
              max-width="100%"
             
            >
   
              <h1 class="text-h4 font-weight-regular mb-4 text-left white--text">
                UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRION
              </h1>
              <h1 class="text-h2 font-weight-medium mb-4 text-left white--text">GRADOS Y TITULOS</h1>

          

              <p >
               Hoy empieza un nuevo camino hacia la libertad del conocimiento para ti. Enhorabuena por el éxito en tus estudios <br>
               y vamos por el logro que te servira para toda tu vida.
              </p>

              <div
                :class="$vuetify.breakpoint.smAndDown ? 'flex-column align-start' : 'align-center'"
                class="d-flex flex-wrap"
              >
                <v-btn
                color="primary" dark class="font-weight-bold " elevation="0" x-large to="/register">
                  Comienza ahora
                </v-btn>

                <!--span class="font-weight-bold ml-6 mr-4 my-4">or</span-->

                <v-btn
                  :ripple="false"
                  class="pa-1 font-weight-bold ml-2"
                  height="auto"
                  color="#42a5f6"
                  text
                  x-large
                >
                  Inicia Session
                </v-btn>
              </div>
            </v-responsive>
          </v-container>
        </v-img>
      </section>
      <v-sheet class="mt-16 mb-16"  >
        <v-card elevation="0">
            <h1 class="text-h5 font-weight-bold mb-2 text-center" style="letter-spacing: .1875rem!important;">   NUESTRAS AUTORIDADES </h1>
            <v-responsive class="mx-auto mb-6"  style="max-width: 28px; background:#42a5f6;">
              <v-divider orizontal style="border-width: 3px 0 0 0"></v-divider>
            </v-responsive>
        </v-card>
        <v-row class="mt-5">
          <v-col cols="12" md="4">
              <v-card elevation="0" class="text-center"
              >
                <v-avatar size="200px">
                  <img
                    src="http://incubaeco.org/wp-content/uploads/2013/01/RauldelPozo.jpg"
                    alt="John"
                  >
                </v-avatar>  
                <h3 class="text-h6 font-weight-bold mb-0 text-center" style="letter-spacing: .1875rem!important;"> JUAN CASPIEDRA GOMEZ </h3>
                <div class="text-body-2 font-weight-regular mb-0 text-center grey--text"> SECRETARIO GENERAL UNO </div>
              </v-card>
          </v-col>
          <v-col cols="12" md="4">
              <v-card elevation="0" class="text-center"
              >
                <v-avatar size="200px">
                  <img
                    src="http://incubaeco.org/wp-content/uploads/2013/02/SoniaCasta%C3%B1eda2.jpg"
                    alt="John"
                  >
                  
                </v-avatar>  
                <h3 class="text-h6 font-weight-bold mb-0 text-center" style="letter-spacing: .1875rem!important;">MARIA ALBORAN CASTAÑEDA</h3>
                <div class="text-body-2 font-weight-regular mb-0 text-center grey--text"> SECRETARIA GENERAL DOS </div>
              </v-card>
          </v-col>
          <v-col cols="12" md="4">
              <v-card elevation="0" class="text-center"
              >
                <v-avatar size="200px">
                  <img
                    src="https://logicaeco.es/wp-content/uploads/franciscoromero314-1.jpg"
                    alt="John"
                  >
                  
                </v-avatar>  
                <h3 class="text-h6 font-weight-bold mb-0 text-center" style="letter-spacing: .1875rem!important;">JAVIER DEL PRADO ASTURIAS</h3>
                <div class="text-body-2 font-weight-regular mb-0 text-center grey--text"> SECRETARIO VICERRECTORADO </div>
              </v-card>
          </v-col>
        </v-row>
      </v-sheet>


      <v-sheet dark color="#212121">
        <v-container>
            <v-row class="mt-10 mb-16">
              <v-col md="5" cols="12">
                <div>
                 <h2 class="text-body-1 font-weight-regular mb-4">UNDAC</h2>
                 <P color="grey" class="text-body-1" style="color:#bdbdbd;">El sistema de grados y titulos de la undac tiene soporte todo el tiempo por los administrativos y estudiantes de la universidad,
                 si se te presenta un problema tecnico o tiene problemas con el sistema comuniquese con nosotros.</P>
                </div>
                <div>
                    <v-container>
                      <div class="d-flex mt-2">
                          <div >
                            <v-avatar class="transparent" style="height: 72px; min-width: 72px; width: 72px;">
                              <v-icon style="font-size: 36px;">mdi-map-marker-outline</v-icon>
                            </v-avatar>
                          </div>
                          <div class="ml-6">
                              <h4 class="text-uppercase  font-weight-bold mb-3 text-left white--text"> Direccion </h4>
                              <div class="base-body text-body-1 mx-auto grey--text text--lighten-1 text-left mb-0" style="max-width: 700px;">
                                <p>San Juan 234H<br>Yanacancha,Cerro de pasco
                                </p>
                              </div>
                          </div>
                      </div>
                      <v-divider dark></v-divider>
                       <div class="d-flex mt-2">
                          <div >
                            <v-avatar class="transparent" style="height: 72px; min-width: 72px; width: 72px;">
                              <v-icon style="font-size: 36px;">mdi-cellphone</v-icon>
                            </v-avatar>
                          </div>
                          <div class="ml-6">
                              <h4 class="text-uppercase font-weight-bold mb-3 text-left white--text"> Telefonos </h4>
                              <div class="base-body text-body-1 mx-auto grey--text text--lighten-1 text-left mb-0" style="max-width: 700px;">
                                <p>987 654 321<br> 951 984 962
                                </p>
                              </div>
                          </div>
                      </div>
                      <v-divider dark></v-divider>
                       <div class="d-flex mt-2">
                          <div >
                            <v-avatar class="transparent" style="height: 72px; min-width: 72px; width: 72px;">
                              <v-icon style="font-size: 36px;">mdi-email</v-icon>
                            </v-avatar>
                          </div>
                          <div class="ml-6">
                              <h4 class="text-uppercase  font-weight-bold mb-3 text-left white--text"> Email </h4>
                              <div class="base-body text-body-1 mx-auto grey--text text--lighten-1 text-left mb-0" style="max-width: 700px;">
                                <p>soporte1@postgradoundac.edu.pe<br> admin@postrgradoundac.edu.pe
                                </p>
                              </div>
                          </div>
                      </div>

                    </v-container>
                </div>
                  
              </v-col>
              <v-col cols="2" class="text-center">
                <v-divider  vertical></v-divider>
              </v-col>             
              
              <v-col md="5" cols="12">
                <h3 class="text-uppercase text-h6 font-weight-bold mb-1 text-left white--text" style="letter-spacing: .1875rem!important;"> ENVIANOS UN MENSAJE</h3>
                  <template class="mt-3">
                    <v-form >
                      <v-container>
                        <v-row>
                          <v-col
                            cols="12" 
                            class="py-0"                           
                          >
                            <v-text-field
                              outlined
                              label="Nombres"
                              dense
                              required
                            ></v-text-field>
                          </v-col>

                          <v-col
                            cols="12"
                             class="py-0"
                          >
                            <v-text-field
                              outlined
                              label="Correo"
                              dense
                              required
                            ></v-text-field>
                          </v-col>

                          <v-col
                            cols="12"
                           class="py-0"
                          >
                            <v-text-field                           
                              outlined
                              label="Asunto"
                              dense
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" class="py-0">
                            <v-textarea 
                              outlined 
                              dense
                              label="Describe.."
                            ></v-textarea>
                          </v-col>
                          <v-card-actions>
                            <v-btn x-large outlined color="#fff" >ENVIAR MENSAJE</v-btn>
                          </v-card-actions>
                        </v-row>
                      </v-container>
                    </v-form>
                  </template>
              </v-col>

            </v-row>
        </v-container>
      </v-sheet>
    
    <!--v-layout row wrap align-space-between justify-space-between fill-height>
      <v-flex style="text-align:center;">
        <v-layout align-center justify-center fill-height  >
          <div   >      
            <p class=" text-center text-justify"
               style="font-size:70px; font-family: 'Vollkorn', serif; display: contents; ">
                Grados y Títulos <br>
            </p  > 
                 <hr>Universidad Nacional Daniel Alcides Carrion <hr>
          </div>  
        </v-layout> 
      </v-flex>
      <v-flex class=" d-flex align-center">    
        <v-img max-height="800" width="800"
              class=" darken-1" src="/img/home.png" />
      </v-flex >
    </v-layout-->
  </v-container>
</template>
<script>
export default {
    layout: "home_layout",   

    computed: {
      minHeight () {
        const height = this.$vuetify.breakpoint.mdAndUp ? '100vh' : '50vh'

        return `calc(${height} - ${this.$vuetify.application.top}px)`
      },
    },
}
</script>
<!--style scoped>
.main {
  background-size: cover;
  height: 100%;
  background:#f5f7ff;
}
</style-->