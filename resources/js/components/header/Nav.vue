<template>
     <header id="HeadeMain" class="HeaderMainPC">
          <div class="headerTop">
               <div class="container">
                    <nav>
                         <div class="boxNavMain">
                              <a href="/" class="especial">
                                   <img src="/frontend/images/logo.svg" alt="Maletek" />
                              </a>
                              <!-- <a href="/" class="especial">
                                   <span>ESPECIALISTAS EN LOCKERS</span>
                              </a> -->
                              <!-- <div class="separate"></div> -->
                              <a :href="`${item.slug}`" v-for="(item,index) in menuTop" :key="index">
                                   <span>{{ item.name }}</span>
                              </a>
                              <!-- <a href="/acerca-de-maletek">
                                   <span>Acerca de Maletek</span>
                              </a>
                              <a href="/contactenos">
                                   <span>Contáctenos</span>
                              </a>
                              <a href="/catalogo">
                                   <span>Catálogo 2023</span>
                              </a>
                              <a href="blog">
                                   <span>Blog</span>
                              </a> -->
                         </div>
                         <div class="boxAtencion">
                              <div class="atencionContent">
                                   <img src="/frontend/images/call.svg" alt="Atención al Cliente: 958 474 654">
                                   <div class="info">
                                        <p>Atención al Cliente:</p>
                                        <p>958 474 654</p>
                                   </div>
                              </div>
                         </div>
                    </nav>
               </div>
          </div>
          <div class="headerBottom">
               <div class="container">
                    <div class="navNavegation">
                         <nav>
                              <a :href="`/categoria/${item.slug}`" v-for="(item,index) in menu" :key="index">
                                   <span v-html="item.categoria"></span>
                              </a>
                              <!-- <a href="/categoria/lockers-de-platico/">
                                   <span>Lockers<br> de Plástico</span>
                              </a>
                              <a href="/categoria/linea-industrial/">
                                   <span>Línea<br> Industrial</span>
                              </a>
                              <a href="/categoria/linea-hogar-oficina/">
                                   <span>Línea<br> Mobiliaria</span>
                              </a>
                              <a href="/categoria/linea-rimax/">
                                   <span>Línea<br> Rimax</span>
                              </a>
                              <a href="/categoria/linea-tramontina/">
                                   <span>Línea<br> Tramontina</span>
                              </a>
                              <a href="/categoria/linea-tramontina/">
                                   <span>Alquiler<br> de Lockers</span>
                              </a>
                              <a href="/categoria/linea-tramontina/">
                                   <span>Lockers<br> Inteligentes</span>
                              </a> -->
                         </nav>
                         <!-- <div class="boxSearch">
                              <div class="inputSearch">
                                   <input type="text" name="buscar" placeholder="Buscar productos..." />
                                   <a href="javascript:void(0)"><img src="/frontend/images/search.svg" alt="buscar"></a>
                              </div>
                         </div> -->
                    </div>
                    
               </div>
          </div>
     </header>
     <header class="HeaderMainMovil">
          <div class="boxHeaderTop">
               <div class="optionNav">
                    <div class="boxListaUno">
                         <nav>
                              <a :href="`/categoria/${item.slug}`" v-for="(item,index) in menu" :key="index" v-html="item.categoria"></a>
                              <!-- <a href="/">Lockers de Plástico</a>
                              <a href="/">Línea Industrial</a>
                              <a href="/">Línea Mobiliaria</a>
                              <a href="/">Línea Rimax</a>
                              <a href="/">Línea Tramontina</a>
                              <a href="/">Alquiler de lockers</a>
                              <a href="/">Lockers Inteligentes</a> -->
                         </nav>
                    </div>
                    <div class="boxListaDos">
                         <nav>
                              <a :href="`${item.slug}`" v-for="(item,index) in menuTop" :key="index">{{ item.name }}</a>
                              <!-- <a href="/">Acerca de Maletek</a>
                              <a href="/">Catálogo 2023</a>
                              <a href="/">BLOG</a>
                              <a href="/">Contáctenos</a> -->
                         </nav>
                    </div>
                    <div class="boxAtencion">
                         <div class="boxIcon">
                              <img src="/frontend/images/whatsapp2.svg" alt="Atencion al Cliente WhatsApp" />
                         </div>
                         <div class="boxInfo">
                              <h2>Atención al Cliente</h2>
                              <p>958 474 654</p>
                         </div>
                    </div>
                    <div class="boxRedesSociales">
                         <a href="" target="_blank">
                              <img src="/frontend/images/facebook2.svg" alt="Facebook" />
                         </a>
                         <a href="" target="_blank">
                              <img src="/frontend/images/linkn2.svg" alt="linkn" />
                         </a>
                         <a href="" target="_blank">
                              <img src="/frontend/images/instagram2.svg" alt="instagram" />
                         </a>
                         <a href="" target="_blank">
                              <img src="/frontend/images/youtube2.svg" alt="youtube" />
                         </a>
                    </div>
               </div>
               <div class="boxHamburger">
                    <button class="hambergeMenu" v-on:click="clickMenu()">
                         <div class="lineMenu l1"></div>
                         <div class="lineMenu l2"></div>
                         <div class="lineMenu l3"></div>
                    </button>
               </div>
               <div class="boxLogoMain">
                    <a href="/" class="especial">
                         <img src="/frontend/images/logo.svg" alt="Maletek" />
                    </a>
               </div>
               
          </div>
          <!-- <div class="boxSearchMain">
               <div class="inputSearch">
                    <input type="text" name="buscar" placeholder="Buscar productos..." />
                    <a href="javascript:void(0)"><img src="/frontend/images/search.svg" alt="buscar"></a>
               </div>
          </div> -->
     </header>
