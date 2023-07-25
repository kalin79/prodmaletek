<template>
     <div class="productoPage">
          <producto-detalle></producto-detalle>
          <home-publicidad></home-publicidad>
          <productos-complementarios></productos-complementarios>
     </div>
</template>
<script>
// import 'owl.carousel/dist/assets/owl.carousel.css'
// import 'owl.carousel'
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     props: ['slug'],
     name: 'PageProduct',
     created(){
          this.dameProducto()
     },
     mounted(){
          this.eventHover()
     },
     methods: {
          eventHover(){
               let viewWhatsApp = document.getElementById("boxWhatsApp") 
               let viewHover = $(".boxTextWhatsApp")
               let _this = this
               let hover = gsap.to(viewHover, {x: "-105%", opacity: 1,duration: .5, paused: true, ease: "power1.inOut"})
               viewWhatsApp.addEventListener("mouseenter", function(){
                    hover.play()
               })

               viewWhatsApp.addEventListener("mouseleave", function(){
                    hover.reverse()
               })
               
          },
          async dameProducto(){
               try{
                    // Obtenemos la Filtros
                    let sendSolicitud = await axios.get(`/api/v1/producto/${this.slug}`)
                    // console.log(sendSolicitud.data.data.producto[0])
                    // console.log(sendSolicitud)
                    if (sendSolicitud.data.code === 200){
                         this.$store.commit('product/setProducto', sendSolicitud.data.data.product)
                         this.$store.commit('product/setComplementarios', sendSolicitud.data.data.related_products)
                         this.$store.commit('product/setGalerias', sendSolicitud.data.data.product.galleries)
                         // this.$store.commit('category/setCategoria', sendSolicitud.data.data.categoria)
                         this.$store.commit('product/setColores', sendSolicitud.data.data.product.colores)
                         // this.$store.commit('product/setChapas', sendSolicitud.data.data.chapas)
                         // this.$store.commit('product/setPuertas', sendSolicitud.data.data.puertas)
                         // this.$store.commit('product/setCuerpos', sendSolicitud.data.data.cuerpos)
                    }
               } catch (error) {
                    console.log(error);
               } finally{

               }
          }
     },
}
</script>
