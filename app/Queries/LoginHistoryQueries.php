<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoginHistoryQueries extends Model
{
    public function saveLoginRecords(): void
    {
        $this->user()
            ->associate(Auth::user())
            ->save([
            'description' => 'User logged in',
            'login_at' => now(),
        ]);
    }
    public function saveLogoutRecords(): void
    {
        $this->user()
            ->associate(Auth::user())
            ->save([
            'description' => 'User logged out',
            'logout_at' => now(),
        ]);
    }

}
