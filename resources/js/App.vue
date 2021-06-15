<template>
  <v-app>
    <Menu class="Mymenu"/>
    <AlertsList class="alets"/>
    <Progress :active="true"/>
    <router-view class='routerView' default="{name: 'home'}"/>
  </v-app>
</template>

<script>
  export default{
	  name: 'app'
  }
</script>