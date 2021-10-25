import Vue from 'vue'
import Vuex from 'vuex'
const { menuRoutes } = require('../routes')
const actions = require('./actions/actions.js')
const mutations = require('./mutations')
Vue.use(Vuex)
const vuexStore = new Vuex.Store({
	state: {
		count: 3,
		menuRoutes,
		companyData: {
			id: '',
			cif: '',
			name: '',
			contact: '',
			location: '',
			telephone: '',
			email: ''
		},
		articles: [
			{
				productid: null,
				description: null,
				units: null,
				purchase_price: null,
				price_without_vat: null,
				public_price: null
			}
		],
		moneyBox: {
			actualMoneyInBox: 0,
			actualMoneyCard: 0,
			dayToReport: new Date().toISOString().substr(0, 10),
			openReport: null,
			closeReport: null,
			lastReports: [],
			checkUpdate: 0,
			newMoneyInSaleBox: 0,
			newRemoveToBox: 0
		},
		printType: 'nada',
		printers: [],
		printersList: [],
		paymentType: 1,
		creditCard: 0,
		tempItemNumber: -2,
		storeCard: [],
		purchaseToModify: [],
		itemsCardList: [],
		priceStoreCard: 0,
		incomingMoney: 0,
		pricePurchaseToModify: 0,
		priceTicketPreview: 0,
		newCompanyDataId: 0,
		alerts: [],
		companyDataContacts: [],
		progresActive: false,
		companys: [],
		facturations: [],
		tickets: [],
		FacturationListVisibility: true,
		ticketsListVisibility: true,
		ActualFacturationId: 0,
		FacturationPreviewVisibility: false,
		TicketPreviewVisibility: false,
		UpdateButton: true,
		config: {
			vat: 21,
			mail: '',
			mailhost: '',
			mailport: '',
			secure: ''
		},
		accessToken: ''
	},
	actions,
	mutations,
	//strict: process.env.NODE_ENV !== "production"
	strict: 1
})
vuexStore.commit(
	'addAccessToken',
	sessionStorage.getItem('accessTokenCashCash')
)
export default vuexStore
