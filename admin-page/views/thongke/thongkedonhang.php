<?php

$model = new ThongKeModel();
$data = $model->tongDoanhThuMonth(); // Lấy dữ liệu doanh thu theo tháng
$data2 = $model->tongDoanhThuDay(); // Lấy dữ liệu doanh thu theo ngày
?>
<!DOCTYPE html>
<html>

<head>
    <title>Biểu đồ Doanh Thu (chart)</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        .canvas-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
            margin-bottom: 100px;
        }

        .canvas-wrapper {
            flex: 1;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .canvas-container canvas {
            width: 100%;
            max-width: 600px;
            background-color: #eeeeee;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="canvas-container">
        <canvas class="bieudo1" id="myChart1" style="width:100%;max-width:600px"></canvas>
        <canvas class="bieudo2" id="myChart2" style="width:100%;max-width:600px"></canvas>
        <canvas class="bieudo3" id="myChart3" style="width:100%;max-width:600px"></canvas>
    </div>
    <script>
        // Biểu đồ doanh thu theo tháng
        var xValuesMonth = <?php echo json_encode(array_column($data, 'Month')); ?>;
        var yValuesMonth = <?php echo json_encode(array_column($data, 'TotalRevenue')); ?>;

        var barColors = ["blue", "green", "red", "orange", "brown"];
        new Chart("myChart1", {
            type: "bar",
            data: {
                labels: xValuesMonth,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValuesMonth
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Doanh Thu Đơn Hàng Theo Tháng",
                    fontSize: 18,
                    padding: 20
                }
            }
        });
        // Biểu đồ doanh thu theo tuần
        var xValuesWeek = <?php echo json_encode(array_column($data, 'Week')); ?>;
        var yValuesWeek = <?php echo json_encode(array_column($data, 'TotalRevenue')); ?>;
        var barColors = ["blue", "green", "red", "orange", "brown"];
        new Chart("myChart3", {
            type: "bar",
            data: {
                labels: xValuesWeek,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValuesWeek
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Doanh Thu Đơn Hàng Theo Tuần",
                    fontSize: 18,
                    padding: 20
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Tuần'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Doanh thu (VND)'
                        }
                    }]
                }
            }
        });
        // Biểu đồ doanh thu theo ngày
        var xValues = <?php echo json_encode(array_column($data, 'Day')); ?>;
        var yValues = <?php echo json_encode(array_column($data, 'TotalRevenue')); ?>;
        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: "Doanh thu (VND)",
                    data: yValues,
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Doanh Thu Đơn Hàng Theo Ngày",
                    fontSize: 18
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Ngày'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Doanh thu (VND)'
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>