<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success(
        $data = [],
        int $httpCode = 200
    ): Application|Response|ResponseFactory {
        return response([
            'status' => 'success',
            'data' => $data,
            'error' => []
        ], $httpCode);
    }

    protected function error(
        $error,
        int $httpCode = 400
    ): Application|Response|ResponseFactory {
        if (!is_array($error)) {
            $error = [
                'message' => $error
            ];
        }
        return response([
            'status' => 'error',
            'data' => [],
            'error' => $error,
        ], $httpCode);
    }
}
