export default {
     namespaced: true,
     state: {
          categoria: [],
          productos: [],
          totalProductos: 0,
          filter: {
               colors: [],
               chapas: [],
               puertas: [],
               cuerpos: [],
               bandejas: [],
               materiales: [],
               cajones: [],
          }
     },
     mutations: {
          setCategoria(state,payload){
               state.categoria = payload;
          },
          setProductos(state,payload){
               state.productos = payload;
          },
          setFiltroColors(state,payload){
               state.filter.colors = payload;
          },
          setFiltroChapas(state,payload){
               state.filter.chapas = payload;
          },
          setFiltroPuertas(state,payload){
               state.filter.puertas = payload;
          },
          setFiltroCuerpos(state,payload){
               state.filter.cuerpos = payload;
          },
          setFiltroBandejas(state,payload){
               state.filter.bandejas = payload;
          },
          setFiltroMateriales(state,payload){
               state.filter.materiales = payload;
          },
          setFiltroCajones(state,payload){
               state.filter.cajones = payload;
          },
          setCantidadProductos(state,payload){
               state.totalProductos = payload;
          }
          
     },
     actions: {
          consultasAxios({commit},payload){
               console.log(payload);
               // commit('addStudent',payload);
          }
     },
     getters: {
          getCategoria(state){
               return state.categoria
          },
          getProductos(state){
               return state.productos
          },
          getCantidadProductos(state){
               return state.totalProductos
          },
          getFiltroColors(state){
               return state.filter.colors;
          },
          getFiltroChapas(state){
               return state.filter.chapas;
          },
          getFiltroPuertas(state){
               return state.filter.puertas;
          },
          getFiltroCuerpos(state){
               return state.filter.cuerpos;
          },
          getFiltroBandejas(state){
               return state.filter.bandejas;
          },
          getFiltroMateriales(state){
               return state.filter.materiales;
          },
          getFiltroCajones(state){
               return state.filter.cajones;
          },
     }
}