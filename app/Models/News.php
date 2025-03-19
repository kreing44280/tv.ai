<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    protected $table = 'news';
    protected $primaryKey = 'news_id';

    protected $fillable = [
        'news_id',
        'news_title',
        'news_type_id',
        'news_permalink',
        'news_permission',
        'news_comment',
        'news_content',
        'news_date',
        'news_pic',
        'is_news_external_link',
        'is_headline',
        'is_short_news',
        'news_external_link',
        'program_id',
        'video_id',
        'video_position_start',
        'video_location',
        'video_position_all',
        'video_position_end',
        'facebook_post',
        'twitter_post',
        'video_external_link',
        'video_display_start',
        'video_display_end',
        'news_display_start',
        'news_display_end',
        'social_post_start',
        'social_post_date',
        'news_count',
        'is_web_display',
        'is_mobile_display',
        'publish_status',
        'publish_date',
        'publish_start',
        'active',
        'post_by',
        'post_date',
        'update_by',
        'update_date',
        'seo_desc',
        'seo_title',
        'seo_keyword',
        'ref_news_id',
        'news_title_ai',
        'news_content_ai',
        'news_convert_mp3_status',
        'news_transcript',
        'news_transcript_only',
        'news_convert_transcript_status',
        'is_require_transcribe',
        'news_duration',
        'is_video_exist'
    ];

    const NEWS_ID = 'news_id'; // int(11) Auto Increment
    const NEWS_TITLE = 'news_title'; // varchar(255) NULL
    const NEWS_TITLE_COUNT = 'news_title_count'; // int(11) NULL
    const NEWS_TYPE_ID = 'news_type_id'; // tinyint(4) NULL
    const NEWS_PERMALINK = 'news_permalink'; // varchar(255)
    const NEWS_PERMISSION = 'news_permission'; // int(1)
    const NEWS_COMMENT = 'news_comment'; // int(1) NULL [0]
    const NEWS_CONTENT = 'news_content'; // text NULL
    const NEWS_CONTENT_COUNT = 'news_content_count'; // int(11) NULL [0]
    const NEWS_DATE = 'news_date'; // datetime NULL
    const NEWS_PIC = 'news_pic'; // varchar(100) NULL
    const IS_NEWS_EXTERNAL_LINK = 'is_news_external_link'; // tinyint(1) NULL
    const IS_HEADLINE = 'is_headline'; // tinyint(1) NULL
    const IS_SHORT_NEWS = 'is_short_news'; // varchar(45) NULL
    const NEWS_EXTERNAL_LINK = 'news_external_link'; // varchar(100) NULL
    const PROGRAM_ID = 'program_id'; // int(11)
    const VIDEO_ID = 'video_id'; // int(11) NULL
    const VIDEO_POSITION_START = 'video_position_start'; // varchar(45) NULL
    const VIDEO_LOCATION = 'video_location'; // varchar(200) NULL
    const VIDEO_POSITION_ALL = 'video_position_all'; // int(1)
    const VIDEO_POSITION_END = 'video_position_end'; // varchar(45) NULL
    const FACEBOOK_POST = 'facebook_post'; // int(11) NULL
    const TWITTER_POST = 'twitter_post'; // int(11) NULL
    const VIDEO_EXTERNAL_LINK = 'video_external_link'; // varchar(100) NULL
    const VIDEO_DISPLAY_START = 'video_display_start'; // date NULL
    const VIDEO_DISPLAY_END = 'video_display_end'; // date NULL
    const NEWS_DISPLAY_START = 'news_display_start'; // date NULL
    const NEWS_DISPLAY_END = 'news_display_end'; // date NULL
    const SOCIAL_POST_START = 'social_post_start'; // date NULL
    const SOCIAL_POST_DATE = 'social_post_date'; // int(1) NULL
    const NEWS_COUNT = 'news_count'; // int(11) NULL
    const IS_WEB_DISPLAY = 'is_web_display'; // tinyint(1) NULL
    const IS_MOBILE_DISPLAY = 'is_mobile_display'; // tinyint(1) NULL
    const PUBLISH_STATUS = 'publish_status'; // int(11) NULL
    const PUBLISH_DATE = 'publish_date'; // datetime NULL
    const PUBLISH_START = 'publish_start'; // int(1) NULL
    const ACTIVE = 'active'; // varchar(1) NULL
    const POST_BY = 'post_by'; // varchar(45) NULL
    const POST_DATE = 'post_date'; // datetime NULL
    const UPDATE_BY = 'update_by'; // varchar(45) NULL
    const UPDATE_DATE = 'update_date'; // datetime NULL
    const SEO_DESC = 'seo_desc'; // varchar(255) NULL
    const SEO_TITLE = 'seo_title'; // varchar(255) NULL
    const SEO_KEYWORD = 'seo_keyword'; // text NULL
    const REF_NEWS_ID = 'ref_news_id'; // int(11) NULL
    const NEWS_TITLE_AI = 'news_title_ai'; // varchar(255) NULL
    const NEWS_CONTENT_AI = 'news_content_ai'; // text NULL
    const NEWS_CONVERT_MP3_STATUS = 'news_convert_mp3_status'; // varchar(30) NULL [wait]
    const NEWS_TRANSCRIPT = 'news_transcript'; // text NULL
    const NEWS_TRANSCRIPT_ONLY = 'news_transcript_only'; // text NULL
    const NEWS_CONVERT_TRANSCRIPT_STATUS = 'news_convert_transcript_status'; // varchar(30) NULL [wait]    
    const IS_REQUIRE_TRANSCRIBE = 'is_require_transcribe'; // tinyint(1)
    const IS_VIDEO_EXIST = 'is_video_exist';
    const NEWS_DURATION = 'news_duration';


    public $casts = [
        'news_date' => 'datetime',
        'publish_date' => 'datetime',
        'publish_start' => 'datetime',
        'post_date' => 'datetime',
        'update_date' => 'datetime',
    ];


    public function newsType()
    {
        return $this->belongsTo(NewsType::class, self::NEWS_TYPE_ID, 'news_type_id')->select('news_type_name', 'news_type_id');
    }

    public function tvProgram()
    {
        return $this->belongsTo(TvProgram::class, self::PROGRAM_ID, 'program_id')->select('program_name', 'program_id', 'program_permalink');
    }

    public function videoMaster()
    {
        return $this->belongsTo(VideoMaster::class, self::VIDEO_ID, 'video_id')->select('video_name', 'video_id', 'video_date');
    }

    public static function getData()
    {
        return cache()->remember('getData', now()->addHours(1), function () {  
            $array = self::getPublishedNewsCount();  
            return [            
                'categoryCountViews' => NewsCategory::categoryCountView(),
                'newsCount' => $array['total'],
                'archivedNewsCount' => $array['archived_news'],
                'teroNewsCount' => $array['tero_news'],
                'aiNewsCount' => self::getAINewsCount(),
                'pendingCount' => self::getAINewsPendingCount(),
                'categoryNewsCount' => NewsCategory::categoryCountNews()
            ];

        });
    }

    public function setPicture()
    {
        $image = $this->news_pic;
        $imagePath = 'https://backend.teroasia.com/uploads/pic_news/mid_' . $image;

        $this->news_pic = (!empty($image) && @get_headers($imagePath)[0] !== 'HTTP/1.1 404 Not Found')
            ? asset($imagePath)
            : asset('https://cdn4.vectorstock.com/i/1000x1000/55/63/error-404-file-not-found-web-icon-vector-21745563.jpg');
    }

    private static function getPublishedNewsCount()
    {
        $archived_news = News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
        ->whereIn(News::NEWS_TYPE_ID, [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)                   
            ->where('news.is_video_exist', 1)     
            ->count();

        $tero_news = TeroNews::whereIn(TeroNews::NEWS_TYPE_ID, [1, 7])->where(TeroNews::PUBLISH_STATUS, 1)->where(TeroNews::ACTIVE, 1)->count();

        return array('archived_news' => $archived_news, 'tero_news' =>  $tero_news, 'total' => $archived_news + $tero_news);

    }

    private static function getAINewsCount()
    {
        return News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn('news.news_type_id', [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->whereNotNull('news.ref_news_id')                        
            ->count();
    }

    private static function getAINewsPendingCount()
    {
        return News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn('news.news_type_id', [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->whereNull('news.ref_news_id')                        
            ->count();
    }
}
