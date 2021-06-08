<template>
  <v-app>
    <router-view class='routerView' default="{name: 'home'}"></router-view>
  </v-app>
</template>

<script>
  export default{
	  name: 'app'
  }
</script>