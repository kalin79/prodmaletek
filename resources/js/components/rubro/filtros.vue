<template>
     <div class="boxFilters">
          <div class="borderFilter">
               <div class="filterHead">
                    <a href="javascript:void(0)" v-on:click="btnViewFilter()" class="">
                         <img src="/frontend/images/filtro.svg" class="imgFilter" />
                         <p>Filtros</p>
                    </a>
                    <div class="">
                         <button class="ButtonStandart" v-on:click="clearAll()">Limpiar</button>
                    </div>
               </div>
               <div class="boxViewOptionFilt">
                    <div class="boxCloseFilter">
                         <div class="d-flex justify-content-end align-items-center">
                              <a href="javascript: void(0)" v-on:click="btnViewFilter()">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                   <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                   </svg>
                              </a>
                         </div>
                    </div>
                    <div class="boxRowFilter">
                         <h3>Buscar por:</h3>
                         <div class="boxInputSearch">
                              <input type="text" name="buscarProducto" v-model="buscar" @keydown.enter.prevent="buscarProductos" placeholder="¿Qué buscas?" autocomplete="off"/>
                              <a href="javascript:void(0)" class="iconSearch" v-on:click="buscarProductos()">
                                   <img src="/frontend/images/search2.svg" />
                              </a>
                         </div>
                    </div>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                         <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                   <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                   Color
                                   </button>
                              </h2>
                              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                   <div class="accordion-body">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterColor(index,element.id)" :id="'checkColor-'+index"  v-for="(element, index) in colors" :key="index">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>{{ element.nombre }}</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                         <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                   Tipo de chapas
                                   </button>
                              </h2>
                              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                   <div class="accordion-body">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterChapas(index,element.id)" :id="'checkChapas-'+index"  v-for="(element, index) in chapas" :key="index">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>{{ element.nombre }}</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                         <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                   Cantidad de puertas 
                                   </button>
                              </h2>
                              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                   
                                   <div class="accordion-body">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(0,6)" id="checkPuertas-0" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>1 Puerta</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(1,7)" id="checkPuertas-1">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>2 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(2,25)" id="checkPuertas-2">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>4 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(3,26)" id="checkPuertas-3" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>6 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(4,28)" id="checkPuertas-4">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>9 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(5,29)" id="checkPuertas-5" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>10 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(6,27)" id="checkPuertas-6" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>12 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(7,30)" id="checkPuertas-7" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>15 Puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(8,17)" id="checkPuertas-8" >
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>20 Puertas</p>
                                             </div>
                                        </a>
                                   </div>

                                   <div class="accordion-body" v-if="doneCategory.id === 2">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(0,7)" id="checkPuertas-0">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>2 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(1,8)" id="checkPuertas-1">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>3 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(2,25)" id="checkPuertas-2">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>4 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(3,26)" id="checkPuertas-3">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>6 puertas</p>
                                             </div>
                                        </a>
                                   </div>

                                   <div class="accordion-body" v-if="doneCategory.id === 3">
                                        <!-- <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(index,element.id)" :id="'checkPuertas-'+index"  v-for="(element, index) in puertas" :key="index">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>{{ element.nombre }}</p>
                                             </div>
                                        </a> -->

                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(0,6)" id="checkPuertas-0">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>1 puerta</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(1,7)" id="checkPuertas-1">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>2 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(2,8)" id="checkPuertas-2">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>3 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(3,25)" id="checkPuertas-3">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>4 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(4,26)" id="checkPuertas-4">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>6 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(5,28)" id="checkPuertas-5">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>9 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(6,29)" id="checkPuertas-6">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>10 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(7,27)" id="checkPuertas-7">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>12 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(8,30)" id="checkPuertas-8">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>15 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(9,17)" id="checkPuertas-9">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>20 puertas</p>
                                             </div>
                                        </a>
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterPuertas(10,22)" id="checkPuertas-10">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>50 puertas</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                         <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                   Cantidad de cuerpos
                                   </button>
                              </h2>
                              <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                                   <div class="accordion-body">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterCuerpos(index,element.id)" :id="'checkCuerpos-'+index"  v-for="(element, index) in cuerpos" :key="index">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>{{ element.nombre }}</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                         <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                        Tipo de material
                                   </button>
                              </h2>
                              <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
                                   <div class="accordion-body">
                                        <a href="javascript:void(0)" class="" v-on:click="setFilterCuerpos(index,element.id)" :id="'checkCuerpos-'+index"  v-for="(element, index) in cuerpos" :key="index">
                                             <div class="d-flex justify-content-start align-items-center">
                                                  <div class="boxCheck"></div>
                                                  <p>{{ element.nombre }}</p>
                                             </div>
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="boxButonMovil">
                         <button class="ButtonStandart" v-on:click="btnViewFilter()">Buscar</button>
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
               typeColors: [],
               typeChapas: [],
               typePuertas: [],
               typeCuerpos: [],
               buscar: "",
          }
     },
     mounted() {
          this.buscarProductos()
     },
     computed: {
          ...mapGetters({
               colors: 'category/getFiltroColors',
               chapas: 'category/getFiltroChapas',
               puertas: 'category/getFiltroPuertas',
               cuerpos: 'category/getFiltroCuerpos',
               doneCategory: 'category/getCategoria'
          })
     },
     methods: {
          buscarProductos() {
               if (this.buscar != ""){
                    this.searchProducts()
               }else{
                    this.buscar = ""
                    this.searchProducts()
               }
          },
          clearAll(){
               this.typeColors = []
               this.typeChapas = []
               this.typePuertas = []
               this.typeCuerpos = []
               $(".accordion-body a").removeClass("active")

               this.filterLoadProdcuts()
          },
          btnViewFilter(){
               let $viewFilter = $(".boxViewOptionFilt")
               if ($viewFilter.hasClass("active")){
                    $viewFilter.removeClass("active")
               }else{
                    $viewFilter.addClass("active")
               }
          },

          setFilterChapas(id, value){
               let _element = $(`#checkChapas-${id}`)
               // console.log(`checkTransmision-${id}`)
               if (_element.hasClass('active')){
                    let i = this.typeChapas.indexOf(value)
                    if ( i !== -1 ) {
                         this.typeChapas.splice( i, 1 )
                    }
                    _element.removeClass('active')
               }else{
                    _element.addClass('active')
                    this.typeChapas.push(value)
               }
               console.log(this.typeChapas)
               this.filterLoadProdcuts()
          },

          setFilterCuerpos(id, value){
               let _element = $(`#checkCuerpos-${id}`)
               // console.log(`checkTransmision-${id}`)
               if (_element.hasClass('active')){
                    let i = this.typeCuerpos.indexOf(value)
                    if ( i !== -1 ) {
                         this.typeCuerpos.splice( i, 1 )
                    }
                    _element.removeClass('active')
               }else{
                    _element.addClass('active')
                    this.typeCuerpos.push(value)
               }
               console.log(this.typeCuerpos)
               this.filterLoadProdcuts()
          },

          setFilterPuertas(id, value){
               let _element = $(`#checkPuertas-${id}`)
               // console.log(`checkTransmision-${id}`)
               if (_element.hasClass('active')){
                    let i = this.typePuertas.indexOf(value)
                    if ( i !== -1 ) {
                         this.typePuertas.splice( i, 1 )
                    }
                    _element.removeClass('active')
               }else{
                    _element.addClass('active')
                    this.typePuertas.push(value)
               }
               console.log(this.typePuertas)
               this.filterLoadProdcuts()
          },

          setFilterColor(id, value){
               let _element = $(`#checkColor-${id}`)
               // console.log(`checkTransmision-${id}`)
               if (_element.hasClass('active')){
                    let i = this.typeColors.indexOf(value)
                    if ( i !== -1 ) {
                         this.typeColors.splice( i, 1 )
                    }
                    _element.removeClass('active')
               }else{
                    _element.addClass('active')
                    this.typeColors.push(value)
               }
               console.log(this.typeColors)
               this.filterLoadProdcuts()
          },
          async searchProducts(){
               let data = new FormData()
               data.append('buscar',this.buscar)
               data.append('slug', this.doneCategory.slug)
               // console.log(this.buscar)
               try{
                    // Obtenemos la Prouctos
                    let sendSolicitud = await axios.post(`/api/v1/categoria/listado/buscar`,data)
                    // console.log(sendSolicitud)
                    if (sendSolicitud.data.code === 200){
                         // console.log(sendSolicitud.data.data)
                         this.$store.commit('category/setProductos', sendSolicitud.data.data.response)
                         this.$store.commit('category/setCantidadProductos', sendSolicitud.data.data.productos.total)
                    }
               } catch (error) {
                    console.log(error);
               } finally{

               }
          },
          async filterLoadProdcuts(){
               let data = new FormData()
               data.append('colores',this.typeColors)
               data.append('chapas',this.typeChapas)
               data.append('puertas',this.typePuertas)
               data.append('cuerpos',this.typeCuerpos)
               data.append('slug', this.doneCategory.slug)

               // this.$store.dispatch('category/consultasAxios',{dataFilters})

               try{
                    // Obtenemos la Prouctos
                    let sendSolicitud = await axios.post(`/api/v1/categoria/listado/productos`,data)
                    // console.log(sendSolicitud)
                    if (sendSolicitud.data.code === 200){
                         // console.log(sendSolicitud.data.data)
                         this.$store.commit('category/setProductos', sendSolicitud.data.data.response)
                         this.$store.commit('category/setCantidadProductos', sendSolicitud.data.data.productos.total)
                    }
               } catch (error) {
                    console.log(error);
               } finally{

               }
          }
     },
}
</script>
