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
      data.addColumn('string', 'date');
      data.addColumn('number', 'Views');
      data.addColumn('number', 'People');
      data.addRows([
        <?php echo $analytics; ?>
      ]);
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('Analytics-Visualization'));
      chart.draw(data, {width: 745, height: 240,chartArea:{left:20,top:20,width:640}});
    }
    </script>


  <!-- CONTENT START -->
  <div class="clearfix" id="red-content">
    <!-- FORM START -->
    <div id="red-edit-full">
      <h1>Marketing</h1>
      <div id="Analytics-Visualization"></div>
    </div>
    
    <!-- ADS & MENU START -->
    <?php $this->view('users/menu-right'); ?> 
    <!-- ADS & MENU START -->

  </div>
  <!-- CONTENT END -->  
