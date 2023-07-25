<template>
     <div class="categoriaPage">
          <banner-interno></banner-interno>
          <div class="container">
               <div class="categoriaGrid">
                    <categoria-filtros></categoria-filtros>
                    <categoria-productos></categoria-productos>
               </div>
          </div>
     </div>
</template>
<script>
// import 'owl.carousel/dist/assets/owl.carousel.css'
// import 'owl.carousel'
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     props: ['slug'],
     name: 'PageCategory',
     computed: {
          ...mapState('categoria',['category/categoria']),
     },
     mounted(){
          // this.eventHover()
     },
     created(){
          this.loadApiCategories()
          this.dameFiltros()
     },
     methods: {
          // eventHover(){
          //      let viewWhatsApp = document.getElementById("boxWhatsApp") 
          //      let viewHover = $(".boxTextWhatsApp")
          //      let _this = this
          //      let hover = gsap.to(viewHover, {x: "-105%", opacity: 1,duration: .5, paused: true, ease: "power1.inOut"})
          //      viewWhatsApp.addEventListener("mouseenter", function(){
          //           hover.play()
          //      })

          //      viewWhatsApp.addEventListener("mouseleave", function(){
          //           hover.reverse()
          //      })
               
          // },
          async dameFiltros(){
               try{
                    // Obtenemos la Filtros
                    let sendSolicitud = await axios.get('/api/v1/get-filters')
                    console.log(sendSolicitud)
                    if (sendSolicitud.data.code === 200){
                         // console.log(sendSolicitud.data.data.filtros[0].chapas)
                         this.$store.commit('category/setFiltroColors', sendSolicitud.data.data.colores)
                         this.$store.commit('category/setFiltroChapas', sendSolicitud.data.data.tipo_cerraduras)
                         this.$store.commit('category/setFiltroPuertas', sendSolicitud.data.data.tipo_cantidad_puertas)
                         this.$store.commit('category/setFiltroCuerpos', sendSolicitud.data.data.tipo_cantidad_cuerpos)
                         this.$store.commit('category/setFiltroMateriales', sendSolicitud.data.data.tipo_material)
                         this.$store.commit('category/setFiltroBandejas', sendSolicitud.data.data.tipo_cantidad_bandejas)
                         this.$store.commit('category/setFiltroCajones', sendSolicitud.data.data.tipo_cantidad_cajones)
                    }
               } catch (error) {
                    console.log(error);
               } finally{

               }
          },
          async loadApiCategories(){
               try{
                    let sendSolicitud = await axios.get(`/api/v1/list-products-rubros/${this.slug}`,)
                    // console.log(sendSolicitud)
                    if (sendSolicitud.data.code === 200){
                         this.category = sendSolicitud.data.data.data_category
                         this.$store.commit('category/setProductos', sendSolicitud.data.data)
                         this.$store.commit('category/setCantidadProductos', sendSolicitud.data.pagination.total)
                    }
               } catch (error) {
                    console.log(error);
               } finally{

               }
          },
          
     }
}
</script>