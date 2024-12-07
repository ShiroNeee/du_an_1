<html>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    .chart-container {
        display: flex;
        flex-wrap:wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .chart {
        width: 100%;
        max-width: 600px;
        height: 500px;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="chart-container">
        <div id="myChart" class="chart" style="padding-left:100px"></div>
        <div id="myChart2" class="chart" style="padding-right:100px"></div>
        <div id="myChart3" class="chart" style="padding-left:100px"></div>
        <div id="myChart4" class="chart" style="padding-right:100px"></div>
    </div>

    <script>
        // Doanh thu theo năm
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawYearlyChart);

        function drawYearlyChart() {
            const doanhThuData = <?php echo json_encode($data1); ?>;

            const data = [
                ['Năm', 'Doanh Thu']
            ];
            doanhThuData.forEach(row => {
                data.push([row.Nam.toString(), parseFloat(row.DoanhThu)]);
            });

            const chartData = google.visualization.arrayToDataTable(data);

            const options = {
                title: 'Doanh Thu Theo Năm',
                vAxis: {
                    title: 'Doanh Thu (Vnd)'
                },
                legend: 'none'
            };

            const chart = new google.visualization.LineChart(document.getElementById('myChart'));
            chart.draw(chartData, options);
        }

        // Doanh thu theo tháng
        google.charts.setOnLoadCallback(drawMonthlyChart);

        function drawMonthlyChart() {
            const doanhThuData = <?php echo json_encode($data2); ?>;

            const data = [
                ['Tháng', 'Doanh Thu Đơn Hàng']
            ];
            doanhThuData.forEach(row => {
                data.push([row.Thang, parseFloat(row.DoanhThu)]);
            });

            const chartData = google.visualization.arrayToDataTable(data);

            const options = {
                title: 'Doanh Thu Theo Tháng',
                vAxis: {
                    title: 'Doanh Thu (Vnd)'
                },
                legend: 'none'
            };

            const chart = new google.visualization.LineChart(document.getElementById('myChart2'));
            chart.draw(chartData, options);
        }
        // Doanh thu theo tuần
        function drawWeekChart() {
            const data = [
                ['Tuần', 'Doanh Thu Đơn Hàng']
            ];
            <?php foreach ($data3 as $row): ?>
                data.push(['<?php echo $row['Nam'] . "-Tuần " . $row['Tuan']; ?>', <?php echo $row['DoanhThu']; ?>]);
            <?php endforeach; ?>

            const chartData = google.visualization.arrayToDataTable(data);
            const options = {
                title: 'Doanh Thu Theo Tuần',
                vAxis: {
                    title: 'Doanh Thu (Vnd)'
                }
            };
            const chart = new google.visualization.LineChart(document.getElementById('myChart3'));
            chart.draw(chartData, options);
        }
        google.charts.setOnLoadCallback(drawWeekChart);

        // Doanh thu theo ngày
        function drawDayChart() {
            const data = [
                ['Ngày', 'Doanh Thu Đơn Hàng']
            ];
            <?php foreach ($data4 as $row): ?>
                data.push(['<?php echo $row['Ngay']; ?>', <?php echo $row['DoanhThu']; ?>]);
            <?php endforeach; ?>

            const chartData = google.visualization.arrayToDataTable(data);
            const options = {
                title: 'Doanh Thu Theo Ngày',
                vAxis: {
                    title: 'Doanh Thu (Vnd)'
                }
            };
            const chart = new google.visualization.LineChart(document.getElementById('myChart4'));
            chart.draw(chartData, options);
        }
        google.charts.setOnLoadCallback(drawDayChart);
    </script>
</body>

</html>