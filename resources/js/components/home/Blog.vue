<template>
    <div class="homeBlog">
        <div class="bcg">
            <img src="/frontend/images/blog.png" alt="Blog Introduccion">
        </div>
        <div class="container">
            <div class="gridBlog">
                <div class="boxContent">
                    <h2>¿Listo para transformar tu espacio de trabajo?</h2>
                    <p>Déjate inspirar por nuestro blog y encuentra los secretos para un ambiente de trabajo impecable, con lockers que mantienen todo en orden y muebles de oficina que potencian la eficiencia.</p>
                    <button v-on:click="irBlog()">IR AL BLOG</button>
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
        irBlog: function () {
            top.location.href ="/blog"       
        }
     }
}
</script>