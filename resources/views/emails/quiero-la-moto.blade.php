<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>

    <style>
        html,body, ul, h2, h3, img, b{
            padding:0;
            margin: 0;
        }

        h1{
            text-align: center;    
            color:#FFF;
            font-size:20px;
            display:block;
        }

        h3{
            font-size:16px;
            display:block;
        }

        body{
            width: 85%;
            margin:0 auto;
            font-family: 'Helvetica';
            color:#000;
            font-size:12px;
        }
        .header{
            padding-top: 30px;
            padding-bottom: 20px;
            width: 200px;
            margin:0 0 0 30px;
        }
        .header img{
            width: auto;
        }

        .footer{
            padding-top:20px;
            padding-bottom:20px;
            width:85%;
            margin:0 auto;
        }
        div.footer img{
            width:100%;
        }
        div.footer span{
            display: block;
            text-align: right;
        }

        #header {text-align: left; }
        #footer { text-align: center; padding-top:20px;margin-top:20px;}

        .page-container{
            padding-top: 50px;
            padding-bottom: 50px;
        }

    </style>
    <body>        
        <div id="header">
            <div class="header">

            </div>
        </div>

        <div class="page-container">
            <div style="background-color:#0097ff;color:white;text-align: center;">
                <h1>MotoPopular</h1>
            </div>
            <div style="">
                <h2>QUIERO LA MOTO</h2>
            </div>
            
            <div id="content-mail">
                <div style="width:100%;margin-top: 20px;margin-bottom: 20px;">

                    <ul>
                        <li><b>Nombres y Apellidos    :</b> {{ $data["nombre_apellidos"] }}</li>
                        <li><b>Correo  :</b> {{ $data["correo"] }}</li>
                        <li><b>Nro. Celular     :</b> {{ $data["nro_celular"] }}</li>
                        <li><b>Tipo Documento :</b> {{ $data["tipo_documento"] }}</li>
                        <li><b>Nro. Documento    :</b> {{ $data["nro_documento"] }}</li>
                        <li><b>Departamento  :</b> {{ $data["departamento"] }}</li>
                        <li><b>Provincia     :</b> {{ $data["provincia"] }}</li>
                        <li><b>Distrito :</b> {{ $data["distrito"] }}</li>
                        <li><b>Marca  :</b> {{ $data["marca"] }}</li>
                        <li><b>Producto  :</b> {{ $data["producto"] }}</li>
                        <li><b>Precio  :</b> S/. {{ $data["precio"] }}</li>
                        <li><b>Monto a financiar     :</b> S/. {{ $data["montoFinanciar"] }}</li>
                        <li><b>Nro. Mensual :</b>  {{ $data["numeroCuotas"] }}</li>
                        <li><b>Cuota Mensual :</b> S/. {{ $data["valorCuota"] }}</li>
                        <li><b>Seguro Riego :</b>  {{ $data["seguroRiesgo"] }}</li>
                        <li><b>SOAT :</b> {{ $data["soat"] }}</li>
                    </ul>
                    
                </div>
            
            </div>
           
   
        </div>
    </body>
</html>
