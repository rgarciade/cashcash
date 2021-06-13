<template>
  <v-app>
    <Menu class="Mymenu" ></Menu>
    <Alerts></Alerts>
    <Progress :active="true"></Progress>
    <router-view class='routerView' default="{name: 'home'}"></router-view>
  </v-app>
</template>

<script>
  export default{
	  name: 'app'
  }
</script>