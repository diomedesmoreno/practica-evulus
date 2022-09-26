<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Validator;

class BaseController extends Controller
{
    public function ok($message="Petición completada con éxito",$result=[]){
        return $this->response($message,$result,200);
    }

    public function preconditionFailed($message="Validación fallida",$detalleErrores=[]){
        return $this->response($message,$detalleErrores,412);
    }

    public function response($message="Petición completada con éxito",$result=[], $code = 200){   
        $success = $code == 200 ? true : false ;
        
    	$response = [
            'code' => $code,
            'success' => $success,            
            'message' => $message,
        ];

        if(!empty($result))
        {
           foreach ($result as $key => $value) {
            
            $response[$key] = $value;
            } 
        } else {
            $response['errors'] = $result;
        }
        

        return response()->json($response, $code);
    }

    public function sendResponse($message,$result=[]){ 
        return $this->response($message,$result,200);
    }
    
    public function sendError($error,$errorMessages=[], $code = 412){ 
        // dd($errorMessages);
        // foreach ($errorMessages[0] as $key => $value) {
            
        // //     $response[$key] = $value;
        //     } 
        return $this->response($error,$errorMessages,$code);
    }

}
