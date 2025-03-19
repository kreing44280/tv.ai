<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    
    protected $table = 'news_type';

    protected $casts = [
        'news_type_id' => 'integer',
        'news_type_name' => 'string',
    ];

    const NEWS_TYPE_ID = 'news_type_id';
    const NEWS_TYPE_NAME = 'news_type_name';
}
