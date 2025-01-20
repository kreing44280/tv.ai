<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class FootageNews extends Model
{
      /** @use HasFactory<\Database\Factories\UserFactory> */
      use HasFactory, Notifiable, SoftDeletes;

      protected $table = 'footage_news';

      protected $fillable = [
            'raw_file_name',
            'folder_name',
            'mp3_name',
            'mp4_name',
            'status_mp3_convert',
            'mp3_convert_os',
            'transcript',
            'status_transcript',
            'news_title',
            'news_desc',
            'news_tag',
            'news_timestamp',
            'news_title_human',
            'news_desc_human',
            'news_tag_human',
            'news_timestamp_human',
            'is_require_transcribe',
            'created_at',
            'updated_at',
      ];

      const ID = 'id';
      const RAW_FILE_NAME = 'raw_file_name';
      const FOLDER_NAME = 'folder_name';
      const MP3_NAME = 'mp3_name';
      const MP4_NAME = 'mp4_name';
      const STATUS_MP3_CONVERT = 'status_mp3_convert';
      const MP3_CONVERT_OS = 'mp3_convert_os';
      const TRANSCRIPT = 'transcript';
      const STATUS_TRANSCRIPT = 'status_transcript';
      const NEWS_TITLE = 'news_title';
      const NEWS_DESC = 'news_desc';
      const NEWS_TAG = 'news_tag';
      const NEWS_TIMESTAMP = 'news_timestamp';
      const NEWS_TITLE_HUMAN = 'news_title_human';
      const NEWS_DESC_HUMAN = 'news_desc_human';
      const NEWS_TAG_HUMAN = 'news_tag_human';
      const NEWS_TIMESTAMP_HUMAN = 'news_timestamp_human';
      const IS_REQUIRE_TRANSCRIBE = 'is_require_transcribe';
      const CREATED_AT = 'created_at';
      const UPDATED_AT = 'updated_at';

      protected $casts = [
            self::RAW_FILE_NAME => 'string',
            self::FOLDER_NAME => 'string',
            self::MP3_NAME => 'string',
            self::MP4_NAME => 'string',
            self::STATUS_MP3_CONVERT => 'string',
            self::MP3_CONVERT_OS => 'string',
            self::TRANSCRIPT => 'string',
            self::STATUS_TRANSCRIPT => 'string',
            self::NEWS_TITLE => 'string',
            self::NEWS_DESC => 'string',
            self::NEWS_TAG => 'string',
            self::NEWS_TIMESTAMP => 'string',
            self::NEWS_TITLE_HUMAN => 'string',
            self::NEWS_DESC_HUMAN => 'string',
            self::NEWS_TAG_HUMAN => 'string',
            self::NEWS_TIMESTAMP_HUMAN => 'string',
            self::IS_REQUIRE_TRANSCRIBE => 'string',
            self::CREATED_AT => 'datetime',
            self::UPDATED_AT => 'datetime',
      ];

      public function footageTranscribe() {
            return $this->belongsTo(FootagetranscribeLogs::class, self::ID);
      }
}
