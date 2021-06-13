<template>
    <div>
      <v-snackbar
            v-if="close"
            v-model="alert"
            multi-line
            :timeout=4000
            top
          >
            {{alert}}
            <v-btn
              color="primary"
              flat
              @click="close = false"
            >
              Cerrar
            </v-btn>
          </v-snackbar>
    </div>
</template>
<script>
    import { mapState } from "vuex"
    export default {
        name: 'alert',
        computed: mapState(['alert']),
        data(){
          return { 
            msgActive:false,
            close: false
          }
        },
        watch:{
          alert: function(val){
            if(val != ''){
              this.close = true
            }
          }

        }
    }
</script>
<style scoped>
</style>
