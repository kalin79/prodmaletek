<template>
     <footer class="footerMain">
          <div class="container">
               <div class="gridFooter">
                    <div class="footerItem">
                         <div class="boxImage">
                              <img src="/frontend/images/logo2.svg" alt="Maletek">
                         </div>
                         <div class="boxRedes">
                              <a href="" target="_blank">
                                   <img src="/frontend/images/facebook.svg" alt="Maletek :: Facebook">
                              </a>
                              <a href="" target="_blank">
                                   <img src="/frontend/images/linkdn.svg" alt="Maletek :: Linkdn">
                              </a>
                              <a href="" target="_blank">
                                   <img src="/frontend/images/instagram.svg" alt="Maletek :: Instagram">
                              </a>
                              <a href="" target="_blank">
                                   <img src="/frontend/images/youtube.svg" alt="Maletek :: YouTube">
                              </a>
                         </div>
                    </div>
                    <div class="footerItem">
                         <div class="boxIcon">
                              <img src="/frontend/images/call2.svg" alt="Informacion de la Empresa">
                         </div>
                         <div class="boxContent">
                              <h2>Contáctanos</h2>
                              <p>
                                   <span>Dirección:</span> <br>
                                   Avda. Manuel Gonzales <br>
                                   Olaechea 338 Int. 301 <br>
                                   San Isidro - Lima
                              </p>
                              <p>
                                   <span>Horario de atención:</span> <br>
                                   Lunes a Viernes <br>
                                   08:00 am - 17:30 pm
                              </p>
                              <p>
                                   <span>Ventas:</span> <br>
                                   Cel.: 717 2149 / 924 483 805 <br>
                                   Email: <a href="mailto:ventas@maletek.com.pe" target="_blank">ventas@maletek.com.pe</a>
                              </p>
                              <p>
                                   <span>Atención al Cliente:</span> <br>
                                   Cel.: 997 519 920/ 717 2129 <br>
                                   Email: <a href="mailto:atencionalciente@maletek.com.pe" target="_blank">atencionalciente@maletek.com.pe</a>
                              </p>
                         </div>
                    </div>
                    <div class="footerItem">
                         <div class="boxIcon">
                              <img src="/frontend/images/iprod.svg" alt="Productos">
                         </div>
                         <div class="boxContent">
                              <h2>Productos</h2>
                              <p  v-for="(item,index) in menu" :key="index">
                                   <a :href="`/categoria/${item.slug}`" v-html="item.categoria"></a>
                              </p>
                         </div>
                    </div>
                    <div class="footerItem">
                         <div class="boxIcon">
                              <img src="/frontend/images/iprod.svg" alt="Institucional">
                         </div>
                         <div class="boxContent">
                              <h2>Institucional</h2>
                              <p v-for="(item,index) in menuTop" :key="index">
                                   <a :href="`/${item.slug}`" v-html="item.name"></a>
                              </p>
                         </div>
                    </div>
                    
               </div>
          </div>
          <div class="footerCierre">
               <p>© 2023 Maletek Todos los derechos reservados.</p>
          </div>
     </footer>
</template>
<script>
export default {
     data(){
          return {
               menu: [],
               menuTop: [],
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
     }
}
</script>

