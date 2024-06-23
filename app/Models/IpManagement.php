<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Queries\IpManagementQueries;

class IpManagement extends IpManagementQueries
{

    use HasFactory;
    protected $fillable = [
        'ip_address',
        'label',
        'comment',
    ];

    /**
     * Belongs to relationship connects this model to the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
