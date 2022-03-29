<template>
<v-container style="background:red, ">
  <form @submit.prevent="updatePassword" @keydown="form.onKeydown($event)">
    <v-bottom-sheet v-model="sheet">
      <v-sheet      class="text-center"      height="200px"    >
        <div class="py-3">
          <alert-success :form="form" :message="$t('password_updated')" />
          <has-error  :form="form" field="password" style="color:red" />
          <has-error :form="form" field="password_confirmation" style="color:blue" />
        </div>
      </v-sheet>
    </v-bottom-sheet >
    <v-card class="pb-5" elevation="0" >
      <v-row style="display:flex ;justify-content: center;  " class="pb-10">
        <!-- Password -->
        <v-col cols="4">
          <v-subheader>contraseña</v-subheader>
        </v-col>
        <v-col
          cols="11"
          sm="6" 
        >
          <v-text-field
            v-model="form.password"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[ rules.min]"
            :type="show1 ? 'text' : 'password'"
            name="password"
            label="password"
            hint="al menos 6 caracteres"
            counter
            @click:append="show1 = !show1"
          ></v-text-field>
        </v-col>
        <!-- Password Confirmation --> 
        <v-col cols="4">
          <v-subheader>repetir contraseña</v-subheader>
        </v-col>
        <v-col
          cols="11"
          sm="6"
        >
          <v-text-field
            v-model="form.password_confirmation"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[ rules.min]"
            :type="show1 ? 'text' : 'password'"
            name="password_confirmation"
            label="password_confirmation"
            counter
            @click:append="show1 = !show1"
          ></v-text-field>
        </v-col>
      </v-row>
    
           <!-- Submit Button -->
    <div class="text-center mb-5" row  justify-space-around>
          <v-btn  
            :loading="form.busy" type="success"
            color="blue"
            levation="15"
            large
            small
            x-small
            @click="sheet = !sheet"
          >
           <v-icon left>
             mdi-update
            </v-icon>
            Actualizar
          </v-btn>
    </div>
    </v-card>
</form>
</v-container>
</template> 
<script>
import Form from "vform";

export default {
  scrollToTop: false,

  data () {
    return{ 
      show1: false,
        
        rules: {
          
          min: v => v.length >= 0 || 'Min 6 characters',
        },
    form: new Form({
      password: "",
      password_confirmation: "",


    }),
  }
 },

  methods: {
    async updatePassword() {
      await this.form.patch("/api/settings/password");

      this.form.reset();
    },
  },
};
</script> 
