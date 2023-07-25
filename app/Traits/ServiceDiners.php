<?php


namespace App\Traits;


trait ServiceDiners
{
    public function consult($postData)
    {
        /**
         * Dev: http://200.62.220.231:8080/dinersclub-join
         * Calidad: http://200.62.220.249:28080/dinersclub-join
         * Produccion: https://zonaseguradinersservicios.pe:8543/dinersclub-join
         */
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMDYwNjkzNjA4OCIsImlhdCI6MTYwNjUwNjc3Mn0.Aq7YMV7Q1RqMAHA_hsMP8TlIhDzShn2_WBHAatITUJY';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://zonaseguradinersservicios.pe:8543/dinersclub-join/api/prospeccion/consultar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.'App '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function registerCustomer($postData)
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMDYwNjkzNjA4OCIsImlhdCI6MTYwNjUwNjc3Mn0.Aq7YMV7Q1RqMAHA_hsMP8TlIhDzShn2_WBHAatITUJY';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://zonaseguradinersservicios.pe:8543/dinersclub-join/api/tarjeta/registrar-solicitud',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.'App '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }

    public function maritalStatus()
    {
        return $this->getCallsLists('/api/catalogo/estado-civil');
    }

    public function typeRoad()
    {
        return $this->getCallsLists('/api/catalogo/tipo-via');
    }

    public function typePerson()
    {
        return $this->getCallsLists('/api/catalogo/tipo-persona');
    }

    public function typeSendEecc()
    {
        return $this->getCallsLists('/api/catalogo/tipo-envio-eecc/');
    }

    public function billingDay()
    {
        return $this->getCallsLists('/api/catalogo/dia-facturacion');
    }

    public function degreeInstruction()
    {
        return $this->getCallsLists('/api/catalogo/grado-instruccion');
    }

    // adds

    public function getDepartment()
    {
        return $this->getCallsLists('/api/organizacion-territorial/departamento');
    }

    public function getProvince($department)
    {
        return $this->getCallsLists('/api/organizacion-territorial/provincia/'.$department);
    }

    public function getDisctrict($province)
    {
        return $this->getCallsLists('/api/organizacion-territorial/distrito/'.$province);
    }

    public function getProduct()
    {
        return $this->getCallsLists('/api/catalogo/producto');
    }

    public function typeSendCard()
    {
        return $this->getCallsLists('/api/catalogo/tipo-envio-tarjeta');
    }

    public function getMonth()
    {
        return $this->getCallsLists('/api/catalogo/mes');
    }



    private function getCallsLists($url)
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMDYwNjkzNjA4OCIsImlhdCI6MTYwNjUwNjc3Mn0.Aq7YMV7Q1RqMAHA_hsMP8TlIhDzShn2_WBHAatITUJY';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://zonaseguradinersservicios.pe:8543/dinersclub-join'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.'App '.$token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    private function getSocio($dni)
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMDYwNjkzNjA4OCIsImlhdCI6MTYwNjUwNjc3Mn0.Aq7YMV7Q1RqMAHA_hsMP8TlIhDzShn2_WBHAatITUJY';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://200.62.220.231:8080//api/socio/'.$dni.'/consultar-datos',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.'App '.$token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
