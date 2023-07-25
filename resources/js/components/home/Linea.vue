<template>
     <div class="homeLineaProducto">
          <div class="container">
               <div class="gridLinea">
                    <div class="itemLinea">
                         <h1>Línea de productos <br>por sector</h1>
                         <p>Descubre nuestra amplia gama de productos diseñados específicamente para satisfacer las necesidades del sector minero, gimnasios, alimenticio, educación, agro y construcción.</p>
                    </div>
                    <div class="itemLinea">
                         <div class="sliderContainer">
                              <div class="owl-carousel owl-theme owl-carouselBannerHomeLimea">
                                   <div class="slide" v-for="(item,index) in rubros" :key="index">
                                        <div class="boxImage">
                                             <img :src="item.imagen" :alt="item.name">
                                        </div>
                                        <div class="boxInfo">
                                             <h2>{{ item.name }}</h2>
                                             <a :href="item.slug">
                                                  <p>VER PRODUCTOS</p>
                                                  <img src="/frontend/images/arrow3.png" :alt="item.name" />
                                             </a>
                                        </div>
                                   </div>
                                   <!-- <div class="slide">
                                        <div class="boxImage">
                                             <img src="/frontend/images/l2.png" alt="Clubes, Gimnasios y SPA's">
                                        </div>
                                        <div class="boxInfo">
                                             <h2>Entretenimiento y Recreacion</h2>
                                             <a href="#">
                                                  <p>VER PRODUCTOS</p>
                                                  <img src="/frontend/images/arrow3.png" alt="ver productos" />
                                             </a>
                                        </div>
                                   </div>
                                   <div class="slide">
                                        <div class="boxImage">
                                             <img src="/frontend/images/l3.png" alt="Educación">
                                        </div>
                                        <div class="boxInfo">
                                             <h2>Educación</h2>
                                             <a href="#">
                                                  <p>VER PRODUCTOS</p>
                                                  <img src="/frontend/images/arrow3.png" alt="ver productos" />
                                             </a>
                                        </div>
                                   </div>
                                   <div class="slide">
                                        <div class="boxImage">
                                             <img src="/frontend/images/l1.png" alt="Construcción">
                                        </div>
                                        <div class="boxInfo">
                                             <h2>Construcción</h2>
                                             <a href="#">
                                                  <p>VER PRODUCTOS</p>
                                                  <img src="/frontend/images/arrow3.png" alt="ver productos" />
                                             </a>
                                        </div>
                                   </div> -->
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</template>
<script>
export default {
     props: ['rubros'],
     data() {
          return {
          }
     },
     mounted: function() {
          var _this = this
          setTimeout(() => {
               _this.activeCarouselBannerHomeLinea()   
          }, 1000);
     },
     methods: {
          activeCarouselBannerHomeLinea: function () {
               $('.owl-carouselBannerHomeLimea').owlCarousel({
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
                              items: 3,
                         }
                    }
               })
          }
     }
}
</script>