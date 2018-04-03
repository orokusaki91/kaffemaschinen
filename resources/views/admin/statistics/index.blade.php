@php($page_name = 'Statistik')
@extends('admin.layouts.app')

@section('content')
    <div class="row mb-4">
        <div onclick="showhide('myChart3')" class="col-lg-3 col-sm-12">
            <div class="card" style="min-height: 95px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 text-center bg-primary-dark pv-lg">
                            <img src="/back/img/money.svg" alt="My SVG Icon">
                        </div>
                        <div class="col-lg-8 pv-lg">
                            <div class="h5 mt0">CHF {{ number_format($sumOrders, 2) }}</div>
                            <div class="text-uppercase" style="font-size: 11px;">{{ __('lang.sum') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div onclick="showhide('myChart2')" class="col-lg-3 col-sm-12">
            <div class="card" style="min-height: 95px;">
                <div class="card-body" style="min-height: 90px;">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-8 pv-lg">
                            <div class="h2 mt0">{{ $totalOrder }}</div>
                            <div class="text-uppercase" style="font-size: 11px;">{{ __('lang.admin-dashboard-total-order-title') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div onclick="showhide('myChart4')" class="col-lg-3 col-sm-12">
            <div class="card" style="min-height: 95px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-8 pv-lg">
                            <div class="h5 mt0">CHF {{ number_format($sumCartValues, 2) }}</div>
                            <div class="text-uppercase" style="font-size: 11px;">{{ __('lang.cart-value') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div onclick="showhide('myChart')" class="col-lg-3 col-sm-12">
            <div class="card" style="min-height: 95px;">
                <div class="card-body" style="min-height: 90px;">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <img src="/back/img/people.svg" height="60px" alt="My SVG Icon">
                        </div>
                        <div class="col-lg-8 pv-lg">
                            <div class="h2 mt0">{{ $countVisits }}</div>
                            <div class="text-uppercase" style="font-size: 11px;">{{ __('lang.visits') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="calendar" class="panel">
                <form action="#" method="post" id="calendar_form" name="calendar_form" class="form-inline">
                    <div class="btn-group">
                        <button type="button" id="submitDateWeek" name="submitDateWeek" class="days btn btn-default submitDateWeek active">
                            {{ __('lang.week') }}
                        </button>
                        <button type="button" id="submitDateMonth" name="submitDateMonth" class="days btn btn-default submitDateMonth">
                            {{ __('lang.month') }}
                        </button>
                        <button type="button" id="submitDateYear" name="submitDateYear" class="days btn btn-default submitDateYear">
                            {{ __('lang.year') }}
                        </button>
                        @if ($labelBetweenCollection !== null)
                            <button type="button" id="submitDateCustom" name="submitDateCustom" class="days btn btn-default submitDateCustom">
                                {{ __('lang.custom') }}
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <input type="text" name="daterange" id="daterange" class="form-control rounded float-right" />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-sm-12" style="min-height: 800px;">
            <canvas class="hide" id="myChart"></canvas>

            <canvas class="hide" id="myChart2"></canvas>

            <canvas class="hide" id="myChart3"></canvas>

            <canvas class="hide" id="myChart4"></canvas>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="back/css/font-awesome.min.css">
<style>
    button.active {
        background-color: #ccc;
    }
    #daterange {
        width: 210px;
    }
    .hide {
        display:none;
    }
    .card-body:hover {
        background-color: #ccc;
        -webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out;
    }
    .card-body img {
        height: 50px;
    }
</style>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
@endpush

@push('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



<script>
    $().ready()
    {
        showhide('myChart3');
    }
    var selector = 'button.days';

    $(selector).on('click', function(){
        $(selector).removeClass('active');
        $(this).addClass('active');

        showhide('myChart3');

    });

    var d1 = "01/01/2018";
    var d2 = new Date();
    var url_string = window.location.href;
    var url = new URL(url_string);
    var start = url.searchParams.get("start");
    var end = url.searchParams.get("end");

    if (start != null && end != null) {
        d1 = start;
        d2 = end;
    }

    $('#daterange').daterangepicker({
        "autoApply": true,
        "startDate": d1,
        "endDate": d2,
        locale: {
            applyLabel: 'Abfragen',
            fromLabel: 'Von',
            toLabel: 'Bis',
            customRangeLabel: 'Benutzer definiert',
            daysOfWeek: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
            monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
            firstDay: 1
        }
    }, function(start, end, label) {
        window.location.href = "/admin/statistics?start=" + start.format("MM/DD/YYYY") + "&end=" + end.format("MM/DD/YYYY");
    });



    function showhide(id){
        if (document.getElementById) {

            var divid = document.getElementById(id);
            var divs = document.getElementsByClassName("hide");
            for(var i=0;i<divs.length;i++) {
                divs[i].style.display = "none";
            }
            divid.style.display = "block";

            if ( $('#submitDateWeek').is('.active') ) {
                if (divid.id == 'myChart') {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelWeekCollection !!} ],
                            datasets: [{
                                label: "# von Besuchen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $visitorValueWeekCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart2') {
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelWeekCollection  !!} ],
                            datasets: [{
                                label: "# von Bestellungen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $orderValueWeekCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart3') {
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelWeekCollection  !!} ],
                            datasets: [{
                                label: "Summenauftragswert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $sumOrderValuesWeekCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart4') {
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelWeekCollection  !!} ],
                            datasets: [{
                                label: "Durchschnittlicher Bestellwert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $averageCartValueWeekCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                }
            }

            if ( $('#submitDateMonth').is('.active') ) {
                if (divid.id == 'myChart') {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelMonthCollection !!} ],
                            datasets: [{
                                label: "# von Besuchen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $visitorValueMonthCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart2') {
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelMonthCollection !!} ],
                            datasets: [{
                                label: "# von Bestellungen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $orderValueMonthCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart3') {
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelMonthCollection !!} ],
                            datasets: [{
                                label: "Summenauftragswert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $sumOrderValuesMonthCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart4') {
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelMonthCollection  !!} ],
                            datasets: [{
                                label: "Durchschnittlicher Bestellwert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $averageCartValueMonthCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                }
            }

            if ( $('#submitDateYear').is('.active') ) {
                if (divid.id == 'myChart') {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelYearCollection !!} ],
                            datasets: [{
                                label: "# von Besuchen",
                                borderColor: 'rgb(80, 80, 80)',
                                borderWidth: 2,
                                pointRadius: 1,
                                pointHoverRadius: 1,
                                data: [{{ $visitorValueYearCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart2') {
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelYearCollection !!} ],
                            datasets: [{
                                label: "# von Bestellungen",
                                borderColor: 'rgb(80, 80, 80)',
                                borderWidth: 2,
                                pointRadius: 1,
                                pointHoverRadius: 1,
                                data: [{{ $orderValueYearCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart3') {
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelYearCollection !!} ],
                            datasets: [{
                                label: "Summenauftragswert",
                                borderColor: 'rgb(80, 80, 80)',
                                borderWidth: 2,
                                pointRadius: 1,
                                pointHoverRadius: 1,
                                data: [{{ $sumOrderValuesYearCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart4') {
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelYearCollection  !!} ],
                            datasets: [{
                                label: "Durchschnittlicher Bestellwert",
                                borderColor: 'rgb(80, 80, 80)',
                                borderWidth: 2,
                                pointRadius: 1,
                                pointHoverRadius: 1,
                                data: [{{ $averageCartValueYearCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                }
            }

            if ( $('#submitDateCustom').is('.active') ) {
                if (divid.id == 'myChart') {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelBetweenCollection !!} ],
                            datasets: [{
                                label: "# von Besuchen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $visitorValueBetweenCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart2') {
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelBetweenCollection  !!} ],
                            datasets: [{
                                label: "# von Bestellungen",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $orderValueBetweenCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart3') {
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelBetweenCollection  !!} ],
                            datasets: [{
                                label: "Summenauftragswert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $sumOrderValuesBetweenCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                } else if (divid.id == 'myChart4') {
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [ {!! $labelBetweenCollection  !!} ],
                            datasets: [{
                                label: "Durchschnittlicher Bestellwert",
                                borderColor: 'rgb(80, 80, 80)',
                                data: [{{ $averageCartValueBetweenCollection }}],
                            }]
                        },

                        // Configuration options go here
                        options: {}
                    });
                }
            }
        }
        return false;
    }






</script>
@endpush