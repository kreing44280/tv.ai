@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Video Detail'])
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">back</button>
                    </div>
                    <div class="card-body overflow-auto pb-0">
                        <form action="{{ route('news.update', ['id' => $datas->news->news_id]) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <video controls class="w-100">
                                            <source src="{{ $datas->news->video_url }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">News convert mp3 status</label>
                                        <span
                                            class="text-xs @if ($datas->news->news_convert_mp3_status == 'success') text-success @else text-warning @endif opacity-8 me-1">
                                            ( {{ $datas->news->news_convert_mp3_status }} )</span>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">News convert transcript status</label>
                                        <span
                                            class="text-xs @if ($datas->news->news_convert_transcript_status == 'success') text-success @else text-warning @endif opacity-8 me-1">
                                            ( {{ $datas->news->news_convert_transcript_status }} )</span>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">News duration: </label>
                                        <span class="text-xs me-1">
                                            {{ $datas->news->news_duration }}</span>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Created AT: </label>
                                        <span class="text-xs me-1">
                                            {{ $datas->news->news_date->format('Y-m-d') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label for="news_type" class="form-label">News Type</label>
                                                <input type="text" class="form-control" id="news_type"
                                                    value="{{ $datas->news->newsType->news_type_name }}">
                                            </div>
                                            <div class="col">
                                                <label for="category_name" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="category_name"
                                                    value="{{ $datas->TvCategory->category_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label for="category_name" class="form-label">TV Program</label>
                                                <input type="text" class="form-control" id="category_name"
                                                    value="{{ $datas->news->tvProgram->program_name }}">
                                            </div>
                                            <div class="col">
                                                <label for="news_permalink" class="form-label">News Permalink</label>
                                                <input type="text" class="form-control" id="news_permalink"
                                                    value="{{ $datas->news->news_permalink }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="seo_title" class="form-label">SEO Title</label>
                                        <textarea name="seo_title" class="form-control" id="seo_title" cols="30" rows="6">{{ $datas->news->seo_title }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 bg-gray-200">                                                                       
                                    <div class="mb-3">
                                        <label for="news_title" class="form-label">News Title
                                        </label>
                                        <input type="text" class="form-control" id="news_title"
                                            value="{{ $datas->news->news_title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="news_content" class="form-label">News Content</label>
                                        <textarea name="news_content" class="form-control" id="news_content" cols="30" rows="10">{{ $datas->news->news_content }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" id="copyTextAI">Copy text
                                            AI</button>
                                        <span class="btn btn-danger" id="copyTextAICancel">Cancel</span><br>
                                        <u class="text-danger text-sm">เมื่อกด Copy ข้อมูลจะไปแสดงที่ข้างบน !</u>
                                    </div>
                                    <div class="mb-3">
                                        <label for="news_title_ai" class="form-label">News Title AI</label>
                                        <input type="text" class="form-control" id="news_title_ai" name="news_title_ai"
                                            value="{{ $datas->news->news_title_ai }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="news_content_ai" class="form-label">News Content AI</label>
                                        <textarea name="news_content_ai" class="form-control" id="news_content_ai" name="news_content" cols="30" rows="10">{{ $datas->news->news_content_ai }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 pb-3">
                                <div class="col-12 col-md-6">
                                    <label for="seo_desc" class="form-label">SEO Description</label>
                                    <textarea name="seo_desc" class="form-control" id="seo_desc" cols="30" rows="6">{{ $datas->news->seo_desc }}</textarea>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="seo_keyword" class="form-label">SEO Keyword</label>
                                    <textarea name="seo_keyword" class="form-control" id="seo_keyword" cols="30" rows="6">{{ $datas->news->seo_keyword }}</textarea>
                                </div>                                
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="news_transcript" class="form-label">News Transcript</label>
                                        <textarea name="news_transcript" class="form-control" id="news_transcript" name="news_transcript" cols="30"
                                            rows="15">{{ $datas->news->news_transcript }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="news_transcript_only" class="form-label">News Transcript Only</label>
                                        <textarea name="news_transcript_only" class="form-control" id="news_transcript_only" name="news_transcript_only"
                                            cols="30" rows="15">{{ $datas->news->news_transcript_only }}</textarea>
                                    </div>
                                </div>                         
                            </div>
                            <div class="mb-3 text-center pt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" onclick="history.back()">back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#copyTextAI').click(function() {
            const news_title_ai = $('#news_title_ai').val();
            const news_content_ai = $('#news_content_ai').val();
            if (news_title_ai == '' || news_content_ai == '') {
                alert('กรุณากรอกข้อมูลให้ครบ');
                return false;
            }
            $('#news_title').val(news_title_ai);
            $('#news_content').val(news_content_ai);
        });

        $('#copyTextAICancel').click(function() {
            $('#news_title').val(`{{ $datas->news->news_title }}`);
            $('#news_content').val(`{{ $datas->news->news_content }}`);
        });
    </script>
@endsection
