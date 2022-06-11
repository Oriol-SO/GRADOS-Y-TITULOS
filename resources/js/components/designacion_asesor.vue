<template>
    <div>
        <form>
            <v-row>
                <v-col cols="12" sm="8">
                    <v-select
                        label="seleccione un asesor"
                        :items="asesores"
                        v-model="form.asesor"
                        item-text="nombre"
                        item-value="id"
                        return-object
                    >
                    </v-select>
                </v-col>
                <v-col cols="12" sm="4">
                    <v-btn color="primary" class="text-capitalize" small @click="designar()">Designar</v-btn>
                </v-col>
            </v-row>
        </form>

     
        
        <snackbar :visible="modal_msg" :msg="msg" :color="color_msg"/>
        
   
    </div>
</template>


<script>
import axios from 'axios';
import Form from "vform";
import snackbar from '~/components/snackbar.vue';
export default {
    name:"designarAsesor",
    props: {
    tramite: {default:''},
    },
    components:{
        snackbar,
    },
    data(){
        return{
         modal_msg:false,
         msg:'',
         color_msg:'',
         asesores:[],   

         form: new Form({
            tramite:'',
            asesor:'',
         })
        }
    },
    mounted(){
        this.fetchasesores();
    },    
    methods:{
        fetchasesores(){
            axios.get('/api/sf-asesores/'+this.tramite).then(response=>{
                this.asesores=response.data;
                 console.log(response.data);
            })
        },
        designar(){
            this.form.tramite=this.tramite;
            this.form.post('/api/sf-asignar-asesor/'+this.tramite).then(response=>{
                console.log(response.data)
                if(response.data==true){
                    this.modal_msg=true;
                    this.color_msg='cyan acent-2'
                    this.msg='Asesor agregado'
                }else{
                    this.modal_msg=true;
                    this.color_msg='red acent-2'
                    this.msg='Ya asignaste un asesor'
                }
            })

        }
    }
}
</script>

