<template>
    <div class="mt-5">
        <v-card elevation="0" >
        <v-card-text class="py-2 text-h5" elevation="0">{{procesos.nombre}}</v-card-text>
        </v-card>     
        <template>
            <v-card class="mt-1" elevation="0">
            
                <v-dialog
                    transition="dialog-top-transition"
                    max-width="600"
                    v-model="dialog"
                >   
                    <template v-slot:activator="{ on, attrs }" >
                        <div class="d-flex">
                            <v-subheader class="text-h6 d-flex" style="color:#000;">Fases del Tramite </v-subheader>
                            <v-btn 
                                v-if="estadoE && uso"
                                color="#2cdd9b"
                                elevation="0" 
                                style="color:#fff;" 
                                class="my-auto ml-auto mr-4 text-capitalize"
                                v-bind="attrs"
                                v-on="on"
                            >Agregar Fase</v-btn> 
                        </div>
                    </template>              

                    <template >
                        <v-card>
                            <v-toolbar
                            color="#2cdd9b"
                            dark
                            >Agregar Nueva fase en este tramite</v-toolbar>
                            <v-card-text>
                                <form>
                                    <v-text-field
                                        v-model="formfase.nombrefase"
                                        label="Nombre"
                                        required
                                    ></v-text-field> 
                                    <div v-if="errores.nombrefase">
                                        <v-alert   dense outlined type="error" >
                                        El Campo Nombre es obligatorio 
                                        </v-alert>
                                    </div>
                                    <v-text-field
                                        v-model="formfase.numerofase"
                                        label="Numero de orden"
                                        required
                                    ></v-text-field> 
                                    <div v-if="errores.numerofase">
                                        <v-alert   dense outlined type="error" >
                                        El Campo Orden es Obligatorio
                                        </v-alert>
                                    </div> 
                                    <v-select
                                        v-model="formfase.rol_ejecutor"
                                        :items="roles"
                                        item-text='rolNombre'
                                        item-value='id'                                                     
                                        
                                        return-object
                                        
                                        label="encargado de subir o ejecutar"

                                    >                                    
                                    </v-select>  
                                    <div v-if="errores.rol_ejecutor">
                                        <v-alert   dense outlined type="error" >
                                        El rol del encargado de subir o ejecutar es obligatorio
                                        </v-alert>
                                    </div>   
                                    <v-select
                                        v-model="formfase.rol_revisar"
                                        :items="roles"
                                        item-text='rolNombre'
                                        item-value='id'                                                       
                                    
                                    return-object
                                    
                                    label="encargado de subir o ejecutar"

                                >                                    
                                </v-select>  
                                <div v-if="errores.rol_ejecutor">
                                    <v-alert   dense outlined type="error" >
                                     el rol del encargado de subir o ejecutar es obligatorio
                                    </v-alert>
                                </div>   
                                <v-select
                                    v-model="formfase.rol_revisar"
                                    :items="roles"
                                    item-text='rolNombre'
                                    item-value='id'                                                       
                                   
                                    return-object
                                    
                                    label="encargado de revisar"
                                >                                    
                                </v-select>  
                                <div v-if="errores.rol_revisar">
                                    <v-alert   dense outlined type="error" >
                                     el rol del encargado de revisar o evaluar es obligatorio
                                    </v-alert>
                                </div>                     
                                                                                  
                                    <v-btn
                                    class="mr-4 text-capitalize"
                                    color="#2cdd9b"
                                    style="color:#fff;"
                                        @click="enviarfase()"                                            
                                    >
                                    Enviar
                                    </v-btn>
                                    <v-btn  @click="clear" color="#000"  style="color:#fff;" class="text-capitalize">
                                    Limpiar
                                    </v-btn>
                            </form>                     
                        </v-card-text>
                        <v-card-actions class="justify-end">
                        <v-btn
                            text
                            @click="dialog=false,clear()"
                            class="text-capitalize"
                        >Cerrar</v-btn>
                        </v-card-actions>
                    </v-card>
                </template>    
                </v-dialog>
               
                <v-tabs
                v-model="tab"
                background-color="#337ab7 "
                dark
                next-icon="mdi-arrow-right-bold-box-outline"
                prev-icon="mdi-arrow-left-bold-box-outline"

            
                >
                <v-tab
                    v-for="(fase,i) in fases"
                    :key="i"
                    style="color:#fff;"
                    class="text-h7"
                    active-class="light-blue darken-4 "
                   @click="mostrarid(fase,i)"
                >
                    {{ fase.numero }}
                </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="(fase,i) in fases"
                    :key="i"

                >
                    <div class="d-flex"  >
                        <v-card-text class="text-md-body-1 font-weight-medium" >
                        {{ fase.nombre }} | Encargado Ejecutar {{fase.ejecutar.rolNombre}} | Encargado Revisar {{fase.revisar.rolNombre}}
                        </v-card-text>
                        
                        <v-btn
                          v-if="estadoG"
                          icon
                          small elevation="0"  
                          color="error"
                          class="my-auto ml-n16"
                          @click="eliminarfase(fase.id)"
                        >
                          <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </div>
                </v-tab-item>
                </v-tabs-items>
            </v-card>
        </template>
            
            <template >
                <v-row flex   >
                    <v-col  cols="12" xl="8" lg="8" sm="12" xs="12">
              
                    <v-card
                        class=" mt-2 "
                        tile
                        elevation="0"
                    >
                    <v-list dense >
                    <v-subheader class="font-weight-medium text-md-body-1 d-flex">REQUISITOS 
                        <v-dialog
                                transition="dialog-top-transition"
                                max-width="600"
                                v-model="dialog2"
                            >   
                            <template v-slot:activator="{ on, attrs }" >
                                <div class="d-flex" style="width: 100%;">
                                    
                                <v-btn v-if="faseid && estadoE && uso" 
                                color="#2cdd9b" small elevation="0" style="color:#fff;"  class=" ml-auto text-capitalize"  
                                v-bind="attrs"
                                v-on="on" >Agregar requisito</v-btn> 
                                </div>
                            </template>              

                            <template >
                            <v-card>
                                <v-toolbar
                                color="#3DB2FF"
                                dark
                                >Agregar Nuevo requisito | Encargado de ejecutar </v-toolbar>
                                <v-card-text>                                                                
                                <template>
                                    <v-card elevation="0" class="mt-2">
                                        <v-tabs
                                        color="primary"
                                        centered

                                        >
                                            <v-tab >seleccionar requisito </v-tab>
                                            <v-tab >crear nuevo</v-tab>                                                                         
                                                <v-tab-item> 
                                                    <form >                                                                                      
                                                    <v-container >
                                                        <v-row fluid>                                                                                    
                                                            <v-select
                                                                v-model="formrequi1.requisito"   
                                                                :hint="`${formrequi1.requisito.nombre}`"               
                                                                :items="allrequisitos"
                                                                item-text='nombre'
                                                                item-value='id'
                                                                label="Seleccionar Requisito existentente"
                                                                persistent-hint
                                                                return-object
                                                                single-line                                                                      
                                                            ></v-select>                                                                                                                                                            
                                                        </v-row>
                                                        <v-row>
                                                            <div>
                                                                <v-alert v-if="erroresR1.requisito"   dense outlined type="error" >
                                                                            {{erroresR1.requisito[0]}}
                                                                </v-alert>
                                                            </div>
                                                        </v-row>

                                                                                                                    
                                                    </v-container> 
                                                        <v-btn
                                                            class="mr-4 text-capitalize"
                                                            color="#3DB2FF"
                                                            style="color:#fff;"
                                                            @click="submitrequisito()"                                            
                                                            >
                                                            Enviar
                                                            </v-btn>
                                                            <v-btn  @click="limpiarselect()" color="#000"  style="color:#fff;  " class="text-capitalize">
                                                            Limpiar
                                                            </v-btn>
                                                    </form>                                                                                            
                                                </v-tab-item>                                                                                           
                                                
                                                <v-tab-item> 
                                                    <form>                                                                                   
                                                    <v-container >
                                                        <v-row fluid>                                                                                    
                                                            <v-text-field
                                                                v-model="formrequi2.nombre"
                                                                label="nombre"
                                                                required
                                                            ></v-text-field> 
                                                        </v-row>
                                                        <v-row>
                                                            <div>
                                                                <v-alert v-if="erroresR2.nombre"   dense outlined type="error" >
                                                                            {{erroresR2.nombre[0]}}
                                                                </v-alert>
                                                            </div>
                                                        </v-row>
                                                        <v-row fluid> 
                                                            <v-select
                                                                v-model="formrequi2.tipodocumento"                                                                                
                                                                required          
                                                                :items="tipoarchivos"
                                                                item-text='tipoNombre'
                                                                item-value='id'
                                                                label="Seleccionar tipo de documento"
                                                                persistent-hint
                                                                return-object
                                                                single-line                                                                      
                                                            ></v-select>
                                                        </v-row>
                                                        <v-row>
                                                            <div>
                                                                <v-alert v-if="erroresR2.tipodocumento"   dense outlined type="error" >
                                                                            {{erroresR2.tipodocumento[0]}}
                                                                </v-alert>
                                                            </div>
                                                        </v-row>                                                                                  
                                                        <v-row fluid>
                                                            <v-text-field
                                                                v-model="formrequi2.extension"
                                                                label="extension"
                                                                required
                                                            ></v-text-field>                                                                                 
                                                        </v-row>
                                                        <v-row>
                                                            <div>
                                                                <v-alert v-if="erroresR2.extension"   dense outlined type="error" >
                                                                            {{erroresR2.extension[0]}}
                                                                </v-alert>
                                                            </div>
                                                        </v-row>
                                                        <v-row fluid>                                                                                       
                                                            <v-select
                                                            v-model="formrequi2.rol"                                                                               
                                                            required          
                                                            :items="roles"
                                                            item-text='rolNombre'
                                                            item-value='id'
                                                            label="Seleccionar rol"
                                                            persistent
                                                            return-object
                                                            single-line                                                                      
                                                            ></v-select>                                                                                                                                                                                
                                                        </v-row> 
                                                        <v-row>
                                                            <div>
                                                                <v-alert v-if="erroresR2.rol"   dense outlined type="error" >
                                                                            {{erroresR2.rol[0]}}
                                                                </v-alert>
                                                            </div>
                                                        </v-row>                                                                 
                                                    </v-container>                                                                     
                                                        <v-btn                                                                                 
                                                        class="mr-4 text-capitalize"
                                                        color="#3DB2FF"
                                                        style="color:#fff;"
                                                        @click="submitrequisitonuevo()"                                            
                                                        >
                                                        Enviar
                                                        </v-btn>
                                                        <v-btn  @click="limpiarnuevo()" color="#000"  style="color:#fff;" class="text-capitalize">
                                                        Limpiar
                                                        </v-btn>                                                                    
                                                    </form>                                                                                                                                         
                                                </v-tab-item>                                                                                        
                                            
                                        </v-tabs>
                                    </v-card>
                                </template>                                
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                <v-btn
                                    text
                                    @click="dialog2=false,clearall()"
                                    class="text-capitalize"
                                >Cerrar</v-btn>
                                </v-card-actions>
                            </v-card>
                            </template>    
                        </v-dialog>
                            
                    </v-subheader>
                    <v-list-item-group
                        v-model="selectedItem"
                        color="primary"
                        mandatory
                        class="mx-auto"
                    >
                        <v-list-item
                        v-for="(requisito, i) in requisitos"
                        :key="i"
                        @click="detallerequisito(requisito)"
                         
                        >
                        <v-list-item-icon>
                            <v-icon >mdi-check-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item class="d-flex" >
                            <v-row class="mt-2">
                            {{requisito.nombre}}
                                <div class="ml-auto mb-5">
                                    <v-chip
                                    color="deep-purple accent-1"
                                    text-color="#fff"
                                    >                        
                                        {{requisito.rol}}
                                        <v-avatar
                                            rigth
                                            class="deep-purple accent-3 ml-1 "
                                            text-color="#fff"
                                        >
                                        <v-icon>mdi-account-tie</v-icon>
                                        </v-avatar>
                                    </v-chip>
                                </div> 
                            </v-row>                                
                            </v-list-item>

                        </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                    </v-list>
                     
                    </v-card>
                    </v-col>
                    
                    <v-col  lg="4" xl="8" sm="12"  xs="12">
                    <v-card class="mt-2" elevation="0">
                        <v-subheader class="font-weight-medium text-md-body-1">DETALLE REQUISITO </v-subheader>
                            <v-list three-line style="min-height:02;">
                                <template>                                
                                    <v-divider
                                    class="mx-auto"
                                    style="min-width:90%;"
                                    ></v-divider>
                                    <v-list-item  class="mt-1" style="min-height:50px;">
                                    <v-list-item-content class="py-0 " style="max-height: 55px;" v-if="nombrereq" >
                                        <v-list-item-title > Nombre</v-list-item-title>
                                        <v-list-item-subtitle>{{nombrereq}}</v-list-item-subtitle>
                                    </v-list-item-content>                             
                                    </v-list-item>
                                    <v-list-item class="mt-1" style="min-height:50px;">                                    
                                        <v-list-item-content class="py-0 " style="max-height: 55px;" v-if="encargado" >
                                            <v-list-item-title > Debe cargar</v-list-item-title>
                                            <v-list-item-subtitle>{{encargado}}</v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item class="mt-1" style="min-height: 50px;">                                    
                                        <v-list-item-content class="py-0 " style="max-height: 55px;" v-if="documento" >
                                            <v-list-item-title > Tipo de documento</v-list-item-title>
                                            <v-list-item-subtitle>{{documento}}</v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item class="mt-1" style="min-height: 50px;">                                    
                                        <v-list-item-content class="py-0 " style="max-height: 55px;" v-if="extension" >
                                            <v-list-item-title >Extension</v-list-item-title>
                                            <v-list-item-subtitle>{{extension}}</v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item class="mt-1" style="min-height: 50px;">                                    
                                        <v-list-item-content  class="py-0 " style="max-height: 55px;" >
                                            <v-list-item-title v-if="otros.length" >otros tramites en los que aparece</v-list-item-title>
                                            <v-list-item-subtitle>
                                                <ul v-for="(otro,i) in otros" :key="i">
                                                    <li>{{otro.nombre}}</li>
                                                </ul>
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                
                                </template>
                            </v-list>       
                        </v-card>
                    </v-col> 
                    <v-bottom-sheet
                        v-if="estadoG"
                        v-model="sheet"
                        inset
                        >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn 
                                    v-bind="attrs"
                                    v-on="on"
                                    color="blue-grey"                
                                    class=" ma-2 white--text my-auto ml-auto mr-4 text-capitalize"
                                    >
                                Guardar
                                <v-icon
                                    right
                                    dark
                                >
                                mdi-cloud-upload
                                </v-icon>
                            </v-btn>
                        </template>
                        <v-sheet
                            
                            class="text-center"
                            height="110px"
                        >
                            <v-btn
                                class="mt-1 pb-0"
                                text
                                color="error"
                                @click="sheet = !sheet"
                                >
                            close
                            </v-btn>
                            <v-btn
                                class="mt-1 pb-0"
                                text
                                color="green"
                                @click="GuardarProceso(),sheet = !sheet,{ path: `/admin/tramites`} "  
                            >
                            Continuar
                            </v-btn>
                            <div class="my-1 pa-0">
                                <v-alert
                                    colored-border
                                    type="info"
                                    >
                                    Si continua ya no podra borrar las fases ni los requisitos, solo podra agregarlos
                                </v-alert>
                            
                            </div>
                        </v-sheet>
                    </v-bottom-sheet>
                    
                </v-row>
        </template>              

    </div>
