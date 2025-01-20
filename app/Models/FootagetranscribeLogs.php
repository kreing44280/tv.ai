<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FootagetranscribeLogs extends Model
{
     /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable;

     protected $table = 'footage_transcribe_logs';

     protected $fillable = [
        'footage_news_id',
        'logs_type',
        'logs',
        'created_at',
     ];

     const FOOTAGE_NEWS_ID = 'footage_news_id';
     const LOGS_TYPE = 'logs_type';
     const LOGS = 'logs';
     const CREATED_AT = 'created_at';

     protected $casts = [
        'id' => 'integer',
        'footage_news_id' => 'integer',
        'created_at' => 'datetime',
     ];

     public function footage_news()
     {
        return $this->belongsTo(FootageNews::class);
     }
}
