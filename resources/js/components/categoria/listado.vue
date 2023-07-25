<template>
     <div class="listProducts">
          <div class="boxHeader">
               <h2>
                    Se están mostrando {{ cantidadProductos }} productos
               </h2>
          </div>
          <div class="viewProducts">
               <div class="cardProduct" v-for="(item,index) in productos" :key="index">
                    <a :href="`/producto/${item.slug}`">
                         <div class="boxImage">
                              <img :src="item.image" />
                         </div>
                         <div class="boxInfo">
                              <h3 v-html="item.title"></h3>
                              <p v-html="item.codigo"></p>
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