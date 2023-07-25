<template>
     <div class="boxBanner">
          <div class="owl-carousel owl-carouselBannerContacto owl-theme">
               <div class="item">
                    <div class="imageFullScreem">
                         <picture>
                              <source media="(min-width: 992px)" srcset="/frontend/images/contacto.png">
                              <img src="/frontend/images/contacto.png" alt="Contacto">
                         </picture>
                    </div>
                    <div class="boxInfo">
                         <div class="boxBreadcrumbs">
                              <div class="breadCrumbs">
                                   <a href="/">Principal</a>
                                   <p>\</p>
                                   <a href="/contactenos">Contáctenos</a>
                              </div>
                         </div>
                         <div class="boxDescripcion">
                              <h1>CONTÁCTENOS</h1>
                              <p>Si deseas alguna información adicional de nuestros productos, no dudas en escribirnos.</p>
                         </div>
                    </div>
               </div>
               
          </div>
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'

export default {
     computed: {
          ...mapGetters({
               doneProducto: 'product/getProducto',
               doneCategoria: 'category/getCategoria'
          })
     },
     mounted: function() {
          this.activeCarouselBannerHome()
     },
     methods: {
          dameNombre(data){
               if (data){
                    let newData = data
                    newData = newData.replace('<br>', ' ');
                    newData = newData.replace('<BR>', ' ');
                    return newData
               }
          },
          activeCarouselBannerHome: function () {
               $('.owl-carouselBannerContacto').owlCarousel({
                    loop: false,
                    margin: 0,
                    responsiveClass: true,
                    autoplay: false,
                    autoplayTimeout: 118000,
                    navigation : true,
                    autoplayHoverPause: true,
                    dots: false,
                    nav: false,
                    responsive:{
                         0:{
                              items: 1,
                         }
                    }
               })
          }
     }
}
</script>
