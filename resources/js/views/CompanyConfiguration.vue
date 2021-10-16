<template>
    <div>
        aaa
    </div>
</template>

<script>

import { mapState, mapActions } from "vuex";
import {
    findChangesInObjetExist,
    checkInputs
} from "../functions/commonfunctions";
export default {
    name: "CompanyConfiguration",
    async mounted() {
        let id = this.$route.params.companyId;
        if (id !== undefined) {
            this.companyId = id;
            this.companyName = this.companyConfigurationView(id);
        } else {
            this.$router.push({ name: "Empresas" });
        }
    },
    created() {
    },
    data() {
        return {
            companyName: "",
            telephoneRules: checkInputs.telephoneRules,
            email: "",
            contactEmailError: false,
            emailRules: checkInputs.emailRules,
            nombreContacto: "",
            newContact: "",
            newContactEmail: "",
            newContacttelephone: "",
            nameRules: checkInputs.nameRules,
            controlDigit: checkInputs.controlDigit
        };
    },
    computed: mapState(["companyData", "companyDataContacts"]),
    methods: Object.assign(
        {},
        mapActions([
            "companyConfigurationView",
            "addNewContact",
            "updateCompanyData",
            "deleteContactFromId"
        ]),
        {
            insertNewContact() {
                let contact = {
                    id: this.companyData.id,
                    newContact: this.newContact,
                    newContactEmail: this.newContactEmail,
                    newContacttelephone: this.newContacttelephone
                };
                if (contact.newContactEmail && /.+@.+/.test(contact.newContactEmail)) {
                    this.contactEmailError = false;
                    this.addNewContact(contact);
                } else {
                    this.contactEmailError = true;
                }
            },
            updateCompany() {
                let company = {
                    companyId: this.companyData.id,
                    cif: document.getElementById("c_cif").value,
                    name: document.getElementById("c_name").value,
                    contact: document.getElementById("c_contact").value,
                    telephone: document.getElementById("c_telephone").value,
                    email: document.getElementById("c_email").value,
                    mobile: document.getElementById("c_mobile").value,
                    banck: document.getElementById("c_banck").value.toUpperCase(),
                    cta: document.getElementById("c_cta").value,
                    province: document.getElementById("c_province").value,
                    city: document.getElementById("c_city").value,
                    postalcode: document.getElementById("c_postalcode").value,
                    street: document.getElementById("c_street").value,
                    notas: document.getElementById("c_notas").value
                };
                console.error(company);
                if (findChangesInObjetExist(company, this.companyData)) {
                    this.updateCompanyData(company);
                }
            },
            deleteContact(deleteFocustId) {
                const data = {
                    companyId: this.companyData.id,
                    deleteFocustId: deleteFocustId
                };
                this.deleteContactFromId(data);
            },
            goLastRoute() {
                this.$router.go(-1);
            }
        }
    )
};
</script>

<style scoped>

</style>
