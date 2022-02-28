<template>
    <div class="ml-8 mt-5">
        <v-card  >
        <v-card-title class="py-1 text-h5">{{procesos.nombre}}</v-card-title>
        </v-card>     

        <template>
            <v-card class="mt-1">
            
                <v-dialog
                    transition="dialog-top-transition"
                    max-width="600"
                    v-model="dialog"
                >   
                        <template v-slot:activator="{ on, attrs }" >
                            <div class="d-flex">
                                <v-subheader class="text-h6 d-flex" style="color:#000;">Fases del Tramite </v-subheader>
                                <v-btn 
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
                                            {{errores.nombrefase[0]}}
                                            </v-alert>
                                        </div>                           
                                        <v-text-field
                                            v-model="formfase.numerofase"
                                            label="Orden"
                                            required
                                        ></v-text-field>  
                                        <div v-if="errores.numerofase">
                                            <v-alert   dense outlined type="error" >
                                            {{errores.numerofase[0]}}
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
                                >Close</v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>    
                </v-dialog>
               
                <v-tabs
                v-model="tab"
                background-color="blue lighten-1"
                dark
                next-icon="mdi-arrow-right-bold-box-outline"
                prev-icon="mdi-arrow-left-bold-box-outline"

            
                >
                <v-tab
                    v-for="(fase,i) in fases"
                    :key="i"
                    style="color:#fff;"
                    class="text-h7"
                    active-class="blue darken-4 "
                   @click="mostrarid(fase,i)"
                >
                    {{ i+1 }}
                </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="(fase,i) in fases"
                    :key="i"
                >
                    <v-card flat  >
                        
                    <v-card-text class="text-md-body-1 font-weight-medium" >{{ fase.nombre }} </v-card-text>
                    </v-card>
                </v-tab-item>
                </v-tabs-items>
            </v-card>
        </template>
            
            <template >
                <div class="d-flex" style="width:100%; min-height:600px;">

              
                <v-card
                    class=" mt-2 "
                    tile
                    width="70%"
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
                                                           
                                                      <v-btn color="#2cdd9b" small elevation="0" style="color:#fff;"  class=" ml-auto text-capitalize"  
                                                      v-bind="attrs"
                                                      v-on="on" >Agregar requisito</v-btn> 
                                                        </div>
                                                    </template>              

                                                    <template >
                                                        <v-card>
                                                            <v-toolbar
                                                            color="#3DB2FF"
                                                            dark
                                                            >Agregar Nuevo requisito en esta fase</v-toolbar>
                                                            <v-card-text>
                                                                <form>
                                                                    <template>
                                                                        <v-card elevation="0" class="mt-2">
                                                                            <v-tabs
                                                                            color="primary"
                                                                            centered

                                                                            >
                                                                            <v-tab>seleccionar requisito </v-tab>
                                                                            <v-tab>crear nuevo</v-tab>                                                                            
                                                                            <v-tab-item>
                                                                                <v-container fluid>
                                                                                    <v-row>                                                                                    
                                                                                       <v-select
                                                                                            v-model="formrequi.requisito"   
                                                                                            :hint="`${formrequi.requisito.nombre}`"               
                                                                                            :items="allrequisitos"
                                                                                            item-text='nombre'
                                                                                            item-value='id'
                                                                                            label="Seleccionar Requisito existentente"
                                                                                            persistent-hint
                                                                                            return-object
                                                                                            single-line                                                                      
                                                                                        ></v-select>                                                                                
                                                                                    </v-row>                                                                  
                                                                                </v-container>                                                           
                                                                            </v-tab-item>
                                                                               <v-tab-item>
                                                                                <v-container fluid>
                                                                                    <v-row>                                                                                    
                                                                                         <v-text-field
                                                                                            v-model="formrequi.nombre"
                                                                                            label="nombre"
                                                                                            required
                                                                                        ></v-text-field> 
                                                                                    </v-row> 
                                                                                    <v-row>
                                                                                        <v-text-field
                                                                                            v-model="formrequi.tipodocumneto"
                                                                                            label="Tipo de documento"
                                                                                            required
                                                                                        ></v-text-field>
                                                                                    </v-row> 
                                                                                    <v-row>
                                                                                         <v-text-field
                                                                                            v-model="formrequi.extension"
                                                                                            label="extension"
                                                                                            required
                                                                                        ></v-text-field>                                                                                 
                                                                                    </v-row>                                                                  
                                                                                </v-container>                                                           
                                                                            </v-tab-item>
                                                                            </v-tabs>
                                                                        </v-card>
                                                                    </template>                                                                                                                                                             
                                                                    <v-text-field
                                                                        v-model="formrequi.rol"
                                                                        label="rol"
                                                                        required
                                                                    ></v-text-field>  
                                                                                                                   
                                                                        <v-btn
                                                                        class="mr-4 text-capitalize"
                                                                        color="#3DB2FF"
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
                                                                @click="dialog2=false,clear()"
                                                                class="text-capitalize"
                                                            >Close</v-btn>
                                                            </v-card-actions>
                                                        </v-card>
                                                    </template>    
                                        </v-dialog>
                           
                    </v-subheader>
                    <v-list-item-group
                        v-model="selectedItem"
                        color="primary"
                        mandatory
                        
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
                            <v-list-item-title >{{requisito.nombre}}</v-list-item-title>
                        </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                    </v-list>
                     
                </v-card>
                <v-spacer></v-spacer>
                <v-card class="mt-2 ml-4 mr-2"  width="30%" tile>
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
                
                 
                  </div>
            </template> 

                


    </div>
    
</template>

<script>
import axios from 'axios';
import Form from "vform";
export default{

  data(){     
     return{
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
        otros:[],
        dialog:false,
        dialog2:false,
        errores:{},
        formfase: new Form({
            nombrefase:'',
            numerofase:'',
            procesoid:this.$route.params.id,
          }),
        formrequi:new Form({
            requisito:'',
            nombre:'',
            rol:'',
            tipodocumento:'',
            extension:'',

        }),
        allrequisitos:{},

        
     } 
  },mounted(){
      this.FetchTramites();
      this.FetchFases();
      this.FetchAllrequisitos();
    // this.formfase.procesoid=this.$route.params.id;
     // console.log(this.faseid);

      //console.log(this.formfase.procesoid);
  },methods:{
      async FetchTramites(){
          const { data } = await axios.get(`/api/proceso/${this.$route.params.id}`);   
          this.procesos = data;
          console.log(data);
      },
      async FetchFases(){
          const {data}=await axios.get(`/api/fase/${this.$route.params.id}`);
          this.fases=data;
          this.faseid=(data[0].id);   

          this.mostrarrequisito(data[0].id);
      }, mostrarid(fase,i){
          console.log(fase.id);
          this.faseid=fase.id;
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
          console.log(data);
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
         this.errores={};         
      },async enviarfase(){
          const {data}= await this.formfase.post(`/api/fase/`)
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
      }
  }
}
</script>

<style >
 
</style>
