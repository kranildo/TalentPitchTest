<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\Implementation\UserService;
use Illuminate\Http\Request;

/**
 * @group OAuth
 * APIs for authorization control
 */
class AuthCtrl extends Controller
{
    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Revoke Logged User Token
     * Endpoint to logout the user revoking the token
     *
     * @response 200{
     * "status": 200,
     * "message": "You have been successfully disconnected",
     * "date": [],
     * "errors": []
     * }
     * @response 401{
     * Unauthorized.
     * }
     * @response 404{
     * "status": 404,
     * "message": "Data not found",
     * "date": [],
     * "errors": []
     * }
     */
    public function logout(Request $request)
    {
        $token = auth()->user()->token();
        $token->revoke();
        if ($token->revoked) {
            return $this->Json(200, "You have been successfully disconnected");
        }
        return $this->Json(400, "Error when disconnected");
    }
}
