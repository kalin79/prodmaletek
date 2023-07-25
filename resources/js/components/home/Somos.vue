<template>
    <div class="homeSomos">
        <div class="bcg">
            <img src="/frontend/images/homesomos.png" alt="Somos MALETEK, la empresa líder en alquiler y venta de Lockers" />
        </div>
        <div class="boxContent">
            <div class="container">
                <div class="boxCard">
                    <div class="cardItem">
                        <h3>Somos MALETEK, la empresa líder en alquiler y venta de Lockers</h3>
                    </div>
                    <div class="cardItem">
                        <p>Con más de 20 años de experiencia en el mercado peruano. Reconocidos por nuestra calidad de productos y servicio, contamos con más de 8,000 lockers alquilados y más de 6,000 módulos de lockers vendidos a nivel nacional en los últimos 5 años.</p>
                        <button v-on:click="irSomos()">ACERCA DE NOSOTROS</button>
                    </div>
                    <div class="cardItem">
                        <clientes-logos></clientes-logos>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
     data() {
        return {
        
        }
     },
     methods: {
        irSomos: function () {
            top.location.href ="/acerca-de-nosotros"       
        }
     }
}
</script>
