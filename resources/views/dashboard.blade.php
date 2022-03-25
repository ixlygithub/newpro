@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">User Datas</h5>
                            <h2 class="card-title">Performance</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">User Accounts</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Passing Percentage</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Users Test</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                            <?php
                                $label_names = array("Jan"=>"0","Feb"=>"0","Mar"=>"0","Apr"=>"0","May"=>"0","Jun"=>"0","Jul"=>"0","Aug"=>"0","Sep"=>"0","Oct"=>"0","Nov"=>"0","Dec"=>"0");
                                $data=array();
                                $data_name=array();
                                foreach($website_reports as $website_report) {
                                    $data[date('M', strtotime($website_report['x']))] = $website_report['y'];
                                    $data_name= $label_names;
                                }
                            ?>
                            <?php
                                $data1=array();
                                $data_name1=array();
                                // dd($passing_reports);
                                foreach($passing_reports as $passing_report) {
                                    $data1[date('M', strtotime($passing_report->x))] = $passing_report->y;
                                    $data_name1= $label_names;
                                }
                            ?>
                            <?php
                                $data2=array();
                                $data_name2=array();
                                // dd($passing_reports);
                                foreach($test_reports as $test_report) {
                                    $data2[date('M', strtotime($test_report->x))] = $test_report->y;
                                    $data_name2= $label_names;
                                }
                            ?>
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Users Per Day</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> <?php echo count($todal_day); ?> Users</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <?php 
                            $week_names = array("Mon"=>"0","Tue"=>"0","Wed"=>"0","Thu"=>"0","Fri"=>"0","Sat"=>"0");
                            $data3=array();
                            $data_name3=array();
                            foreach($todal_weeks as $todal_week) {
                                $data3[date('D', strtotime($todal_week['x']))] = $todal_week['y'];
                                $data_name3= $week_names;
                            }
                           // dd(implode(',',array_merge($data_name3, $data3)));
                        ?>
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Daily Pass Status</h5>
                    <?php 
                        $data4=array();
                        $data_name4=array();
                        $sum = 0;
                        foreach($passing_reports_week as $passing_report_week) {
                            $data4[date('D', strtotime($passing_report_week->x))] = $passing_report_week->y;
                            $data_name4= $week_names;
                            $sum+= $passing_report_week->y;
                        }
                        // dd(implode(',',array_merge($data_name4, $data4)));
                    ?>
                    <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> <?php echo $sum;
                    ?> Passed Users</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Completed Tests</h5>
                        <?php 
                            $data5=array();
                            $data_name5=array();
                            $sum1 = 0;
                            foreach($test_reports_week as $test_report_week) {
                                $data5[date('D', strtotime($test_report_week->x))] = $test_report_week->y;
                                $data_name5= $week_names;
                                $sum1+= $test_report_week->y;
                            }
                            // dd(implode(',',array_merge($data_name5, $data5)));
                        ?>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> <?php echo $sum1;
                    ?> Tests</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">-->
    <!--    <div class="col-lg-6 col-md-12">-->
    <!--        <div class="card card-tasks">-->
    <!--            <div class="card-header ">-->
    <!--                <h6 class="title d-inline">Tasks(5)</h6>-->
    <!--                <p class="card-category d-inline">today</p>-->
    <!--                <div class="dropdown">-->
    <!--                    <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">-->
    <!--                        <i class="tim-icons icon-settings-gear-63"></i>-->
    <!--                    </button>-->
    <!--                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">-->
    <!--                        <a class="dropdown-item" href="#pablo">Action</a>-->
    <!--                        <a class="dropdown-item" href="#pablo">Another action</a>-->
    <!--                        <a class="dropdown-item" href="#pablo">Something else</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="card-body ">-->
    <!--                <div class="table-full-width table-responsive">-->
    <!--                    <table class="table">-->
    <!--                        <tbody>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="">-->
    <!--                                            <span class="form-check-sign">-->
    <!--                                                <span class="check"></span>-->
    <!--                                            </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">Update the Documentation</p>-->
    <!--                                    <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="" checked="">-->
    <!--                                            <span class="form-check-sign">-->
    <!--                                                <span class="check"></span>-->
    <!--                                            </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">GDPR Compliance</p>-->
    <!--                                    <p class="text-muted">The GDPR is a regulation that requires businesses to protect the personal data and privacy of Europe citizens for transactions that occur within EU member states.</p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="">-->
    <!--                                                <span class="form-check-sign">-->
    <!--                                                    <span class="check"></span>-->
    <!--                                                </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">Solve the issues</p>-->
    <!--                                    <p class="text-muted">Fifty percent of all respondents said they would be more likely to shop at a company </p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="">-->
    <!--                                            <span class="form-check-sign">-->
    <!--                                                <span class="check"></span>-->
    <!--                                            </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">Release v2.0.0</p>-->
    <!--                                    <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="">-->
    <!--                                            <span class="form-check-sign">-->
    <!--                                                <span class="check"></span>-->
    <!--                                            </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">Export the processed files</p>-->
    <!--                                    <p class="text-muted">The report also shows that consumers will not easily forgive a company once a breach exposing their personal data occurs. </p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td>-->
    <!--                                    <div class="form-check">-->
    <!--                                        <label class="form-check-label">-->
    <!--                                            <input class="form-check-input" type="checkbox" value="">-->
    <!--                                            <span class="form-check-sign">-->
    <!--                                                <span class="check"></span>-->
    <!--                                            </span>-->
    <!--                                        </label>-->
    <!--                                    </div>-->
    <!--                                </td>-->
    <!--                                <td>-->
    <!--                                    <p class="title">Arival at export process</p>-->
    <!--                                    <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>-->
    <!--                                </td>-->
    <!--                                <td class="td-actions text-right">-->
    <!--                                    <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">-->
    <!--                                        <i class="tim-icons icon-pencil"></i>-->
    <!--                                    </button>-->
    <!--                                </td>-->
    <!--                            </tr>-->
    <!--                        </tbody>-->
    <!--                    </table>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
        <!--<div class="col-lg-6 col-md-12">-->
        <!--    <div class="card ">-->
        <!--        <div class="card-header">-->
        <!--            <h4 class="card-title">Simple Table</h4>-->
        <!--        </div>-->
        <!--        <div class="card-body">-->
        <!--            <div class="table-responsive">-->
        <!--                <table class="table tablesorter" id="">-->
        <!--                    <thead class=" text-primary">-->
        <!--                        <tr>-->
        <!--                            <th>-->
        <!--                                Name-->
        <!--                            </th>-->
        <!--                            <th>-->
        <!--                                Country-->
        <!--                            </th>-->
        <!--                            <th>-->
        <!--                                City-->
        <!--                            </th>-->
        <!--                            <th class="text-center">-->
        <!--                                Salary-->
        <!--                            </th>-->
        <!--                        </tr>-->
        <!--                    </thead>-->
        <!--                    <tbody>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                              Dakota Rice-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                              Niger-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                              Oud-Turnhout-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                              $36,738-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Minerva Hooper-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Curaçao-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Sinaai-Waas-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $23,789-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Sage Rodriguez-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Netherlands-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Baileux-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $56,142-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Philip Chaney-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Korea, South-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Overland Park-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $38,735-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Doris Greene-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Malawi-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Feldkirchen in Kärnten-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $63,542-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Mason Porter-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Chile-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Gloucester-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $78,615-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                Jon Porter-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Portugal-->
        <!--                            </td>-->
        <!--                            <td>-->
        <!--                                Gloucester-->
        <!--                            </td>-->
        <!--                            <td class="text-center">-->
        <!--                                $98,615-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                    </tbody>-->
        <!--                </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    <!--</div>-->
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
    <script type="text/javascript">
        //Dashboard Chart

