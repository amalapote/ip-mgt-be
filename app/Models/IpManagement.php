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
}
