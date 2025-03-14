<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeroNews extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'news_tero';

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
        'news_pic_mobile',
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
        'ivs_key',
        'showheroes_id',
        'showheroes_signature',
        'status_bugaboo',
        'tero_pre_video_id',
        'tero_post_video_id',
        'news_pull_video_status',
        'news_merge_video_status',
        'is_youtube_required',
        'news_upload_youtube_ch7_status',
        'news_upload_youtube_tero_status',
        'news_title_youtube',
        'news_content_youtube',
        'news_youtube_category',
        'news_line_category',
        'is_send_to_ch7',
        'tero_youtube_id',
        'ch7_youtube_id',
        'send_line_api',
        'special_flag',
        'news_ch7_url',
        'news_ch7_thumb_url',
        'news_ch7_mp4_url',
        'election_first',
        'is_foryou_news',
        'flag_not_send_youtube',
        'is_send_marqo',
    ];

    protected $casts = [
        'publish_date' => 'datetime:Y-m-d',
        'publish_start' => 'datetime:Y-m-d H:i:s',
        'post_date' => 'datetime:Y-m-d H:i:s',
        'update_date' => 'datetime:Y-m-d H:i:s',
        'news_date' => 'datetime',
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
    const NEWS_PIC_MOBILE = 'news_pic_mobile';
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
    const IVS_KEY = 'ivs_key';
    const SHOWHEROES_ID = 'showheroes_id';
    const SHOWHEROES_SIGNATURE = 'showheroes_signature';
    const STATUS_BUGABOO = 'status_bugaboo';
    const TERO_PRE_VIDEO_ID = 'tero_pre_video_id';
    const TERO_POST_VIDEO_ID = 'tero_post_video_id';
    const NEWS_PULL_VIDEO_STATUS = 'news_pull_video_status';
    const NEWS_MERGE_VIDEO_STATUS = 'news_merge_video_status';
    const IS_YOUTUBE_REQUIRED = 'is_youtube_required';
    const NEWS_UPLOAD_YOUTUBE_CH7_STATUS = 'news_upload_youtube_ch7_status';
    const NEWS_UPLOAD_YOUTUBE_TERO_STATUS = 'news_upload_youtube_tero_status';
    const NEWS_TITLE_YOUTUBE = 'news_title_youtube';
    const NEWS_CONTENT_YOUTUBE = 'news_content_youtube';
    const NEWS_YOUTUBE_CATEGORY = 'news_youtube_category';
    const NEWS_LINE_CATEGORY = 'news_line_category';
    const IS_SEND_TO_CH7 = 'is_send_to_ch7';
    const TERO_YOUTUBE_ID = 'tero_youtube_id';
    const CH7_YOUTUBE_ID = 'ch7_youtube_id';
    const SEND_LINE_API = 'send_line_api';
    const SPECIAL_FLAG = 'special_flag';
    const NEWS_CH7_URL = 'news_ch7_url';
    const NEWS_CH7_THUMB_URL = 'news_ch7_thumb_url';
    const NEWS_CH7_MP4_URL = 'news_ch7_mp4_url';
    const ELECTION_FIRST = 'election_first';
    const IS_FORYOU_NEWS = 'is_foryou_news';
    const FLAG_NOT_SEND_YOUTUBE = 'flag_not_send_youtube';
    const IS_SEND_MARQO = 'is_send_marqo';
    

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

    public static function newsCount()
    {
        return cache()->remember(
            'newsCountTero',
            now()->addHours(1),
            fn() =>
            TeroNews::whereIn('news_type_id', [1, 7])
                ->where('publish_status', 1)
                ->where('active', 1)
                ->count()
        );
    }

    public static function sumNewsContent()
    {
        // return cache()->remember(
        //     'sumNewsContentTero',
        //     now()->addHours(1),
        //     fn() =>
        //     TeroNews::whereIn('news_type_id', [1, 7])
        //         ->where('publish_status', 1)
        //         ->where('active', 1)
        //         ->where('is_video_exist', 1)
        //         ->sum('news_content_count')
        // );
    }
}
