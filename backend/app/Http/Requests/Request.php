<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Pearl\RequestValidate\RequestAbstract;

class Request extends RequestAbstract
{
    protected function formatErrors(Validator $validator): JsonResponse
    {
        return new JsonResponse([
            "status" => 422,
            "message" => "Validation error",
            "data" => [],
            "errors" => $validator->getMessageBag()->toArray(),
        ], 422);
    }
}
