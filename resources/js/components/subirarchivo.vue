 
            <template>  
                <v-card elevation="0">
                  <v-card-title class="text-h6 d-flex" style="background:#2cdd9b; color:#fff;">
                   subir archivo
                    <v-btn
                      class="ml-auto"
                      color="error"     
                      rounded 
                      @click="cerrar_modal()"
                    >
                      Cerrar
                      <v-icon dark >mdi-close</v-icon>
                    </v-btn>
                  </v-card-title>
                  <v-card elevation="0">
                    <v-row no-gutters>
                      <v-col cols="12" md="4">
                        <v-card-text>
                          <strong>Requisito: </strong>{{nom_requisito }} <br/>
                          <strong>Documento: </strong>{{documento }} <br/>
                          <strong>Tipo de archivo: </strong>{{extension}}
                          <v-file-input
                              v-if="subir==true"
                              v-model="daterequisito.archivo"
                              label="selecciona un archivo"                           
                              prepend-icon="mdi-file"
                              class="mt-2 mr-2"
                              @change="vistaprevia"
                            ></v-file-input>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn
                            v-if="subir==true"
                            color="#2cdd9b"      
                            rounded 
                            chip     
                            v-bind:disabled="subir==false?true:false"
                            style="color:#fff;"
                            @click="guardar()"
                          >
                            <v-icon dark left>mdi-upload</v-icon>
                            {{nom_btn}}
                          </v-btn>
                           <v-btn 
                            class="text-capitalize" 
                            color="#FFD93D"  
                            style="color:#fff;"                           
                            rounded
                            @click="verformato(requisito)"
                           >
                              <v-icon dark>
                                 mdi-eye
                              </v-icon>
                              ver formato
                          </v-btn>

                        </v-card-actions>
                          <div v-if="observacion">
                             <v-subheader class="font-weight-medium text-md-body-1 d-flex">{{nom_obser}}:</v-subheader>
                              <v-alert 
                                border="left"
                                colored-border
                                type="warning"
                                elevation="2"
                                class="mx-2"
                              >
                              {{observacion}}
                            </v-alert>                                                        
                          </div>
                      </v-col>
                      <v-col cols="12"  md="8" style="height:100ch;" >   
                        <v-card height="95%" width="95%" class="my-2 mx-2 d-flex" >
                        
                        <embed v-if="daterequisito.archivo" :src="url_document" type="application/pdf" width="100%" height="100%"/> 
                          <v-card v-else class="d-flex mx-auto my-auto"  width="300px" height="150px"  elevation="0"
                           style=" justify-content:center; align-items: center; text-align: center;">
                            <div >
                              <v-icon color="#2cdd9b" class="text-h1">mdi-eye</v-icon>
                              <v-card-title>Vista previa</v-card-title>
                            </div>                          
                          </v-card>
                         
                        </v-card>                 
                                          
                      </v-col>
                    </v-row>                                    
                  </v-card>
                </v-card>
            </template>
    

<script>
export default {
    name:"Subirarchivo",
   data(){
        return{
          //dialog:false,
          nom_requisito:'a',
          documento:'a',
          extension:'a',
          subir:true,
          msg_file:'asd',
          nom_btn:'asd',
          nom_obser:'',
          observacion:'',

          daterequisito: new Form({
             archivo:null,
             idfaserequi:'',
             tramite:this.$route.params.id,          
          }),
          subir_file_error:'',
          boxerror:false,
          url_document:'',
        }
    },methods:{
        cerrar_modal(){
         this.daterequisito.archivo='';
         this.url_document='';
         this.dialog=false;
      }, 
    }
}
</script>