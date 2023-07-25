<template>
    <div class="sliderContainer" >
          <div class="owl-carousel owl-theme owl-carouselBannerHome">
               <div class="slide" v-for="(item, index) in listslider" :key="index">
                    <div class="bcg">
                         <img src="/frontend/images/fondo.jpg" alt="fondo"  />
                    </div>
                    <div class="slideContent">
                         <div class="container">
                              <div class="contentGrid">
                                   <div>
                                        <div class="boxLogo" v-if="(item.imagemobile != '') && (item.imagemobile != NULL)">
                                             <img :src="item.imagemobile" :alt="item.title" />
                                        </div>
                                        <h2>
                                             {{ item.title }}
                                        </h2>
                                        <p>
                                             {{ item.descripcion }}
                                        </p>
                                        <button v-on:click="irSitio(item.link)">VER PRODUCTOS</button>
                                   </div>
                                   <div>
                                        <img :src="item.image" :alt="item.title" />
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
              
          </div>
    </div>
</template>
<script>

import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     props: ['listslider'],
     data() {
          return {
          }
     },
     computed: {
          // ...mapGetters({
          //      doneCategory: 'category/getCategoria'
          // })
     },
     mounted: function() {
          const _this = this
          setTimeout(() => {
               _this.activeCarouselBannerHome()
          }, 1000);
          
     },
     methods: {
          irSitio: function(url){
               top.location.href = url
          },
          activeCarouselBannerHome: function () {
               $('.owl-carouselBannerHome').owlCarousel({
                    loop: false,
                    margin: 0,
                    responsiveClass: true,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    navigation : true,
                    autoplayHoverPause: true,
                    dots: true,
                    nav: true,
                    responsive:{
                         0:{
                              items: 1,
                              nav: false,
                         },
                         992:{
                              items: 1,
                              nav: true,
                         }
                    }
               })
          }
     }
}
</script>