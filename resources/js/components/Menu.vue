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
      class='background_img fixedmenu position_menu'
    >
      <v-list-item class="px-2 ">

        <v-btn
          icon
          v-if="mini" @click.stop="mini = !mini"
        >
          <v-icon class='menu_arrow_right'>mdi-chevron-right</v-icon>
        </v-btn>
        <v-btn
          icon
          @click.stop="mini = !mini"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense>
        <v-list-item
          v-for="item in menuRoutes"
          :key="item.title"
          link
        >
          <v-list-item-icon>
            <v-icon color="blue">{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title >{{ item.title }}</v-list-item-title>
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