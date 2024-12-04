<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng số lượng sản phẩm</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");
        #pieChart1,
        #pieChart2 {
            width: 350px !important;
            height: 350px !important;
        }

        .canvas-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .canvas-container canvas {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: 300px;
            border: 3px solid #f0f0f0;
            border-radius: 12px;
        }
        .chart-title {
            font-size: 30px;
            font-family: 'Poppins',sans-serif;
            display: flex; 
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="canvas-container">
        <canvas id="pieChart1" class="soluong1"></canvas>
        <canvas id="pieChart2" class="soluong2"></canvas>
    </div>
    <div class="chart-title">
        <h5 style="padding-left:155px">Tổng số lượng sản phẩm</h5>
        <h5 style="padding-right:100px">Tổng số lượng size của sản phẩm</h5>
    </div>
    <script>
        var totalStock = <?php echo json_encode($soluong1['TotalStock']); ?>;
        var barColors = ["blue"];
        var borderColors = ['black'];

        new Chart("pieChart1", {
            type: "pie",
            data: {
                labels: ["Tống số lượng sản phẩm"],
                datasets: [{
                    data: [totalStock],
                    backgroundColor: barColors,
                    borderColor: borderColors,
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `Tổng số lượng sản phẩm: ${tooltipItem.raw}`;
                            }
                        }
                    }
                },
            }
        });
        // số lượng size của sản phẩm
        var sizeLabels = <?php echo json_encode(array_column($soluong2, 'Size')); ?>;
        var stockQuantities = <?php echo json_encode(array_column($soluong2, 'TotalStock')); ?>;
        var barColors = ["lightblue", "green", "brown", "black", "yellow"];
        var borderColors = ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)", "rgba(153, 102, 255, 1)"];
        new Chart("pieChart2", {
            type: "pie",
            data: {
                labels: sizeLabels,
                datasets: [{
                    data: stockQuantities,
                    backgroundColor: barColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const percentage = ((tooltipItem.raw / tooltipItem.dataset._meta[0].total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage}%)`;
                            }
                        }
                    },
                }
            }
        });
    </script>
</body>

</html>