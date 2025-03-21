<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoMaster extends Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = env('APP_ENV') === 'local' ? 'mysql2' : 'mysql';
    }

    protected $table = 'video_master';

    protected $fillable = [
        'video_id',
        'video_name',
        'video_reference',
        'video_date',
        'video_url',
        'video_pic',
        'video_child',
        'program_id',
        'active',
        'post_by',
        'post_date',
        'update_by',
        'update_date',
        'publish_status',
        'video_count',
    ];

    const VIDEO_ID = 'video_id';    
    const VIDEO_NAME = 'video_name';
    const VIDEO_REFERENCE = 'video_reference';
    const VIDEO_DATE = 'video_date';
    const VIDEO_URL = 'video_url';
    const VIDEO_PIC = 'video_pic';
    const VIDEO_CHILD = 'video_child';
    const PROGRAM_ID = 'program_id';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';
    const PUBLISH_STATUS = 'publish_status';
    const VIDEO_COUNT = 'video_count';
    
}
