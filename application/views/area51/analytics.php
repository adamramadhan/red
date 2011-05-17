

  <!--Load the AJAX API-->
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
      data.addColumn('number', 'Total Views');
      data.addColumn('number', 'Guest Views');
      data.addColumn('number', 'Netcoid Views');
      data.addColumn('number', 'People');
      data.addRows([
        <?php echo $data['page']; ?>
      ]);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.AreaChart(document.getElementById('Insights-page'));
      chart.draw(data, {lineWidth:3, pointSize:8, width: 745, height: 240, chartArea:{left:50,top:20,width:550}});

      // DUA
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'PID');
      data.addColumn('number', 'Total Views');
      data.addColumn('number', 'Guest Views');
      data.addColumn('number', 'Netcoid Views');
      data.addColumn('number', 'People');
      data.addRows([
        <?php echo $data['product']; ?>
      ]);

      var chart = new google.visualization.ColumnChart(document.getElementById('Insights-product'));
      chart.draw(data, {
      width: 745, height: 240, chartArea:{left:50,top:20,width:550}});
    }
    </script>


  <!-- CONTENT START -->
  <div class="clearfix" id="red-content">
    <!-- FORM START -->
    <div id="red-edit-full">
      <h1>Insights</h1>
      <p>untuk saran atau permintaan tambahan data, langsung ke <a href="https://www.networks.co.id/blog?id=6" style="color: rgb(211, 46, 46);">Invitasi &amp; Voting</a>.</p>
      <h3>Weekly Account Information</h3>
      <div id="Insights-page"></div>
      <h3>Weekly Top Product</h3>
      <div id="Insights-product"></div>
    </div>
    
    <!-- ADS & MENU START -->
    <?php $this->view('users/menu-right'); ?> 
    <!-- ADS & MENU START -->

  </div>
  <!-- CONTENT END -->  
