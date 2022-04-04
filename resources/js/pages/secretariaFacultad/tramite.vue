<template>
  <div class="mx-4 mt-5">
    <v-card elevation="0" flat class="mb-2 d-flex" >
      <v-card-title class="px-0 py-1 ml-3 text-h6">{{nomtramite.tipo_tramite}}</v-card-title>
    </v-card>
    <v-stepper v-model="e1" >   
      <v-stepper-header class="overflow-x-auto">
    
        <v-stepper-step 
          v-for="(fase,i) in parseInt(this.numfases,10)" :key="i" 
          :complete="e1 > (fase)"        
          :step="fase"
          editable      
          @click="limpiar()"
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
             <v-subheader class="font-weight-medium text-md-body-1 d-flex" v-if="requisitos.length" >REQUISITOS ALUMNO </v-subheader>
                <v-list-item
                    v-for="(requisito, i) in requisitos"
                    :key="i"
                >
                    <v-list-item-icon>
                        <v-icon >mdi-check-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item class="d-flex" >
                     <!-- agregado vrow  div -->

                        <v-row>
                        {{requisito.nombre}}  
                            <div class="ml-auto my-2 " >
                                <v-btn 
                                    v-if="requisito.archivo.length>0"
                                    class=" text-capitalize" 
                                    color="#2cdd9b" 
                                    text-color="#fff"
                                    dark 
                                    small
                                    @click="revisar(requisito)">
                                Revisar
                                </v-btn>
                                <v-btn 
                                    class="ml-2"                                 
                                    color="rgb(241 173 48)" 
                                    outlined
                                    rounded
                                    small
                                    @click="verformato(requisito)"
                                >
                                    <v-icon dark>
                                        mdi-eye
                                    </v-icon>
                                    
                                </v-btn>
                           </div>
                           </v-row>
                        </v-list-item> 

                    </v-list-item-content>
                </v-list-item>

            </v-list-item-group>

            <v-divider></v-divider>

            <v-list-item-group
                v-model="selectedItem"
                color="primary"
                mandatory
                
            >
                <v-subheader class="font-weight-medium text-md-body-1 d-flex" v-if="requisitosPropios.length">REQUISITOS A SUBIR </v-subheader>
                <v-list-item
                    v-for="(requisitoP, i) in requisitosPropios"
                    :key="i"
                    color="#01b559"
                >
                    <v-list-item-icon>
                        <v-icon >mdi-check-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title class="d-flex" >{{requisitoP.nombre}}  
                            <v-btn 
                                class="ml-auto text-capitalize" 
                                color="#00C897" 
                                outlined
                                rounded
                                small
                                @click="verformato(requisitoP)"
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
                                @click="openmodal(requisitoP)">
                                <v-icon dark>
                                    mdi-cloud-upload
                                </v-icon>
                            </v-btn>
                        </v-list-item-title> 

                    </v-list-item-content>
                </v-list-item>

            </v-list-item-group>

          </v-card>


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
                    v-model="archivoreq"
                    label="selecciona un archivo"
                    
                        prepend-icon="mdi-file"
                    class="mt-2 mr-2"
                    ></v-file-input>
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
                  @click="guardar()"
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

    <template>
        <v-row justify="center">
            <v-dialog
            v-model="dialogR"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            >
            <v-card>
                <v-toolbar
                dark
                color="primary"
                >
                <v-btn
                    icon
                    dark
                    @click="dialogR = false"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title class="d-flex" style="overflow:auto;">Revisar requisito</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn
                    dark
                    text
                    @click="revisarReq()"
                    >
                    Guardar
                    </v-btn>
                </v-toolbar-items>
                </v-toolbar>
                    <v-card elevation="0">
                        <v-card-title  class="text-subtitle-1">
                            {{requisitoRevisar}}
                        </v-card-title>
                           <v-card class="mx-4 "  >
                                <v-row no-gutters >
                                
                                    <v-col cols="12"  md="8" style="height:100ch;"  >
                                    <embed :src="urlrequisito" type="application/pdf" width="100%" height="100%"/>
                                    </v-col>
                                    <v-col  cols="12" md="4" >                                                       
                                        <v-card-actions class="d-block" >            
                                            <v-alert color="warning" outlined  dense class="py-0" style="max-">
                                                <div class="ml-4">
                                                    <v-switch
                                                        class="my-0"
                                                        v-model="formrevisado.observado"
                                                        color="warning"
                                                        label="Observado"
                                                        @click="obser()"
                                                    ></v-switch>
                                                    <v-banner
                                                    v-model="formrevisado.observado"
                                                    single-line
                                                    transition="slide-y-transition"
                                                    ><div fuid>
                                                        <v-textarea
                                                            clearable
                                                            color="warning"
                                                            v-model="formrevisado.observacion"
                                                            label="Indique la observación"
                                                            prepend-inner-icon="mdi-eye-plus"                                                        
                                                        ></v-textarea>
                                                    </div>


                                                    </v-banner>
                                                </div>
                                            </v-alert>
                
                                            <v-alert color="#2cdd9b" outlined dense class="py-0">
                                                     <v-switch
                                                        class="ml-4 my-0"
                                                        v-model="formrevisado.aprovado"
                                                        color="#2cdd9b"
                                                        label="Conforme"
                                                        @click="conforme()"
                                                    ></v-switch>
                                            </v-alert>

                                        
                                        </v-card-actions>
                                    </v-col>  
                                </v-row>   
                           </v-card>            
                        
                 
                    </v-card>
                
            </v-card>
            </v-dialog>
        </v-row>
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
          requisitosPropios:[],
          dialog:false,
          idrequi:'',
          archivoreq:null,
          documento:'',
          extension:'',

          dialog2:false,
          dialogR:false,
            //revisar 

            requisitoRevisar:'',

            formrevisado:new Form({
                observado:false,
                aprovado:false,
                observacion:'',
                revisado:'',
                file:'',
            }),
          

          content:'',
          urlrequisito:'',

          
        }
    },mounted(){
        this.fetchtramite();
       // this.fetchfase();
        this.numfase();
    },methods:{

      obser(){
          this.formrevisado.aprovado=false;
          this.formrevisado.revisado=0;
      },
      conforme(){
          this.formrevisado.observado=false;
          this.formrevisado.observacion='';
          this.formrevisado.revisado=1;
      } ,
      limpiar(){
          this.requisitos='';
          this.requisitosPropios=''
      },
      async fetchtramite(){
         const { data } = await axios.get(`/api/sf-tramite/${this.$route.params.id}`);   
         this.nomtramite = data;
        // this.codigoproc=this.nomtramite.proceso_id;
         //console.log(this.codigoproc)
          this.fetchfase(this.nomtramite.proceso_id)
      },async fetchfase($id){
         const { data } =await axios.get(`/api/sf-fasestramite/${$id}`);   
         this.fases = data.fases;
         this.numfases=data.cantidad;
      },async mostrarrequisito(id){
          const {data}=await axios.get(`/api/sf-faserequisito/${id}/${this.$route.params.id}`);
          this.requisitos=data.alumno;
          this.requisitosPropios=data.propios;

         // console.log(data);
      },openmodal(requisito){        
        this.idrequi=requisito.id;
        this.documento=requisito.documento;
        this.extension=requisito.extension;
        this.dialog=true;
      },async revisar(requisito){
          this.dialogR=true;
          this.requisitoRevisar=requisito.nombre.toUpperCase();
          /*await axios.get(`/api/sf-archivorequisito/${this.$route.params.id}/${requisito.id}`).then(response=>{
              //console.log(response.data[0].path);
              this.urlrequisito=response.data[0].path;
          });*/
           this.urlrequisito=requisito.archivo[0].path;
           this.formrevisado.file=requisito.archivo[0];
          
      },      
      guardar(){ 
        console.log(this.idrequi);
        console.log(this.archivoreq);
      },verformato(requisito){
         this.dialog2=true;
         this.content=requisito.nombre;
      },async revisarReq(){
          console.log(this.formrevisado);
          await this.formrevisado.post(`/api/sf-revisarrequisito`).then(response=>{
              console.log(response.data);
          });
          
          this.dialogR=false;
      }
    }
}
</script>