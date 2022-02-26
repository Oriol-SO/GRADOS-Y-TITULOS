<template>
  <v-card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{
          $t("name")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.nombre"
            :class="{ 'is-invalid': form.errors.has('name') }"
            class="form-control"
            type="text"
            name="name"
          />
          <has-error :form="form" field="name" />
        </div>
      </div>
            <!-- Apellido pat -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{
          $t("apellido Paterno")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.apellido1"
            :class="{ 'is-invalid': form.errors.has('apellido1') }"
            class="form-control"
            type="text"
            name="apellido1"
          />
          <has-error :form="form" field="apellido1" />
        </div>
      </div>
            <!-- Apellido Mat-->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{
          $t("apellido Materno")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.apellido2"
            :class="{ 'is-invalid': form.errors.has('apellido2') }"
            class="form-control"
            type="text"
            name="apellido2"
          />
          <has-error :form="form" field="apellido2" />
        </div>
      </div>

      <!-- Email -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{
          $t("email")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.email"
            :class="{ 'is-invalid': form.errors.has('email') }"
            class="form-control"
            type="email"
            name="email"
             style="border:solid 1px black;"
          />
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-btn :loading="form.busy" type="success">
            {{ $t("update") }}
          </v-btn>
        </div>
      </div>
    </form>
  </v-card>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      nombre: "",
      email: "",
      apellido1:"",
      apellido2:"",
    }),
  }),

  computed: mapGetters({
    user: "auth/user",
  }),

  created() {
    // Fill the form with user data.
    this.form.keys().forEach((key) => {
      this.form[key] = this.user[key];
    });
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/api/settings/profile");

      this.$store.dispatch("auth/updateUser", { user: data });
    },
  },
};
</script>
