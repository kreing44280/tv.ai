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
                            <form action="{{ route('video.update', ['id' => $video['id']]) }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="file_name" class="form-control-label font-weight-bold text-uppercase">File
                                        Name</label>
                                    <input type="text" name="file_name" id="file_name"
                                        value="{{ $video['raw_file_name'] }}" class="form-control form-control-alternative"
                                        disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="folder_name"
                                        class="form-control-label font-weight-bold text-uppercase">Folder Name</label>
                                    <input type="text" name="folder_name" id="folder_name"
                                        value="{{ $video['folder_name'] }}" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mp3_name" class="form-control-label font-weight-bold text-uppercase">MP3
                                        Name</label>
                                    <input type="text" name="mp3_name" id="mp3_name" value="{{ $video['mp3_name'] }}"
                                        class="form-control form-control-alternative" disabled />
                                </div>
                                @if ($video['mp3_name'] != null)
                                    <div class="form-group mb-3">
                                        <video controls width="640" height="360">
                                            <source
                                                src="{{ route('video.stream', ['filename' => '' . $video['mp3_name'] . '']) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    <p class="text-danger text-xs pt-1">Cannot find MP3 file</p>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="mp4_name" class="form-control-label font-weight-bold text-uppercase">MP4
                                        Name</label>
                                    <input type="text" name="mp4_name" id="mp4_name" value="{{ $video['mp4_name'] }}"
                                        class="form-control form-control-alternative" disabled />
                                </div>
                                @if ($video['mp4_name'] != null)
                                    <div class="form-group mb-3">
                                        <video controls width="640" height="360">
                                            <source
                                                src="{{ route('video.stream', ['filename' => '' . $video['mp4_name'] . '']) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    <p class="text-danger text-xs pt-1">Cannot find MP4 file</p>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="mp3_convert_os"
                                        class="form-control-label font-weight-bold text-uppercase">MP3 Convert OS</label>
                                    <input type="text" name="mp3_convert_os" id="mp3_convert_os"
                                        value="{{ $video['mp3_convert_os'] }}" class="form-control form-control-alternative"
                                        disabled />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="transcript"
                                        class="form-control-label font-weight-bold text-uppercase">Transcript</label>
                                    <textarea name="transcript" id="transcript" class="form-control form-control-alternative" cols="30" rows="10"
                                        disabled>{{ $video['transcript'] }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="news_title" class="form-control-label font-weight-bold text-uppercase">News
                                        Title
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green"
                                            class="bi bi-android2 mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="m10.213 1.471.691-1.26q.069-.124-.048-.192-.128-.057-.195.058l-.7 1.27A4.8 4.8 0 0 0 8.005.941q-1.032 0-1.956.404l-.7-1.27Q5.281-.037 5.154.02q-.117.069-.049.193l.691 1.259a4.25 4.25 0 0 0-1.673 1.476A3.7 3.7 0 0 0 3.5 5.02h9q0-1.125-.623-2.072a4.27 4.27 0 0 0-1.664-1.476ZM6.22 3.303a.37.37 0 0 1-.267.11.35.35 0 0 1-.263-.11.37.37 0 0 1-.107-.264.37.37 0 0 1 .107-.265.35.35 0 0 1 .263-.11q.155 0 .267.11a.36.36 0 0 1 .112.265.36.36 0 0 1-.112.264m4.101 0a.35.35 0 0 1-.262.11.37.37 0 0 1-.268-.11.36.36 0 0 1-.112-.264q0-.154.112-.265a.37.37 0 0 1 .268-.11q.155 0 .262.11a.37.37 0 0 1 .107.265q0 .153-.107.264M3.5 11.77q0 .441.311.75.311.306.76.307h.758l.01 2.182q0 .414.292.703a.96.96 0 0 0 .7.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h1.343v2.182q0 .414.292.703a.97.97 0 0 0 .71.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h.76q.436 0 .749-.308.31-.307.311-.75V5.365h-9zm10.495-6.587a.98.98 0 0 0-.702.278.9.9 0 0 0-.293.685v4.063q0 .406.293.69a.97.97 0 0 0 .702.284q.42 0 .712-.284a.92.92 0 0 0 .293-.69V6.146a.9.9 0 0 0-.293-.685 1 1 0 0 0-.712-.278m-12.702.283a1 1 0 0 1 .712-.283q.41 0 .702.283a.9.9 0 0 1 .293.68v4.063a.93.93 0 0 1-.288.69.97.97 0 0 1-.707.284 1 1 0 0 1-.712-.284.92.92 0 0 1-.293-.69V6.146q0-.396.293-.68" />
                                        </svg>
                                    </label>
                                    <input type="text" name="news_title" id="news_title"
                                        value="{{ $video['news_title'] }}" class="form-control form-control-alternative"
                                        @if ($video['news_title']) disabled @endif />
                                </div>
                                @if ($video['news_title'])
                                    <div class="form-group mb-3">
                                        <label for="news_title_human"
                                            class="form-control-label font-weight-bold text-uppercase">News Title
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                            </svg></label>
                                        <input type="text" name="news_title_human" id="news_title_human"
                                            value="{{ $video['news_title_human'] ?? $video['news_title'] }}"
                                            class="form-control form-control-alternative" />
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="news_desc" class="form-control-label font-weight-bold text-uppercase">News
                                        Description <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="green" class="bi bi-android2 mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="m10.213 1.471.691-1.26q.069-.124-.048-.192-.128-.057-.195.058l-.7 1.27A4.8 4.8 0 0 0 8.005.941q-1.032 0-1.956.404l-.7-1.27Q5.281-.037 5.154.02q-.117.069-.049.193l.691 1.259a4.25 4.25 0 0 0-1.673 1.476A3.7 3.7 0 0 0 3.5 5.02h9q0-1.125-.623-2.072a4.27 4.27 0 0 0-1.664-1.476ZM6.22 3.303a.37.37 0 0 1-.267.11.35.35 0 0 1-.263-.11.37.37 0 0 1-.107-.264.37.37 0 0 1 .107-.265.35.35 0 0 1 .263-.11q.155 0 .267.11a.36.36 0 0 1 .112.265.36.36 0 0 1-.112.264m4.101 0a.35.35 0 0 1-.262.11.37.37 0 0 1-.268-.11.36.36 0 0 1-.112-.264q0-.154.112-.265a.37.37 0 0 1 .268-.11q.155 0 .262.11a.37.37 0 0 1 .107.265q0 .153-.107.264M3.5 11.77q0 .441.311.75.311.306.76.307h.758l.01 2.182q0 .414.292.703a.96.96 0 0 0 .7.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h1.343v2.182q0 .414.292.703a.97.97 0 0 0 .71.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h.76q.436 0 .749-.308.31-.307.311-.75V5.365h-9zm10.495-6.587a.98.98 0 0 0-.702.278.9.9 0 0 0-.293.685v4.063q0 .406.293.69a.97.97 0 0 0 .702.284q.42 0 .712-.284a.92.92 0 0 0 .293-.69V6.146a.9.9 0 0 0-.293-.685 1 1 0 0 0-.712-.278m-12.702.283a1 1 0 0 1 .712-.283q.41 0 .702.283a.9.9 0 0 1 .293.68v4.063a.93.93 0 0 1-.288.69.97.97 0 0 1-.707.284 1 1 0 0 1-.712-.284.92.92 0 0 1-.293-.69V6.146q0-.396.293-.68" />
                                        </svg></label>
                                    <textarea name="news_desc" id="news_desc" class="form-control form-control-alternative" cols="30"
                                        rows="10" @if ($video['news_desc']) disabled @endif>
                                {{ $video['news_desc'] }}
                                </textarea>
                                </div>
                                @if ($video['news_desc'])
                                    <div class="form-group mb-3">
                                        <label for="news_desc_human"
                                            class="form-control-label font-weight-bold text-uppercase">News Description
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                            </svg></label>
                                        <textarea name="news_desc_human" id="news_desc_human" class="form-control form-control-alternative" cols="30"
                                            rows="10">
                                {{ $video['news_desc_human'] ?? $video['news_desc'] }}
                                </textarea>
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="news_tag" class="form-control-label font-weight-bold text-uppercase">News
                                        Tags <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="green" class="bi bi-android2 mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="m10.213 1.471.691-1.26q.069-.124-.048-.192-.128-.057-.195.058l-.7 1.27A4.8 4.8 0 0 0 8.005.941q-1.032 0-1.956.404l-.7-1.27Q5.281-.037 5.154.02q-.117.069-.049.193l.691 1.259a4.25 4.25 0 0 0-1.673 1.476A3.7 3.7 0 0 0 3.5 5.02h9q0-1.125-.623-2.072a4.27 4.27 0 0 0-1.664-1.476ZM6.22 3.303a.37.37 0 0 1-.267.11.35.35 0 0 1-.263-.11.37.37 0 0 1-.107-.264.37.37 0 0 1 .107-.265.35.35 0 0 1 .263-.11q.155 0 .267.11a.36.36 0 0 1 .112.265.36.36 0 0 1-.112.264m4.101 0a.35.35 0 0 1-.262.11.37.37 0 0 1-.268-.11.36.36 0 0 1-.112-.264q0-.154.112-.265a.37.37 0 0 1 .268-.11q.155 0 .262.11a.37.37 0 0 1 .107.265q0 .153-.107.264M3.5 11.77q0 .441.311.75.311.306.76.307h.758l.01 2.182q0 .414.292.703a.96.96 0 0 0 .7.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h1.343v2.182q0 .414.292.703a.97.97 0 0 0 .71.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h.76q.436 0 .749-.308.31-.307.311-.75V5.365h-9zm10.495-6.587a.98.98 0 0 0-.702.278.9.9 0 0 0-.293.685v4.063q0 .406.293.69a.97.97 0 0 0 .702.284q.42 0 .712-.284a.92.92 0 0 0 .293-.69V6.146a.9.9 0 0 0-.293-.685 1 1 0 0 0-.712-.278m-12.702.283a1 1 0 0 1 .712-.283q.41 0 .702.283a.9.9 0 0 1 .293.68v4.063a.93.93 0 0 1-.288.69.97.97 0 0 1-.707.284 1 1 0 0 1-.712-.284.92.92 0 0 1-.293-.69V6.146q0-.396.293-.68" />
                                        </svg></label>
                                    <div class="tag-input" style="" id="tagInput">
                                        <input type="text" id="tagInputField"
                                            class="form-control form-control-alternative" placeholder="Add a tag..."
                                            @if ($video['news_tag']) disabled @endif />
                                    </div>
                                    <input type="hidden" name="news_tag" id="news_tag"
                                        value="{{ $video['news_tag'] }}"
                                        @if ($video['news_tag']) disabled @endif />
                                </div>
                                @if ($video['news_tag'])
                                    <div class="form-group mb-3">
                                        <label for="news_tag_human"
                                            class="form-control-label font-weight-bold text-uppercase">News Tags
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                            </svg>
                                        </label>
                                        <div class="tag-input" id="tagInputHuman">
                                            <input type="text" id="tagInputFieldHuman"
                                                class="form-control form-control-alternative"
                                                placeholder="Add a tag..." />
                                        </div>
                                        <input type="hidden" name="news_tag_human" id="news_tag_human"
                                            value="{{ $video['news_tag_human'] ?? $video['news_tag'] }}" />
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="news_timestamp"
                                        class="form-control-label font-weight-bold text-uppercase">News Timestamp <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="green" class="bi bi-android2 mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="m10.213 1.471.691-1.26q.069-.124-.048-.192-.128-.057-.195.058l-.7 1.27A4.8 4.8 0 0 0 8.005.941q-1.032 0-1.956.404l-.7-1.27Q5.281-.037 5.154.02q-.117.069-.049.193l.691 1.259a4.25 4.25 0 0 0-1.673 1.476A3.7 3.7 0 0 0 3.5 5.02h9q0-1.125-.623-2.072a4.27 4.27 0 0 0-1.664-1.476ZM6.22 3.303a.37.37 0 0 1-.267.11.35.35 0 0 1-.263-.11.37.37 0 0 1-.107-.264.37.37 0 0 1 .107-.265.35.35 0 0 1 .263-.11q.155 0 .267.11a.36.36 0 0 1 .112.265.36.36 0 0 1-.112.264m4.101 0a.35.35 0 0 1-.262.11.37.37 0 0 1-.268-.11.36.36 0 0 1-.112-.264q0-.154.112-.265a.37.37 0 0 1 .268-.11q.155 0 .262.11a.37.37 0 0 1 .107.265q0 .153-.107.264M3.5 11.77q0 .441.311.75.311.306.76.307h.758l.01 2.182q0 .414.292.703a.96.96 0 0 0 .7.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h1.343v2.182q0 .414.292.703a.97.97 0 0 0 .71.288.97.97 0 0 0 .71-.288.95.95 0 0 0 .292-.703v-2.182h.76q.436 0 .749-.308.31-.307.311-.75V5.365h-9zm10.495-6.587a.98.98 0 0 0-.702.278.9.9 0 0 0-.293.685v4.063q0 .406.293.69a.97.97 0 0 0 .702.284q.42 0 .712-.284a.92.92 0 0 0 .293-.69V6.146a.9.9 0 0 0-.293-.685 1 1 0 0 0-.712-.278m-12.702.283a1 1 0 0 1 .712-.283q.41 0 .702.283a.9.9 0 0 1 .293.68v4.063a.93.93 0 0 1-.288.69.97.97 0 0 1-.707.284 1 1 0 0 1-.712-.284.92.92 0 0 1-.293-.69V6.146q0-.396.293-.68" />
                                        </svg></label>
                                    <textarea name="news_timestamp" id="news_timestamp" class="form-control form-control-alternative" cols="30"
                                        rows="10" @if ($video['news_timestamp']) disabled @endif>{{ $video['news_timestamp'] }}</textarea>
                                </div>
                                @if ($video['news_timestamp'])
                                    <div class="form-group mb-3">
                                        <label for="news_timestamp_human"
                                            class="form-control-label font-weight-bold text-uppercase">News Timestamp
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                            </svg></label>
                                        <textarea name="news_timestamp_human" id="news_timestamp_human" class="form-control form-control-alternative"
                                            cols="30" rows="10">{{ $video['news_timestamp_human'] ?? $video['news_timestamp'] }}</textarea>
                                    </div>
                                @endif
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
