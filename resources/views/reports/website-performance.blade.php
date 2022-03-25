@extends('layouts.app', ['pageSlug' => 'websitereport'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">

         @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
          <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <h4 class="card-title">Website Performance</h4>
                    </div>
                    <div class="col-8">
                        <div class="px-1 px-sm-5 mx-auto">
                            <form action="{{route('websitereport')}}" method="GET"  enctype="multipart/form-data">
                                {{ method_field('GET') }}
                                <div class="row">
                                    <div class="col-9" style="padding-left:0px; padding-right:0px">
                                        <div class="input-group input-daterange"> 
                                            <input type="text" name="start_date" id="start" class="form-control text-left mr-2"> <label class="ml-3 form-control-placeholder" id="start-p" for="start">Start Date</label> <span class="fa fa-calendar" id="fa-1"></span> <input name="end_date" type="text" id="end" class="form-control text-left ml-2"> <label class="ml-3 form-control-placeholder" id="end-p" for="end">End Date</label> <span class="fa fa-calendar" id="fa-2"></span>
                                        </div>
                                    </div>
                                    <div class="col-1" style="padding-left:5px; padding-right:0px">
                                        <button type="submit" class="btn btn-success" style="border-radius: 24px;border: none;">
                                            <i class="fas fa-paper-plane icon-large" style="font-size: 12px;
                                        padding-right: 4px;vertical-align: baseline;"></i> GO
                                        </button>
                                    </div>
                                    <div class="col-1" style="padding-left: 28px;padding-right:0px;">
                                        <button type="submit" class="btn btn-warning" style="border-radius: 24px;border: none;color: #fff;">
                                            <i class="fas fa-times-circle icon-large"></i> CLEAR
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <div class="charts">
                            <?php
                                $data = array();
                                foreach ($website_reports as $website_report) {
                                    $data[] = $website_report;
                                }

                                // echo 
                            ?>
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class="text-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $report->name }}</td>
                                            <td>{{ date('d - m - Y',strtotime($report->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center"> No Users found!</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<style type="text/css">
    .tablesorter td{
        font-size: 13px;
    }
    a.canvasjs-chart-credit {
            display: none;
    }

input {
    padding: 22px 15px !important;
    border: 1px solid #CFD8DC !important;
    border-radius: 4px !important;
    box-sizing: border-box;
    background-color: #fff !important;
    color: #000 !important;
    font-size: 16px !important;
    letter-spacing: 1px;
    position: relative
}

input:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #1976D2 !important;
    outline-width: 0
}

.fa-calendar {
    position: absolute;
    top: 13px;
    font-size: 20px;
    color: #1976D2;
    z-index: 1000
}

#fa-1 {
    left: calc(50% - 40px)
}

#fa-2 {
    left: calc(100% - 40px)
}

.form-control-placeholder {
    position: absolute;
    padding: 12px 2px 0 2px;
    opacity: 0.5
}

#end-p {
    left: calc(50% + 4px)
}

.form-control:focus+.form-control-placeholder,
.form-control:valid+.form-control-placeholder {
    font-size: 90%;
    opacity: 1
}

::placeholder {
    color: #BDBDBD;
    opacity: 1
}

:-ms-input-placeholder {
    color: #BDBDBD
}

::-ms-input-placeholder {
    color: #BDBDBD
}
table.table.tablesorter th {
    color: #000;
}
button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

.datepicker {
    background-color: #fff;
    border-radius: 0 !important;
    align-content: center !important;
    padding: 0 !important
}

.datepicker-dropdown {
    top: 153px !important;
    left: calc(55% - 10.5px) !important;
    border-right: #1976D2 !important;
    border-left: #1976D2 !important;
}
th.dow {
    padding-top: 20px;
}
.datepicker-dropdown.datepicker-orient-left:before {
    left: calc(50% - 6px) !important
}

.datepicker-dropdown.datepicker-orient-left:after {
    left: calc(50% - 5px) !important;
    border-bottom-color: #1976D2
}

.datepicker-dropdown.datepicker-orient-right:after {
    border-bottom-color: #1976D2
}

.datepicker table tr td.today,
span.focused {
    border-radius: 50% !important;
    background-image: linear-gradient(#FFF3E0, #FFE0B2)
}


.cw {
    font-size: 14px !important;
    background-color: #E8EAF6 !important;
    border-radius: 0px !important;
    padding: 0px 20px !important;
    margin-right: 10px solid #fff !important
}

.old,
.day,
.new {
    width: 40px !important;
    height: 40px !important;
    border-radius: 0px !important
}

.day.old,
.day.new {
    color: #E0E0E0 !important
}

.day.old:hover,
.day.new:hover {
    border-radius: 50% !important
}

.old-day:hover,
.day:hover,
.new-day:hover,
.month:hover,
.year:hover,
.decade:hover,
.century:hover {
    border-radius: 50% !important;
    background-color: #eee
}


.range-start,
.range-end {
    border-radius: 50% !important;
    background-image: linear-gradient(#1976D2, #1976D2) !important
}

.range {
    background-color: #E3F2FD !important
}

.prev,
.next,
.datepicker-switch {
    border-radius: 0 !important;
    padding: 10px 10px 10px 10px !important;
    font-size: 18px;
    opacity: 0.7;
    color: #fff
}

.prev:hover,
.next:hover,
.datepicker-switch:hover {
    background-color: inherit !important;
    opacity: 1
}

@media screen and (max-width: 726px) {
    .datepicker-dropdown.datepicker-orient-right:before {
        right: calc(50% - 6px)
    }

    .datepicker-dropdown.datepicker-orient-right:after {
        right: calc(50% - 5px)
    }
}
thead tr:nth-child(2) {
    background-color: #1976D2 !important;
}
</style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,  
    title:{
        text: "User Datas by Year"
    },
    axisX:{
              valueFormatString: "#",
               lineColor: "#eee",
            },
    axisY: {
        title: "Count of Users",
        valueFormatString: "#",
        gridColor: "#eee",
        lineColor: "#eee",
    },
    toolTip:{
        content:"{x}: {y} User(s)" ,
    },
    data: [{
        lineColor: "#03f4fc",
        type: "splineArea",
        color: "rgba(245,245,249, 1.30)",
        markerSize: 8,
        markerColor: "#03f4fc",
        markerBorderThickness: 4,
        yValueFormatString: "#####",
        xValueFormatString: "####",
        dataPoints:<?php echo json_encode($data,JSON_NUMERIC_CHECK); ?>

    }]
    });
chart.render();
}
</script>