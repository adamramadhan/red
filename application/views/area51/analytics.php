<?php if (!isset($null)): ?>
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
<?php endif ?>

  <!-- CONTENT START -->
  <div class="clearfix" id="red-content">
    <!-- FORM START -->
    <div id="red-edit-full">
      <h1>Insights</h1>

      <?php if (isset($null)): ?>
      <p>Anda tidak mempunyai cukup data, Kunjungi Profile / Produk anda dan sebarkan url anda di <code>www.networks.co.id/<?php echo $this->sessions->get('username'); ?></code> *<i>Mimimal kami mempunyai data untuk dapat membandingkan akfititas penunjung anda diantara 2 hari. Hubungi <a href="/help">Pusat Bantuan</a> untuk support.</i> jangan lupa bookmark <b>ctrl + d</b></p>        
      <?php endif ?>

      <?php if (!isset($null)): ?>
        <p>untuk saran atau permintaan tambahan data, langsung ke <a href="https://www.networks.co.id/blog?id=6" style="color: rgb(211, 46, 46);">Invitasi &amp; Voting</a>.</p>
        <h3>Weekly Account Insights</h3>
        <div id="Insights-page"></div>
        <h3>Weekly Product Insights</h3>
        <div id="Insights-product"></div>        
      <?php endif ?>

    </div>
    
    <!-- ADS & MENU START -->
    <?php $this->view('users/menu-right'); ?> 
    <!-- ADS & MENU START -->

  </div>
  <!-- CONTENT END -->  
