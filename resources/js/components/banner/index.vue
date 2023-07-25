<template>
     <div>
          <div class="bannerCategoria">
               <div class="boxBreadcrumb">
                    <div class="container">
                         <div class="breadcrumb">
                              <p>Principal</p>
                              <img src="/frontend/images/break.png" alt="" />
                              <p>{{ titleCategory }}</p>
                         </div>
                    </div>
               </div>
               <div class="owl-carousel owl-carouselBannerCategoria owl-theme">
                    <div class="item" v-for="(banner, index) in category" :key="index">
                         <div class="imageFullScreem">
                              <picture>
                                   <source media="(min-width: 992px)" :srcset="`/frontend/images/bannerCat1.png`">
                                   <img :src="`/frontend/images/bannerCat1Movil.png`" :alt="`SDSDDS`">
                              </picture>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'

export default {
     props: ['category','titleCategory'],
     computed: {

     },
     mounted: function() {
          this.activeCarouselBannerHome()
     },
     methods: {
          activeCarouselBannerHome: function () {
               $('.owl-carouselBannerCategoria').owlCarousel({
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
