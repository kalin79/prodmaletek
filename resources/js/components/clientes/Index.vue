<template>
    <div class="boxClientes">
        <h4>Clientes que confían en nosotros...</h4>
        <div class="boxLogos">
            <div class="sliderContainer">
                <div class="owl-carousel owl-theme owl-carouselBannerHomeLogos">
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie1.svg" alt="Real Plaza"  />
                    </a>
                    <a href="#" target="_blank" >
                        <img src="/frontend/images/clie2.svg" alt="Bembos" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie3.svg" alt="Cencosud"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie4.svg" alt="Sodimac Home Center"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie5.svg" alt="Super Mercados Peruanos SA"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie6.svg" alt="Gloria"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie7.svg" alt="Popeyes"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie8.svg" alt="Mediterraneo" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie9.svg" alt="Mediterraneo" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie10.svg" alt="Mediterraneo" />
                    </a>

                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie11.svg" alt="Real Plaza"  />
                    </a>
                    <a href="#" target="_blank" >
                        <img src="/frontend/images/clie12.svg" alt="Bembos" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie13.svg" alt="Cencosud"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie14.svg" alt="Sodimac Home Center"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie15.svg" alt="Super Mercados Peruanos SA"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie16.svg" alt="Gloria"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie17.svg" alt="Popeyes"  />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie18.svg" alt="Mediterraneo" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="/frontend/images/clie19.svg" alt="Mediterraneo" />
                    </a>
                    <!-- <a href="#" target="_blank">
                        <img src="/frontend/images/clie20.svg" alt="Mediterraneo" />
                    </a> -->
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
     created(){
          // this.dameTodasCategorias()
     },
     mounted(){
            this.initLogos()
     },
     methods: {
        initLogos: function () {
               $('.owl-carouselBannerHomeLogos').owlCarousel({
                    loop: true,
                    margin: 20,
                    responsiveClass: true,
                    autoplay: true,
                    autoplayTimeout: 2500,
                    navigation : true,
                    autoplayHoverPause: true,
                    dots: true,
                    nav: false,
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