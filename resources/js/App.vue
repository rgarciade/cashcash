<template>
  <v-app>
    <Menu class="Mymenu" v-if="logued"/>
    <AlertsList class="alets" />
    <ProgressBar :active="true"/>
    <router-view class='routerView'/>
  </v-app>
</template>

<script>
  import { mapState } from "vuex";
  export default{
	  name: 'app',
    data: () => ({
      route: 'home' 
    }),
    computed: Object.assign({}, mapState(["logued"]), {}),
    beforeMount() {
      if(!this.logued){
        this.$router.push('login')
      }
    }
  }
</script>