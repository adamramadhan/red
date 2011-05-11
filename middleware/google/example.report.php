<?php
define('ga_email','labs@networks.co.id');
define('ga_password','cicakkurus');
define('ga_profile_id','44030755');

require 'gapi.class.php';

$ga = new gapi('labs@networks.co.id','cicakkurus');

$path = "/netcoid";

/*
 * if you only want to get one path, use a filter:
 */

$filter = "pagePath == '$path'";
$sort = array('-date');
$dimensions = array('visitCount','source','city','date');
$metrics    = array('pageviews','uniquePageviews');

$ga->requestReportData(ga_profile_id, $dimensions, $metrics , $sort, $filter,NULL,NULL,1,1000);

$result = $ga->getResults();
var_dump($result);

$ga->requestReportData(ga_profile_id,array('pagePath'),
   array('pageviews','uniquePageviews'),'',$filter,NULL,NULL,1,1000);
 
$result = $ga->getResults();
var_dump($result);

 
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');
        data.addColumn('number', 'Sales');
        data.addColumn('number', 'Expenses');
        data.addRows(10);
        data.setValue(1, 0, '2005');
        data.setValue(1, 1, 1170);
        data.setValue(1, 2, 460);

        data.setValue(2, 0, '2006');
        data.setValue(2, 1, 860);
        data.setValue(2, 2, 580);

        data.setValue(3, 0, '2007');
        data.setValue(3, 1, 1030);
        data.setValue(3, 2, 540);

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 400, height: 240, title: 'Company Performance'});
      }
    </script>
  </head>

  <body>
    <div id="chart_div"></div>
  </body>
</html>