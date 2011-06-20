<?php
require 'class.xhttp.php';
#header('content-type: text/plain');
// Set account login info
$search = 'lingerie';
$data['post'] = array(
  'accountType' => 'HOSTED_OR_GOOGLE',  // indicates a Google account
  'Email'       => 'damsprivate@gmail.com',  // full email address
  'Passwd'      => 'cicakkurus28',
  'service'     => 'trendspro', // Name of the Google service
  'source'      => 'sudocode.net-example-1.0' // Application's name, e.g. companyName-applicationName-versionID
);

$response = xhttp::fetch('https://www.google.com/accounts/ClientLogin', $data);

// Test if unsuccessful
if(!$response['successful']) {
    echo 'response: '; print_r($response);
    die();
}

// Extract SID
preg_match('/SID=(.+)/', $response['body'], $matches);
$sid = $matches[1];

// Erase POST variables used on the previous xhttp call
$data = array();

// Set the SID in cookies
$data['cookies'] = array(
    'SID' => $sid
);

$response = xhttp::fetch('http://www.google.com/insights/search/overviewReport?q='.$search.'&geo=ID&cmpt=q&content=1&export=1', $data);

// CSV data in the response body
#$a = str_getcsv($response['body']);
#var_dump(str_getcsv($response['body']));
$f = explode("\n\n", $response['body']);
#echo $f[3];

# AMBIL 5 KOTA TERATAS
preg_match_all("/[a-zA-Z]{1,255},[0-9]{1,3}/",$f[3],$kotateratas,PREG_PATTERN_ORDER);
$netcoidinsights_topcity = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $kotateratas[0]);

# AMBIL SUBKAWASAN TERTINGGI
preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[2],$regional,PREG_PATTERN_ORDER);
$netcoidinsights_topregion = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1($2)', $regional[0]);

# AMBIL TAG PALING BANYAK DIGUNAKAN
preg_match_all("/[a-zA-Z]{1,255}[\s][a-zA-Z]{1,255},([1-9]{1,2}(?!\d)|100)/",$f[5],$regional,PREG_PATTERN_ORDER);
$netcoidinsights_toptag = preg_replace('/([a-zA-Z]{1,255}),([0-9]{1,3})/', '$1', $regional[0]);

#echo $response['body'];
preg_match_all("/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/",$f[1],$chart,PREG_PATTERN_ORDER);
$chart2 = preg_replace('/([0-9]{4}-[0-9]{2}-[0-9]{2}\s-\s[0-9]{4}-[0-9]{2}-[0-9]{2}),(\d+)/', '["$1",$2]', $chart[0]);
$netcoidtrends = array_slice($chart2, -50);
?>
<div id="netcoid-google-trends">
  <div><h3>Netcoid Insights "<?php echo ucfirst($search); ?>"</h3></div>
  <div id="netcoid-google-topcity">
  	<h4>Kota Peminat tertinggi</h4>
  	<p><?php echo implode(', ',$netcoidinsights_topcity); ?></p>
  </div>
  <div id="netcoid-google-topregion">
  	<h4>Subkawasan Peminat tertinggi</h4>
  	<p><?php echo implode(', ',$netcoidinsights_topregion); ?></p>
  </div>
  <div id="netcoid-google-graph"></div>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create our data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Date');
      data.addColumn('number', 'Search Volume');
	  data.addRows([
		<?php echo implode(',',$netcoidtrends); ?>
	  ]);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.AreaChart(document.getElementById('netcoid-google-graph'));
      chart.draw(data, { width: 940, height: 240, chartArea:{left:50,top:20,width:745}});
    } 
    </script>
</div>

    