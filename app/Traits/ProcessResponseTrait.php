<?php
namespace App\Traits;
trait ProcessResponseTrait
{
    public function processResponse($data,$status,$message=null)
    {
        if($status=='success')
        {
            return response()->json([
                'status' => $status,
                'categories' => $data,
                'code' => 200,
                'message' => $message
            ]);
        }
    
        else
        {
            return response()->json([
                'code'=>404,
                'status'=>$status,
                'message'=>$message

            ]);
        }
    }
    public function blogProcessResponse($data,$status,$message=null)
    {
        if($status=='success')
        {
            return response()->json([
                'status' => $status,
                'blogs' => $data,
                'code' => 200,
                'message' => $message
            ]);
        }
    
        else
        {
            return response()->json([
                'code'=>404,
                'status'=>$status,
                'message'=>$message

            ]);
        }
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}