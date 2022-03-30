<template>
  <div class="mx-4 mt-5">
    <v-card elevation="0" flat class="mb-2 d-flex" >
      <v-card-title class="px-0 py-1 ml-3 text-h6">{{nomtramite.tipo_tramite}}</v-card-title>
    </v-card>
    <v-stepper v-model="e1" >
      <v-stepper-header>
        <v-stepper-step
          v-for="(fase,i) in parseInt(this.numfases,10)" :key="i" 
          :complete="e1 > (fase)"        
          :step="fase"
      
         
        >
          fase {{fase}}
        </v-stepper-step>

      </v-stepper-header>

      <v-stepper-items>
      
        <v-stepper-content
        v-for="(fase,i) in fases" :key="i"
        :step="i+1" 
         >
          <v-card
            class="mb-5 mt-0"
            elevation="0"
            style="min-height:350px;"
          >
            <v-card-title class="my-0">{{fase.nombre}}</v-card-title>
            <v-btn 
            color="#2cdd9b" 
            class="mb-2 text-capitalize" 
            style="color:#fff;" elevation="0"
             @click="mostrarrequisito(fase.id)">
             Requisitos
             <v-icon dark right>mdi-arrow-down</v-icon>
             </v-btn>

            <v-divider></v-divider>
            <v-list-item-group
                v-model="selectedItem"
                color="primary"
                mandatory
                
            >
                <v-list-item
                v-for="(requisito, i) in requisitos"
                :key="i"
                >
                <v-list-item-icon>
                    <v-icon >mdi-check-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title class="d-flex" >{{requisito.nombre}}  
                          <v-btn 
                            class="ml-auto text-capitalize" 
                            color="#00C897" 
                            outlined
                            rounded
                            small
                            @click="verformato(requisito)"
                           >
                              <v-icon dark>
                                 mdi-eye
                              </v-icon>
                              ver formato
                          </v-btn>
                          <v-btn 
                            class="ml-2" 
                            color="indigo" 
                            dark 
                            small
                            @click="openmodal(requisito)">
                              <v-icon dark>
                                 mdi-cloud-upload
                              </v-icon>
                          </v-btn>
                    </v-list-item-title> 

                </v-list-item-content>
                </v-list-item>
            </v-list-item-group>

          </v-card>

          <v-btn color="warning" style="color:#fff;" rounded @click="atras()">
           <v-icon dark left>
            mdi-arrow-left
           </v-icon>
            atras
          </v-btn>
          <v-btn
            color="primary" rounded 
            @click="siguiente()"           
          >Continuar
          <v-icon dark right>
            mdi-arrow-right
           </v-icon>            
          </v-btn>

        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
    
      <template>
        <div class="text-center">
          <v-dialog
            v-model="dialog"
            width="500"
          >
            <v-card>
              <v-card-title class="text-h5 " style="background:#2cdd9b; color:#fff;">
                Subir archivo
              </v-card-title>
              <v-card-text>
                <strong>Documento: </strong>{{documento }} <br/>
                <strong>Tipo de archivo: </strong>{{extension}}
                 <v-file-input
                    v-model="daterequisito.archivo"
                    label="selecciona un archivo"
                  
                     prepend-icon="mdi-file"
                    class="mt-2 mr-2"
                  ></v-file-input>
              </v-card-text>
              <v-card-text>
              {{daterequisito.archivo}}
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="#2cdd9b"      
                  rounded 
                  chip     
                  style="color:#fff;"
                  @click="guardar()"
                >
                <v-icon dark left>mdi-upload</v-icon>
                  cargar
                </v-btn>
                <v-btn
                  color="error"     
                  rounded 
                  @click="dialog = false"
                >
                 <v-icon dark >mdi-close</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
        <template>
            <div class="text-center ma-2">

                <v-snackbar
                    v-model="boxerror"
                    tile
                    color="red accent-2"
                    top
                >
                {{ subir_file_error }}

                <template v-slot:action="{ attrs }">
                    <v-btn
                    color="white"
                    text
                    v-bind="attrs"
                    @click="boxerror = false"
                    >
                    Close
                    </v-btn>
                </template>
                </v-snackbar>
            </div>
        </template>
      </template>

      <template>
        <div class="text-center">
          <v-dialog
            v-model="dialog2"
            width="500"
          >
            <v-card>
              <v-card-title class="text-h5 " style="background:#ffc136; color:#fff;">
                Formato del requisito
              </v-card-title>
              <v-card-text>
                  <v-container fluid>
                  <v-textarea
                    clearable
                    clear-icon="mdi-close-circle"
                    label="Formato"
                    :value="content"
                  ></v-textarea>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="#2cdd9b"      
                  rounded 
                  chip     
                  style="color:#fff;"
                >
                <v-icon dark left>mdi-download</v-icon>
                  Descargar
                </v-btn>
                <v-btn
                  color="error"     
                  rounded 
                  @click="dialog2 = false"
                >
                 <v-icon dark >mdi-close</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
      </template>
  </div>    
</template>


<script>

import axios from 'axios';
import Form from "vform";
export default {
    data(){
        return{
          e1: 1,
          nomtramite:[],
          fases:[],
          numfases:'',
          requisitos:[],
          dialog:false,
          
         
          documento:'',
          extension:'',

          dialog2:false,
          content:'',

          requser:[],

          daterequisito: new Form({
             archivo:null,
             idfaserequi:'',
             tramite:this.$route.params.id,          
          }),

          subir_file_error:'',
          boxerror:false,
         
        }
    },mounted(){
        this.fetchtramite();
       // this.fetchfase();
        this.numfase();
    },methods:{
      siguiente(){            
        if(this.e1<this.numfases){
         this.e1=this.e1+1;
          this.requisitos='';
        }
      },
      atras(){
        if(this.e1<=this.numfases && this.e1>1 ){
         this.e1=this.e1-1;
          this.requisitos='';
        }
      },
      async fetchtramite(){
         const { data } = await axios.get(`/api/tramite/${this.$route.params.id}`);   
         this.nomtramite = data;
        // this.codigoproc=this.nomtramite.proceso_id;
         //console.log(this.codigoproc)
          this.fetchfase(this.nomtramite.proceso_id)
      },async fetchfase($id){
         const { data } =await axios.get(`/api/fasestramite/${$id}`);   
         this.fases = data.fases;
         this.numfases=data.cantidad;
      },async mostrarrequisito(id){ 
          const {data}=await axios.get(`/api/alu-faserequisito/${id}/${this.$route.params.id}`);
          this.requisitos=data;
          console.log(data);
      },openmodal(requisito){        
        this.daterequisito.idfaserequi=requisito.id;
        this.documento=requisito.documento;
        this.extension=requisito.extension;
       // this.requser=requisito;
        this.dialog=true;
      },async guardar(){
        console.log(this.daterequisito);  
        await this.daterequisito.post(`/api/alu-filerequisito/`).then(response=>{
          console.log(response.data);

        }).catch(error=>{
          if(error.response.status === 422){
                const errores_R=error.response.data.errors;
              //  console.log(errores_R),                      
                this.subir_file_error=errores_R.archivo[0];
                //console.log(this.subir_file_error)
                this.boxerror=true;
              }
          });

      },verformato(requisito){
         this.dialog2=true;
         this.content=requisito.nombre;
      }
    }
}
</script>