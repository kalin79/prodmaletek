require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;
try {
     require('jquery-validation/dist/jquery.validate.js');
 } catch (e) {}

import { gsap, Power4 } from 'gsap';
import Scrolltrigger from 'gsap/ScrollTrigger';
import ScrollToPlugin from 'gsap/ScrollToPlugin';
import EasePack from 'gsap/EasePack';
import EaselPlugin from 'gsap/EasePack';
// import {Draggable}  from "gsap/dist/Draggable";
gsap.registerPlugin(Scrolltrigger);
gsap.registerPlugin(ScrollToPlugin);
gsap.registerPlugin(EasePack);
gsap.registerPlugin(EaselPlugin);
// gsap.registerPlugin(Draggable);
global.gsap = gsap
global.Power4 = Power4

import 'owl.carousel/dist/assets/owl.carousel.css'
import 'owl.carousel'


import { createApp } from 'vue';
import  store  from './store/index';


import FooterMain from './components/footer/Footer.vue';
import HeaderNav from './components/header/Nav.vue';

import Home from './components/home/Index.vue';
import Banner from './components/home/Banner.vue';
import Promocion from './components/home/Promocion.vue'
import Ingresado from './components/home/Ingresado.vue';
import PublicidadHome from './components/home/Publicidad.vue';
import LineaProducto from './components/home/Linea.vue';
import BlogHome from './components/home/Blog.vue';
import SomosHome from './components/home/Somos.vue';


import Categoria from './components/categoria/Index.vue';
import CategoriaProductos from './components/categoria/listado.vue';
import CategoriaFiltros from './components/categoria/filtros.vue';
import Producto from './components/producto/Index.vue';
import ProductoDetalle from './components/producto/Detalle.vue';
import ProductosComplementarios from './components/producto/Complementario.vue';
import BannerInterno from './components/banner/index.vue';
import BannerInternoProducto from './components/banner/producto.vue';
import Cotizador from './components/cotizador/Cotizador.vue';
import Contacto from './components/contacto/Index.vue';
import BannerContacto from './components/banner/contacto.vue';
import FormularioContacto from './components/contacto/Formulario.vue';
import MapaContacto from './components/contacto/Mapa.vue';

import SomosPage from './components/somos/Index.vue';
import SomosDetalle from './components/somos/Detalle.vue';
import BannerSomos from './components/banner/somos.vue';

import ClientesLogos from './components/clientes/Index.vue';

import Rubro from './components/rubro/Index.vue';


const app = createApp({});

app.component('footer-main',FooterMain);
app.component('header-nav',HeaderNav);
app.component('home-main',Home);

app.component('home-banner',Banner);
app.component('home-promocion',Promocion);
app.component('home-ingresados',Ingresado);
app.component('home-linea',LineaProducto);
app.component('home-publicidad',PublicidadHome);
app.component('home-blog',BlogHome);
app.component('home-somos',SomosHome);

app.component('somos-main',SomosPage);
app.component('somos-banner',BannerSomos);
app.component('somos-detalle',SomosDetalle);

app.component('clientes-logos', ClientesLogos);

app.component('rubro-main',Rubro);

app.component('categoria-main',Categoria);
app.component('categoria-productos',CategoriaProductos);
app.component('categoria-filtros',CategoriaFiltros);
app.component('banner-interno',BannerInterno);
app.component('banner-interno-producto',BannerInternoProducto);
app.component('producto-main',Producto);
app.component('producto-detalle',ProductoDetalle);
app.component('productos-complementarios',ProductosComplementarios);
app.component('cotizador-main',Cotizador);
app.component('contacto-main',Contacto);
app.component('banner-contact',BannerContacto);
app.component('formulario-contact',FormularioContacto);
app.component('mapa-contact',MapaContacto);
app.use(store);
app.mount('#app');