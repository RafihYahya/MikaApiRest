<?php
namespace App\Traits;

trait HttpResponses
{
    protected function Ok($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request Was Succesful',
            'message' => $message,
            'data' => $data
        ], 200);
    }
    protected function Err($data, $code, $message = null)
    {
        return response()->json([
            'status' => 'Something Wrong Has Occured',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}