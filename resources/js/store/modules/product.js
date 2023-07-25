export default {
     namespaced: true,
     state: {
          producto: [],
          complementarios: [],
          galerias: [],
          colores: [],
          chapas: [],
          puertas: [],
          cuerpos: [],
          cantidad: 1,
     },
     mutations: {
          setProducto(state,payload){
               state.producto = payload;
          },
          setComplementarios(state,payload){
               state.complementarios = payload;
          },
          setGalerias(state,payload){
               state.galerias = payload;
          },
          setColores(state,payload){
               state.colores = payload;
          },
          setChapas(state,payload){
               state.chapas = payload;
          },
          setPuertas(state,payload){
               state.puertas = payload;
          },
          setCuerpos(state,payload){
               state.cuerpos = payload;
          },
          setCantidad(state,payload){
               state.cantidad = payload;
          },
     },
     actions: {
          
     },
     getters: {
          getProducto(state){
               return state.producto;
          },
          getComplementarios(state){
               return state.complementarios;
          },
          getGalerias(state){
               return state.galerias;
          },
          getColores(state){
               return state.colores;
          },
          getChapas(state){
               return state.chapas;
          },
          getPuertas(state){
               return state.puertas;
          },
          getCuerpos(state){
               return state.cuerpos;
          },
          getCantidad(state){
               return state.cantidad;
          },
     }
}