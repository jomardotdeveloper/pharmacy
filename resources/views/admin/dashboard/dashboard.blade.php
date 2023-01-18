@extends("layouts.admin-master")
@section("title", "Dashboard")
@section("custom-styles")
<link href="/admin/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/css/dashboard/dashboard_1.css" rel="stylesheet" type="text/css">
@endsection
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><span>Dashboard</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="row">
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qc-primary rounded-circle">
                    <i class="las la-shopping-cart"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ count($products) }}</h3>
                <p class="font-17 text-primary mb-0">Total Products</p>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" onclick="openLow()">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qc-warning rounded-circle">
                    <i class="las la-boxes"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ count($low)  }}</h3>
                <p class="font-17 text-warning mb-0">Low on Stock</p>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" onclick="openOut()">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qcompare-danger rounded-circle">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ count($out)  }}</h3>
                <p class="font-17 text-danger mb-0">Out of Stock</p>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qc-success-teal rounded-circle">
                    <i class="las la-money-bill"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ count($sales) }}</h3>
                <p class="font-17 text-success-teal mb-0">Total Sales Today</p>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" onclick="openSoon()">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qcompare-danger rounded-circle">
                    <i class="las la-calendar-times"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ count($soon) }}</h3>
                <p class="font-17 text-danger mb-0">Soon to expire</p>
            </div>
        </a>
    </div>
    @if($product)
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category">
            <div class="quick-category-head">
                <span class="quick-category-icon qcompare-success rounded-circle">
                    <i class="las la-shopping-cart"></i>
                </span>
            </div>
            <div class="quick-category-content">
                <h3>{{ $product->name }}</h3>
                <p class="font-17 text-success mb-0">Product of the Month</p>
            </div>
        </a>
    </div>
    @endif
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h5 class="">Monthly Sales</h5>
                <ul class="tabs tab-pills">
                    <li>
                        <select name="month" id="month" class="form-control">
                            <option value="0">January</option>
                            <option value="1">February</option>
                            <option value="2">March</option>
                            <option value="3">April</option>
                            <option value="4">May</option>
                            <option value="5">June</option>
                            <option value="6">July</option>
                            <option value="7">August</option>
                            <option value="8">September</option>
                            <option value="9">October</option>
                            <option value="10">November</option>
                            <option value="11">December</option>
                        </select>
                    </li>
                </ul>
            </div>

            <div class="widget-content">
                <div class="tabs tab-content">
                    <div id="content_1" class="tabcontent">
                        <div id="transactionsMonthly"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="lowModal" class="modal animated fadeInDown" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Low on Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="cartList">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Date Arrived</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($low as $stock)
                            <tr>
                                <td>
                                    <a href="{{route('stocks.show', ['stock' => $stock])}}" title="Edit" class="text-primary">
                                        {{ $stock->product->full_name }}
                                    </a>
                                </td>
                                <td>{{ $stock->product->category->name }}</td>
                                <td>{{date_format(date_create($stock->date_arrived), 'F d, Y')}}</td>
                                <td>{{ $stock->supplier->name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'F d, Y') : "N/A" }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<div id="outModal" class="modal animated fadeInDown" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Out of Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="cartList">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Date Arrived</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($out as $stock)
                            <tr>
                                <td>
                                    <a href="{{route('stocks.show', ['stock' => $stock])}}" title="Edit" class="text-primary">
                                        {{ $stock->product->full_name }}
                                    </a>
                                </td>
                                <td>{{ $stock->product->category->name }}</td>
                                <td>{{date_format(date_create($stock->date_arrived), 'F d, Y')}}</td>
                                <td>{{ $stock->supplier->name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'F d, Y') : "N/A" }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<div id="soonModal" class="modal animated fadeInDown" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Soon to expire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="cartList">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Date Arrived</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($soon as $stock)
                            <tr>
                                <td>
                                    <a href="{{route('stocks.show', ['stock' => $stock])}}" title="Edit" class="text-primary">
                                        {{ $stock->product->full_name }}
                                    </a>
                                </td>
                                <td>{{ $stock->product->category->name }}</td>
                                <td>{{date_format(date_create($stock->date_arrived), 'F d, Y')}}</td>
                                <td>{{ $stock->supplier->name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'F d, Y') : "N/A" }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push("custom-scripts")
<script src="/admin/plugins/apex/apexcharts.min.js"></script>
<script src="/admin/assets/js/dashboard/dashboard_1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function openLow() {
        $("#lowModal").modal("show");
    }

    function openOut() {
        $("#outModal").modal("show");
    }

    function openSoon() {
        $("#soonModal").modal("show");
    }
