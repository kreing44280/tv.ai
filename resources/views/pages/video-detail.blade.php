@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Video Detail'])
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <button type="button" class="btn btn-primary" onclick="history.back()">back</button>
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="file_name" class="form-control-label font-weight-bold text-uppercase">File Name</label>
                                <input type="text" name="file_name" id="file_name" value="{{ $video['raw_file_name'] }}"
                                    class="form-control form-control-alternative">
                            </div>
                            <div class="form-group mb-3">
                                <label for="folder_name" class="form-control-label font-weight-bold text-uppercase">Folder Name</label>
                                <input type="text" name="folder_name" id="folder_name" value="{{ $video['folder_name'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="mp3_name" class="form-control-label font-weight-bold text-uppercase">MP3 Name</label>
                                <input type="text" name="mp3_name" id="mp3_name" value="{{ $video['mp3_name'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <video controls width="640" height="360">
                                    <source src="{{ route('video.stream', ['filename' => '' . $video['mp3_name'] . '']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mp4_name" class="form-control-label font-weight-bold text-uppercase">MP4 Name</label>
                                <input type="text" name="mp4_name" id="mp4_name" value="{{ $video['mp4_name'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <video controls width="640" height="360">
                                    <source src="{{ route('video.stream', ['filename' => '' . $video['mp4_name'] . '']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mp3_convert_os" class="form-control-label font-weight-bold text-uppercase">MP3 Convert OS</label>
                                <input type="text" name="mp3_convert_os" id="mp3_convert_os" value="{{ $video['mp3_convert_os'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="transcript" class="form-control-label font-weight-bold text-uppercase">Transcript</label>
                                <textarea name="transcript" id="transcript" class="form-control form-control-alternative"
                                    cols="30" rows="10">{{ $video['transcript'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="news_title" class="form-control-label font-weight-bold text-uppercase">News Title</label>
                                <input type="text" name="news_title" id="news_title" value="{{ $video['news_title'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="news_desc" class="form-control-label font-weight-bold text-uppercase">News Description</label>
                                <textarea name="news_desc" id="news_desc" class="form-control form-control-alternative" cols="30" rows="10">
                                {{ $video['news_desc'] }}
                                </textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="news_tag" class="form-control-label font-weight-bold text-uppercase">News Tag</label>
                                <input type="text" name="news_tag" id="news_tag" value="{{ $video['news_tag'] }}" class="form-control form-control-alternative" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="news_timestamp" class="form-control-label font-weight-bold text-uppercase">News Timestamp</label>
                                <input type="text" name="news_timestamp" id="news_timestamp" value="{{ $video['news_timestamp'] }}" class="form-control form-control-alternative" />
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
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