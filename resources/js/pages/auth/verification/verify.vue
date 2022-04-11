<template>
  <v-container fluid class="fill-height main">
  <v-flex>
    <v-card
        class="mx-auto my-auto h-100 transparente pt-6 pb-3"
        rounded="lg"
        elevation="2"
        width="380"
     >
      <v-flex>
          <div class="img rounded-circle mx-auto">
            <v-img src="/img/u.png" />
          </div>
        </v-flex>

                <v-card-title class="d-block text-center "
          >{{ appName }}</v-card-title
        >
      <v-card :title="$t('verify_email')" class="transparent mx-3 pt-5 " elevation="0" style="text-align: center ; background:transparent">
        <template v-if="success" >
          <div class="alert alert-success  " role="alert">
            {{ success }}
          </div>
            <v-btn              
              color="primary"
              class="my-6 mx-2"
            >
          <router-link :to="{ name: 'login' }" 
          class="btn btn-primary"
          style="text-decoration:none ; color:#fff;"
          >
            {{ $t("login") }}
          </router-link>
          </v-btn>
        </template>
        <template v-else>
          <div class="alert alert-danger" role="alert">
            {{ error || $t("error al verificar correo electrónico") }}
          </div>
          
            <v-btn
              color="primary"
              class="my-6 mx-2"
              small
            >
          <router-link
            :to="{ name: 'verification.resend' }"
            class="small float-end"
            style="text-decoration:none ; color:#fff;"
          >
            {{ $t("reenviar enlace") }}
          </router-link>
          </v-btn>
        </template>
      </v-card>
    </v-card>
    </v-flex>
  </v-container>
</template>

<script>
import axios from "axios";

const qs = (params) =>
  Object.keys(params)
    .map((key) => `${key}=${params[key]}`)
    .join("&");

export default {
  async beforeRouteEnter(to, from, next) {
    try {
      const { data } = await axios.post(
        `/api/email/verify/${to.params.id}?${qs(to.query)}`
      );

      next((vm) => {
        vm.success = data.status;
      });
    } catch (e) {
      next((vm) => {
        vm.error = e.response.data.status;
      });
    }
  },
  layout: "basic",
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("verify_email") };
  },

  data: () => ({
    error: "",
    success: "",
    appName: window.config.appName,
  }),
};
</script>
<style scoped>
.main {
  background-image: url("/img/bg-login.jpg");
  background-size: cover;
}

.img {
  height: 7.5rem;
  width: 7.5rem;
  padding: 0.5rem;
}
</style>
