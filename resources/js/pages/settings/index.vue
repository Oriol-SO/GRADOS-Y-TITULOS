<template>
  <div class="row justify-content-center" >
    <div class="justify-space-around row">
      <v-card :title="$t('settings')" 
        class="settings-card" 
        height="300px"
        
        >
        <ul class="nav flex-column nav-pills ">
          
          <li v-for="tab in tabs" :key="tab.route" class="nav-item ">
            
            <router-link 
              :to="{ name: tab.route }"
              class="nav-link"
              active-class="active"
            >
              <fa :icon="tab.icon" fixed-width />
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </v-card>
    </div>

    <div class="col-md-7">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  computed: {
    tabs() {
      return [
        {
          icon: "user",
          name: this.$t("profile"),
          route: "settings.profile",
        },
        {
          icon: "lock",
          name: this.$t("password"),
          route: "settings.password",
        },
      ];
    },
  },
};
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
