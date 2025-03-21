<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvCategory extends Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = env('APP_ENV') === 'local' ? 'mysql2' : 'mysql';
    }
    protected $table = 'category';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_desc',
        'category_permalink',
        'category_pic',
        'template_id',
        'category_seq',
        'category_permission',
        'category_format',
        'active',
        'post_by',
        'post_date',
        'update_by',
        'update_date',
        'seo_title',
        'seo_desc',
        'seo_keyword',
        'publish_status',
        'publish_start',
        'category_color',
        'is_category_search',
        'playlist_id',
    ];

    const ID = 'category_id';
    const CATEGORY_NAME = 'category_name';
    const CATEGORY_DESC = 'category_desc';
    const CATEGORY_PERMALINK = 'category_permalink';
    const CATEGORY_PIC = 'category_pic';
    const TEMPLATE_ID = 'template_id';
    const CATEGORY_SEQ = 'category_seq';
    const CATEGORY_PERMISSION = 'category_permission';
    const CATEGORY_FORMAT = 'category_format';
    const ACTIVE = 'active';
    const POST_BY = 'post_by';
    const POST_DATE = 'post_date';
    const UPDATE_BY = 'update_by';
    const UPDATE_DATE = 'update_date';
    const SEO_TITLE = 'seo_title';
    const SEO_DESC = 'seo_desc';
    const SEO_KEYWORD = 'seo_keyword';
    const PUBLISH_STATUS = 'publish_status';
    const PUBLISH_START = 'publish_start';
    const CATEGORY_COLOR = 'category_color';
    const IS_CATEGORY_SEARCH = 'is_category_search';
    const PLAYLIST_ID = 'playlist_id';
    
    public function tvArchived()
    {
        return $this->hasMany(TvArchived::class, TvArchived::CATE_ID, self::ID);
    }

}
