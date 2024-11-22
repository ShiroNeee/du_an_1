<?php
// dữ liệu thống kê
$chartData = [
    ['Danh mục sản phẩm', 'Số lượng'],
    ['nam', 50],
    ['nữ', 40],
    ['phụ kiện', 50],
];
$chartDataJson = json_encode($chartData);

// in ra
// echo "<pre>";
// var_dump($chartData);
?>
<style>
    body{
        background-color: white;
    }
    .chart{
        margin-left: 200px;
        margin-top:50px;
        border-radius:20px;
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
            title: 'Số sản phẩm của các danh mục sản phẩm',
            is3D: true
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>

<body>
    <div id="piechart_3d" style="width: 900px; height:500px" class="chart"></div>
</body>