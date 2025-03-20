<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvProgram extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'tv_program';

    protected $primaryKey = 'program_id';
    protected $fillable = [
        'program_name', 'program_desc', 'program_stream', 'program_permalink', 'program_slug', 'program_wd_start', 'program_wd_end',
        'program_we_start', 'program_we_end', 'facebook_app_id', 'fanpage', 'igapp_id', 'ig_password', 'facebook_app_secret',
        'twitter_username', 'twitter_password', 'active', 'post_by', 'post_date', 'update_by', 'update_date', 'theme_id', 'seo_desc',
        'seo_title', 'seo_keyword', 'publish_status', 'publish_start', 'tvp_logo', 'tvp_bg', 'tvp_color', 'tvp_img_main', 'tvp_img_program',
        'tvp_header_desk', 'tvp_header_mobi',
    ];

    const PROGRAM_ID = 'program_id';
    const PROGRAM_NAME = 'program_name';
    const PROGRAM_DESC = 'program_desc';
    const PROGRAM_STREAM = 'program_stream';
    const PROGRAM_PERMALINK = 'program_permalink';
    const PROGRAM_SLUG = 'program_slug';
    const PROGRAM_WD_START = 'program_wd_start';
    const PROGRAM_WD_END = 'program_wd_end';
    const PROGRAM_WE_START = 'program_we_start';
    const PROGRAM_WE_END = 'program_we_end';
    const FACEBOOK_APP_ID = 'facebook_app_id';
    const FANPAGE = 'fanpage';
    const IGAPP_ID = 'igapp_id';
    const IG_PASSWORD = 'ig_password';
    const FACEBOOK_APP_SECRET = 'facebook_app_secret';
    const TWITTER_USERNAME = 'twitter_username';
    const TWITTER_PASSWORD = 'twitter_password';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';
    const THEME_ID = 'theme_id';
    const SEO_DESC = 'seo_desc';
    const SEO_TITLE = 'seo_title';
    const SEO_KEYWORD = 'seo_keyword';
    const PUBLISH_STATUS = 'publish_status';
    const PUBLISH_START = 'publish_start';
    const TVP_LOGO = 'tvp_logo';
    const TVP_BG = 'tvp_bg';
    const TVP_COLOR = 'tvp_color';
    const TVP_IMG_MAIN = 'tvp_img_main';
    const TVP_IMG_PROGRAM = 'tvp_img_program';
    const TVP_HEADER_DESK = 'tvp_header_desk';
    const TVP_HEADER_MOBI = 'tvp_header_mobi';
    
}