</template>
<script>
export default {
     data(){
          return {
               menu: [],
               menuTop: [],
               btnMenuBool: false
          }
     },
     created(){
          // this.dameTodasCategorias()
     },
     mounted(){
          this.loadMenu()
     },
     methods: {
          loadMenu: async function(){

               // Traemos las consultas de API 
               
               try{
                    let sendSolicitudAPI = await axios.get(`/api/v1/home`)
                    // console.log(sendSolicitudAPI.data.data.slider)
                    if (sendSolicitudAPI.data.code === 200){
                         this.menu = sendSolicitudAPI.data.data.categories
                         // console.log(this.menu)
                    }
               }catch(error){
                    console.log(error)
               }finally{

               }


               try{
                    let sendSolicitud = await axios.get(`/data/menu.json`)
                    // console.log(sendSolicitud.data[1].menu)
                    // console.log(sendSolicitud)
                    if (sendSolicitud.status === 200){
                         this.menuTop = sendSolicitud.data[1].menu
                    }
               }catch(error){
                    console.log(error)
               }finally{

               }
          },
          clickMenu: function(){
               const boxmenu = $('.HeaderMainMovil .hambergeMenu')
               const linea1 = $('.HeaderMainMovil .hambergeMenu .l1')
               const linea2 = $('.HeaderMainMovil .hambergeMenu .l2')
               const linea3 = $('.HeaderMainMovil .hambergeMenu .l3')
               const optionNav = $('.HeaderMainMovil .optionNav')
               if (!this.btnMenuBool){
                    this.btnMenuBool = true
                    optionNav.addClass('active')
                    gsap.set(boxmenu,{rotation: 45})
                    gsap.set(linea2,{width: 0})
                    gsap.set(linea1,{y: 6, x: 1, width: "24px"})
                    gsap.set(linea3,{y: -9, x: 1, width: "24px"})
                    gsap.to(linea1,{rotation: 0})
                    gsap.to(linea3,{rotation: 90})
               }else{
                    this.btnMenuBool = false
                    optionNav.removeClass('active')
                    gsap.set(boxmenu,{rotation: 0})
                    gsap.set(linea1,{y: 0, x: 0, width: "28px"})
                    gsap.set(linea3,{y: 0, x: 0, width: "28px"})
                    gsap.to(linea1,{rotation: 0})
                    gsap.to(linea3,{rotation: 0})
                    gsap.to(linea2,{width: "100%"})
               }
          }
     }
}
</script>

