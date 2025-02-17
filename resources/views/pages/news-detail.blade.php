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
                        <div class="embed-responsive embed-responsive-16by9">
                            <form action="" method="POST">
                                @csrf
                                <div class="row row-col-2 mb-3">
                                    <div class="col form-group">
                                        <label for="category" class="form-control-label font-weight-bold text-uppercase">Category Id</label>
                                        <input type="text" name="category" id="category"
                                            value="{{ $datas->TvCategory->category_id }}" class="form-control form-control-alternative"
                                            disabled>
                                    </div>
                                    <div class="col form-group">
                                        <label for="category_name" class="form-control-label font-weight-bold text-uppercase">Category name</label>
                                        <input type="text" name="category_name" id="category_name"
                                            value="{{ $datas->TvCategory->category_name }}" class="form-control form-control-alternative"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="news_tile" class="form-control-label font-weight-bold text-uppercase">Title</label>
                                    <input type="text" name="news_tile" id="news_tile"
                                        value="{{ $datas->news->news_title }}" class="form-control form-control-alternative"
                                        disabled>
                                </div>                             
                                <div class="form-group mb-3">
                                    <label for="news_content" class="form-control-label font-weight-bold text-uppercase">Content</label>
                                    <textarea name="news_content" id="news_content" class="form-control form-control-alternative" rows="10" disabled>{{ $datas->news->news_content }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="video_name"
                                        class="form-control-label font-weight-bold text-uppercase">Video Name</label>
                                    <input type="text" name="video_name" id="video_name"
                                        value="{{ $datas->news->news_id}}.mp4" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                <div class="form-group mb-3">
                                    <video controls width="640" height="360">
                                        <source
                                        src="{{$datas->news->video_url}}"
                                        type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ref_news_id_ai"
                                        class="form-control-label font-weight-bold text-uppercase">Ref Video AI</label>
                                    <input type="text" name="ref_news_id_ai" id="ref_news_id_ai"
                                        value="{{ $datas->news->ref_news_id}}" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="news_title_ai"
                                        class="form-control-label font-weight-bold text-uppercase">Title AI</label>
                                    <input type="text" name="news_title_ai" id="news_title_ai"
                                        value="{{ $datas->news->news_title_ai}}" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="news_content_ai"
                                        class="form-control-label font-weight-bold text-uppercase">Content AI</label>
                                    <input type="text" name="news_content_ai" id="news_content_ai"
                                        value="{{ $datas->news->news_content_ai}}" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <label for="news_tags" class="form-control-label font-weight-bold text-uppercase">News
                                        Tags <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="green" class="bi bi-android2 mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="m10.213 1.471.691-1.26q.069-.124-.048-.192-.128-.057-.195.058l-.7 1.27A4.8 4.8 0 0 0 8.005.941q-1.032 0-1.956.404l-.7-1.27Q5.281-.037 5.154.02q-.117.069-.049.193l.691 1.259a4.25 4.25 0 0 0-1.673 1.476A3.7 3.7 0 0 0 3.5 5.02h9q0-1.125-.623-2.072a4.27 4.27 0 0 0-1.664-1.476ZM6.22 3.303a.37.37 0 0 1-.267.11.35.35 0 0 1-.263-.11.37.37 0 0 1-.107-.264.37.37 0 0 1 .107-.265.35.35 0 0 1 .263-.11q.155 0 .267.11a.36.36 0 0 1 .112.265.36.36 0 0 1-.112.264m4.101 0a.35.35 0 0 1-.262.11.37.37 0 0 1-.268-.11.36.36 0 0 1-.112-.264q0-.154.112-.265a.37.37 0 0 1 .268-.11q.155 0 .262.11a.37.37 0 0 1 .107.265q0 .153-.107.264M3.5 11.77q0 .441.311.75.311.306.76.307h.758l.01 2.182q0 .414.292.703a.96.96 0 0 0 .7.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h1.343v2.182q0 .414.292.703a.97.97 0 0 0 .71.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h.76q.436 0 .749-.308.31-.307.311-.75V5.365h-9zm10.495-6.587a.98.98 0 0 0-.702.278.9.9 0 0 0-.293.685v4.063q0 .406.293.69a.97.97 0 0 0 .702.284q.42 0 .712-.284a.92.92 0 0 0 .293-.69V6.146a.9.9 0 0 0-.293-.685 1 1 0 0 0-.712-.278m-12.702.283a1 1 0 0 1 .712-.283q.41 0 .702.283a.9.9 0 0 1 .293.68v4.063a.93.93 0 0 1-.288.69.97.97 0 0 1-.707.284 1 1 0 0 1-.712-.284.92.92 0 0 1-.293-.69V6.146q0-.396.293-.68" />
                                        </svg></label>
                                    <div class="tag-input" style="" id="tagInput">
                                        <input type="text" id="tagInputField"
                                            class="form-control form-control-alternative" placeholder="Add a tag..."
                                            @if ($news->tags) disabled @endif
                                            />
                                    </div>
                                    <input type="hidden" name="news_tags" id="news_tags"
                                        value="{{ $news->tags }}"
                                        @if ($news->tags) disabled @endif/>
                                </div> --}}

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Save</button>
                                    <button type="button" class="btn btn-secondary mt-4"
                                        onclick="history.back()">back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
