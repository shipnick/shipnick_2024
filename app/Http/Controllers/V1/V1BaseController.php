<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class V1BaseController extends Controller
{
    /**
     * Summary of successJSON
     * @param mixed $data
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function successJSON($data = [], $message = null)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ]);
    }
    /**
     * Summary of errorJSON
     * @param mixed $message
     * @param mixed $data
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function errorJSON($message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $status);
    }

}
