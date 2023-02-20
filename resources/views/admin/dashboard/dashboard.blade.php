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
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Product for the month (Seasonal)</p>
            </div>
            <h2>
                {{ $seasonal ? $seasonal->name : "N/A"}}
            </h2>
        </a>
    </div>
</div>
<div class="row">
    
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Expiring < 30 Days</p>
            </div>
            <center>
                <canvas id="demo" class="mx-auto"></canvas>
                <div id="preview-textfield"></div>
            </center>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Expiring < 90 Days</p>
            </div>
            <center>
                <canvas id="demo2" class="mx-auto"></canvas>
                <div id="preview-textfield2"></div>
            </center>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Expiring < 180 Days</p>
            </div>
            <center>
                <canvas id="demo3" class="mx-auto"></canvas>
                <div id="preview-textfield3"></div>
            </center>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Days Left</p>
            </div>
            <center>
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="line_ids">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Days left</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soon_30 as $s)
                                <tr>
                                    <td>{{ $s->product->name }}</td>
                                    <td>{{ $s->days_left }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </center>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Days Left</p>
            </div>
            <center>
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="line_ids">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Days left</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soon_90 as $s)
                                <tr>
                                    <td>{{ $s->product->name }}</td>
                                    <td>{{ $s->days_left }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </center>
        </a>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Days Left</p>
            </div>
            <center>
                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="line_ids">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Days left</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soon_180 as $s)
                                <tr>
                                    <td>{{ $s->product->name }}</td>
                                    <td>{{ $s->days_left }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </center>
        </a>
    </div>
    
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Low on Stock</p>
            </div>
            <center>
                <div><canvas id="myChartLow"></canvas></div>
            </center>
        </a>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Out of Stock</p>
            </div>
            <center>
                <div><canvas id="myChartOut"></canvas></div>
            </center>
        </a>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <a class="widget quick-category" href="#">
            <div class="quick-category-content">
                <p class="font-17 text-primary mb-0">Top 5 Sales</p>
            </div>
            <center>
                <div><canvas id="myChart"></canvas></div>
            </center>
        </a>
    </div>
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
                                <td>{{ $stock->product->category ?  $stock->product->category->name : "N/A"}}</td>
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
<script src="{{ asset('dist-gauge/gauge.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxOut = document.getElementById('myChartOut');
    var dataOut = {!! json_encode($out) !!};
    // console.log(data);
    // var dataParsed = JSON.parse(data);
    // console.log(dataParsed);
    var valuesOut = [];
    var labelsOut = [];

    for (var i = 0; i < dataOut.length; i++) {
        valuesOut.push(100);
        labelsOut.push(dataOut[i].product.name);
    }
    // var dataParsed = [];
    new Chart(ctxOut, {
        type: 'pie',
        data: {
        labels: labelsOut,
        datasets: [{
            label: 'Out of Stock',
            data: valuesOut,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>
<script>
    const ctxLow = document.getElementById('myChartLow');
    var dataLow = {!! json_encode($low) !!};
    // console.log(data);
    // var dataParsed = JSON.parse(data);
    // console.log(dataParsed);
    var valuesLow = [];
    var labelsLow = [];

    for (var i = 0; i < dataLow.length; i++) {
        valuesLow.push(dataLow[i].quantity);
        labelsLow.push(dataLow[i].product.name);
    }
    // var dataParsed = [];
    new Chart(ctxLow, {
        type: 'pie',
        data: {
        labels: labelsLow,
        datasets: [{
            label: 'Low On Stock',
            data: valuesLow,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    
</script>
<script>
    const ctx = document.getElementById('myChart');
    var data = {!! json_encode($top_sales) !!};
    // console.log(data);
    // var dataParsed = JSON.parse(data);
    // console.log(dataParsed);
    var values = [];
    var labels = [];

    for (var i = 0; i < data.length; i++) {
        values.push(data[i].total);
        labels.push(data[i].name);
    }
    // var dataParsed = [];
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: labels,
        datasets: [{
            label: 'Top 5 Sales',
            data: values,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>
<script>
    var opts = {};
    var target = document.getElementById('demo'); 
    var gauge = new Gauge(target).setOptions(opts);

    document.getElementById("preview-textfield").className = "preview-textfield";
    gauge.setTextField(document.getElementById("preview-textfield"));
    gauge.maxValue = parseInt("{{ $soon_total }}");
    gauge.setMinValue(0); 
    gauge.set(parseInt("{{ count($soon_30) }}"));
    gauge.animationSpeed = 32;


    var opts2 = {};
    var target2 = document.getElementById('demo2'); 
    var gauge2 = new Gauge(target2).setOptions(opts2);

    document.getElementById("preview-textfield2").className = "preview-textfield";
    gauge2.setTextField(document.getElementById("preview-textfield2"));
    gauge2.maxValue = parseInt("{{ $soon_total }}");
    gauge2.setMinValue(0); 
    gauge2.set(parseInt("{{ count($soon_90) }}"));
    gauge2.animationSpeed = 32;

    var opts3 = {};
    var target3 = document.getElementById('demo3'); 
    var gauge3 = new Gauge(target3).setOptions(opts3);

    document.getElementById("preview-textfield3").className = "preview-textfield";
    gauge3.setTextField(document.getElementById("preview-textfield3"));
    gauge3.maxValue = parseInt("{{ $soon_total }}");
    gauge3.setMinValue(0); 
    gauge3.set(parseInt("{{ count($soon_180) }}"));
    gauge3.animationSpeed = 32;
</script>
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