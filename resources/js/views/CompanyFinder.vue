<template>
  <div>
    <div style="-webkit-app-region: drag">
      <v-card>
        <v-card-title class="headline primary lighten-3">
          Empresas
          <v-btn icon class="button_add_company" @click="activeNewCompany = true">
            <v-icon>mdi-account-plus</v-icon>
          </v-btn>
        </v-card-title>
      </v-card>
      <v-text-field
        v-on:keyup="findCompanys(textFinder)"
        label="buscar..."
        placeholder="Buscar"
        solo
        v-model="textFinder"
      ></v-text-field>
    </div>
    <div>
      <v-row>
        <v-col
          v-for="company in companys.data"
          :key="company.id"
          row
          justify-space-around
          style="margin: 1em"
        >
            <v-hover>
              <v-card
                color="blue-grey darken-2"
                slot-scope="{ hover }"
                min-width="24em"
                :class="`elevation-${hover ? 24 : 2}`"
                class="white--text"
              >
                <v-card-title primary-title>
                    <div class="headline">{{company.name}}</div>
                </v-card-title>
                <v-card-text class="white--text">
                  <div>
                    <span>Id empresa: {{company.id}}</span>
                    <br>
                    <span>telefono: {{company.telephone}}</span>
                    <br>
                    <span>cif: {{company.cif}}</span>
                    <br>
                  </div>
                 </v-card-text>
                  <v-card-actions>
                    <v-btn  color="orange" :href="`mailto:${company.email}`" dark>
                      <v-icon>mdi-email</v-icon>
                    </v-btn>
                    <v-btn  to="conpanyconfiguration" color="orange">ver</v-btn>
                  </v-card-actions>
              </v-card>
            </v-hover>
        </v-col>
      </v-row>
    </div>
    <NewCompany v-bind:active="activeNewCompany" @disable="activeNewCompany = $event "></NewCompany>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "companysfinder",
  created() {
    this.findCompanys("");
  },
  data() {
    return {
      activeNewCompany: false,
      textFinder:''
    };
  },
  computed: mapState(["companys"]),
  methods: Object.assign({}, mapActions(["findCompanys"]), {})
};
</script>