</template>

<script>
import axios from 'axios';
import Form from "vform";
export default{

  data(){     
     return{
        sheet: false,
        procesos:[],
        tab: null,
        fases: [],
        selectedItem:undefined,
        requisitos: [],
        faseid:'',
        nombrereq:'',
        encargado:'',
        documento:'',
        extension:'',
        estadoG:'',
        estadoE:'',
        uso:'',
        otros:[],
        dialog:false,
        dialog2:false,
        errores:{},
        erroresR1:{},
        erroresR2:{},
        formfase: new Form({
            nombrefase:'',
            numerofase:'',
            procesoguardado:this.$route.params.guardado,
            procesoid:this.$route.params.id,
            rol_ejecutor:[],
            rol_revisar:[],
          }),
        formrequi1:new Form({
            requisito:'',
            rol:'',
            fase_id:'',
        }),
        formrequi2:new Form({
            nombre:'',
            rol:'',
            tipodocumento:'',
            extension:'',
            fase_id:'',
        }),
        allrequisitos:[],
        tipoarchivos:[],
        roles:[],
        rol:[],
     } 
  },mounted(){
      this.FetchTramites();
      this.FetchFases();
      this.Roles();
      this.FetchAllrequisitos();
      this.FetchTipoDocumento();
      this.FetchRoles();
      this.FetchPersona();
      this.GuardarProceso();
      //console.log(this.formrequi);
      // this.formfase.procesoid=this.$route.params.id;
      // console.log(this.faseid);

      //console.log(this.formfase.procesoid);

  },methods:{
      async GuardarProceso() {
        const { data } = await axios.get(`/api/cambiarGuardado/${this.$route.params.id}`)
        this.estadoG=data;
        //console.log(data);
      },async FetchTramites(){
          const { data } = await axios.get(`/api/proceso/${this.$route.params.id}`);   
          this.procesos = data;
          this.estadoG = !(data.guardado);
          this.estadoE = !(data.estado);
          this.uso=!(data.uso);
        console.log(this.uso);
      },
      async FetchFases(){
          const {data}=await axios.get(`/api/fase/${this.$route.params.id}`);
          this.fases=data;
          console.log("fases",this.fases);
          this.faseid=(data[0].id);   
          this.formrequi1.fase_id=(data[0].id);
          this.formrequi2.fase_id=(data[0].id);
          this.mostrarrequisito(data[0].id);
      },
       async Roles(){
          const {data}=await axios.get(`/api/roles/ `);
          this.rol=data;
          console.log("fase",this.faseid);
      },
        mostrarid(fase,i){
         // console.log(fase.id);
          this.faseid=fase.id;
          this.formrequi1.fase_id=fase.id;
          this.formrequi2.fase_id=fase.id;
          this.mostrarrequisito(fase.id);
          //return(fase.id);
      },async mostrarrequisito(id){
          const {data}=await axios.get(`/api/faserequisito/${id}`);
          this.requisitos=data;
          if(data.length!=0){
              this.nombrereq=data[0].nombre;
              this.encargado=data[0].rol;
              this.documento=data[0].documento;
              this.extension=data[0].extension;
              this.otros=data[0].otrostramites;
             // console.log(this.otrostramitesA[0].nombre);
          }else{
               this.nombrereq='';
               this.selectedItem=null;
               this.documento='';
               this.encargado='';
               this.extension='';
               this.otros=[];
          }
          //console.log(data);
      },detallerequisito(requisito){
          this.nombrereq=requisito.nombre;
          this.encargado=requisito.rol;
          this.documento=requisito.documento;
          this.extension=requisito.extension;
           this.otros=requisito.otrostramites;
         // console.log(this.selectedItem);
         
      }, clear() {
         this.formfase.nombrefase='';
         this.formfase.numerofase='';
         this.formfase.rol_ejecutor='';
         this.formfase.rol_revisar='';
         this.errores={};         
      },async enviarfase(){
          const {data}= await this.formfase.post(`/api/fase/`)
           .then(response =>{
            this.FetchFases();
            this.clear();
            console.log(response.data);
            this.dialog=false;
            
          }).catch(error=>{
            if(error.response.status === 422){
              this.errores=error.response.data.errors;
            //  console.log(this.errores);
            }
          });
      },async eliminarfase(id){
          confirm("¿Confirma eliminar el registro?");
          this.formfase.delete(`/api/fase/${id}`)
          .then(response =>{
            this.FetchFases();
            this.clear();
            this.dialog=false;
            
          }).catch(error=>{
            if(error.response.status === 422){
              this.errores=error.response.data.errors;
              console.log(this.errores);
            }
          });

      },async FetchAllrequisitos(){
             const {data}=await axios.get(`/api/requisito/`);
             this.allrequisitos=data;
             //console.log(data);
      },async FetchTipoDocumento(){
          const{data}=await axios.get('/api/tipoarchivo/');
          this.tipoarchivos=data;
          //console.log(data);
      },async FetchRoles(){
          const{data}=await axios.get('/api/rol/');
          this.roles=data;
      },limpiarnuevo(){
          this.formrequi2.nombre='';
          this.formrequi2.tipodocumento='';
          this.formrequi2.extension='';
          this.formrequi2.rol='';
          this.erroresR2={};
      },limpiarselect(){
          this.formrequi1.requisito='';
          this.formrequi1.rol='';
          this.erroresR1={};
      },clearall(){
          this.limpiarnuevo();
          this.limpiarselect();          
      },async submitrequisito(){ 
          console.log("requisito",this.formrequi1);                 
          const {data}= await this.formrequi1.post('/api/faserequisito/')
           .then(response =>{
            this.mostrarrequisito(this.formrequi1.fase_id);
            this.clearall();
            this.dialog2=false;
          }).catch(error=>{
            if(error.response.status === 422){
              this.erroresR1=error.response.data.errors;
            //  console.log(this.erroresR1);
            }
          });
          
      },async submitrequisitonuevo(){                 
          const {data}= await this.formrequi2.post('/api/requisito/')
           .then(response =>{
            this.mostrarrequisito(this.formrequi2.fase_id);
            this.clearall();
            this.dialog2=false;
           // console.log(response);
          }).catch(error=>{
            if(error.response.status === 422){
              this.erroresR2=error.response.data.errors;
            //  console.log(this.erroresR2);
            }
          });
          
      },async submitrequisitoeliminado(id){ 
          /* console.log(this.formrequi2);  
          const {data}= await axios.get(`/api/ver/${id}`); 
          console.log("fase",data);  
          console.log("fase",id);    */   
          axios.delete(`/api/faserequisito/${id}`)
           .then(response =>{
            this.mostrarrequisito(this.formrequi2.fase_id);
            this.clearall();
            this.dialog2=false;
            console.log(response);
          }).catch(error=>{
            if(error.response.status === 422){
              this.erroresR2=error.response.data.errors;
              console.log(this.erroresR2);
            }
          }); 
          
      }
  }
}
</script>


