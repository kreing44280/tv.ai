<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\FootageNews;

class VideoController extends Controller
{

    public function index()
    {
        $videos = FootageNews::select(
            'id',
            'raw_file_name',
            'folder_name',
            'mp3_name',
            'mp4_name',
            'status_mp3_convert',
            'status_transcript',
            'created_at'
        )->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.video-list', compact('videos'));
    }

    public function show($id)
    {
        $video = FootageNews::find($id);
        return view('pages.video-detail', compact('video'));
    }

    public function stream($filename)
    {
        $path = storage_path("app/public/videos/{$filename}");

        if (!file_exists($path)) {
            abort(404, "Video not found");
        }

        return response()->stream(function () use ($path) {
            $stream = fopen($path, 'rb');
            while (!feof($stream)) {
                echo fread($stream, 1024 * 8);
                flush();
            }
            fclose($stream);
        }, 200, [
            "Content-Type" => "video/mp4",
            "Content-Length" => filesize($path),
            "Accept-Ranges" => "bytes",
        ]);
    }

    public function update($id)
    {
        $data = request()->all();
        if (isset($data['news_tag'])) {
            $data['news_tag'] = str_replace('×', '', $data['news_tag']);
        }

        $video = FootageNews::find($id);
        $video->update([
            FootageNews::NEWS_TITLE => $data['news_title'] ?? $video->news_title,
            FootageNews::NEWS_DESC => $data['news_desc'] ?? $video->news_desc,
            FootageNews::NEWS_TAG => $data['news_tag'] ?? $video->news_tag,
            FootageNews::NEWS_TIMESTAMP => $data['news_timestamp'] ?? $video->news_timestamp,
        ]);
        return redirect()->route('video-detail', ['id' => $id]);
    }
}
