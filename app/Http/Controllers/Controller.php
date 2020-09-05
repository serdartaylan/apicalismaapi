<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResultType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // TODO:temizleneek

    public function respond($data, $message = 'default', $code = 200)
    {

        $response = [];
        /*
        if ($resultType == ResultType::Success) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        */

        $response['result'] = $data;
        $response['message'] = $message;

        return response()->json($response, $code);
    }
}
