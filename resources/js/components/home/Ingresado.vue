<template>
     <div>
          <div class="homeBoxIngresado">
               <div class="container">
                    <div class="boxCard">
                         <h2>Productos recién ingresados</h2>
                         <div class="sliderContainer">
                              <div class="owl-carousel owl-theme owl-carouselBannerHomeIngresados">
                                   <div class="slide" v-for="(item, index) in productosRecientes" :key="index">
                                        <a :href="`/producto/${item.slug}`">
                                             <div class="boxImage">
                                                  <img :src="item.image" :alt="item.title" />
                                             </div>
                                             <div class="boxContent">
                                                  <h3 v-html="item.title"></h3>
                                                  <p>{{ item.categoria }}</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</template>
<script>
export default {
     props: ['productosRecientes'],
     data() {
          return {
          }
     },
     mounted: function() {
          const _this = this
          setTimeout(() => {
               _this.activeCarouselBannerHomeIngresados()
          }, 1000);
     },
     methods: {
          activeCarouselBannerHomeIngresados: function () {
               $('.owl-carouselBannerHomeIngresados').owlCarousel({
                    loop: false,
                    margin: 20,
                    responsiveClass: true,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    navigation : true,
                    autoplayHoverPause: true,
                    dots: false,
                    nav: true,
                    responsive:{
                         0:{
                              items: 2,
                         },
                         992:{
                              items: 5,
                         }
                    }
               })
          }
     }
}
</script>