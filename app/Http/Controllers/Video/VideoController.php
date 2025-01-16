<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index()
    {
        return view('pages.video');
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
}
