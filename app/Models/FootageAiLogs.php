<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FootageAiLogs extends Model
{

     /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable;


    protected $table = 'footage_ai_logs';

    protected $fillable = [
        'logs_type',
        'logs',
    ];

    public $timestamps = false;

    const LOGS_TYPE = 'logs_type';
    const LOGS = 'logs';

    protected $casts = [
        'logs_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
