<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <v-card :title="$t('reset_password')">
        <form @submit.prevent="reset" @keydown="form.onKeydown($event)">
          <alert-success :form="form" :message="status" />

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
                readonly
              />
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{
              $t("password")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.password"
                :class="{ 'is-invalid': form.errors.has('password') }"
                class="form-control"
                type="password"
                name="password"
              />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{
              $t("confirm_password")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.password_confirmation"
                :class="{
                  'is-invalid': form.errors.has('password_confirmation'),
                }"
                class="form-control"
                type="password"
                name="password_confirmation"
              />
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>

          <!-- Submit Button -->
          <div class="mb-3 row">
            <div class="col-md-9 ms-md-auto">
              <v-btn :loading="form.busy">
                {{ $t("reset_password") }}
              </v-btn>
            </div>
          </div>
        </form>
      </v-card>
    </div>
  </div>
</template>

<script>
import Form from "vform";

export default {
  layout: "basic",
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("reset_password") };
  },

  data: () => ({
    status: "",
    form: new Form({
      token: "",
      email: "",
      password: "",
      password_confirmation: "",
    }),
  }),

  created() {
    this.form.email = this.$route.query.email;
    this.form.token = this.$route.params.token;
  },

  methods: {
    async reset() {
      const { data } = await this.form.post("/api/password/reset");

      this.status = data.status;

      this.form.reset();
    },
  },
};
</script>
