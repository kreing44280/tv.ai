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
        <div class="row pb-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">All News</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($news_count) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" aria-hidden="true"
                                        fill="white" class="bi bi-newspaper mt-2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                        <path
                                            d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Search Count</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($datas->total()) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" aria-hidden="true"
                                        fill="white" class="bi bi-newspaper mt-2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                        <path
                                            d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Count Content</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($sumNewsContent) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" aria-hidden="true"
                                        fill="white" class="bi bi-newspaper mt-2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                        <path
                                            d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Video Duration</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $videoDuration }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" aria-hidden="true"
                                        fill="white" class="bi bi-newspaper mt-2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                        <path
                                            d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card p-0">
                <div class="card-body pt-4">
                    <form action="{{ route('news.search') }}" method="get">
                        <div class="row grid-cols-2">
                            <div class="col d-flex flex-column align-items-start">
                                <label for="startDate" class="form-label me-2">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate"
                                    value="{{ request('startDate') }}">
                            </div>
                            <div class="col d-flex flex-column align-items-start">
                                <label for="endDate" class="form-label me-2">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate"
                                    value="{{ request('endDate') }}">
                            </div>
                            <div class="col d-flex flex-column align-items-start">
                                <label for="category" class="form-label me-2">Category</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col d-flex flex-column align-items-start">
                                <label for="tv_program" class="form-label me-2">TV Program</label>
                                <select name="tv_program" id="tv_program" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($tv_programs as $tv_program)
                                        <option value="{{ $tv_program->program_id }}"
                                            {{ request('tv_program') == $tv_program->program_id ? 'selected' : '' }}>
                                            {{ $tv_program->program_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row grid-cols-2 gap-3 align-items-center">
                            <div class="col d-flex flex-column align-items-start">
                                <label for="newsName" class="form-label me-2">Search</label>
                                <input type="text" class="form-control input-search" placeholder="Search..."
                                    id="newsName" name="newsName" value="{{ request('newsName') }}">
                            </div>
                            <div class="col d-flex gap-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 2.5rem"
                                    id="searchButton">Search</button>
                                <a href="{{ route('news') }}" class="btn btn-secondary"
                                    style="margin-top: 2.5rem">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="row row-cols-2">
                        @foreach ($datas as $data)
                            <div class="col-6 list-group-item border-0 d-flex flex-column flex-lg-row border-radius-lg">
                                <div class="d-flex flex-column flex-lg-row align-items-lg-center">
                                    <img style="width: 150px; height: 150px;" src="{{ asset($data->news_pic) }}"
                                        alt="{{ $data->news_title }}" class="img-fluid me-3 image-picture">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-sm text-truncate" style="max-width: 300px">
                                            {{ $data->news_title }}
                                        </h6>
                                        <span class="mb-2 text-xs">News ID: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->news_id }}</span></span>
                                        <span class="mb-2 text-xs">TV Program: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->tvProgram->program_name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Category: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->category_name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">News Type: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->newsType->news_type_name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Video Duration: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $data->video_duration ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Created AT: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $data->news_date->format('Y-m-d') }}
                                                <span
                                                    class="text-muted mx-1">({{ $data->news_date->diffForHumans() }})</span></span></span>
                                    </div>
                                </div>
                                <div class="ms-auto text-end d-flex align-items-center">
                                    <a class="btn btn-link px-3 mb-0"
                                        href="{{ route('news-detail', $data->news_id) }}"><i
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
    </div>
@endsection
