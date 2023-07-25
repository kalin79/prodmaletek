<template>
     <div class="listProducts">
          <div class="boxHeader">
               <h2>
                    Se están mostrando {{ cantidadProductos }} productos
               </h2>
          </div>
          <div class="viewProducts">
               <!-- <div class="cardProduct">
                    <a :href="`/producto/${producto.data.slug}`" v-for="(producto, index) in productos" :key="index">
                         <div class="boxImage">
                              <img :src="`https://locker.codegraph.pe/${producto.imagen}`" :alt="producto.data.nombre">
                              
                         </div>
                         <div class="boxInfo">
                              <h3>{{ producto.data.nombre }}</h3>
                              <p>
                                   {{ producto.data.descripcion_corta }}
                              </p>
                         </div>
                    </a>
               </div> -->
               <div class="cardProduct">
                    <a href="#">
                         <div class="boxImage">
                              <img src="/frontend/images/producto1.png" />
                         </div>
                         <div class="boxInfo">
                              <h3>Bodega mediana de jardín</h3>
                              <p>SKU W0007-A</p>
                         </div>
                    </a>
               </div>
               <div class="cardProduct">
                    <a href="#">
                         <div class="boxImage">
                              <img src="/frontend/images/producto3.png" />
                         </div>
                         <div class="boxInfo">
                              <h3>Estantería 4 niveles</h3>
                              <p>SKU W0007-A</p>
                         </div>
                    </a>
               </div>
               <div class="cardProduct">
                    <a href="#">
                         <div class="boxImage">
                              <img src="/frontend/images/producto1.png" />
                         </div>
                         <div class="boxInfo">
                              <h3>Contenedor de basura 240 Lt.</h3>
                              <p>SKU W0007-A</p>
                         </div>
                    </a>
               </div>
               <div class="cardProduct">
                    <a href="#">
                         <div class="boxImage">
                              <img src="/frontend/images/producto3.png" />
                         </div>
                         <div class="boxInfo">
                              <h3>Armario mediano BARU</h3>
                              <p>SKU W0007-A</p>
                         </div>
                    </a>
               </div>
               <div class="cardProduct">
                    <a href="#">
                         <div class="boxImage">
                              <img src="/frontend/images/producto1.png" />
                         </div>
                         <div class="boxInfo">
                              <h3>Armario mediano BARU</h3>
                              <p>SKU W0007-A</p>
                         </div>
                    </a>
               </div>
          </div>
     </div>
</template>

<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'

export default {
     computed: {
          ...mapState({
               categoria: state => state.categoria
          }),

          ...mapGetters({
               productos: 'category/getProductos',
               cantidadProductos: 'category/getCantidadProductos',
          })
          

     },
     mounted: function() {
     },
     methods: {
          
     }
}
</script>