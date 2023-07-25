<template>
     <div class="boxForm">
          <div class="container">
               <div class="gridContent">
                    <div>
                         <h2>¿Algún proyecto en mente?, conversemos...</h2>
                         <div class="formContent">
                              <form name="formContacto" id="formContacto" v-on:submit.prevent="sendData">
                                   <div class="">
                                        <label for="nombre" class="mb-2">Nombres y Apellidos: *</label>
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombres y Apellidos" v-model="form.nombre"/>
                                   </div>
                                   <div class="">
                                        <label for="celular" class="mb-2">Número de celular:*</label>
                                        <input type="text" name="celular" id="celular" placeholder="Número de celular" v-model="form.celular"/>
                                   </div>
                                   <div class="">
                                        <label for="nombre" class="mb-2">Número de RUC/DNI:*</label>
                                        <input type="text" name="ruc" id="ruc" placeholder="RUC / DNI" v-model="form.ruc"/>
                                   </div>
                                   
                                   <div class="">
                                        <label for="email" class="mb-2">Correo electrónico:*</label>
                                        <input type="text" name="email" id="email" placeholder="Coreo electrónico" v-model="form.email"/>
                                   </div>
                                   <div class="">
                                        <label for="Mensaje" class="mb-2">Mensaje: (opcional)</label>
                                        <textarea name="mensaje" id="mensaje" placeholder="Mensaje" v-model="form.descripcion"></textarea>
                                   </div>
                                   
                                   <div class="">
                                        <div class="d-flex justify-content-start align-items-start">
                                             <div class="boxCheckbox ">
                                                  <input type="checkbox" id="agree" name="agree" value="yes">
                                                  <label for="agree"></label>
                                             </div>
                                             <p class="labelP">He leído y aceptado las <a href="terminos-y-condiciones" target="_blank">Políticas de privacidad, los Términos de uso y Aviso de Privacidad</a></p>
                                        </div>
                                        <label class="agree-error msnError">Debe aceptar los Términos y Condiciones </label>

                                   </div>
                                   <div class="">
                                        <p class="legal">*Datos requeridos.</p>
                                   </div>
                                   <div class="">
                                        <div class="boxLoadForm">
                                             <div class="d-flex justify-content-center">
                                                  <div class="spinner-border" role="status">
                                                       <span class="visually-hidden">Loading...</span>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="alert ocultar" role="alert">
                                             <p></p>
                                        </div>
                                        <div class="boxButton">
                                             <button type="submit">
                                                  <img src="/frontend/images/send2.png" alt="ENVIAR INFORMACIÓN" />
                                                  ENVIAR INFORMACIÓN
                                             </button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
                    <div>
                         <h2 class="">Información de contacto</h2>
                         <div class="boxInfo">
                              <div class="boxIcon">
                                             <img src="/frontend/images/ubicacion.svg" alt="Oficina central" />
                              </div>
                              <div class="boxDescripcion">
                                   <p>
                                        <span>Oficina central:</span> <br>
                                        Av. Manuel Gonzales Olaechea 338, San Isidro
                                   </p>
                              </div>
                         </div>
                         <div class="boxInfo">
                              <div class="boxIcon">
                                   <img src="/frontend/images/reloj.svg" alt="" />
                              </div>
                              <div class="boxDescripcion">
                                   <p>
                                        <span>Horario de atención: </span> <br>
                                        Lunes a Viernes, 08:00 am a 17:30 pm
                                   </p>
                              </div>
                         </div>
                         <div class="boxInfo">
                              <div class="boxIcon">
                                   <img src="/frontend/images/email.svg" alt="" />
                              </div>
                              <div class="boxDescripcion">
                                   <p>
                                        <span>Correo electrónico:</span> <br />
                                        <a href="mailto:ventas@maletek.com.pe" class="colorblueLight">ventas@maletek.com.pe</a>
                                   </p>
                              </div>
                         </div>
                         <div class="boxInfo">
                              <div class="boxIcon">
                                   <img src="/frontend/images/movil.svg" alt="" />
                              </div>
                              <div class="boxDescripcion">
                                   <p>
                                        <span>Teléfono:</span> <br />
                                        01 717 2344
                                   </p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</template>
<script>
export default {
     name: 'PageContacto',
     data() {
          return {
               form: []
          }
     },
     mounted: function() {
          this.loadForm()
          this.validateCamposForm()
     },
     methods: {
          loadForm: function () {
               $( "#formContacto" ).validate({
                    rules: {
                         nombre: {
                              required: true,
                         },
                         ruc: {
                              required: true,
                         },
                         celular: {
                              required: true,
                         },
                         mensaje: {
                              required: true,
                         },
                         email: {
                              required: true,
                              email: true
                         }
                    },
                    messages: {
                         nombre: {
                              required: "Nombre - es obligatorio",
                         },
                         ruc: {
                              required: "RUC / DNI - es obligatorio",
                         },
                         celular: {
                              required: "Celular - es obligatorio",
                         },
                         mensaje: {
                              required: "Mensaje - es obligatorio",
                         },
                         email: {
                              required: "Debe completar un correo válido",
                              email: "Debe completar un correo válido"
                         },
                    }
               })
          },
          validateCamposForm: function(){
               $("#celular").keydown(function (e) {
                    if (($("#celular").val().length < 12) || (e.keyCode == 8)){
                         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
                              return;
                         }
                         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                              e.preventDefault();
                         }
                    }else{
                         e.preventDefault();
                    }

               })
               $("#ruc").keydown(function (e) {
                    if (($("#ruc").val().length < 12) || (e.keyCode == 8)){
                         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
                              return;
                         }
                         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                              e.preventDefault();
                         }
                    }else{
                         e.preventDefault();
                    }

               })
          },
          async sendData(e) {
               e.preventDefault()
               var _flat_agree = 0
               
               if (!($(".alert").hasClass("ocultar")))
                    $(".alert").addClass("ocultar")

               if ($('#agree').is(':checked') != true ) {
                    // alert('no')
                    $(".agree-error").addClass('errorManual')
                    return false
               }else{
                    _flat_agree = 1
                    $(".agree-error").removeClass('errorManual')
               }
               
               let formData = new FormData()

               // console.log(this.form)
               
               if ($("#formContacto").valid()) {
                    $(".boxButtonCotizar").addClass("ocultar");
                    $(".boxLoadForm").addClass("active");
                    formData.append("cliente", this.form.nombre)
                    formData.append("email", this.form.email)
                    formData.append("flat_agree", _flat_agree)
                    formData.append("celular", this.form.celular)
                    formData.append("descripcion", this.form.descripcion)
                    formData.append("ruc", this.form.ruc)
                    // console.log(this.cantidad)
                    // console.log(this.producto.subtitulo)
                    try{
                         let sendSolicitud = await axios.post('/api/v1/mail/contacto',formData)
                         // console.log(sendSolicitud)
                         if (sendSolicitud.data.code === 200) {
                              $(".alert p").html("Se ha enviado su consulta")
                              $(".alert").addClass("alert-success").removeClass("ocultar")
                              
                              $("#msnSuscripcion").html("Se registro su correo")
                              this.form = []
                              $("#agree").prop( "checked", false )
                         }
                    }catch (error) {
                         console.log(error)
                         $(".alert p").html("Hubo problemas para enviar, intente más tarde")
                         $(".alert").addClass("alert-danger").removeClass("ocultar")
                    } finally {
                         console.log('final')
                         $(".boxButtonCotizar").removeClass("ocultar");
                         $(".boxLoadForm").removeClass("active");
                    }
               }
          },
     }
}
</script>