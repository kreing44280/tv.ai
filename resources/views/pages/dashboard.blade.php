@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($newsCount) }}
                                    </h5>
                                    <p class="mb-0">
                                        ข่าวทั้งหมด
                                    </p>
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
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($aiNewsCount) }}
                                    </h5>
                                    <p class="mb-0">
                                        ข่าวที่กรอกโดย AI
                                    </p>
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
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($pendingCount) }}
                                    </h5>
                                    <p class="mb-0">
                                        ข่าวที่ยังไม่ได้กรอก
                                    </p>
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
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($userCount) }}
                                    </h5>
                                    <p class="mb-0">
                                        จำนวนสมาชิก
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Top news</h6>
                    </div>
                    <div class="card-body p-1 relative">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner border-radius-lg">
                                @foreach ($populars as $popular)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img width="680" height="364" src="{{ asset($popular->news_pic) }}"
                                            alt="{{ $popular->news_title }}"
                                            class="w-100 border-radius-lg shadow-sm object-contain">
                                        <div class="carousel-caption d-none d-md-block bottom-3 text-start start-0 ms-5"
                                            style="background: rgba(0,0,0,0.5); border-radius: 10px; padding: 10px;">
                                            <h5 class="text-white mb-1" style="text-shadow: 2px 2px black">
                                                {{ $popular->news_title }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                <button class="carousel-control-prev w-5 me-3" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next w-5 me-3" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100 d-flex align-items-center justify-content-center">
                    <div class="card-body p-1 relative">
                        <div class="chart pb-4">
                            <canvas id="doughnutChart" class="chart-canvas"></canvas>
                        </div>
                        <div class="d-flex gap-2">
                            <p class="mb-0 text-sm text-primary">จํานวนข่าวทั้งหมด: </p>
                            <h5 class="mb-0 text-sm font-weight-bolder text-primary">
                                {{ number_format($newsCount) }}
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <p class="mb-0 text-sm text-info">จํานวนข่าวที่กรอกโดย AI: </p>
                            <h5 class="mb-0 text-sm font-weight-bolder text-info">
                                {{ number_format($aiNewsCount) }}
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <p class="mb-0 text-sm text-success">จํานวนข่าวที่ยังไม่ได้กรอก: </p>
                            <h5 class="mb-0 text-sm font-weight-bolder text-success">
                                {{ number_format($pendingCount) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Rating</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Number of news in each category</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="myBarChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')    
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');

        const categoryNames = {!! json_encode($categoryNames) !!};
        const categoryViews = {!! json_encode($categoryViews) !!};

        new Chart(ctx1, {
            type: "line",
            data: {
                labels: categoryNames,
                datasets: [{
                    label: "Views",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 5, // กำหนดขนาดจุดให้มองเห็นชัดเจน
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: categoryViews,
                    maxBarThickness: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: false, // ปิด tooltip ที่ต้องโฮเวอร์
                    },
                    datalabels: {
                        align: 'top', // ให้แสดงค่าด้านบนจุด
                        anchor: 'end',
                        color: '#333', // สีของตัวเลข
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        backgroundColor: 'rgba(128, 128, 128, 0.5)', // สีเทาพร้อม opacity
                        formatter: function(value, context) {
                            let formatter = new Intl.NumberFormat('th-TH');
                            return formatter.format(value);
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            },
            plugins: [ChartDataLabels] // เพิ่ม plugin datalabels
        });

        const ctx2 = document.getElementById("doughnutChart").getContext("2d");

        const dataDoughnut = {
            labels: ['ข่าวทั้งหมด', 'ข่าวที่กรองโดย AI', 'ข่าวที่ยังไม่ถูกกรอง'],
            datasets: [{
                data: [{{ $newsCount }}, {{ $aiNewsCount }}, {{ $pendingCount }}],
                backgroundColor: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99'],
                hoverOffset: 5
            }]
        };

        const optionsDoughnut = {
            responsive: false,
            maintainAspectRatio: false,
            width: 400,
            height: 400,
            cutout: '50%'
        };

        new Chart(ctx2, {
            type: 'doughnut',
            data: dataDoughnut,
            options: optionsDoughnut
        });

        const cateNewsNames = {!! json_encode($cateNewsNames) !!};
        const cateNewsCount = {!! json_encode($cateNewsCount) !!};

        const ctx = document.getElementById('myBarChart').getContext('2d');

        const myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cateNewsNames,
                datasets: [{
                    label: 'Sales',
                    data: cateNewsCount,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(244, 67, 54, 0.6)',
                        'rgba(233, 30, 99, 0.6)',
                        'rgba(156, 39, 176, 0.6)',
                        'rgba(103, 58, 183, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 1)',
                        'rgba(156, 39, 176, 1)',
                        'rgba(103, 58, 183, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: false, // ปิด tooltip ที่ต้องโฮเวอร์
                    },
                    datalabels: {
                        align: 'top', // ให้แสดงค่าด้านบนจุด
                        anchor: 'end',
                        color: '#333', // สีของตัวเลข
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        backgroundColor: 'rgba(128, 128, 128, 0.5)', // สีเทาพร้อม opacity
                        formatter: function(value, context) {
                            let formatter = new Intl.NumberFormat('th-TH');
                            return formatter.format(value);
                        }
                    }
                },
            },plugins: [ChartDataLabels] // เพิ่ม plugin datalabels
        });
    </script>
@endpush
