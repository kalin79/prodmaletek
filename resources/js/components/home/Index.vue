<template>
     <div>
          <home-banner :listslider="listslider"></home-banner>
          <!-- <home-promocion></home-promocion> -->
          <home-ingresados :productosRecientes="productosRecientes"></home-ingresados>
          <home-linea :rubros="rubros"></home-linea>
          <home-publicidad></home-publicidad>
          <home-blog></home-blog>
          <home-somos></home-somos>
          
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     props: ['slug'],
     name: 'PageHome',
     data(){
          return {
               rubros: [],
               listslider: [],
               productosRecientes: [],
          }
     },
     created(){
          // this.dameTodasCategorias()
     },
     mounted(){
          this.loadApis()
     },
     methods: {
          loadApis: async function(){
               // Traemos las consultas de API 
               
               try{
                    let sendSolicitudAPI = await axios.get(`/api/v1/home`)
                    console.log(sendSolicitudAPI.data.code)
                    // console.log(sendSolicitudAPI.data.data.slider)
                    if (sendSolicitudAPI.data.code === 200){
                         this.listslider = sendSolicitudAPI.data.data.slider
                         this.productosRecientes = sendSolicitudAPI.data.data.recently_entered_products
                    }
               }catch(error){
                    console.log(error)
               }finally{

               }

               // Traemos los rubros
               try{
                    let sendSolicitud = await axios.get(`/data/rubros.json`)
                    // console.log(sendSolicitud.data)
                    // console.log(sendSolicitud)
                    if (sendSolicitud.status === 200){
                         this.rubros = sendSolicitud.data
                    }
               }catch(error){
                    console.log(error)
               }finally{

               }
          },
     }
}
</script>