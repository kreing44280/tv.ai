<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_role';

    public $timestamps = false; 

    protected $fillable = [
        'role_role_id',
        'user_user_id',
        'active',
        'post_by',
        'post_date',
        'update_by',
        'update_date'
    ];

    const ROLE_ROLE_ID = 'role_role_id';
    const USER_USER_ID = 'user_user_id';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';

    public $with = ['roles'];

    public function roles () {
        return $this->hasMany(Role::class, 'role_id', 'role_role_id');
    }
}
