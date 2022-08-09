@extends('layouts.admin')

@section('breadcrumb')
<div class="page-title">
    <h3>Dashboard</h3>
    {{ Breadcrumbs::render('dashboard') }}
</div>
@endsection

@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="row mb-0 justify-content-between">
                    <!-- col -->
                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="mr-2"><span class="text-primary display-5">$</span></div>
                            <div>
                                <h3 class="font-medium mb-0">{{ $totalPay }}</h3>
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="mr-2"><span class="text-success display-5"><i class="mdi mdi-airplane"></i></span></div>
                            <div>
                                <h3 class="font-medium mb-0">{{ $totalBooking }}</h3>
                                <span>Bookings</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="mr-2"><span class="text-info display-5"><i class="mdi mdi-beach"></i></span></div>
                            <div>
                                <h3 class="font-medium mb-0">{{ $totalTour }}</h3>
                                <span>Tours</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="mr-2"><span class="text-warning display-5"><i class="mdi mdi-map-marker"></i></span></div>
                            <div>
                                <h3 class="font-medium mb-0">{{ $totalDestination }}</h3>
                                <span>Destinations</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="mr-2"><span class="text-danger display-5"><i class="mdi mdi-account-alert"></i></span></div>
                            <div>
                                <h3 class="font-medium mb-0">{{ $totalContact }}</h3>
                                <span>Contact</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row mb-0 justify-content-between">
                    <!-- col -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body analytics-info">
                                <h4 class="card-title">Profits in 6 months ago</h4>
                                <div id="profits_chart" style="height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row mb-0 justify-content-between">
                    <!-- col -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body analytics-info">
                                <h4 class="card-title">Infomation</h4>
                                <div id="basic-line" style="height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.getDataChart') }}",
        success: function (response) {
            lineChartProfits(response['arrayDate'], response['profits']);
            lineChartInfor(response['arrayDate'], response['bookings'], response['contacts'], response['tours']);
        },
        error: function (xhr) {
            
        }
    })
});
    function lineChartProfits(arrayDate, profits) {
        var myChart = echarts.init(document.getElementById('profits_chart'));

        // specify chart configuration item and data
        var option = {
                // Setup grid
                grid: {
                    left: '1%',
                    right: '2%',
                    bottom: '3%',
                    containLabel: true
                },

                // Add Tooltip
                tooltip : {
                    trigger: 'axis'
                },

                // Add Legend
                legend: {
                    data:['Profits']
                },

                // Enable drag recalculate
                calculable : true,

                // Horizontal Axiz
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : arrayDate,
                    }
                ],

                // Vertical Axis
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value}'
                        }
                    }
                ],

                // Add Series
                series : [
                    {
                        name: 'Profits',
                        type:'line',
                        data: profits,
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(0,0,0,0.1)',
                                shadowBlur: 10,
                                shadowOffsetY: 10
                            }
                        },
                    }
                ]
            };
        // use configuration item and data specified to show chart
        myChart.setOption(option);
    };

    function lineChartInfor(arrayDate, bookings, contacts, tours) {
        var myChart = echarts.init(document.getElementById('basic-line'));

        // specify chart configuration item and data
        var option = {
                // Setup grid
                grid: {
                    left: '1%',
                    right: '2%',
                    bottom: '3%',
                    containLabel: true
                },

                // Add Tooltip
                tooltip : {
                    trigger: 'axis'
                },

                // Add Legend
                legend: {
                    data:['Bookings', 'Contacts', 'Tours']
                },

                // Enable drag recalculate
                calculable : true,

                // Horizontal Axiz
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : arrayDate,
                    }
                ],

                // Vertical Axis
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value}'
                        }
                    }
                ],

                // Add Series
                series : [
                    {
                        name: 'Bookings',
                        type: 'line',
                        data: bookings,
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                            ]
                        },
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(0,0,0,0.1)',
                                shadowBlur: 10,
                                shadowOffsetY: 10
                            }
                        },
                    },
                    {
                        name: 'Contacts',
                        type: 'line',
                        data: contacts,
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                            ]
                        },
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(0,0,0,0.1)',
                                shadowBlur: 10,
                                shadowOffsetY: 10
                            }
                        },
                    },
                    {
                        name: 'Tours',
                        type: 'line',
                        data: tours,
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                            ]
                        },
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(0,0,0,0.1)',
                                shadowBlur: 10,
                                shadowOffsetY: 10
                            }
                        },
                    }
                ]
            };
        // use configuration item and data specified to show chart
        myChart.setOption(option);
    };
</script>
@endsection
