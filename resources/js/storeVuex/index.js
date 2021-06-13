import Vue from "vue"
import Vuex from "vuex"
const { menuRoutes } = require('../routes')
const actions = require('./actions/actions.js')
const mutations = require('./mutations')
Vue.use(Vuex)
export default new Vuex.Store({
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
        articles: {
            data: [{
                productid: null,
                description: null,
                units: null,
                purchase_price: null,
                price_without_vat: null,
                public_price: null
            }],
            articlesPerPage:0,
            currentPage:1,
            lastPage:1
        },
		moneyBox:{
			actualMoneyInBox : 0,
			actualMoneyCard : 0,
			dayToReport: new Date().toISOString().substr(0, 10),
			openReport: null,
			closeReport: null,
			lastReports:[],
			checkUpdate:0,
			newMoneyInSaleBox:0,
			newRemoveToBox:0,
		},
		printType:'nada',
		printers : [],
		printersList : [],
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
        alert: "",
        companyDataContacts: [],
        progresActive: false,
        companys: [],
        facturations:[],
        tickets:[],
        FacturationListVisibility:true,
        ticketsListVisibility:true,
        ActualFacturationId:0,
        FacturationPreviewVisibility:false,
        TicketPreviewVisibility:false,
		UpdateButton:true,
		config:{
			vat:21,
			mail:'',
			mailhost:'',
			mailport:'',
			secure: ''
		}
    },
    actions,
    mutations,
    //strict: process.env.NODE_ENV !== "production"
    strict: 1
})