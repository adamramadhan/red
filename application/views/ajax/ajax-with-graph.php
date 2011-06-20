<div id="netcoid-google-trends">
	   <script src="https://www.google.com/jsapi?key=ABQIAAAAGNFVm5amJ-XGJXUiKXaliRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRH827W55PGQHSqvK8RZOl9wFLwDw" type="text/javascript"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Date');
      data.addColumn('number', 'Search Volume');
  	  data.addRows([
  		<?php echo implode(',',$netcoidtrends); ?>
  	  ]);

      var chart = new google.visualization.AreaChart(document.getElementById('netcoid-google-graph'));
        chart.draw(data, { width: 940, height: 240, chartArea:{left:50,top:20,width:745}});
      }
    </script>
  <div><h3>Netcoid Insights "<?php echo ucfirst($search); ?>"</h3></div>
  <div id="netcoid-google-topcity">
  	<h4>Kota Peminat tertinggi</h4>
  	<p><?php echo implode(', ',$netcoidinsights_topcity); ?></p>
  </div>
  <div id="netcoid-google-topregion">
  	<h4>Subkawasan Peminat tertinggi</h4>
  	<p><?php echo implode(', ',$netcoidinsights_topregion); ?></p>
  </div>
  <div id="netcoid-google-graph">loading...</div>
</div>