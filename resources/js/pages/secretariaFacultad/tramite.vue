<template>

  <div class="mx-4 mt-5">

    <v-card elevation="0" flat class="mb-2 d-flex" >
        <template >
        <v-toolbar
          class="mb-2 rounded"
          flat
          color="#40768A "
        >
          <v-toolbar-title class="white--text " >{{nomtramite.tipo_tramite}}</v-toolbar-title>
       </v-toolbar>
     </template>
      
    </v-card>
    <div>
    <v-row no-gutters >       
        <v-col class="pa-1"  cols="12" xl="9" lg="9" sm="12" xs="12" >
            <v-card >
                <v-card-title  class="px-0 py-2 ml-0 pl-3 text-h6  white--text" style="background-color: #1F94BF">Fases que te corresponden</v-card-title>
                <v-stepper v-model="e1" >
                <v-stepper-header non-linear>
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
                                <v-card-title class="pt-0 mb-3">{{fase.nombre}}</v-card-title>
                                <v-row>
                                <v-btn 
                                    color="#2cdd9b" 
                                    class="mr-2 mb-2 text-capitalize" 
                                    style="color:#fff;" elevation="0"
                                    @click="mostrarrequisito(fase.id)">
                                    Requisitos
                                <v-icon dark right>mdi-arrow-down</v-icon>
                                </v-btn>

                                <v-btn 
                                v-if="fase.encargado_revisar==5"
                                class="mb-5 text-capitalize" 
                                elevation="0"
                                color="cyan lighten-2"
                                style="float: right; color:#fff;"
                                @click="aprobarfase(fase.id)"
                                >
                                    Aprovar Fase
                                </v-btn>
                                </v-row>
                                <v-card v-if="tipo_tramite==2 && fase.numero==2" elevation="0">
                                    <designarAsesor :tramite="nomtramite.id"/>
                                </v-card>
                                <v-divider></v-divider>
                                <v-list >
                                    <v-subheader class="font-weight-medium text-md-body-1 d-flex" style=" height: auto;"  v-if="requisitos.length" >
                                        REQUISITOS ALUMNO 
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
                                                <v-list-item class="d-flex" >
                                                    <v-row>
                                                        {{requisito.nombre}}  
                                                        <div class="ml-auto my-2">
                                                            <!--div v-if="requisito.revisado.length>0">revisado</div-->
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
                                                                Revisar
                                                            </v-btn>

                                                        </div>
                                                    </v-row>
                                                </v-list-item> 
                                            </v-list-item-content>
                                        </v-list-item>
                                    </div>
                                </v-list>

                                <v-divider></v-divider>

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
                                                <!--v-chip
                                                class="ma-2"
                                                color="#b3ffce"
                                                text-color="black"
                                                >                       
                                                    Aprovados
                                                    <v-avatar
                                                        rigth
                                                        class="green accent-3 ml-1"
                                                    >
                                                    {{requisitos_aprovadosPropios}}
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
                                                    {{requisitos_observadosPropios}}
                                                    </v-avatar>
                                                </v-chip-->                   
                                        </div>
                                    </v-subheader>
                                    <v-list-item
                                        v-for="(requisitoP, i) in requisitosPropios"
                                        :key="i"
                                        class="mb-1"
                                        color="black"
                                        v-bind:style="requisitoP.archivo_subido.length>0?'background:#82b1ff;':'' "

                                    > 
                                        <v-list-item-icon>
                                            <v-icon >mdi-check-outline</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title class="d-flex" >{{requisitoP.nombre}}  
                                                <div class="ml-auto">
                                                    <v-chip
                                                        v-if="requisitoP.revisado_aprovado.length>0"
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
                                                    v-if="requisitoP.revisado_observado.length>0 && requisitoP.modificado[0]==0 "
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
                                                    v-if="requisitoP.modificado[0]==1"
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

                                    <small v-if="requisitosPropios.length>0">*Es importante que notifiques los cambios para que tus documentos sean revisados lo mas antes posible</small>
                                    

                                </v-list>

                            </v-card>
                            </v-stepper-content>
                        </v-stepper-items>
                    
                </v-stepper>
            </v-card>
        </v-col>
         <v-col class="pa-1"  lg="3" xl="3" sm="12"  xs="12">
            <v-card class="ml-2" elevation="0" >
               <v-subheader :inset="inset" style="background-color: #1F94BF " class=" white--text text-h7">
                    Fases del tramite
                </v-subheader>

                    <v-stepper
                    :value="fase_actualy"
                    class="mt-12"
                    vertical
                    style="display: contents;"
                    >
                    <v-stepper-header elevation="0" style="min-height:476px; overflow:auto; flex-wrap: nowrap; flex-direction: column;">
                        <v-stepper-step v-for="(fase,i) in fasestramite" :key="i"
                        :step="i+1"
                        v-bind:complete="(i+1)<fase_actualy"
                        color="green"
                        >
                        {{fase.nombre}}
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
                          cerrar
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
                        @click="cerrar_dialog()"
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
    
  </div>    
