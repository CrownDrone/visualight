<?php
use backend\modules\chart\controllers\ChartController;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Brand Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .chart-container {
            margin: 10px;
            padding: 10px;
            border-radius: 15px;
            background-color: white;
            display: inline-block;
            height: 40vh;
            width: 35vw; 
        }

        .chart-container canvas {
            background-color: white;
            border-radius: 15px;
        }
        body.dark-mode .chart-container {
            background-color: black;
        }
        body.dark-mode .chart-container canvas {
            background-color: black;}


        @media (max-width: 900px) {
            .chart-container {
                flex-basis: 100%;
                max-width: 100%;
                width: 100%;
                display: block; /* Change to block to stack vertically */
            }
        }
    </style>
</head>
<body>
    <div class="chart-container" >
        <canvas id="barChart" data-chart-data="
        <?= htmlspecialchars(json_encode($barChartData), ENT_QUOTES, 'UTF-8') ?>"></canvas>
    </div>

    <div class="chart-container" >
        <canvas id="pieChart" data-chart-data="
        <?= htmlspecialchars(json_encode($pieChartData), ENT_QUOTES, 'UTF-8') ?>"></canvas>
    </div>

    <script>
        // Get the data from the canvas element data attribute for both bar and pie charts
        var barChartData = JSON.parse(document.getElementById('barChart').getAttribute('data-chart-data'));
        var pieChartData = JSON.parse(document.getElementById('pieChart').getAttribute('data-chart-data'));

        // Prepare the bar chart
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
            type: 'bar',
            data: barChartData,
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                        grid: {
                            display: false,
                        },
                    },
                    x: {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 7,
                        },
                        grid: {
                            display: false,
                        },
                    },
                },
                plugins: {
                    title:{
                        display: true,
                        text: 'Car Brands Total Order per Year',
                    },
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15,
                    },
                },
            },
        });

        // Prepare the pie chart
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: pieChartData,
            options: {
                maintainAspectRatio: false,
                plugins: {
                    title:{
                        display: true,
                        text: 'Car Brands General Total Order',
                    },
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15,
                    },
                },
            },
        });
    </script>
</body>
</html>