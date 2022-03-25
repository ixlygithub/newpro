@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-account'])
@section('content')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    
            <section class="row border">
                <div class="col-md-9 no_padding">
                    <div class="para_title" style="border-right: none;">
                        <h6>Exams</h6>
                    </div>
                    <div class="small_title">
                        <h3>NCLEX PREP > Exams</h3>
                    </div>
                    <div class="home_signin">
                       
                        <h3><a href="<?php echo url('/userpage');?>">HOME </a>/ <a href="<?php echo url('/exam_history');?>">Exam History </a> </h3>
                    </div>
                    <div class="bgcolour">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- Tabs nav -->
                                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active mb-3 p-3 shadow" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <i class="fa fa-file-text mr-2"></i>
                                        <span class="font-weight-bold small text-uppercase">Exam History</span></a>

                                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <i class="fa fa-bar-chart mr-2"></i>
                                        <span class="font-weight-bold small text-uppercase">Bar Chart</span></a>

                                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                        <i class="fa fa-pie-chart mr-2"></i>
                                        <span class="font-weight-bold small text-uppercase">Pie Chart</span></a>
                                    </div>
                            </div>

                            <div class="col-md-9">
                                <!-- Tabs content -->
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade shadow rounded bg-white p-5 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                       <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Test Name</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; foreach ($exams as $exam) { ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $exam->test_name; ?></td>
                                                            <td><?php echo $exam->test_result; ?></td>
                                                            <td><?php echo date('d-m-Y',strtotime($exam->created_at)); ?></td>
                                                        </tr>
                                                    <?php $i++;} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">   
                                        <div id="chartdiv"></div>
                                    </div>
                                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                            <?php
                                                $label_names = array("Jan"=>"0","Feb"=>"0","Mar"=>"0","Apr"=>"0","May"=>"0","Jun"=>"0","Jul"=>"0","Aug"=>"0","Sep"=>"0","Oct"=>"0","Nov"=>"0","Dec"=>"0");
                                                $data1=array();
                                                $data_name1=array();
                                                // dd($passing_reports);
                                            foreach($bar_chart as $bar_chart) {
                                                $data1[date('M', strtotime($bar_chart->x))] = $bar_chart->y;
                                                $data_name1= $label_names;
                                            }
                                            ?>
                                          
                                        <div id="chartdiv1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.profile_sidebar')
            </section>
        </div>
        @endsection
    <!--     <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "none",
    "type": "serial",
  "startDuration": 2,
    "dataProvider": [{
        "country": "JAN",
        "visits": <?php //echo array_merge($data_name1, $data1)['Jan']; ?>,
        "color": "#8A0CCF"
    }, {
        "country": "FEB",
        "visits": <?php //echo array_merge($data_name1, $data1)['Feb']; ?>,
        "color": "#CD0D74"
    }, {
        "country": "MAR",
        "visits": <?php //echo array_merge($data_name1, $data1)['Mar']; ?>,
        "color": "#754DEB"
    }, {
        "country": "APRIL",
        "visits": <?php //echo array_merge($data_name1, $data1)['Apr']; ?>,
        "color": "#2A0CD0"
    }, {
        "country": "MAY",
        "visits": <?php //echo array_merge($data_name1, $data1)['May']; ?>,
        "color": "#F8FF01"
    },{
        "country": "JUN",
        "visits": <?php //echo array_merge($data_name1, $data1)['Jun']; ?>,
        "color": "#3EA7CC"
    },{
        "country": "JUL",
        "visits": <?php //echo array_merge($data_name1, $data1)['Jul']; ?>,
        "color": "#9C7B63"
    },{
        "country": "SEP",
        "visits": <?php //echo array_merge($data_name1, $data1)['Aug']; ?>,
        "color": "#4AA977"
    },{
        "country": "OCT",
        "visits": <?php //echo array_merge($data_name1, $data1)['Sep']; ?>,
        "color": "#E4B05F"
    },{
        "country": "NOV",
        "visits": <?php //echo array_merge($data_name1, $data1)['Oct']; ?>,
        "color": "#0F0931"
    },{
        "country": "DEC",
        "visits": <?php //echo array_merge($data_name1, $data1)['Nov']; ?>,
        "color": "#730E2C"
    },{
        "country": "DEC",
        "visits": <?php //echo array_merge($data_name1, $data1)['Dec']; ?>,
        "color": "#730E2C"
    },],
    "titles": [{
			"text": "USER SCORE REPORT",
			"size": 15
		}],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "visits"
    }],
    "depth3D": 5,
  "angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 90,

    },
    "export": {
    	"enabled": true
     }

});
</script>
<script type="text/javascript">
			AmCharts.makeChart("chartdiv1",
				{
					"type": "pie",
					"angle": 34.2,
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"depth3D": 18,
					"labelRadius": 5,
					"minRadius": 174,
					"baseColor": "#CD0D74",
					"colors": [
						"#FF0F00",
						"#FF6600",
						"#FF9E01",
						"#FCD202",
						"#F8FF01",
						"#B0DE09",
						"#04D215",
						"#0D8ECF",
						"#0D52D1",
						"#2A0CD0",
						"#8A0CCF",
						"#CD0D74",
						"#754DEB",
						"#DDDDDD",
						"#999999",
						"#333333",
						"#000000",
						"#57032A",
						"#CA9726",
						"#990000",
						"#4B0C25"
					],
					"titleField": "category",
					"valueField": "column-1",
					"theme": "default",
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"align": "center",
						"markerType": "circle"
					},
					"titles": [{
						"text": "USER STATUS REPORT",
						"size": 15
						}],
					"dataProvider": [
						{
							"category": "No.Of Tests",
							"column-1": "<?php //echo count($all_exam_count); ?>"
						},
						{
							"category": "Pass Test",
							"column-1": "<?php //echo count($pass_exam_count); ?>"
						},
						{
							"category": "Quit Tests",
							"column-1": "<?php //echo count($quit_exam_count); ?>"
						},
						{
							"category": "Fail Tests",
							"column-1": "<?php //echo count($fail_exam_count); ?>"
						}
					]
				}
			);
		</script> -->
