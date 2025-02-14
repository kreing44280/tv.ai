@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'News'])
    <style>
        @media (max-width: 680px) {
            .image-picture {
                width: 100% !important;
                height: 100% !important;
            }

            .input-search {
                width: 100% !important;
            }
        }
    </style>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card p-0">
                <div class="card-body pt-4">
                    <form action="{{ route('news.search') }}" method="get">
                        <div class="d-flex justify-content-end my-3 px-3">
                            <input type="text" class="form-control w-25 input-search" placeholder="Search..." id="newsName"
                                name="newsName" value="{{ request('newsName') }}">
                            <button type="submit" class="btn btn-primary ms-2 mb-0" id="searchButton">search</button>
                            <a href="{{ route('news') }}" class="btn btn-secondary ms-2 mb-0">reset</a>
                        </div>
                    </form>
                    <div class="row row-cols-2">
                        @foreach ($datas as $data)
                            <div class="col-6 list-group-item border-0 d-flex flex-column flex-lg-row border-radius-lg">
                                <div class="d-flex flex-column flex-lg-row align-items-lg-center">
                                    <img style="width: 100px; height: 100px;" src="{{ asset($data->news->news_pic) }}"
                                        alt="{{ $data->news->news_title }}" class="img-fluid me-3 image-picture">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm text-truncate" style="max-width: 300px">
                                            {{ $data->news->news_title }}
                                        </h6>
                                        <span class="mb-2 text-xs">Category: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->TvCategory->category_name }}</span></span>
                                        <span class="mb-2 text-xs">News Type: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->news->newsType->news_type_name }}</span></span>
                                        <span class="mb-2 text-xs">Created At: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $data->news->news_date->format('Y-m-d') }}
                                                <span
                                                    class="text-muted mx-1">({{ $data->news->news_date->diffForHumans() }})</span></span></span>
                                    </div>
                                </div>
                                <div class="ms-auto text-end d-flex align-items-center">
                                    <a class="btn btn-link px-3 mb-0"
                                        href="{{ route('news-detail', $data->news->news_id) }}"><i
                                            class="fas fa-pencil-alt me-2" style="color: #ea3005"
                                            aria-hidden="true"></i>Edit</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $datas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
