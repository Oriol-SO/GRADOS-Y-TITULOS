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

                            <v-btn v-if="tramite.grado==2" color="green accent-3" class="text-capitalize mt-3" small @click="revisar_docu()">Revisar proyecto</v-btn>    

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
                                                        <v-list-item-title >{{requisitoP.nombre}}  
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

                                             <v-divider></v-divider>
                                <v-list >
                                    <v-subheader class="font-weight-medium text-md-body-1 d-flex" style=" height: auto;"  v-if="requisitos.length" >
                                        REQUISITOS
                                        <div>
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
                                    <div style="overflow:auto; max-height:400px;">
                                        <v-list-item
                                            v-for="(requisito, i) in requisitos"
                                            :key="i"
                                            color="black"
                                            class="mt-1"
                                            v-bind:style="requisito.conforme.length>0?'background:#5dff97e3;':(requisito.observacion.length>0?'background:#ffec70;':'') "
                                            
                                        >
                                            <v-list-item-icon>
                                                <v-icon >mdi-check-outline</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content  >
                                                <v-list-item >
                                                    <v-row>
                                                        {{requisito.nombre}}  
                                                        <div class="ml-auto my-2">
                                                            <!--div v-if="requisito.revisado.length>0">revisado</div-->
                                                            <v-chip
                                                            v-if="requisito.modificado[0]==1"
                                                            color="#ff9400"
                                                            text-color="#fff"
                                                            >                       
                                                                Actualizado
                                                                <v-avatar
                                                                    rigth
                                                                    class="amber accent-3 ml-1"
                                                                    text-color="#fff"
                                                                >
                                                                <v-icon>mdi-cog-clockwise</v-icon>
                                                                </v-avatar>
                                                            </v-chip>  
                                                            <v-btn 
                                                                v-if="requisito.conforme.length>0"
                                                                class=" text-capitalize" 
                                                                color="#1f6effc9" 
                                                                text-color="#fff"
                                                                dark 
                                                                small
                                                                @click="revisar(requisito)">
                                                                <v-icon dark>mdi-eye-check</v-icon>
                                                            </v-btn>
                                                            <v-btn  
                                                                v-else-if="requisito.archivo.length>0"                                   
                                                                class=" text-capitalize" 
                                                                color="#2cdd9b" 
                                                                text-color="#fff"
                                                                dark 
                                                                small
                                                                @click="revisar(requisito)">
                                                                Ver
                                                            </v-btn>

                                                        </div>
                                                    </v-row>
                                                </v-list-item> 
                                            </v-list-item-content>
                                        </v-list-item>
                                    </div>
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
        <v-row justify="center">
            <v-dialog
            v-model="dialogR"
            fullscreen
            transition="dialog-bottom-transition"
            >
                <v-card elevation="0">
                    <v-toolbar
                    dark
                    color="primary"                
                    >

                    <v-toolbar-title class="d-flex" style="overflow:auto;">{{nom_estado_req}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn
                        text
                        @click="cerrar_modal()"
                        >
                        <v-icon>mdi-close</v-icon> Cerrar
                        </v-btn>
                    </v-toolbar-items>
                    </v-toolbar>
                        <v-card elevation="0">
                            <v-card-title  class="text-subtitle-1">
                                {{requisitoRevisar}}
                            </v-card-title>
                            <v-card class="mx-4 " elevation="0" >
                                    <v-row no-gutters >                                
                                        <v-col  cols="12" md="4" v-if="revisar_req==true">                                                       
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
                                                    label="Aprovar"
                                                    @click="conforme()"
                                                    ></v-switch>
                                                </v-alert>
                                                    <v-btn 
                                                        class=" text-capitalize" 
                                                        color="#fda70b" 
                                                        rounded
                                                        text-color="#fff"
                                                        style="color:#fff;"
                                                        @click="verformato(requisito)"
                                                    >
                                                        <v-icon dark>
                                                            mdi-eye
                                                        </v-icon>
                                                        ver formato
                                                    </v-btn>     
                                                    <v-btn
                                                        color="#2cdd9b"
                                                        text-color="#fff"
                                                        class=" text-capitalize" 
                                                        rounded
                                                        style="color:#fff;"
                                                        @click="revisarReq()"
                                                        >
                                                        Guardar
                                                    </v-btn>                                  
                                            </v-card-actions>
                                        </v-col>  
                                        <v-col cols="12"  md="8" style="height:100ch;" class="mx-auto" >
                                            <v-card  height="95%" width="95%" class="my-2 mx-2 d-flex" >
                                            <embed :src="urlrequisito" type="application/pdf" width="100%" height="100%"/>
                                            </v-card>
                                        
                                        </v-col>
                                    </v-row>   
                            </v-card>            
                            
                    
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
                        {{ revisar_errores }}

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
            panel:'',

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

            //dailog
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


            //revisar requisito

            dialogR:'',
            nom_estado_req:'',
            revisar_req:'',
            formrevisado:new Form({
                observado:false,
                aprovado:false,
                observacion:'',
                revisado:'',
                file:'',
            }),
            urlrequisito:'',
            requisitoRevisar:'',





        }
    },mounted() {
        this.fetchTramite();
    },methods: {
        fetchTramite(){
            axios.get(`/api/unidad-tramite/${this.$route.params.id}`).then(response=>{
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
            axios.get(`/api/unidad-fases/${$id}`).then(response=>{
                this.fases = response.data.fases;
                this.fasestramite=response.data.fases_tramite;
                //this.numfases=response.data.cantidad;
                this.fases.forEach(
                    element =>{if(element.fase_num==this.fase_actualy){this.panel=element.numero}}
                );
                //console.log(this.panel)
            });                
        },
        async mostrarrequisito(id){
            const {data}=await axios.get(`/api/unidad-faserequisito/${id}/${this.$route.params.id}`);
            this.requisitos=data.revisar;
            this.requisitosPropios=data.propios;
            this.id_fase=id;
            this.requisitos_aprovados=data.aprovados;
            this.requisitos_observados=data.observados;
            this.requisitos_aprovadosPropios=data.aprovadosPropios;
            this.requisitos_observadosPropios=data.observadosPropios;
            this.requisitos_subidosPropios=data.subidosPropios;
            //console.log(data);
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
            this.formrevisado.aprovado=false;
            this.formrevisado.observado=false;
            this.formrevisado.observacion='';
            this.dialogR=false;   
        },


        //revisar req
        obser(){
          this.formrevisado.aprovado=false;
          this.formrevisado.revisado=0;
        },
        conforme(){
            this.formrevisado.observado=false;
            this.formrevisado.observacion='';
            this.formrevisado.revisado=1;
        } ,
        async revisar(requisito){
          this.nom_estado_req='Revisar requisito';
          this.formrevisado.aprovado=false;
          this.formrevisado.observado=false;
          this.revisar_req=true;
          this.requisitoRevisar=requisito.nombre.toUpperCase();
          this.urlrequisito=requisito.archivo[0].path;
          this.formrevisado.file=requisito.archivo[0];

          if(requisito.conforme.length>0){
              this.formrevisado.aprovado=true;
              this.revisar_req=false;
              this.nom_estado_req='Este requisito esta aprobado';



          }else if(requisito.observacion.length>0){
              this.formrevisado.observado=true;
              this.formrevisado.observacion=requisito.observacion[0].texto;
              if(requisito.modificado[0]===1){
                   this.nom_estado_req='Levantar la observacion de este requisito';
              }
          }
            this.dialogR=true;
        },
        async revisarReq(){
          console.log(this.formrevisado);
          await this.formrevisado.post(`/api/unidad-revisarrequisito`).then(response=>{
              console.log(response.data);
                if(response.data===1){
                     this.revisar_errores='selleciona una opcion si quieres guardar cambios';
                     this.boxerror=true; 

                }else if(response.data===2){
                     this.revisar_errores='ya fue aprobado este documento';
                     this.boxerror=true;
                }
                else{
                     this.mostrarrequisito(this.id_fase);
                     this.dialogR=false;
                }
               
          }).catch(error=>{
                if(error.response.status === 422){
                      const errores_R=error.response.data.errors;                      
                      this.revisar_errores='indica la observacion si quieres guardar cambios';
                       this.boxerror=true;
                    }
              }); 
          
          
        },

    },
    
}
</script>