$(document).ready(function(){
    var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
    var chart_data = [<?php  echo implode(',',array_merge($data_name, $data)); ?>];

    var ctx = document.getElementById("chartBig1").getContext('2d');

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    var config = {
      type: 'line',
      data: {
        labels: chart_labels,
        datasets: [{
          label: "User(s)",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#A2FBFF',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#A2FBFF',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#A2FBFF',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: chart_data,
        }]
      },
      options: gradientChartOptionsConfigurationWithTooltipPurpleUsers

    };
    var myChartData = new Chart(ctx, config);
    $("#0").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#1").click(function() {
      var chart_data = [<?php  echo implode(',',array_merge($data_name1, $data1)); ?>];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.datasets[0].label = 'Passed Users';
      myChartData.update();
    });

    $("#2").click(function() {
      var chart_data = [<?php  echo implode(',',array_merge($data_name2, $data2)); ?>];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.datasets[0].label = 'Test Count';
      myChartData.update();
    });
});
$(document).ready(function(){

    var ctx = document.getElementById("chartLinePurple").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    var data = {
      labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
      datasets: [{
        label: "User(s)",
        fill: true,
        backgroundColor: gradientStroke,
        borderColor: '#A2FBFF',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#A2FBFF',
        pointBorderColor: 'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#A2FBFF',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: [<?php echo implode(',',array_merge($data_name3, $data3)); ?>],
      }]
    };

    var myChart = new Chart(ctx, {
      type: 'line',
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipPurpleUsers
    });
});
$(document).ready(function(){

    var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

    var gradientStroke = ctxGreen.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
    gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
    gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors

    var data = {
      labels: ['MON', 'TUE', 'WED', 'THU', 'FRI','SAT'],
      datasets: [{
        label: "Test Count",
        fill: true,
        backgroundColor: gradientStroke,
        borderColor: '#00d6b4',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#00d6b4',
        pointBorderColor: 'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#00d6b4',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: [<?php echo implode(',',array_merge($data_name5, $data5)); ?>],
      }]
    };

    var myChart = new Chart(ctxGreen, {
      type: 'line',
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipGreen

    });
});
$(document).ready(function(){
    var ctx = document.getElementById("CountryChart").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors
    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        datasets: [{
          label: "Pass Counts",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: [<?php echo implode(',',array_merge($data_name4, $data4)); ?>],
        }]
      },
      options: gradientBarChartConfiguration
    });
});
</script>
@endpush
