<template>
	<div>
		<div style="-webkit-app-region: drag">
			<v-card>
				<v-card-title class="headline primary lighten-3"
					>Articulos</v-card-title
				>
			</v-card>
		</div>
		<div class="articles_finder">
			<v-text-field v-model="textFinder" label="" solo>
				<v-icon
					slot="prepend"
					color="primary"
					@click="findArticles(textFinder)"
				>
					mdi-magnify
				</v-icon>
			</v-text-field>
		</div>
		<div>
			<v-data-table
				:headers="headers"
				:items="articles.data"
				sort-by="description"
				class="elevation-1"
			>
				<template v-slot:top>
					<v-spacer></v-spacer>
					<v-dialog v-model="dialog" max-width="500px">
						<template v-slot:activator="{ on, attrs }">
							<v-btn
								color="primary"
								dark
								class="new_article"
								v-bind="attrs"
								v-on="on"
							>
								Nuevo Articulo
							</v-btn>
							<v-btn
								color="primary"
								dark
								class="new_article"
								@click="allArticles()"
							>
								<v-icon dark> mdi-reload </v-icon>
							</v-btn>
						</template>
						<v-card class="modal_article">
							<v-card-title>
								<span class="text-h5">{{ formTitle }}</span>
							</v-card-title>

							<v-card-text>
								<v-container>
									<v-row>
										<v-col cols="12" sm="6" md="5">
											<v-text-field
												v-model="editedItem.productid"
												label="Id del producto"
											></v-text-field>
										</v-col>
										<v-col cols="12" sm="6" md="5">
											<v-text-field
												v-model="editedItem.description"
												label="description"
											></v-text-field>
										</v-col>
										<v-col cols="12" sm="6" md="5">
											<v-text-field
												v-model="editedItem.units"
												label="unidades"
											></v-text-field>
										</v-col>
										<v-col cols="12" sm="6" md="5">
											<v-text-field
												v-model="editedItem.purchase_price"
												label="precio de compra"
											></v-text-field>
										</v-col>
										<v-col cols="12" sm="6" md="5">
											<v-text-field
												v-model="editedItem.public_price"
												label="precio de venta"
											></v-text-field>
										</v-col>
									</v-row>
								</v-container>
							</v-card-text>

							<v-card-actions>
								<v-spacer></v-spacer>
								<v-btn color="blue darken-1" text @click="closeDialog">
									Cancel
								</v-btn>
								<v-btn color="blue darken-1" text @click="save"> Save </v-btn>
							</v-card-actions>
						</v-card>
					</v-dialog>
					<v-dialog v-model="dialogDelete" max-width="510px">
						<v-card>
							<v-card-title class="text-h5"
								>¿Esta seguro de borrar el artículo?</v-card-title
							>
							<v-card-actions>
								<v-spacer></v-spacer>
								<v-btn color="blue darken-1" text @click="closeDeleteModal"
									>Cancel</v-btn
								>
								<v-btn color="blue darken-1" text @click="deleteArticles()"
									>OK</v-btn
								>
								<v-spacer></v-spacer>
							</v-card-actions>
						</v-card>
					</v-dialog>
				</template>
				<template v-slot:[`item.units`]="{ item }">
					<v-chip :color="getColor(item.units)" dark>
						{{ item.units }}
					</v-chip>
				</template>
				<template v-slot:[`item.actions`]="{ item }">
					<v-icon small class="mr-2" @click="editItem(item)">
						mdi-pencil
					</v-icon>
					<v-icon small @click="openDeleteItem(item)"> mdi-delete </v-icon>
				</template>
				<template v-slot:no-data>
					<v-btn color="primary" @click="allArticles"> Reset </v-btn>
				</template>
			</v-data-table>
		</div>
	</div>
</template>
<script>
import { mapState, mapActions } from 'vuex'
import _ from 'lodash'
import {
	basePrice,
	addIvaToPrice,
	checkInputs
} from '../functions/commonfunctions'
export default {
	name: 'articles',
	data: () => ({
		newItem: false,
		idMaxLength: checkInputs.idMaxLength,
		rowsPerPage: [
			25,
			50,
			100,
			200,
			{ text: '$vuetify.dataIterator.rowsPerPageAll', value: -1 }
		],
		dialog: false,
		dialogDelete: false,
		headers: [
			{ text: 'Id Articulo', value: 'productid' },
			{ text: 'Descripción', value: 'description' },
			/*   { text: "Precio sin iva", value: "price_without_vat" }, */
			{ text: 'Precio de compra', value: 'purchase_price' },
			{ text: 'Precio de venta', value: 'public_price' },
			/*      { text: "iva", value: "iva" }, */
			{ text: 'unidades', value: 'units' },
			{ text: 'Actions', value: 'actions', sortable: false }
		],
		desserts: [],
		textFinder: '',
		editedIndex: -1,
		editedItem: {
			productid: '',
			description: null,
			units: null,
			purchase_price: null,
			price_without_vat: 0,
			public_price: null,
			public_price_without_vat: 0
		},
		defaultItem: {
			productid: '',
			description: null,
			units: null,
			purchase_price: null,
			price_without_vat: 0,
			public_price: null
		},
		itemToDelete: {}
	}),
	computed: Object.assign({}, mapState(['articles', 'config']), {
		formTitle() {
			return this.editedIndex === -1 ? 'Nuevo artículo' : 'Editar Articulo'
		}
	}),
	watch: {
		textFinder(str, ss) {
			this.findArticles(str)
		}
	},
	methods: Object.assign(
		{},
		mapActions([
			'allArticles',
			'findArticles',
			'saveArticles',
			'updateArticles',
			'deleteAndRechargeArticles'
		]),
		{
			getColor(number) {
				return number ? 'green' : 'red'
			},
			closeDialog() {
				this.dialog = false
				this.$nextTick(() => {
					this.editedItem = Object.assign({}, this.defaultItem)
					this.editedIndex = -1
				})
			},
			editItem(item) {
				this.editedIndex = this.articles.data.indexOf(item)
				this.editedItem = Object.assign({}, item)
				this.dialog = true
			},
			openDeleteItem(item) {
				this.itemToDelete = item
				this.dialogDelete = true
			},
			deleteArticles() {
				this.deleteAndRechargeArticles({
					id: this.itemToDelete.id,
					textFinder: this.textFinder
				})
				this.closeDeleteModal()
			},
			closeDeleteModal() {
				this.dialogDelete = false
				this.itemToDelete = {}
			},
			async saveArticleDialog() {
				await this.saveArticles(this.editedItem)
				await this.allArticles()
				this.closeDialog()
			},
			async save() {
				debugger
				if (this.editedIndex == -1) {
					this.saveArticleDialog()
				} else {
					await this.updateArticles(this.editedItem)
					debugger
					await this.findArticles(this.textFinder)
					this.closeDialog()
				}
			}
		}
	),
	async mounted() {
		this.allArticles()
	}
}
</script>
