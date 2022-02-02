<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function Json(
        int $status = 200,
        string $message = null,
        array $data = [],
        array $errors = []
    ): JsonResponse
    {
        return new JsonResponse([
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "errors" => $errors,
        ], $status);
    }
}
