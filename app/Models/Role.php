<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $table = 'role';
    public $timestamps = false;
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
        'active',
        'post_by',
        'post_date',
        'update_by',
        'update_date',
        'publish_status'
    ];

    const ROLE_ID = 'role_id';
    const ROLE_NAME = 'role_name';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';
    const PUBLISH_STATUS = 'publish_status';    
}
