<?php
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser
{
    //construye la respouesta de existo  la data puede ser un string o array y aparte un codigo de respuesta
    public function apiResponse($status = 0,$code = Response::HTTP_OK, $data = [], $data_error = [])
    {
        return response()->json([
            'status'        => $status,
            'code'          => $code,
            'msg'           => 'OK',
            'data'          => $data, 
            'data_error'    => $data_error
            ],
            $code); 
    }
    //construye la respouesta de error  el messsage es string y aparte un codigo de respuesta
    /*public function errorResponse($message, $code)
    {
        return response()->json(['success' => false, 'message' => $message, 'code' => $code],$code);
    }*/

    //mensaje de error de cualquier servicio
    //Response
    /*public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type','application/json');
    }*/
}