</script>

<script>
    var dt = new Date();
    var month = dt.getMonth();
    var year = dt.getFullYear();
    var seriesData = [];
    daysInMonth = new Date(year, month, 0).getDate();
    var labelsData = [];
    var revenue = {
        revenue: 0
    };
    $("#month").val(parseInt(month)).change();


    for (var i = 1; i <= daysInMonth; i++) {
        labelsData.push(i);
    }

    var options1 = {
        chart: {
            fontFamily: 'Poppins, sans-serif',
            height: 320,
            type: 'area',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                opacity: 0.2,
                blur: 5,
                left: -7,
                top: 22
            },
            toolbar: {
                show: false
            },
            events: {
                mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#009688" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                            style: {
                                cssClass: 'd-none'
                            }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                },
            }
        },
        colors: ['#009688', '#e7515a'],
        dataLabels: {
            enabled: false
        },
        markers: {
            discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
            }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
            }]
        },
        subtitle: {
            text: 'Monthly Earnings',
            align: 'left',
            margin: 0,
            offsetX: -10,
            offsetY: 35,
            floating: false,
            style: {
                fontSize: '14px',
                color: '#888ea8'
            }
        },
        title: {
            text: '₱' + revenue.revenue.toString(),
            align: 'left',
            margin: 0,
            offsetX: -10,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '25px',
                color: '#515365'
            },
        },
        stroke: {
            show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
        },
        series: [{
                name: 'Total Sales',
                data: seriesData
            }
            // , {
            //     name: 'Total Commissions',
            //     data: [1000, 1856, 2415, 10568, 3542, 4856, 1000, 5869, 2000, 8596, 6999, 1025]
            // }
        ],
        labels: labelsData,
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                show: true
            },
            labels: {
                offsetX: 0,
                offsetY: 5,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Poppins, sans-serif',
                    cssClass: 'apexcharts-xaxis-title',
                },
            }
        },
        yaxis: {
            labels: {
                offsetX: -22,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Poppins, sans-serif',
                    cssClass: 'apexcharts-yaxis-title',
                },
            }
        },
        grid: {
            borderColor: '#e0e6ed',
            strokeDashArray: 8,
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true,
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: -10
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -50,
            fontSize: '13px',
            fontFamily: 'Poppins, sans-serif',
            markers: {
                width: 10,
                height: 10,
                strokeWidth: 0,
                strokeColor: '#fff',
                fillColors: undefined,
                radius: 12,
                onClick: undefined,
                offsetX: 0,
                offsetY: 0
            },
            itemMargin: {
                horizontal: 0,
                vertical: 20
            }
        },
        tooltip: {
            theme: 'dark',
            marker: {
                show: true,
            },
            x: {
                show: false,
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .28,
                opacityTo: .05,
                stops: [45, 100]
            }
        },
        responsive: [{
            breakpoint: 575,
            options: {
                legend: {
                    offsetY: -30,
                },
            },
        }]
    }
    var chart1 = new ApexCharts(
        document.querySelector("#transactionsMonthly"),
        options1
    );

    async function setLabelData(daysInMonth) {
        labelsData = [];
        for (var i = 1; i <= daysInMonth; i++) {
            labelsData.push(i);
            console.log(i);
        }
    }

    $("#month").change(async function() {
        seriesData = [];
        dt = new Date();
        month = parseInt($("#month").val());
        year = dt.getFullYear();
        daysInMonth = new Date(year, month + 1, 0).getDate();
        await setLabelData(daysInMonth);
        var data = await getData(daysInMonth, month + 1);
        for (var i = 1; i <= labelsData.length; i++) {
            seriesData.push(data[i]);
        }
        revenue.revenue = data["revenue"];

        chart1.updateSeries([{
            name: 'Total Sales',
            data: seriesData
        }]);

        chart1.updateOptions({
            title: {
                text: format(revenue.revenue),
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '25px',
                    color: '#515365'
                },
            }
        });



    });

    function format(amount) {
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
        });

        return formatter.format(amount);
    }

    async function getData(totalDays, month) {
        return (await axios.get("/dashboard/data/" + totalDays.toString() + "/" + month.toString())).data;
    }

    async function loadData() {

        var data = await getData(daysInMonth, month + 1);
        for (var i = 1; i <= labelsData.length; i++) {
            seriesData.push(data[i]);
        }
        revenue.revenue = data["revenue"];

        chart1.render();

        chart1.updateOptions({
            title: {
                text: format(revenue.revenue),
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '25px',
                    color: '#515365'
                },
            }
        });
    }

    loadData();
</script>
@endpush