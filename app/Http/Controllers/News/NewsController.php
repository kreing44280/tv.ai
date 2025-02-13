<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\TvCategory;

class NewsController extends Controller
{
    public function index(){    
        $data_category = TvCategory::select('category_id', 'category_name', 'active')        
        ->where([
            TvCategory::ACTIVE => 1,
            TvCategory::PUBLISH_STATUS => 1
        ])
        ->has('tvArchived')
        ->paginate(15);

        return view('pages.news', compact('data_category'));
    }
}
