<template>
  <v-card>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      permanent
      floating
      hide-overlay
      stateless
      absolute
      dark
      expand-on-hover
      class='background_img fixedmenu position_menu'
    >
      <v-list-item class="px-2">
        <v-list-item-avatar style="border-radius: 0%">
          <v-img src="../../images/logo.png"></v-img>
        </v-list-item-avatar>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense>
        <v-list-item
          v-for="item in menuRoutes"
          :key="item.title"
          link
          :to='item.route'
          @click.stop="mini = true"
        >
          <v-list-item-icon>
            <v-icon color="primary">{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content >
            <v-list-item-title class="indigo--text font-weight-black" >{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
  import { mapState } from "vuex"
  export default {
      name: 'Menu',
      computed: mapState(["menuRoutes"]),
      data() {
          return {
              drawer: true,
              mini: true,
              right: null
          }
      }
  }
</script>