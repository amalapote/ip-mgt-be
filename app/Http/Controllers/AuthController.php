<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\{
    User,
    LoginHistory
};
use App\Http\Requests\{
    RegistrationRequest,
    LoginRequest,
    RefreshTokenRequest
};
use App\Http\Resources\{
    LoginResource,
    RegistrationResource
};
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
class AuthController extends Controller
{
    /**
     * @param User $user
     */
    public function __construct(readonly protected User $user)
    {
        //
    }

    /**
     * Registration of user.
     *
     * @param RegistrationRequest $request
     * @return RegistrationResource
     */
    public function register(RegistrationRequest $request): RegistrationResource
    {
        return new RegistrationResource($this->user->create($request->validated()));
    }

    /**
     * Login of user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            if (!Auth::guard('web')
                ->attempt(['email' => $request->username,
                    'password' => $request->password])
            ) {
                return response()->json([
                    'message' => Lang::get('auth.failed'),
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json($this->user->generateToken($request), Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Logout of user.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $revoke = Auth::user()->token()->revoke();

        return response()->json([
            'message' => $revoke ? 'Successfully logged out' : 'Failed to logout'
        ], Response::HTTP_OK);
    }

    /**
     * Refresh token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(RefreshTokenRequest $request): JsonResponse
    {
        return response()->json($this->user->generateRefreshToken($request->refresh_token), Response::HTTP_OK);
    }

}
