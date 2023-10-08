<!Doctype html>
<html>
<head>
  <title>Google Date Wise Bar and Line Chart Codeigniter Tutorial</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
  <script type="text/javascript">
      google.charts.load('visualization', "1", {
          packages: ['corechart']
      });
  </script>
</head>
<body>
<div class="row">
  <div class="col-md-12">
    <div id="line_date_wise" style="width: 900px; height: 500px; margin: 0 auto"></div>
    <div id="bar_date_wise" style="width: 900px; height: 500px; margin: 0 auto"></div>
  </div>  
</div>
</body>
<script language="JavaScript">
  // Draw the pie chart for registered users month wise
  google.charts.setOnLoadCallback(lineChart);
 
  // Draw the pie chart for registered users year wise
  google.charts.setOnLoadCallback(barChart);
   
  //for
  function lineChart() {
 
        /* Define the chart to be drawn.*/
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Users Count'],
            <?php 
             foreach ($day_wise as $row){
             echo "['".$row->day_date."',".$row->count."],";
             }
             ?>
        ]);
 
        var options = {
          title: 'Day Wise Registered Users Of Line Chart',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        /* Instantiate and draw the chart.*/
        var chart = new google.visualization.LineChart(document.getElementById('line_date_wise'));
        chart.draw(data, options);
  }
  // for
  function barChart() {
 
    /* Define the chart to be drawn.*/
    var data = google.visualization.arrayToDataTable([
        ['Date', 'Users Count'],
        <?php 
         foreach ($day_wise as $row){
         echo "['".$row->day_date."',".$row->count."],";
         }
         ?>
    ]);
    var options = {
        title: 'Date wise Registered Users Bar Chart',
        is3D: true,
    };
    /* Instantiate and draw the chart.*/
    var chart = new google.visualization.BarChart(document.getElementById('bar_date_wise'));
    chart.draw(data, options);
  }
</script>
</html>