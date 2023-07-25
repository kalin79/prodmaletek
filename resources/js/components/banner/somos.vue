<template>
    <div class="boxBanner">
          <div class="boxBreadcrumb">
               <div class="container">
                    <div class="breadcrumb">
                         <p>Principal</p>
                         <img src="/frontend/images/break.png" alt="" />
                         <p>Acerca de Nosotros</p>
                    </div>
               </div>
          </div>
          <div class="owl-carousel owl-carouselBannerSomos owl-theme">
              <div class="item">
                   <div class="imageFullScreem">
                        <picture>
                             <source media="(min-width: 992px)" srcset="/frontend/images/somosbanner.png">
                             <img src="/frontend/images/somosmovil.png" alt="Contacto">
                        </picture>
                   </div>
                   <div class="boxInfo">
                        <div class="boxBreadcrumbs">
                             <div class="breadCrumbs">
                                  <a href="/">Principal</a>
                                  <p>\</p>
                                  <a href="/acerca-de-nosotros">Acerca de Maletek</a>
                             </div>
                        </div>
                        <div class="boxDescripcion">
                             <h1>ACERCA DE NOSOTROS</h1>
                             <p>Somos la empresa líder en alquiler y venta de lockers, con más de 20 años de experiencia en el mercado peruano. </p>
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
              $('.owl-carouselBannerSomos').owlCarousel({
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
