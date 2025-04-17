<?php

namespace App\Http\Controllers;

use App\Models\NewsType;
use App\Models\TvCategory;
use App\Models\TvProgram;

abstract class Controller
{
    protected function getTvProgram()
    {
        return cache()->remember('tvProgram', now()->addDay(), fn() => TvProgram::all());
    }

    protected function getCategories()
    {
        return cache()->remember('category', now()->addDay(), fn() => TvCategory::all());
    }

    protected function getNewsType() {
        return cache()->remember('newsType', now()->addDay(), fn() => NewsType::all());
    }
}
