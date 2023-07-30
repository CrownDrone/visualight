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
            margin: 0.5rem;
            padding-bottom: 1rem;
            padding: 1rem;
            border-radius: 1rem;
            background-color: white;
            display: inline-block;
            height: 25rem;
            width: 90%;
        }

        /* .chart-container canvas {
            background-color: white;
            border-radius: 5px;
        } */

        body.dark-mode .chart-container {
            background-color: black;
        }

        body.dark-mode .chart-container canvas {
            background-color: black;
        }


        @media (max-width: 900px) {
            .chart-container {
                flex-basis: 100%;
                max-width: 100%;
                width: 100%;
                display: block;
                /* Change to block to stack vertically */
            }
        }
    </style>
</head>

<body><!-- removed direct declaration of chart from controller -->
    <div class="chart-container">
        <a> From </a>
        <select name="startDate" id="startDate" onchange="filterData()">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <a> To </a>
        <select name="endDate" id="endDate" onchange="filterData()">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <br>
        <canvas id="barChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="pieChart"></canvas>
    </div>
    
    <script>
        // Get the data from the canvas element data attribute for both bar and pie charts
        const barChartData = (<?= json_encode($barChartData)?>);//eto rekta na tawag from array to json
        const pieChartData = (<?= json_encode($pieChartData)?>);//di ma edit pag sa html declared yung canvas/chart
        //testing lang extract
        const barLabelArray = barChartData.labels;
        const barDataArray = barChartData.datasets;
        // Prepare the bar chart 
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barLabelArray,
                datasets: barDataArray//reminder, filter this thing later at DOST it causes to post labels even without the labels:barLabelArray
            },
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
                    title: {
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
                    title: {
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

        function filterData() {
            //logs to see if I am not hallucinating
            const barLabel = [...barLabelArray];//duplicate array
            console.log(barChartData);
            const startDate = document.getElementById('startDate');//retrieve selected year
            const endDate = document.getElementById('endDate');

            const pickStartDate = barLabel.indexOf(startDate.value);//pass selected year
            const pickEndDate = barLabel.indexOf(endDate.value);

            console.log(pickStartDate);
            console.log(pickEndDate);
            //slice array based on selected year
            const filterDate = barLabel.slice(pickStartDate, pickEndDate + 1);
            console.log(filterDate);
            //replace labels hopefully
            barChart.data.labels = filterDate;

            barChart.data.labels.splice(0, barChart.data.labels.length, ...filterDate);
            
            barChart.update();
            pieChart.update();
        }
    </script>
</body>

</html>