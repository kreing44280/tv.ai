@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Video List'])
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        #</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        video name</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7 ps-2">
                                        file name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        mp3 name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        mp4 name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        status mp3 convert</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        status transcript</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7">
                                        crated at</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <a href="{{ route('video-detail', ['id' => $video->id]) }}" class="text-sm font-semibold mb-0 cursor-pointer text-info
                                                text-decoration-underline">{{ $video->id }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <a href="#" class="text-sm font-semibold mb-0 cursor-pointer text-info
                                                text-decoration-underline">{{ $video->raw_file_name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-semibold mb-0 cursor-pointer text-info
                                                text-decoration-underline">{{ $video->folder_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-semibold mb-0 cursor-pointer text-info
                                                text-decoration-underline">{{ $video->mp3_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-semibold mb-0 cursor-pointer text-info
                                                text-decoration-underline">{{ $video->mp4_name }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-semibold mb-0 badge 
                                        @if ($video->status_mp3_convert == 'success') bg-gradient-success @else bg-gradient-warning @endif">
                                            {{ $video->status_mp3_convert }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-semibold mb-0 badge 
                                        @if ($video->status_transcript == 'success') bg-gradient-success @else bg-gradient-warning @endif">
                                            {{ $video->status_transcript }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-semibold mb-0">{{ $video->created_at }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $videos->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>
@endsection