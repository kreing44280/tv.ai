<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    public $timestamps = false; 

    protected $fillable = [
        'role_number',
        'role_name'
    ];

    const ROLE_NUMBER = 'role_number';
    const ROLE_NAME = 'role_name';
}
