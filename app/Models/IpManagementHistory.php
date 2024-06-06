<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpManagementHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_management_id',
        'ip_address',
        'edit_at',
        'added_at',
        'description'
    ];
}
