<template>
     <div>
          <div class="componentComplementario">
               <div class="container">
                    <div class="gridComplementario">
                         <div class="boxSubTitle">
                              <h2>
                                   Productos <br>
                                   Relacionados
                              </h2>
                         </div>
                         <div class="listProducts">
                              <div class="owl-carousel owl-carouselComplementario owl-theme">
                                   <div class="item" v-for="(complemento, index) in complementarios" :key="index">
                                        <div class="imageFullScreem">
                                             <picture>
                                                  <source media="(min-width: 992px)" :srcset="complemento.image">
                                                  <img :src="complemento.image" :alt="complemento.title">
                                             </picture>
                                        </div>
                                        <div class="boxInfo">
                                             <h3 v-html="complemento.title"></h3>
                                             <p v-html="complemento.categoria"></p>
                                        </div>
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
     computed: {
          ...mapGetters({
               complementarios: 'product/getComplementarios',
          })
     },
     mounted: function() {
         let _this = this;
          setTimeout(function(){
              _this.activeCarouselComplementario()
          },1000)
         
     },
     methods: {
          activeCarouselComplementario: function () {
               $('.owl-carouselComplementario').owlCarousel({
                    loop: false,
                    margin: 0,
                    responsiveClass: true,
                    autoplay: false,
                    autoplayTimeout: 118000,
                    navigation : true,
                    autoplayHoverPause: true,
                    dots: true,
                    nav: false,
                    margin: 20,
                    responsive:{
                         0:{
                              items: 2,
                         },
                         768:{
                              items: 2,
                         },
                         992:{
                              items: 4,
                         }
                    }
               })
          }
     }
}
</script>