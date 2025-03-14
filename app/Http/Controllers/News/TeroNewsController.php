<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\TeroNews;
use App\Models\TvProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeroNewsController extends Controller
{
    public function index()
    {
        $datas = cache()->remember('teroNewsPaginated', now()->addMinutes(10), function () {
            return TeroNews::selectRaw('news_tero.news_id, news_tero.news_title, news_tero.news_date, news_tero.news_permalink,
                news_tero.news_pic, news_tero.news_type_id, news_tero.program_id, news_tero.news_line_category')
                ->with('tvProgram', 'newsType')
                ->where('news_tero.publish_status', 1)
                ->where('news_tero.active', 1)
                ->whereIn('news_tero.news_type_id', [1, 7])
                ->paginate(30);
        });
        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        $news_count = TeroNews::newsCount();
        $tv_programs = $this->getTvProgram();

        return view('pages.tero-news', compact('datas', 'news_count', 'tv_programs'));
    }

    private function setPicture($item)
    {
        $image = $item->news_pic;
        $imagePath = 'https://backend.teroasia.com/uploads/pic_news/mid_' . $image;

        $item->news_pic = (!empty($image) && @get_headers($imagePath)[0] !== 'HTTP/1.1 404 Not Found')
            ? asset($imagePath)
            : asset('https://cdn4.vectorstock.com/i/1000x1000/55/63/error-404-file-not-found-web-icon-vector-21745563.jpg');
    }

    private function getTvProgram()
    {
        return cache()->remember('tvProgram', now()->addHours(1), fn() => TvProgram::all());
    }

    public function search()
    {
        // รับค่าจาก request
        $queryParams = [
            'newsName' => request('newsName'),
            'startDate' => request('startDate'),
            'endDate' => request('endDate'),
            'tv_program' => request('tv_program'),
            'page' => request('page', 1),
        ];

        // ลบค่าที่เป็น null หรือว่าง
        $filteredParams = array_filter($queryParams, function ($value) {
            return !is_null($value) && $value !== '';
        });

        // ถ้า URL ปัจจุบันยังมีค่าที่ว่าง ให้ Redirect ไปยัง URL ใหม่ที่สะอาดขึ้น
        if (request()->query() !== $filteredParams) {
            return redirect()->to(url('/tero-news/search') . '?' . http_build_query($filteredParams));
        }

        // ถ้า URL ถูกต้องแล้ว ให้ดำเนินการค้นหาต่อ
        $datas = TeroNews::selectRaw('news_id, news_title, news_date, news_permalink,
        news_pic, program_id')
            ->with('tvProgram', 'newsType')
            ->where(function ($query) use ($filteredParams) {
                if (isset($filteredParams['newsName'])) {
                    $query->where(function ($q) use ($filteredParams) {
                        $q->where('news_id', $filteredParams['newsName'])
                            ->orWhere('news_title', 'like', '%' . $filteredParams['newsName'] . '%');
                    });
                }
            });

        if (!empty($filteredParams['startDate']) && !empty($filteredParams['endDate'])) {
            $datas->whereBetween('news_date', [$filteredParams['startDate'], $filteredParams['endDate']]);
        }

        if (!empty($filteredParams['tv_program'])) {
            $datas->where('program_id', $filteredParams['tv_program']);
        }

        $datas->whereIn('news_type_id', [1, 7]);
        $datas->where('publish_status', 1);
        $datas->where('active', 1);

        $datas = $datas->paginate(10)->appends(request()->query());


        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        $tv_programs = $this->getTvProgram();
        $news_count = TeroNews::newsCount();

        return view('pages.tero-news', compact('datas', 'tv_programs', 'news_count'));
    }

    public function show($id)
    {
        return $this->showDetail($id);
    }

    private function showDetail($id)
    {
        $datas = TeroNews::with(['TvProgram', 'newsType'])->where('news_id', $id)->first();
        $datas->news_content = strip_tags(html_entity_decode($datas->news_content));

        return view('pages.tero-news-detail', compact('datas'));
    }

    private function getVideoUrl($folder, $news_date, $news_id)
    {
        $base_url = "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id";
        $urls = ["{$base_url}_480.mp4", "{$base_url}_720.mp4", "{$base_url}.mp4"];

        if ($this->checkUrlStatus($urls) != 404) {
            return $this->checkUrlStatus($urls);
        }
    }

    public function checkUrlStatus(array $urls)
    {
        foreach ($urls as $url) {

            try {
                $response = Http::head($url);

                if ($response->successful()) {
                    return $url;
                }
            } catch (\Throwable $th) {
                //
            }
        }
        return 404;
    }
}