</template>


<script>
import axios from 'axios';
import Form from "vform";
import designarAsesor from '../../components/designacion_asesor.vue';
export default {
  components:{
    designarAsesor,    
  },
    data(){
        return{
          alert_fase_notify:false,
          color_alert_fase_notify:'',
          msg_notify:'',
          e1: 1,
          fase_actualy:'',
          nomtramite:[],
          fases:[],
          numfases:'',
          requisitos:[],
          fasestramite:[],
          requisitosPropios:[],
          dialog:false,
          idrequi:'',
          archivoreq:null,

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
          id_fase:'',

          requisitos_aprovados:0,
          requisitos_observados:0,
          boxerror:false,
          revisar_errores:'',

          nom_estado_req:'',
          revisar_req:'',

 //saubir archivo
          nom_requisito:'',
          documento:'',
          extension:'',
          subir:true,
          msg_file:'',
          nom_btn:'',
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
          requisitos_aprovadosPropios:'',
          requisitos_observadosPropios:'',
          requisitos_subidosPropios:'',
          id_fasereq:'',
          tipo_tramite:'',
        }
    },mounted(){
        this.fetchtramite();
       // this.fetchfase();
        this.numfase();
    },methods:{
      async aprobarfase(id){
          await axios.get(`/api/sf-fasecheck/${this.$route.params.id}/${id}`).then(response=>{
            console.log(response.data);
              if(response.data=='1'){
                this.alert_fase_notify=true;                
                this.msg_notify='esta fase esta aprobada';
                this.color_alert_fase_notify='green';
                this.fetchtramite();
                this.e1=this.e1+1;
              }else if(response.data=='2'){
                this.alert_fase_notify=true;                
                this.msg_notify='la fase ya fue aprobada';
                this.color_alert_fase_notify='blue';
              } else if(response.data=='3'){
                this.alert_fase_notify=true;                
                this.msg_notify='las fases anteriores aun no se aprueban';
                this.color_alert_fase_notify='red';
              }   
          });
      },
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
         this.fase_actualy=data.fase_actual;
         this.tipo_tramite=data.grado;
        // this.codigoproc=this.nomtramite.proceso_id;
          console.log(data)
          this.fetchfase(this.nomtramite.proceso_id)
      },async fetchfase($id){
         const { data } =await axios.get(`/api/sf-fasestramite/${$id}`);   
         this.fases = data.fases;
         this.fasestramite=data.fases_tramite;
         this.numfases=data.cantidad;
      },async mostrarrequisito(id){

          const {data}=await axios.get(`/api/sf-faserequisito/${id}/${this.$route.params.id}`);
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
      //subir requisitos
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
            this.msg_file='Subido';
            this.daterequisito.archivo='--'
            this.url_document=requisito.archivo_subido[0].path;
           // console.log(this.url_document)
            /*if(requisito.modificado[0]==1){
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
            }*/
        }       
          this.dialog=true;
        
      },
      vistaprevia(){
       // console.log(this.daterequisito.archivo);
        this.url_document=URL.createObjectURL(this.daterequisito.archivo)
      },
        async guardar(){
            // console.log(this.daterequisito);  
            if(this.subir===true){
                await this.daterequisito.post(`/api/sf-subirfilerequisito/`).then(response=>{
                    console.log(response.data);
                    if(response.data===1){
                    this.subir_file_error='ya no se admiten mas archivos'
                    this.boxerror=true;
                    }else{
                    this.daterequisito.archivo='',
                    this.mostrarrequisito(this.id_fase);
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


      },
      //fin subir requisito
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
      },cerrar_dialog(){
          this.formrevisado.aprovado=false;
          this.formrevisado.observado=false;
          this.formrevisado.observacion='';
          this.dialogR=false;          
      },cerrar_modal(){
         this.daterequisito.archivo='';
         this.url_document='';
         this.dialog=false;
      },verformato(requisito){
         this.dialog2=true;
         this.content=requisito.nombre;
      },async revisarReq(){
          console.log(this.formrevisado);
          await this.formrevisado.post(`/api/sf-revisarrequisito`).then(response=>{
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
    }
}
</script>
