<?php
$statistic = new Statistic();
$chartData = $statistic->getChartData();
$chartDataJson = json_encode($chartData);
// in ra
// echo "<pre>";
// var_dump($chartData);
?>
<style>
    body {
        background-color: white;
    }

    .chart {
        margin-left: 200px;
        margin-top: 50px;
        border-radius: 20px;
    }
</style>
<!-- thống kê -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // biểu đồ thể loai
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    // thống kê
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $chartDataJson; ?>);
        var options = {
            title: 'Số Sản Phẩm Của Các Danh Mục Sản Phẩm',
            is3D: true,
            colors: ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#DAF7A6'],
            fontName: 'Poppins',
            pieSliceText: 'percentage',
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>

<body>
    <div id="piechart_3d" style="width: 900px; height:500px" class="chart"></div>
</body>