<template>
    <div class="ml-1">
            <v-card elevation="0" flat class="mb-2 d-flex" style="align-items: center;">
               <v-card-title class="px-0 py-1 ml-3 text-h6">{{tramite.tipo_tramite}}</v-card-title>
              
            </v-card>
         
        <div>
            <v-row >
                <v-col cols="12" md="8" >
                  <v-card style="background:transparent;" elevation="0">
                        <v-subheader  style="background-color: #073c72 " class=" white--text px-0 py-2 ml-0 pl-3 text-subtitle-1">
                            Fases en las que intervienes
                        </v-subheader>     

                         <v-btn v-if="tramite.grado==2" color="primary" class="text-capitalize mt-3" small @click="open_details()">Detalles del tramite</v-btn>         
                        <v-expansion-panels                           
                            v-model="panel"
                            class="mt-4"
                            >
                            <v-expansion-panel
                                 v-for="(fase,i) in fases" :key="i"
                                 @click="limpiar()"
                            >
                                <v-expansion-panel-header class="text-h6">{{fase.nombre}}</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                     <v-btn 
                                        color="#2cdd9b" 
                                        class="mr-2 mb-2 text-capitalize" 
                                        style="color:#fff;" elevation="0"
                                        @click="mostrarrequisito(fase.id)">
                                        Requisitos
                                        <v-icon dark right>mdi-arrow-down</v-icon>
                                    </v-btn>

                                        <v-list>
                                            <v-subheader class="font-weight-medium text-md-body-1 d-flex" v-if="requisitosPropios.length">REQUISITOS A SUBIR 
                                                <div>
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
                                                            {{requisitos_subidosPropios}}
                                                            </v-avatar>
                                                        </v-chip>
                                                                        
                                                </div>
                                            </v-subheader>
                                            <v-list-item
                                                v-for="(requisitoP, i) in requisitosPropios"
                                                :key="i"
                                                class="mb-1"
                                                color="black"
                                                v-bind:style="requisitoP.archivo_subido.length>0?'background:#82b1ff;;':'' "

                                            >
                                                <v-list-item-icon>
                                                    <v-icon >mdi-check-outline</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title class="d-flex" >{{requisitoP.nombre}}  
                                                        <div class="ml-auto">                                                                                                                                                                       
                                                            <v-btn 
                                                                class=" text-capitalize" 
                                                                color="indigo" 
                                                                dark 
                                                                small
                                                                @click="openmodal(requisitoP)">
                                                                <v-icon dark v-if="requisitoP.archivo_subido.length>0">
                                                                mdi-eye
                                                                </v-icon>
                                                                <v-icon v-else-if="requisitoP.revisado_observado.length>0 && requisitoP.modificado[0]==0" dark> mdi-file-edit</v-icon>
                                                                <!--v-icon v-else-if="requisito.revisado_observado.length>0 && requisito.modificado[0]==1" dark> mdi-eye</v-icon-->

                                                                <v-icon v-else dark> mdi-cloud-upload</v-icon>

                                                            </v-btn>
                                                        </div>  
                                                    </v-list-item-title> 

                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-btn v-if="requisitosPropios.length>0" 
                                                @click="notificarCambios(fase.id)" 
                                                color="primary" 
                                                elevation="0" 
                                                class="mx-auto" 
                                                >notificar Cambios
                                                <v-icon right>mdi-bell</v-icon>
                                            </v-btn>
                                            <small v-if="requisitosPropios.length>0">*Es importante que notifiques los cambios para que el tramite siga su curso</small>
                                            

                                        </v-list>

                                </v-expansion-panel-content>
                            </v-expansion-panel>

                            
                         </v-expansion-panels>

                        <v-expansion-panels class="mt-5">
                            <v-expansion-panel @click="fetchotrosreq()">
                                <v-expansion-panel-header class="text-h6" color="blue-grey lighten-2">Otros requisitos</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                       <v-list style="background: transparent;">
                                            <v-list-item
                                            v-for="(requisito_otro, i) in requisitos_otros"
                                            :key="i"
                                            class="mb-1"
                                            style="background:#e7e7e7; border-radius: 0 30px 30px 0;"                 
                                            >
                                                <v-list-item-content>
                                                    <v-list-item-title class="d-flex" >{{requisito_otro.nombre}}  
                                                        <div class="ml-auto">
                                                                <v-btn 
                                                                v-if="requisito_otro.archivo_subido.length>0"
                                                                class=" text-capitalize" 
                                                                color="indigo" 
                                                                dark 
                                                                small
                                                                @click="open_modal_other(requisito_otro)">
                                                                    <v-icon dark>
                                                                    mdi-eye
                                                                    </v-icon>
                                                                </v-btn>
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
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                         </v-expansion-panels>
                       
                  </v-card>
                </v-col>
                <v-col ms="12" md="4">
                    <v-card class="ml-2" elevation="0" >
                    <v-subheader  style="background-color: #073c72 " class=" white--text px-0 py-2 ml-0 pl-3 text-subtitle-1">
                            Fases del tramite
                        </v-subheader>

                            <v-stepper
                            :value="fase_actualy"
                            class="mt-12"
                            vertical
                            style="display: contents;"
                            >
                            <v-stepper-header elevation="0" style="height:650px; overflow:auto; flex-wrap: nowrap; flex-direction: column;">
                                <v-stepper-step v-for="(fase,i) in fasestramite" :key="i"
                                :step="(i+1)"
                                v-bind:color="(i+1)==fase_actualy?'orange':'#6df78e'"
                                v-bind:complete="(i+1)<fase_actualy?true:false"  
                                v-bind:style="(i+1)==fase_actualy?'background:#FFA726 !important; ':''"                    
                                >
                                <strong  v-bind:style="(i+1)==fase_actualy?'color:black !important; ':''"  >{{' '+ fase.nombre}}</strong>
                                </v-stepper-step>

                            </v-stepper-header>
                            </v-stepper>
                    </v-card>
                </v-col>
            </v-row>
        </div>

    <template>
          <v-row justify="center">
            <v-dialog
              v-model="dialog"
              fullscreen
              transition="dialog-bottom-transition"
            >
            <v-card elevation="0">
                  <v-card-title class="text-h6 d-flex" style="background:#058bd9; color:#fff;">
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
        <div class="text-center ma-2">

            <v-snackbar
                v-model="alert_fase_notify"
                tile
                :color="color_alert_fase_notify"
                top
            >
            {{ msg_notify }}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="alert_fase_notify = false"
                >
                Close
                </v-btn>
            </template>
            </v-snackbar>
        </div>
    </template>


    <template>
        <v-row justify="center">
            <v-dialog
            v-model="dialog_details"
            persistent
            max-width="600px"
            >
            <v-card>
                <v-toolbar color="primary"  dark>
                Detalles de tu tramite
                </v-toolbar>
                <v-card-text>
                <v-container>
                    <v-row>
                    <v-col
                        cols="12"
                    >
                        <v-card elevation="0">
                        
                            <v-row style="justify-content: space-around; margin-top:10px">
                            <p><strong>TITULO DE PROYECTO:</strong><br>  {{titulo_proyecto}}<br><br> 
                            <strong>NUMERO DE INTEGRANTES:</strong><br> {{integrantes}}</p>
                            <p><strong>LINEA DE INVESTIGACION:</strong><br>{{linea_investigacion}}<br><br>
                            <strong>SUB LINEA DE INVESTIGACION:</strong><br>{{sub_linea_investigacion}}</p>
                            </v-row>                       
                            
                            
                            <!--v-file-input
                            truncate-length="50"
                            label="Actualiza tu plan"
                            ></v-file-input--> 
                            <v-btn small color="warning" class="text-capitalize" @click="modal_documents_titulo()">Ver plan<v-icon right>mdi-eye</v-icon></v-btn>
                            
                            
                        </v-card>

                    </v-col>
                            
                    
                    </v-row>
                </v-container>
                <small>*Toda la información es importante</small>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog_details = false"
                >
                    Cerrar
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog_details = false"
                >
                    guardar
                </v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </v-row>
    </template>

    <template>
        <v-row justify="center">
          <v-dialog
            v-model="dialog_view_doc"
            width="650px"
            height="800px"
           >
            <v-card width="100vh" height="90vh" >
             <v-toolbar color="primary"  dark>
                  <span class="text-h6">{{nom_document}}</span>
                </v-toolbar>
             
              <v-card  width="95%" height="80%" class="my-2 mx-2 d-flex" >
                  
                <embed v-if="url_document_titulo" :src="url_document_titulo" type="application/pdf" width="100%" height="100%"/> 
                  <v-card v-else class="d-flex mx-auto my-auto"  width="300px" height="150px"  elevation="0"
                     style=" justify-content:center; align-items: center; text-align: center;">
                    <div >
                      <v-icon color="#2cdd9b" class="text-h1">mdi-eye</v-icon>
                      <v-card-title>No hay documento</v-card-title>
                    </div>                          
                  </v-card>
                    
              </v-card> 
            
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="primary"
                  class="text-capitalize "
                  @click="visto_bueno()"
                >
                  Aprobar
                </v-btn>
                <v-btn
                  color="error"
                  text
                  @click="dialog_view_doc = false"
                >
                  Cerrar
                </v-btn>
              </v-card-actions>
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
            alert_fase_notify:false,
            color_alert_fase_notify:'',
            msg_notify:'',

            tramite:[],
            fase_actualy:0,
            fasestramite:[],            
            fases:[],
            panel:''
            ,

            requisitos:'',
            requisitosPropios:'',
            id_fase:'',
            requisitos_aprovados:'',
            requisitos_observados:'',
            requisitos_aprovadosPropios:'',
            requisitos_observadosPropios:'',
            requisitos_subidosPropios:'',
            requisitos_otros:[],
            
            daterequisito: new Form({
             archivo:null,
             idfaserequi:'',
             tramite:this.$route.params.id,          
            }),

            dialog:false,
            nom_requisito:'',
            documento:'',
            extension:'',
            subir:true,
            msg_file:'',
            nom_btn:'',
            nom_obser:'',
            observacion:'',
            subir_file_error:'',
            boxerror:false,
            url_document:'',
            requisitos_aprovadosPropios:'',
            requisitos_observadosPropios:'',
            requisitos_subidosPropios:'',
            id_fasereq:'',


            //details tramite
            dialog_details:false,
            titulo_proyecto:'',
            integrantes:'',
            linea_investigacion:'',
            sub_linea_investigacion:'',
            dialog_view_doc:false,
            nom_document:'Plan de tesis',

            formtram : new Form({
                tramite:'',
            })
            
           
        }
    },mounted(){
        this.fetchTramite();
       
    },methods:{
        fetchTramite(){
            axios.get(`/api/asesor-tramite/${this.$route.params.id}`).then(response=>{
                this.tramite=response.data;
                this.fase_actualy=response.data.fase_actual;
                this.fetchFases(this.tramite.proceso_id);
                this.titulo_proyecto=response.data.titulo_proyecto;
                this.integrantes=response.data.integrantes;
                this.linea_investigacion=response.data.linea_investigacion;
                this.sub_linea_investigacion=response.data.sub_linea;
                this.url_document_titulo=response.data.trabajo_plan_tesis_url;
                this.formtram.tramite=response.data.id;
            });
        },
        fetchFases($id){
            axios.get(`/api/asesor-fases/${$id}`).then(response=>{
                this.fases = response.data.fases;
                this.fasestramite=response.data.fases_tramite;
                //this.numfases=response.data.cantidad;
                this.fases.forEach(
                    element =>{if(element.fase_num==this.fase_actualy){this.panel=element.numero}}
                );
                console.log(this.panel)
            });                
        },

        async mostrarrequisito(id){
            const {data}=await axios.get(`/api/asesor-faserequisito/${id}/${this.$route.params.id}`);
            this.requisitos=data.alumno;
            this.requisitosPropios=data.propios;
            this.id_fase=id;
            this.requisitos_aprovados=data.aprovados;
            this.requisitos_observados=data.observados;
            this.requisitos_aprovadosPropios=data.aprovadosPropios;
            this.requisitos_observadosPropios=data.observadosPropios;
            this.requisitos_subidosPropios=data.subidosPropios;
            console.log(data);
        },
        limpiar(){
          this.requisitos='';
          this.requisitosPropios=''
        },
        async notificarCambios(id){
          await axios.get(`/api/notificarcambio-tramite/${id}/${this.$route.params.id}`).then(response=>{
           if(response.data==1){                  
                this.alert_fase_notify=true;
                this.msg_notify='Cambios notificados correctamente';
                this.color_alert_fase_notify='cyan darken-2';
            }else{
               this.alert_fase_notify=true;
               this.msg_notify='este tramite esta en una fase superior'
               this.color_alert_fase_notify='orange darken-2'
            }
          
          })
        },
        openmodal(requisito){        
            this.daterequisito.idfaserequi=requisito.id;
            this.documento=requisito.documento;
            this.extension=requisito.extension;
            this.nom_requisito=requisito.nombre;
            this.nom_obser='';

                this.observacion='';
                this.subir=true;
                this.nom_btn='Cargar';
                this.msg_file='Subir archivo';
            if(requisito.archivo_subido.length>0 ){
                this.subir=true;
                this.msg_file='Tu Documento';
                this.daterequisito.archivo='--'
                this.url_document=requisito.archivo_subido[0].path;
            }        
            this.dialog=true;
            
        },
        vistaprevia(){
        // console.log(this.daterequisito.archivo);
            this.url_document=URL.createObjectURL(this.daterequisito.archivo)
        },
        cerrar_modal(){
            this.daterequisito.archivo='';
            this.url_document='';
            this.dialog=false;
        },
        async guardar(){
       // console.log(this.daterequisito);  
        if(this.subir===true){
            await this.daterequisito.post(`/api/asesor-subirfilerequisito`).then(response=>{
                console.log(response.data);
                if(response.data===1){
                this.subir_file_error='ya no se admiten mas archivos'
                this.boxerror=true;
                }else{
                this.daterequisito.archivo='',
                this.mostrarrequisito(this.id_fase);
                this.cerrar_modal();
                this.fetchTramite();
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


        },

        //details tramite
        open_details(){
            this.dialog_details=true;
        },
        modal_documents_titulo(){
        this.dialog_view_doc=true;
        },
        visto_bueno(){
            this.formtram.post(`/api/asesor-vistobuenoplan/${this.$route.params.id}`).then(response=>{
                //console.log('')
                this.alert_fase_notify=true;
                this.msg_notify='plan de tesis aprobado';
                this.color_alert_fase_notify='cyan';
            })
        },

        //otros requisitos
        async fetchotrosreq(){
            await axios.get(`/api/asesor-otrosrequisitos/${this.$route.params.id}`).then(response=>{
               // console.log(response.data)
                this.requisitos_otros=response.data.otros;              
    
            });
        },
        open_modal_other(requisito){
          this.documento=requisito.documento;
          this.extension=requisito.extension;
          this.nom_requisito=requisito.nombre;
          this.daterequisito.archivo='--';
          this.msg_file='Visualizacion de documento';
          this.subir=false;
          if(requisito.archivo_subido.length>0 ){
            this.url_document=requisito.archivo_subido[0].path;
          }          
          this.dialog=true;
      },
    }
}
</script>

