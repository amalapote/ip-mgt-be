<?php

namespace App\Queries;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use OwenIt\Auditing\Contracts\Auditable;
class UserQueries extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Saving users to the database.
     *
     * @param array $data
     * @return self
     */
    public function create(array $data): self
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->password = bcrypt($data['password']);
        $this->save();

        return $this;
    }

    /**
     * Generating oauth token.
     *
     * @param Request $request
     * @return \stdClass
     */
    public function generateToken(Request $request): \stdClass
    {
        request()->request->add([
            'grant_type' => config('passport.password_access_client.grant_type'),
            'client_id' => config('passport.password_access_client.id'),
            'client_secret' => config('passport.password_access_client.secret'),
            'scope' => '', // optional
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $response = Route::dispatch(Request::create('oauth/token', 'POST'));

        return json_decode($response->getContent());
    }

    /**
     * Generating refresh token.
     *
     * @param string $tokenId
     * @return \stdClass
     */
    public function generateRefreshToken(string $tokenId): \stdClass
    {
        request()->request->add([
            'grant_type' => 'refresh_token',
            'refresh_token' => $tokenId,
            'client_id' => config('passport.password_access_client.id'),
            'client_secret' => config('passport.password_access_client.secret'),
            'scope' => '', // optional
        ]);

        $response = Route::dispatch(Request::create('oauth/token', 'POST'));

        return json_decode($response->getContent());
    }

    /**
     * Revoking generated oauth token.
     *
     * @param $tokenId
     * @return void
     */
    public function revokeToken($tokenId): void
    {
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $tokenRepository->revokeAccessToken($tokenId);

        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);
    }

}
