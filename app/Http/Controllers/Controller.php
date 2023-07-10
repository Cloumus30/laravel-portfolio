<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendApiResponse(mixed $data = null,string $message = null, int $statusCode = 200){
        return response()->json([
            'message' => $message ?? "Success Get",
            'data' => $data,
        ],$statusCode);
    }

    public function sendApiError(string $message = null, int $statusCode = 500, mixed $data = null){
        $temp = [
            'error' => $message ?? "There is Error",
        ];
        if($data){
            $temp['data'] = $data;
        }
        return response()->json($temp,$statusCode);
    }
}
