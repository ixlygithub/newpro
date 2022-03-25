@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-account'])
@section('content')

      <section class="row">
        <div class="col-md-9 no_padding" style="border: none;">
          
          <div class="para_title">
          <h6>NCLEX MASTERY QUESTIONS</h6>
        </div>
          <div class="small_title">
            <h3>NCLEX PREP > NCLEX MASTERY QUESTIONS</h3>
          </div>
          <div class="home_signin">
            <h3><a href="<?php echo url('/userpage');?>">HOME </a>/ QUESTIONS / NCLEX MASTERY QUESTIONS</h3>
          </div>
          <div class="bgcolour">
            <div class="row">
                    

                    <div class="col-md-12">
                        <!-- Tabs content -->
                        <?php //print_r($catreport);
                         $categories = array_column($catreport, 'category');
                         $test_details = array_column($catreport, 'test_details');
                         $color = array_column($catreport, 'color');
                        // print_r($categories);
                          $categories=json_encode($categories);
                         //echo "<br>";
                        $test_details=json_encode($test_details);
                           //echo "<br>";
                         $color=json_encode($color);
                         $newcatreport=json_encode($newcatreport);
                   
                            
                        ?>
                      <!--   <svg viewBox="0 0 100 100">
      <circle cx="2" cy="2" r="2" />
    </svg>Not Taken Test <svg viewBox="0 0 100 100">
      <circle cx="2" cy="2" r="2" />
    </svg>Taken Test -->
                       <p>  <span class="dotg"></span><span class="textcolor">Test Taken</span> <span class="dotr"></span><span class="textcolor">Test Not Taken</span>
   </p>
                    <!--    <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->
                       <center><h6><b><?php echo $title;?></b></h6></center><div id="chartdiv1"></div>
                      


                    </div>
                </div>
            </div>
        </div>
        @include('layouts.profile_sidebar')
      </section>
    </div>
    <style type="text/css">
      .tab-content>.active {
    display: block;
    opacity: 1;
}


    </style>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    
    <script type="text/javascript">
  /**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */

// Create chart instance

var chart = am4core.create("chartdiv1", am4charts.PieChart);

// Add data

chart.data = <?php echo $newcatreport;?>

// Add and configure Series
chart.legend = new am4charts.Legend();




var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "column-1";
pieSeries.dataFields.category = "category";

// Set up tooltips
pieSeries.tooltip.label.interactionsEnabled = true;
pieSeries.tooltip.keepTargetHover = true;
pieSeries.slices.template.tooltipHTML = '<b>{category}</b><br><a href="https://en.wikipedia.org/wiki/{category.urlEncode()}">More info</a>';

pieSeries.slices.template.propertyFields.fill = "color";
chart.legend.fontSize = 12;
chart.fontSize= 12;
</script>
    @endsection

    <style>
.dotg {
      height: 14px;
    width: 16px;
  background-color:#CD0D74;
  /*border-radius: 50%;*/
  display: inline-block;
   
}
.dotr {
     height: 14px;
    width: 16px;
  background-color:#808080;
 /* border-radius: 50%;*/
  display: inline-block;

}
.p{
  font-size: 5px;
}
.textcolor
{
      font-size: 13px;
}
</style>
