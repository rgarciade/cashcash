<template>
    <div>
      <v-alert
        v-model="alertData"
        border="left"
        margin-left='20%'
        dismissible
        type="error">
        {{alertData.message}}
      </v-alert>
    </div>
</template>
<script>
    import { mapActions } from "vuex"
    export default {
        name: 'alert',
        props: [ "alertData" ],
        data(){
          return { 
            msgActive:false,
            close: false
          }
        },
        methods: mapActions(['removeAlert']),
        computed:{
          typeClass() {
            return `alert-${this.alert.type}`
          }
        },
        created(){
          this.timeout = setTimeout(() => {
            this.removeAlert(this.alertData.id)
          }, 4000);
        },
        beforeDestroy(){
          clearTimeout(this.timeout)
        }
    }
</script>
<style scoped>
</style>
