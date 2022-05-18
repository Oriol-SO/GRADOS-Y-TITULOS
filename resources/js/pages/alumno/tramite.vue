<template>
  <div class="mx-4 mt-5">
    <v-card elevation="0" flat class="mb-2 d-flex" >
      <v-card-text class="px-0 py-1 ml-3 text-h6">{{nomtramite.tipo_tramite}}</v-card-text>
    </v-card>
    <v-stepper v-model="e1" >
      <v-stepper-header class="overflow-y-auto " style=" flex-wrap: nowrap">
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
            <v-card-text class="my-0"><h2>{{fase.nombre}}</h2></v-card-text>
            <v-btn 
              color="#2cdd9b" 
              class="mb-2 text-capitalize" 
              style="color:#fff;" elevation="0"
              @click="mostrarrequisito(fase.id)">
              Desplegar
             <v-icon dark right>mdi-arrow-down</v-icon>
             </v-btn>

            <v-divider></v-divider>
            <v-list v-if="requisitos.length">
            
             <v-subheader class="font-weight-medium text-md-body-1 d-flex " style="    height: auto;"  >
                    <div >
                     <v-chip
                        class="ma-2"
                        color="#95d5ff"
                        text-color="black"
                        >                       
                            Subidos
                            <v-avatar
                                rigth
                                class="blue accent-3 ml-1"
                            > 
                            {{requisitos_subidos}}
                            </v-avatar>
                        </v-chip>
                        <v-chip
                        class="ma-2"
                        color="#b3ffce"
                        text-color="black"
                        >                       
                            Aprovados
                            <v-avatar
                                rigth
                                class="green accent-3 ml-1"
                            >
                            {{requisitos_aprovados}}
                            </v-avatar>
                        </v-chip>  
                         <v-chip
                        class="ma-2"
                        color="#fbef9f"
                        text-color="black"
                        >                       
                            observados
                            <v-avatar
                                rigth
                                class="amber accent-3 ml-1"
                            >
                            {{requisitos_observados}}
                            </v-avatar>
                        </v-chip>                   
                    </div>
                </v-subheader>
                <div style="max-height:400px; overflow:auto;">
                  <v-list-item
                    v-for="(requisito, i) in requisitos"
                    :key="i"
                    class="mb-1"
                    color="black"
                    v-bind:style="requisito.archivo_subido.length>0?'background:#82b1ff;;':'' "
                  >
                    <v-list-item-icon>
                        <v-icon >mdi-check-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item 
                        class="d-flex" >
                        <v-row>
                        {{requisito.nombre}}  
                              <div class="ml-auto my-2" >
                                  <v-chip
                                    v-if="requisito.revisado_aprovado.length>0"
                                    color="#0ce559"
                                    text-color="#fff"
                                    >                       
                                        Aprovado
                                        <v-avatar
                                            rigth
                                            class="green accent-3 ml-1"
                                            text-color="#fff"
                                        >
                                      <v-icon>mdi-checkbox-marked-circle</v-icon>
                                        </v-avatar>
                                    </v-chip>
                                    <v-chip
                                    v-if="requisito.revisado_observado.length>0 && requisito.modificado[0]==0 "
                                    color="#ff9400"
                                    text-color="#fff"
                                    >                       
                                        observado
                                        <v-avatar
                                            rigth
                                            class="amber accent-3 ml-1"
                                            text-color="#fff"
                                        >
                                      <v-icon>mdi-eye-circle</v-icon>
                                        </v-avatar>
                                    </v-chip>
                                    <v-chip
                                      v-if="requisito.modificado[0]==1"
                                      color="#ff9400"
                                      text-color="#fff"
                                      >                       
                                        levantado
                                        <v-avatar
                                            rigth
                                            class="amber accent-3 ml-1"
                                            text-color="#fff"
                                        >
                                          <v-icon>mdi-cog-clockwise</v-icon>
                                        </v-avatar>
                                    </v-chip>    
                                  <v-btn 
                                    class=" text-capitalize" 
                                    color="indigo" 
                                    dark 
                                    small
                                    @click="openmodal(requisito)">
                                      <v-icon dark v-if="requisito.archivo_subido.length>0">
                                      mdi-eye
                                      </v-icon>
                                      <v-icon v-else-if="requisito.revisado_observado.length>0 && requisito.modificado[0]==0" dark> mdi-file-edit</v-icon>
                                      <!--v-icon v-else-if="requisito.revisado_observado.length>0 && requisito.modificado[0]==1" dark> mdi-eye</v-icon-->

                                      <v-icon v-else dark> mdi-cloud-upload</v-icon>

                                  </v-btn>
                              </div> 
                              </v-row> 
                        </v-list-item> 

                    </v-list-item-content>
                  </v-list-item>
                </div>
                <v-btn v-if="requisitos.length" 
                @click="notificarCambios(fase.id)" 
                color="primary" 
                elevation="0" 
                class="mx-auto" 
                >notificar Cambios
                 <v-icon right>mdi-bell</v-icon>
                </v-btn>
                <small v-if="requisitos.length">*Es importante que notifiques los cambios para que tus documentos sean revisados lo mas antes posible</small>
            </v-list>
                    
            <v-list v-else-if="requisitos_otros.length">
              <v-subheader class="font-weight-medium text-md-body-1 d-flex" >Otros Requisitos</v-subheader>
                <v-list-item
                  v-for="(requisito_otro, i) in requisitos_otros"
                  :key="i"
                  class="mb-1"
                  style="background:#e7e7e7; border-radius: 0 30px 30px 0;"                 
                >
                  <v-list-item-content>
                    <v-list-item-title class="d-flex" >{{requisito_otro.nombre}}  
                        <div class="ml-auto">
                                <v-chip
                                  color="deep-purple accent-1"
                                  text-color="#fff"
                                  >                       
                                    {{requisito_otro.rol}}
                                    <v-avatar
                                        rigth
                                        class="deep-purple accent-3 ml-1"
                                        text-color="#fff"
                                    >
                                      <v-icon>mdi-account-tie</v-icon>
                                    </v-avatar>
                                </v-chip>
                        </div>
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
            </v-list>            

           
                 <v-list v-else-if="otros_detalles.length ">
                  <v-subheader class="font-weight-medium text-md-body-1 d-flex"  >Otros Detalles</v-subheader>   
                  <v-card v-if="otros_detalles.length">
                      {{otros_detalles}}
                  </v-card>              
                </v-list>
       
         

          </v-card>

          <v-btn color="warning" style="color:#fff;" rounded @click="atras()">
           <v-icon dark left>
            mdi-arrow-left
           </v-icon>
            atras
          </v-btn>
          <v-btn
            color="primary" rounded 
            @click="siguiente(fase.id)"           
          >Continuar
          <v-icon dark right>
            mdi-arrow-right
           </v-icon>            
          </v-btn>

        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
    
        <template>
          <v-row justify="center">
              <v-dialog
              v-model="dialog"
              fullscreen
              transition="dialog-bottom-transition"
              >
                <v-card elevation="0">
                  <v-card-title class="text-h6 d-flex" style="background:#2cdd9b; color:#fff;">
                    {{msg_file}}
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
              </v-dialog>
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
          </v-row>

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
      
      <template>
        <div class="text-center ma-2">

            <v-snackbar
                v-model="boxerror2"
                tile
                color="red accent-2"
                top
            >
            {{ msg_autorized }}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="boxerror2 = false"
                >
                Close
                </v-btn>
            </template>
            </v-snackbar>
        </div>
      </template>
      
      <template>
        <div class="text-center ma-2">

            <v-snackbar
                v-model="alert_notify"
                tile
                :color="color_notify"
                top
            >
            {{msg_notify}}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="alert_notify = false"
                >
                Close
                </v-btn>
            </template>
            </v-snackbar>
        </div>
      </template>
  </div>    
