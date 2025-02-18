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
                    <div class="card-body overflow-auto">
                        <div class="row grid-cols-2 grid-lg-cols-1">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="news_id" class="form-label">News ID</label>
                                    <input type="text" class="form-control" id="news_id"
                                        value="{{ $datas->news->news_id }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="news_type" class="form-label">News Type</label>
                                    <input type="text" class="form-control" id="news_type"
                                        value="{{ $datas->news->newsType->news_type_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category ID</label>
                                    <input type="text" class="form-control" id="category_id"
                                        value="{{ $datas->TvCategory->category_id }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name"
                                        value="{{ $datas->TvCategory->category_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">TV Program</label>
                                    <input type="text" class="form-control" id="category_name"
                                        value="{{ $datas->news->tvProgram->program_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Created AT</label>
                                    <input type="text" class="form-control" id="category_name"
                                        value="{{ $datas->news->news_date->format('Y-m-d') }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="news_permalink" class="form-label">News Permalink</label>
                                    <input type="text" class="form-control" id="news_permalink"
                                        value="{{ $datas->news->news_permalink }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <video controls width="640" height="300">
                                        <source src="{{ $datas->news->video_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">News convert mp3 status</label>
                                    <span
                                        class="text-xs @if ($datas->news->news_convert_mp3_status == 'success') text-success @else text-warning @endif opacity-8 me-1"
                                        aria-hidden="true">
                                        ( {{ $datas->news->news_convert_mp3_status }} )</span>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">News convert transcript status</label>
                                    <span
                                        class="text-xs @if ($datas->news->news_convert_transcript_status == 'success') text-success @else text-warning @endif opacity-8 me-1"
                                        aria-hidden="true">
                                        ( {{ $datas->news->news_convert_transcript_status }} )</span>
                                </div>
                                <div class="mb-3">
                                    <label for="news_title_ai" class="form-label">News Title AI
                                    </label>
                                    <input type="text" class="form-control" id="news_title_ai"
                                        value="{{ $datas->news->news_title_ai }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="news_content_ai" class="form-label">News Content AI</label>
                                    <textarea name="news_content_ai" class="form-control" id="news_content_ai" cols="30" rows="6" readonly>{{ $datas->news->news_content_ai }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" id="copyTextAI">Copy text AI</button>
                                    <span class="btn btn-danger" id="copyTextAICancel">Cancel</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col grid-cols-1">
                                <div class="mb-3">
                                    <label for="news_title" class="form-label">News Title</label>
                                    <input type="text" class="form-control" id="news_title"
                                        value="{{ $datas->news->news_title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="news_content" class="form-label">News Content</label>
                                    <textarea name="news_content" class="form-control" id="news_content" cols="30" rows="6">{{ $datas->news->news_content }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="news_transcript" class="form-label">News Transcript</label>
                                    <textarea name="news_transcript" class="form-control" id="news_transcript" cols="30" rows="6">{{ $datas->news->news_transcript }}</textarea>
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-secondary" onclick="history.back()">back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('copyTextAI').addEventListener('click', function() {
                console.log('test');
                const news_title_ai = document.getElementById('news_title_ai').value;
                const news_content_ai = document.getElementById('news_content_ai').value;
                document.getElementById('news_title').value = news_title_ai;
                document.getElementById('news_content').value = news_content_ai;
            });

            document.getElementById('copyTextAICancel').addEventListener('click', function() {
                document.getElementById('news_title').value = {{ $datas->news->news_title }};
                document.getElementById('news_content').value = {{ $datas->news->news_content }};
            });
        </script>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
