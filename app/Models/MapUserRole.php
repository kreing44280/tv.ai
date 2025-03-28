<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapUserRole extends Model
{
    use HasFactory;

    protected $table = 'map_user_roles';

    public $timestamps = false; 

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    const USER_ID = 'user_id';
    const ROLE_ID = 'role_id';

}