</template>


<script>

import axios from 'axios';
import Form from "vform";
//
export default {


    data(){
        return{
          alert_notify:false,
          msg_notify:'',
          color_notify:'',
          e1: 1,
          nomtramite:[],
          fases:[],
          numfases:'',
          requisitos:[],
          requisitos_otros:[],
          otros_detalles:[],
          dialog:false,
          
          nom_requisito:'',
          documento:'',
          extension:'',
          subir:'',
          msg_file:'',
          nom_btn:'',
          nom_obser:'',
          observacion:'',

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
          url_document:'',

          requisitos_aprovados:'',
          requisitos_observados:'',
          requisitos_subidos:'',
          id_fasereq:'',

          //p sf
          boxerror2:false,
          msg_autorized:'',
        }
    },mounted(){
        this.fetchtramite();
       // this.fetchfase();
        this.numfase();
    },methods:{
      siguiente(idfase){            
        if(this.e1<this.numfases){
                  this.e1=this.e1+1;  //copiar este codigo
                  this.requisitos=''; //copiar este codigo
                  this.requisitos_otros='';
                  this.otros_detalles='';
         /* axios.get(`/api/alu_autorized/${idfase}/${this.$route.params.id}`).then(response=>{
              //console.log(response.data);
            if(response.data===true){
                  this.e1=this.e1+1;  //copiar este codigo
                  this.requisitos=''; //copiar este codigo
            }else{
              //this.msg_autorized='espera a que todos tus requisitos sean aprobados'; //comentaer
              //this.boxerror2=true;                                                    //comentar
                  this.e1=this.e1+1;  //copiar este codigo
                  this.requisitos=''; //copiar este codigo

              //console.log('auhn no tienes acceso a la siguiente fase');
            }
          
          });*/
          
        }
      },
      atras(){
        if(this.e1<=this.numfases && this.e1>1 ){
         this.e1=this.e1-1;
          this.requisitos='';
           this.requisitos_otros='';
              this.otros_detalles='';
        }
      },
      async fetchtramite(){
         const { data } = await axios.get(`/api/tramite/${this.$route.params.id}`);   
         this.nomtramite = data;
         this.e1=data.fase_actual;
        // this.codigoproc=this.nomtramite.proceso_id;
         //console.log(this.codigoproc)
          this.fetchfase(this.nomtramite.proceso_id)
      },async fetchfase($id){
         const { data } =await axios.get(`/api/fasestramite/${$id}`);   
         this.fases = data.fases;
         this.numfases=data.cantidad;
      },async mostrarrequisito(id){ 
          const {data}=await axios.get(`/api/alu-faserequisito/${id}/${this.$route.params.id}`);
          this.requisitos=data.alumno;
          this.requisitos_otros=data.otros;
          this.otros_detalles=data.otros_detalles;
           this.requisitos_aprovados=data.aprovados;
           this.requisitos_observados=data.observados;
           this.requisitos_subidos=data.subidos;
           this.id_fasereq=id;
          console.log(data);
      },openmodal(requisito){        
          this.daterequisito.idfaserequi=requisito.id;
          this.documento=requisito.documento;
          this.extension=requisito.extension;
          this.nom_requisito=requisito.nombre;
        // this.requser=requisito;
        this.nom_obser='';
        this.observacion='';
        this.subir=true;
        this.nom_btn='Cargar';
        this.msg_file='Subir archivo';
        if(requisito.archivo_subido.length>0 ){
            this.subir=false;
            this.msg_file='En espera de revision';
            this.daterequisito.archivo='--'
            this.url_document=requisito.archivo_subido[0].path;
           // console.log(this.url_document)
            if(requisito.modificado[0]==1){
              this.subir=false;
              this.msg_file='En espera de otra revision';
              this.nom_obser='Observaciones corregidas';
              this.observacion=requisito.revisado_observado[0].texto;
            }
            else if(requisito.revisado_aprovado.length>0){
              this.msg_file='Este requisito esta aprobado';
            }else if(requisito.revisado_observado.length>0){
                   this.msg_file='Levantar observaciones';
                   this.subir=true;
                   this.nom_btn='Actualizar';
                   this.nom_obser='Observaciones'
                   this.observacion=requisito.revisado_observado[0].texto;
            }
        }        
          this.dialog=true;
          //console.log(this.subir);
      },cerrar_modal(){
         this.daterequisito.archivo='';
         this.url_document='';
         this.dialog=false;
      },      
      vistaprevia(){
       // console.log(this.daterequisito.archivo);
        this.url_document=URL.createObjectURL(this.daterequisito.archivo)
      },
      async guardar(){
       // console.log(this.daterequisito);  
       if(this.subir===true){
        await this.daterequisito.post(`/api/alu-filerequisito/`).then(response=>{
            console.log(response.data);
            if(response.data===1){
               this.subir_file_error='ya no se admiten mas archivos'
               this.boxerror=true;
            }else{
            this.daterequisito.archivo='',
            this.mostrarrequisito(this.id_fasereq);
            this.dialog=false;
            }
      
        }).catch(error=>{
          if(error.response.status === 422){
                const errores_R=error.response.data.errors;
              //  console.log(errores_R),                      
                this.subir_file_error=errores_R.archivo[0];
                //console.log(this.subir_file_error)
                
                this.boxerror=true;
              }
          });
       }else{
          this.subir_file_error='tu archivo ya esta subido'
           this.boxerror=true;
       }


      },verformato(requisito){
         this.dialog2=true;
         this.content=requisito.nombre;
      },

      async notificarCambios(id){
          await axios.get(`/api/notificarcambio-tramite/${id}/${this.$route.params.id}`).then(response=>{
            if(response.data==1){                  
                this.alert_notify=true;
                this.msg_notify='Tus documentos fueron notificados'
                this.color_notify='cyan darken-2'
            }else{
               this.alert_notify=true;
               this.msg_notify='Tu tramite ya esta en una fase superior'
               this.color_notify='orange darken-2'
            }
  
          })
      },
    }
}

//hitler es gil
</script>