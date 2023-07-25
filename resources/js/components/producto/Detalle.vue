<template>
     <div class="boxDetail">
          <div class="container">
               <div class="detailGrid">
                    <div class="boxGallery">
                         <!-- <div id="slider-1" class="owl-carousel owl-carouselInterno owl-theme">
                              <div class="item relative" v-for="(galeria,index) in galerias" :key="index">
                                   <div class="imageFullScreem">
                                        <picture>
                                             <source media="(min-width: 992px)" :srcset="`https://locker.codegraph.pe/${galeria.foto}`">
                                             <img :src="`https://locker.codegraph.pe/${galeria.foto}`" />
                                        </picture>
                                   </div>
                              </div>
                         </div> -->
                         <div class="boxBreadcrumb">
                              <div class="breadcrumb">
                                   <p>Principal</p>
                                   <img src="/frontend/images/break.png" alt="" />
                                   <p>{{ producto.categoria }}</p>
                                   <img src="/frontend/images/break.png" alt="" />
                                   <p>Modelo LP1-02</p>
                              </div>
                         </div>
                         <div id="slider-0" class="owl-carousel owl-carouselInterno3 owl-theme">
                              <div class="item" v-for="(galeria, index) in galerias" :key="index">
                                   <div class="imageFullScreem">
                                        <picture>
                                             <source media="(min-width: 992px)" :srcset="galeria">
                                             <img :src="galeria"  />
                                        </picture>
                                   </div>
                              </div>
                              
                         </div>
                         <div id="slider-1" class="owl-carousel owl-carouselInterno owl-theme">
                              <div class="item" v-for="(galeria, index) in galerias" :key="index">
                                   <div class="imageFullScreem">
                                        <picture>
                                             <source media="(min-width: 992px)" :srcset="galeria">
                                             <img :src="galeria"  />
                                        </picture>
                                   </div>
                              </div>
                         </div>
                         <div id="slider-2" class="owl-carousel owl-carouselInterno2 owl-theme">
                              <div class="item" v-for="(galeria, index) in galerias" :key="index">
                                   <div class="imageFullScreem">
                                        <picture>
                                             <source media="(min-width: 992px)" :srcset="galeria">
                                             <img :src="galeria"  />
                                        </picture>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="boxCaracteristicasProducto">
                         <div class="boxEtiqueta">
                              <h3>{{ producto.categoria }}</h3>
                         </div>
                         <div class="boxTitle">
                              <h1 v-html="producto.title"></h1>
                              <h2 v-html="producto.codigo"></h2>
                         </div>
                         <div class="accordion" id="accordionPanelsStayOpenProduct">
                              <div class="accordion-item active">
                                   <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Descripción
                                        </button>
                                   </h2>
                                   <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                             <p v-html="producto.descripcion"></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="accordion-item">
                                   <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        Usos
                                        </button>
                                   </h2>
                                   <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                             <p v-html="producto.usos"></p>
                                        </div>
                                   </div>
                              </div>
                              <div class="accordion-item">
                                   <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                             Características
                                        </button>
                                   </h2>
                                   <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                             <table class="table table-striped">
                                                  <tbody>
                                                       <tr v-if="(producto.alto != null ) && (producto.alto != '')">
                                                            <td width="50%"><p class="bold">Alto:</p></td>
                                                            <td><p >{{ producto.alto }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.ancho != null ) && (producto.ancho != '')">
                                                            <td ><p class="bold">Ancho:</p></td>
                                                            <td><p>{{ producto.ancho }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.fondo != null ) && (producto.fondo != '')">
                                                            <td><p class="bold">Fondo:</p></td>
                                                            <td><p>{{ producto.fondo }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.cantidad_puertas != null ) && (producto.cantidad_puertas != '')">
                                                            <td><p class="bold">Cantidad de puertas:</p></td>
                                                            <td><p>{{ producto.cantidad_puertas }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.alto_puerta != null ) && (producto.alto_puerta != '')">
                                                            <td><p class="bold">Alto de puerta:</p></td>
                                                            <td><p>{{ producto.alto_puerta }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.ancho_puerta != null ) && (producto.ancho_puerta != '')">
                                                            <td><p class="bold">Ancho de puerta:</p></td>
                                                            <td><p>{{ producto.ancho_puerta }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.material != null ) && (producto.material != '')">
                                                            <td><p class="bold">Material:</p></td>
                                                            <td><p>{{ producto.material }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.pintura != null ) && (producto.pintura != '')">
                                                            <td><p class="bold">Pintura:</p></td>
                                                            <td><p>{{ producto.pintura }}</p></td>
                                                       </tr>
                                                       <tr v-if="colores.length > 0">
                                                            <td><p class="bold">Colores:</p></td>
                                                            <td>
                                                                 <div class="d-flex">
                                                                      <div class="boxColor" v-for="(color,index) in colores" :key="index" :style="`background: ${color.color_estilo}`"></div>
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       <tr v-if="(producto.puerta_reforsada != null ) && (producto.puerta_reforsada != '')">
                                                            <td><p class="bold">Puertas reforzadas:</p></td>
                                                            <td><p>{{ producto.puerta_reforsada }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.tipo_cerradura != null ) && (producto.tipo_cerradura != '')">
                                                            <td><p class="bold">Tipo cerradura:</p></td>
                                                            <td><p>{{ producto.tipo_cerradura }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.cuerpos != null ) && (producto.cuerpos != '')">
                                                            <td><p class="bold">Cuerpos:</p></td>
                                                            <td><p>{{ producto.cuerpos }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.bisagras != null ) && (producto.bisagras != '')">
                                                            <td><p class="bold">Bisagras:</p></td>
                                                            <td><p>{{ producto.bisagras }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.accesor != null ) && (producto.accesor != '')">
                                                            <td><p class="bold">Accesorios:</p></td>
                                                            <td><p>{{ producto.accesor }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.ventilacion != null ) && (producto.ventilacion != '')">
                                                            <td><p class="bold">Ventilación:</p></td>
                                                            <td><p>{{ producto.ventilacion }}</p></td>
                                                       </tr>
                                                       <tr v-if="(producto.garantia != null ) && (producto.garantia != '')">
                                                            <td><p class="bold">Ventilación:</p></td>
                                                            <td><p>{{ producto.garantia }}</p></td>
                                                       </tr>
                                                       
                                                  </tbody>
                                             </table>
                                             
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="boxFileDownload">
                              <a :href="producto.ficha_tecnica" target="_blank">
                                   <img src="/frontend/images/file.png" alt="DESCARGAR FICHA TÉCNICA" /> 
                                   <p>DESCARGAR FICHA TÉCNICA</p>
                              </a>
                         </div>
                         <div class="boxCompra">
                              <div class="boxSelectorCantidad">
                                   <p>Selecciona cantidad:</p>
                                   <div class="boxCantidad">
                                        <a href="javascript:void(0)" class="left" v-on:click="disminuirItem()">-</a>
                                        <div class="boxNumber">{{ cantidad }}</div>
                                        <a href="javascript:void(0)" class="right" v-on:click="aumentarItem()">+</a>
                                   </div>
                              </div>
                              <div class="boxCotizacion">
                                   <button v-on:click="abrirCotizador()">
                                        <img src="/frontend/images/coti.png" alt="PIDE TU COTIZACIÓN" />
                                        <p>PIDE TU COTIZACIÓN</p>
                                   </button>
                              </div>
                              <div class="boxAsesor">
                                   <a :href="url" target="_blank">
                                        <img src="/frontend/images/whatsapp6.svg" >
                                        <p>Quiero un Asesor</p>
                                   </a>
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
     data() {
          return {
               sync1: $("#slider-1"),
               sync2: $("#slider-2"),
               syncedSecondary: false,
               url: ""
          }
     },
     computed: {
          ...mapGetters({
               producto: 'product/getProducto',
               galerias: 'product/getGalerias',
               colores: 'product/getColores',
               // chapas: 'product/getChapas',
               // puertas: 'product/getPuertas',
               // cuerpos: 'product/getCuerpos',
               cantidad: 'product/getCantidad',
          })
     },
     mounted: function() {
         this.sync1 =  $("#slider-1");
         this.sync2 =  $("#slider-2");
         this.syncedSecondary = true;
         let _this = this;
         setTimeout(function(){
              _this.activeAllCarousel()
              _this.goWhatsApp()
              _this.activeCarouselMovil()
         },1000)
         this.accordion()
         
         
     },
     methods: {
          activeCarouselMovil: function () {
               $('.owl-carouselInterno3').owlCarousel({
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
                              items: 1,
                         }
                    }
               })
          },
          accordion: function() {
               const myCollapsible = document.getElementById('accordionPanelsStayOpenProduct')
               myCollapsible.addEventListener('hidden.bs.collapse', event => {
                    const elementParent = event.target.parentElement
                    if (elementParent.classList.contains('active')){
                         elementParent.classList.remove('active')  
                    }
               })

               const showCollapsible = document.getElementById('accordionPanelsStayOpenProduct')
               showCollapsible.addEventListener('shown.bs.collapse', event => {
                    const elementParent = event.target.parentElement
                    if (!elementParent.classList.contains('active')){
                         elementParent.classList.add('active')
                    }
               })
          },
          goWhatsApp: function(){
               // console.log(this.producto.nombre)
               let miproducto = this.producto.nombre
               let espacio = "%20"
               this.url = `https://api.whatsapp.com/send?phone=51938256301&text=Hola${espacio}Locker+Plus,${espacio}te${espacio}escribo${espacio}desde${espacio}la${espacio}web.${espacio}Estoy${espacio}interesado${espacio}en${espacio}el${espacio}producto:${espacio}${miproducto}${espacio},`
               
          },
          aumentarItem: function(){
               
               this.$store.commit('product/setCantidad', (this.cantidad + 1))
          },
          disminuirItem: function(){
               if (this.cantidad  >= 2)
                    this.$store.commit('product/setCantidad', (this.cantidad - 1))
          },
          abrirCotizador: function(){
               $("#boxFormCotizadorProducto").addClass('active')
          },
          syncPosition2: function(e){
               if (this.syncedSecondary) {
                    var number = e.item.index;
                    this.sync1.data('owl.carousel').to(number, 100, true);
               }
          },
          syncPosition: function(e){
               //if you set loop to false, you have to restore this next line
               //var current = el.item.index;

               //if you disable loop you have to comment this block
               // console.log(e.item)
               // var count = e.item.count - 1;
               var count = e.item;
               // console.log(count.index)
               var current = count.index
               var current = Math.round(current - (e.item.count / 2) - .5);

               if (current < 0) {
                    current = count;
               }
               if (current > count) {
                    current = 0;
               }

               //end block

               this.sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");

               let onscreen = this.sync2.find('.owl-item.active').length - 1;
               let start = this.sync2.find('.owl-item.active').first().index();
               let end = this.sync2.find('.owl-item.active').last().index();

               if (current > end) {
                    this.sync2.data('owl.carousel').to(current, 100, true);
               }
               if (current < start) {
                    this.sync2.data('owl.carousel').to(current - onscreen, 100, true);
               }
          },
          activeAllCarousel: function () {
               let slidesPerPage = 5; //globaly define number of elements per page
               const _this = this;
               // console.log(this.sync1)
               this.sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    margin: 10,
                    autoplay: false, 
                    dots: false,
                    loop: false,
                    responsiveRefreshRate: 200,
                    responsive:{
                         0:{
                              dots: true,
                              loop: false,
                              nav: false,
                         },
                         992:{
                              dots: false,
                              loop: false,
                              nav: false,
                         }
                    },
               }).on('changed.owl.carousel', function(e){
                    _this.syncPosition(e)
               });

               this.sync2
                    .on('initialized.owl.carousel', function() {
                         _this.sync2.find(".owl-item").eq(0).addClass("current");
                    })
                    .owlCarousel({
                         // items: slidesPerPage,
                         dots: false,
                         nav: false,
                         smartSpeed: 200,
                         margin: 10,
                         slideSpeed: 500,
                         slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                         responsiveRefreshRate: 200,
                         responsive:{
                         0:{
                              items: 2,
                              slideBy: 2,
                              dots: false,
                              // loop: true,
                              nav: true,
                         },
                         992:{
                              items: slidesPerPage,
                              slideBy: slidesPerPage,
                              dots: false,
                              // loop: false,
                              nav: true,
                         }
                    }
                    }).on('changed.owl.carousel', function(e){
                         _this.syncPosition2(e)
                    });

               this.sync2.on("click", ".owl-item", function(e) {
                    e.preventDefault();
                    let number = $(this).index();
                    _this.sync1.data('owl.carousel').to(number, 300, true);
               });
               
          }
     }
}
</script>
