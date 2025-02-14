<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'news';

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
        'news_content_ai'
    ];

    const NEWS_ID = 'news_id';
    const NEWS_TITLE = 'news_title';
    const NEWS_TYPE_ID = 'news_type_id';
    const NEWS_PERMALINK = 'news_permalink';
    const NEWS_PERMISSION = 'news_permission';
    const NEWS_COMMENT = 'news_comment';
    const NEWS_CONTENT = 'news_content';
    const NEWS_DATE = 'news_date';
    const NEWS_PIC = 'news_pic';
    const IS_NEWS_EXTERNAL_LINK = 'is_news_external_link';
    const IS_HEADLINE = 'is_headline';
    const IS_SHORT_NEWS = 'is_short_news';
    const NEWS_EXTERNAL_LINK = 'news_external_link';
    const PROGRAM_ID = 'program_id';
    const VIDEO_ID = 'video_id';
    const VIDEO_POSITION_START = 'video_position_start';
    const VIDEO_LOCATION = 'video_location';
    const VIDEO_POSITION_ALL = 'video_position_all';
    const VIDEO_POSITION_END = 'video_position_end';
    const FACEBOOK_POST = 'facebook_post';
    const TWITTER_POST = 'twitter_post';
    const VIDEO_EXTERNAL_LINK = 'video_external_link';
    const VIDEO_DISPLAY_START = 'video_display_start';
    const VIDEO_DISPLAY_END = 'video_display_end';
    const NEWS_DISPLAY_START = 'news_display_start';
    const NEWS_DISPLAY_END = 'news_display_end';
    const SOCIAL_POST_START = 'social_post_start';
    const SOCIAL_POST_DATE = 'social_post_date';
    const NEWS_COUNT = 'news_count';
    const IS_WEB_DISPLAY = 'is_web_display';
    const IS_MOBILE_DISPLAY = 'is_mobile_display';
    const PUBLISH_STATUS = 'publish_status';
    const PUBLISH_DATE = 'publish_date';
    const PUBLISH_START = 'publish_start';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';
    const SEO_DESC = 'seo_desc';
    const SEO_TITLE = 'seo_title';
    const SEO_KEYWORD = 'seo_keyword';
    const REF_NEWS_ID = 'ref_news_id';
    const NEWS_TITLE_AI = 'news_title_ai';
    const NEWS_CONTENT_AI = 'news_content_ai';

    public $casts = [
        'news_date' => 'datetime',
        'publish_date' => 'datetime',
        'publish_start' => 'datetime',
        'post_date' => 'datetime',
        'update_date' => 'datetime'
    ];

    public $with = ['newsType', 'tvProgram'];

    public function newsType() {
        return $this->belongsTo(NewsType::class, self::NEWS_TYPE_ID, 'news_type_id');
    }

    public function tvProgram() {
        return $this->belongsTo(TvProgram::class, self::PROGRAM_ID, 'program_id');
    }
}
