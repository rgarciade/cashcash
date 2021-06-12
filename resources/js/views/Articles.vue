<template>
  <div>
    <div style="-webkit-app-region: drag">
      <v-card>
        <v-card-title class="headline primary lighten-3">Articulos</v-card-title>
      </v-card>
      <v-text-field
        v-on:keyup="findArticles({ textFinder : textFinder, findAll: true})"
        label="Solo"
        placeholder="Buscar"
        solo
        v-model="textFinder"
      ></v-text-field>
    </div>
    <v-toolbar flat color="white">
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="70%">
        <template v-slot:activator="{ on }">
          <v-btn
            color="primary"
            @click="statusNewItem(true)"
            dark
            class="mb-2"
            v-on="on"
          >Nuevo Articulo</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm5 md2>
                  <v-text-field
                    v-model="editedItem.productid"
                    label="Id del prroducto"
                    :rules="idMaxLength"
                    validate-on-blur
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm3 md2>
                  <v-text-field v-model="editedItem.units" label="unidades"></v-text-field>
                </v-flex>
                <v-flex xs12 sm4 md4>
                  <v-text-field v-model="editedItem.purchase_price" label="precio de compra sin iva"></v-text-field>
                </v-flex>
                <v-flex xs12 sm4 md3>
                  <v-text-field v-model="editedItem.public_price_without_vat" label="precio de venta sin iva" disabled ></v-text-field>
                </v-flex>
              </v-layout>
              <v-layout wrap>
                <v-flex xs12 sm8 md4>
                  <v-text-field v-model="editedItem.description" label="Descripción"></v-text-field>
                </v-flex>
                <v-flex xs12 sm4 md4>
                  <v-text-field
                    v-model="editedItem.price_without_vat"
                    disabled
                    label="precio de compra con iva"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm4 md3>
                  <v-text-field v-model="editedItem.public_price" label="precio de venta con iva"></v-text-field>
                </v-flex>

              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>

    <v-data-table
      :headers="headers"
      :items="articles"
      class="elevation-1 remove_radius"
      :rows-per-page-items="rowsPerPage"
      rows-per-page-text="Listados por pagina"
    >
      <template v-slot:items="props">
        <td>{{ props.item.productid }}</td>
        <td>{{ props.item.description }}</td>
        <td>{{ props.item.price_without_vat }}</td>
        <td>{{ props.item.purchase_price }}</td>
        <td>{{ props.item.public_price }}</td>
        <td>{{ config.vat}}</td>
        <td>
          <input type="number" />
          {{ props.item.units }}
        </td>
        <td class="justify-center layout px-0 actions_icons">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>
<script>
  import { mapState, mapActions } from "vuex";
  import { basePrice, addIvaToPrice,  checkInputs } from "../functions/commonfunctions";
    export default {
        name: "articles",
          data: () => ({
            newItem: false,
            idMaxLength: checkInputs.idMaxLength,
            rowsPerPage: [
                25,
                50,
                100,
                200,
                { text: "$vuetify.dataIterator.rowsPerPageAll", value: -1 }
            ],
            dialog: false,
            headers: [
                { text: "Id Articulo", value: "productid" },
                { text: "Descripción", value: "description" },
                { text: "Precio sin iva", value: "price_without_vat" },
                { text: "Precio de compra", value: "purchase_price" },
                { text: "Precio de venta", value: "public_price" },
                { text: "iva", value: "iva" },
                { text: "unidades", value: "units" },
                { text: "Acciones", value: "name", sortable: false }
            ],
            desserts: [],
            textFinder: "",
            editedIndex: -1,
            editedItem: {
                productid: "",
                description: null,
                units: null,
                purchase_price: null,
                price_without_vat: 0,
                public_price: null,
                public_price_without_vat: 0
            },
            defaultItem: {
                productid: "",
                description: null,
                units: null,
                purchase_price: null,
                price_without_vat: 0,
                public_price: null
            }
        }),
        methods: Object.assign(
          {},
          mapActions(['allArticles'])
        ),
        async mounted() {
          this.allArticles()
        }
    }
</script>
