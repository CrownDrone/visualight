<?php
use yii\bootstrap5\Html;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\View;



?>

<style>
        .chart-container {
            margin: 0.5rem;
            padding-bottom: 1rem;
            padding: 1rem;
            padding-left: 3rem;
            border-radius: 1rem;
            background-color: white;
            display: inline-block;
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
                background-color: white;
                width: 100%;
                display: block;
                /* Change to block to stack vertically */
            }
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


   <div class="prediction-index">
        <h1><?= Html::encode($this->title) ?></h1>

        <form id="prediction-form">
            <label for="years">Enter the number of years for predictions:</label>
            <input type="number" id="years" name="years" step="0.01" value="">
            <button type="submit">Compute Predictions</button>
        </form>

        
<!-- Total -->
<h3> Total Transaction Counts per Month </h3>

<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> National Metrology Division </p>
    <canvas id="transaction-chart4" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> Standards and Testing Division </p>
    <canvas id="transaction-chart8" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container">
    <canvas id="transaction-chart" style="width: 65rem; height: 20rem;" ></canvas>
</div>
<br>



<h3> Total Transaction Counts  </h3>
<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> National Metrology Division </p>
    <canvas id="transaction-chart5" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> Standards and Testing Division </p>
    <canvas id="transaction-chart9" style="width: 30rem; height: 20rem;" ></canvas>
</div>
<div class="chart-container " style="width: 69rem; height: 30rem;display: flex; justify-content: center; align-items: center;">
    <canvas id="transaction-chart1" style="width: 30rem; height: 20rem;" ></canvas>
</div>
<br>


<h3> Total Income per Month </h3>
<div class="chart-container">
    <p style="display: flex; justify-content: center; align-items: center;"> National Metrology Division </p>
    <canvas id="transaction-chart6" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> Standards and Testing Division </p>
    <canvas id="transaction-chart10" style="width: 30rem; height: 20rem;" ></canvas>
</div>
<div class="chart-container">
    <canvas id="transaction-chart2" style="width: 65rem; height: 20rem;" ></canvas>
</div>
<br> 



<h3> Total Income</h3>
<div class="chart-container">
    <p style="display: flex; justify-content: center; align-items: center;"> National Metrology Division </p>
    <canvas id="transaction-chart7" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container">
<p style="display: flex; justify-content: center; align-items: center;"> Standards and Testing Division </p>
    <canvas id="transaction-chart11" style="width: 30rem; height: 20rem;" ></canvas>
</div>

<div class="chart-container " style="width: 69rem; height: 30rem;display: flex; justify-content: center; align-items: center;">
    <canvas id="transaction-chart3" style="width: 30rem; height: 20rem;" ></canvas>
</div>


    </div>


<?php

$chartDb = Yii::$app->db_data;


$sql1 = "
    WITH RECURSIVE AllMonths AS (
        SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
        FROM transaction
        UNION ALL
        SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
        FROM AllMonths
        WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
    )
    SELECT
        AllMonths.last_month AS month_date,
        IFNULL(SUM(CASE WHEN t.transaction_status = 1 OR t.transaction_status = 3 THEN 1 ELSE 0 END), 0) AS paid_and_pending_count
    FROM AllMonths
    LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month
    GROUP BY AllMonths.last_month
    ORDER BY AllMonths.last_month;
";

$transactions = $chartDb->createCommand($sql1)->queryAll();

$sql2 = "
    WITH RECURSIVE AllMonths AS (
        SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
        FROM transaction
        UNION ALL
        SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
        FROM AllMonths
        WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
    )
    SELECT
        AllMonths.last_month AS month_date,
        ROUND(IFNULL(SUM(CASE WHEN t.transaction_status = 1 THEN t.amount ELSE 0 END), 0)) AS total_amount_paid
    FROM AllMonths
    LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month
    GROUP BY AllMonths.last_month
    ORDER BY AllMonths.last_month;


";

$transactions2 = $chartDb->createCommand($sql2)->queryAll();

// NMD

$sql3 = "
    WITH RECURSIVE AllMonths AS (
        SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
        FROM transaction
        UNION ALL
        SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
        FROM AllMonths
        WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
    )
    SELECT
        AllMonths.last_month AS month_date,
        IFNULL(SUM(CASE WHEN t.transaction_status = 1 OR t.transaction_status = 3 THEN 1 ELSE 0 END), 0) AS paid_and_pending_count
    FROM AllMonths
    LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month AND t.division = (SELECT id FROM division WHERE division_code = 'NMD')
    GROUP BY AllMonths.last_month
    ORDER BY AllMonths.last_month;


";

$transactions3 = $chartDb->createCommand($sql3)->queryAll();

$sql4 = "
WITH RECURSIVE AllMonths AS (
    SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
    FROM transaction
    UNION ALL
    SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
    FROM AllMonths
    WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
)
SELECT
    AllMonths.first_month AS month_date,
    ROUND(IFNULL(SUM(CASE WHEN t.transaction_status = 1 THEN t.amount ELSE 0 END), 0)) AS total_amount_paid
FROM AllMonths
LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month AND t.division = (SELECT id FROM division WHERE division_code = 'NMD')
GROUP BY AllMonths.last_month
ORDER BY AllMonths.last_month;

";

$transactions4 = $chartDb->createCommand($sql4)->queryAll();

// STD

$sql5 = "
    WITH RECURSIVE AllMonths AS (
        SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
        FROM transaction
        UNION ALL
        SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
        FROM AllMonths
        WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
    )
    SELECT
        AllMonths.last_month AS month_date,
        IFNULL(SUM(CASE WHEN t.transaction_status = 1 OR t.transaction_status = 3 THEN 1 ELSE 0 END), 0) AS paid_and_pending_count
    FROM AllMonths
    LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month AND t.division = (SELECT id FROM division WHERE division_code = 'STD')
    GROUP BY AllMonths.last_month
    ORDER BY AllMonths.last_month;


";

$transactions5 = $chartDb->createCommand($sql5)->queryAll();

$sql6 = "
WITH RECURSIVE AllMonths AS (
    SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
    FROM transaction
    UNION ALL
    SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
    FROM AllMonths
    WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
)
SELECT
    AllMonths.first_month AS month_date,
    ROUND(IFNULL(SUM(CASE WHEN t.transaction_status = 1 THEN t.amount ELSE 0 END), 0)) AS total_amount_paid
FROM AllMonths
LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month AND t.division = (SELECT id FROM division WHERE division_code = 'STD')
GROUP BY AllMonths.last_month
ORDER BY AllMonths.last_month;

";

$transactions6 = $chartDb->createCommand($sql6)->queryAll();


?>
<script>

     var ctx = document.getElementById('transaction-chart').getContext('2d');
     var transactionChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted Transaction Total per Month',
                data: [],
                borderColor: 'rgb(0, 115, 230)',
                backgroundColor: 'rgb(0, 115, 230)',
                fill: true
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });


    function updateChart(labels, data) {
        transactionChart.data.labels = labels;
        transactionChart.data.datasets[0].data = data;
        transactionChart.update();
    }

    
    var ctx1 = document.getElementById('transaction-chart1').getContext('2d');
    var transactionChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Predicted Total Transaction ', 'Current Total Transaction'],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(0, 115, 230)', 'rgb(255, 119, 51)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart1(data) {
    transactionChart1.data.datasets[0].data = data;
    transactionChart1.update();
}
    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var years = parseFloat(document.getElementById('years').value);

// Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions as $transaction) { ?>
            dataPoints.push([<?php echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['paid_and_pending_count']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        console.log(dataPoints);

        // Calculate the predicted transaction count for the entered number of years starting from next month
        var predictedCounts = [];
        var totalPredictedSum = 0; // To calculate the total sum of predicted counts
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        var predictedLabels = []; // Array to hold labels for predicted months
        var predictedValues = []; // Array to hold predicted transaction counts
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedCount = Math.round(regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1]);

            predictedLabels.push(new Date(futureTimestamp).toDateString());
            predictedValues.push(predictedCount);
            totalPredictedSum += predictedCount; // Add to the total sum
        }

        // Calculate the current transaction sum
        var currentTransactionSum = 0;
        <?php foreach ($transactions as $transaction) { ?>
            currentTransactionSum += <?php echo $transaction['paid_and_pending_count']; ?>;
        <?php } ?>

        // Display the predictions
        var resultsDiv = document.getElementById('prediction-results');
        for (var j = 0; j < predictedLabels.length; j++) {
            var predictionDate = new Date(predictedLabels[j]);
        }

        updateChart(predictedLabels, predictedValues);
        updateChart1([totalPredictedSum, currentTransactionSum]);


    });

    
</script>

<script>
    var ctx2 = document.getElementById('transaction-chart2').getContext('2d');
     var transactionChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted Total Income per Month',
                data: [],
                borderColor: 'rgb(0, 115, 230)',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                fill: true,
                cubicInterpolationMode: 'monotone'
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });
    
    // Function to update the chart data
    function updateChart2(labels, data) {
        transactionChart2.data.labels = labels;
        transactionChart2.data.datasets[0].data = data;
        transactionChart2.update();
    }


    var ctx3 = document.getElementById('transaction-chart3').getContext('2d');
    var transactionChart3 = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: ['Predicted Total Income ', 'Current Total Income '],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(0, 115, 230)', 'rgb(255, 119, 51)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart3(data) {
    transactionChart3.data.datasets[0].data = data;
    transactionChart3.update();
}

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    var alpha = 0.2; // Smoothing factor (0 < alpha < 1)
    var totalPredictedIncome = 0; // Total predicted income sum

    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var years = parseFloat(document.getElementById('years').value);

        // Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions2 as $transaction) { ?>
            dataPoints.push([<?php  echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['total_amount_paid']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        // Calculate the predicted income amount for the entered number of years starting from next month
        var predictedIncomeLabels = [];
        var predictedIncomeValues = [];
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedAmount = regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1];
            
            // Apply exponential smoothing to predicted amounts (adjust alpha value as needed)
            if (predictedIncomeValues.length > 0) {
                predictedAmount = alpha * predictedAmount + (1 - alpha) * predictedIncomeValues[predictedIncomeValues.length - 1];
            }
            
            predictedIncomeLabels.push(new Date(futureTimestamp).toDateString());
            predictedIncomeValues.push(predictedAmount);
            totalPredictedIncome += predictedAmount; // Add to the total sum
        }

        var currentTotalIncome = 0;
        <?php foreach ($transactions2 as $transaction) { ?>
            currentTotalIncome += <?php echo $transaction['total_amount_paid']; ?>;
        <?php } ?>

        // Display the predictions for income
        var resultsDiv = document.getElementById('prediction-results1');
        var totalPredictedIncomeLoop = 0; // Initialize the total

        // Loop to display predicted income and calculate total
        for (var j = 0; j < predictedIncomeLabels.length; j++) {
            var predictionDate = new Date(predictedIncomeLabels[j]);
            var predictedValue = parseFloat(predictedIncomeValues[j].toFixed(0));

                totalPredictedIncomeLoop += predictedValue; // Add to the total
            
        }

        updateChart2(predictedIncomeLabels, predictedIncomeValues)

        updateChart3([totalPredictedIncomeLoop, currentTotalIncome]);
    });
</script>


<!-- NMD -->

<script>

     var ctx4 = document.getElementById('transaction-chart4').getContext('2d');
     var transactionChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted Transaction Total of NMD per Month',
                data: [],
                borderColor: 'rgb(6, 214, 160)',
                backgroundColor: 'rgb(6, 214, 160)',
                fill: true
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });


    function updateChart4(labels, data) {
        transactionChart4.data.labels = labels;
        transactionChart4.data.datasets[0].data = data;
        transactionChart4.update();
    }

    
    var ctx5 = document.getElementById('transaction-chart5').getContext('2d');
    var transactionChart5 = new Chart(ctx5, {
        type: 'doughnut',
        data: {
            labels: ['Predicted Total Transaction NMD', 'Current Total Transaction NMD'],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(6, 214, 160)', 'rgb(255, 214, 51)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart5(data) {
    transactionChart5.data.datasets[0].data = data;
    transactionChart5.update();
}


    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
       var years = parseFloat(document.getElementById('years').value);

// Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions3 as $transaction) { ?>
            dataPoints.push([<?php echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['paid_and_pending_count']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        console.log(dataPoints);

        // Calculate the predicted transaction count for the entered number of years starting from next month
        var predictedCounts = [];
        var totalPredictedSum = 0; // To calculate the total sum of predicted counts
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        var predictedLabels = []; // Array to hold labels for predicted months
        var predictedValues = []; // Array to hold predicted transaction counts
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedCount = Math.round(regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1]);

            predictedLabels.push(new Date(futureTimestamp).toDateString());
            predictedValues.push(predictedCount);
            totalPredictedSum += predictedCount; // Add to the total sum
        }

        // Calculate the current transaction sum
        var currentTransactionSum = 0;
        <?php foreach ($transactions3 as $transaction) { ?>
            currentTransactionSum += <?php echo $transaction['paid_and_pending_count']; ?>;
        <?php } ?>

        // Display the predictions
        var resultsDiv = document.getElementById('prediction-results');
        for (var j = 0; j < predictedLabels.length; j++) {
            var predictionDate = new Date(predictedLabels[j]);
        }

        updateChart4(predictedLabels, predictedValues);
        updateChart5([totalPredictedSum, currentTransactionSum]);

    });

    
</script>


<script>
    var ctx6 = document.getElementById('transaction-chart6').getContext('2d');
     var transactionChart6 = new Chart(ctx6, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted NMD Total Income per Month',
                data: [],
                borderColor: 'rgb(6, 214, 160)',
                backgroundColor: 'rgb(255, 255, 255)',
                fill: true,
                cubicInterpolationMode: 'monotone'
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });
    
    // Function to update the chart data
    function updateChart6(labels, data) {
        transactionChart6.data.labels = labels;
        transactionChart6.data.datasets[0].data = data;
        transactionChart6.update();
    }


    var ctx7 = document.getElementById('transaction-chart7').getContext('2d');
    var transactionChart7 = new Chart(ctx7, {
        type: 'pie',
        data: {
            labels: ['Predicted Total Income NMD', 'Current Total Income  NMD'],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(6, 214, 160)', 'rgb(255, 214, 51)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart7(data) {
    transactionChart7.data.datasets[0].data = data;
    transactionChart7.update();
}

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    var alpha = 0.2; // Smoothing factor (0 < alpha < 1)
    var totalPredictedIncome = 0; // Total predicted income sum

    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var years = parseFloat(document.getElementById('years').value);

        // Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions4 as $transaction) { ?>
            dataPoints.push([<?php  echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['total_amount_paid']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        // Calculate the predicted income amount for the entered number of years starting from next month
        var predictedIncomeLabels = [];
        var predictedIncomeValues = [];
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedAmount = regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1];
            
            // Apply exponential smoothing to predicted amounts (adjust alpha value as needed)
            if (predictedIncomeValues.length > 0) {
                predictedAmount = alpha * predictedAmount + (1 - alpha) * predictedIncomeValues[predictedIncomeValues.length - 1];
            }
            
            predictedIncomeLabels.push(new Date(futureTimestamp).toDateString());
            predictedIncomeValues.push(predictedAmount);
            totalPredictedIncome += predictedAmount; // Add to the total sum
        }

        var currentTotalIncome = 0;
        <?php foreach ($transactions4 as $transaction) { ?>
            currentTotalIncome += <?php echo $transaction['total_amount_paid']; ?>;
        <?php } ?>

        // Display the predictions for income
        var resultsDiv = document.getElementById('prediction-results1');
        var totalPredictedIncomeLoop = 0; // Initialize the total

        // Loop to display predicted income and calculate total
        for (var j = 0; j < predictedIncomeLabels.length; j++) {
            var predictionDate = new Date(predictedIncomeLabels[j]);
            var predictedValue = parseFloat(predictedIncomeValues[j].toFixed(0));
            
            totalPredictedIncomeLoop += predictedValue; // Add to the total
            
        }

        updateChart6(predictedIncomeLabels, predictedIncomeValues)

        updateChart7([totalPredictedIncomeLoop, currentTotalIncome]);
    });
</script>



<!-- STD -->

<script>

     var ctx8 = document.getElementById('transaction-chart8').getContext('2d');
     var transactionChart8 = new Chart(ctx8, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted Transaction Total of STD per Month',
                data: [],
                borderColor: 'rgb(114, 9, 183)',
                backgroundColor: 'rgb(114, 9, 183)',
                fill: true
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });


    function updateChart8(labels, data) {
        transactionChart8.data.labels = labels;
        transactionChart8.data.datasets[0].data = data;
        transactionChart8.update();
    }

    
    var ctx9 = document.getElementById('transaction-chart9').getContext('2d');
    var transactionChart9 = new Chart(ctx9, {
        type: 'doughnut',
        data: {
            labels: ['Predicted Total Transaction STD', 'Current Total Transaction STD'],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(114, 9, 183)', 'rgb(255, 77, 166)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart9(data) {
    transactionChart9.data.datasets[0].data = data;
    transactionChart9.update();
}


    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var years = parseFloat(document.getElementById('years').value);

// Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions5 as $transaction) { ?>
            dataPoints.push([<?php echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['paid_and_pending_count']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        console.log(dataPoints);

        // Calculate the predicted transaction count for the entered number of years starting from next month
        var predictedCounts = [];
        var totalPredictedSum = 0; // To calculate the total sum of predicted counts
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        var predictedLabels = []; // Array to hold labels for predicted months
        var predictedValues = []; // Array to hold predicted transaction counts
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedCount = Math.round(regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1]);

            predictedLabels.push(new Date(futureTimestamp).toDateString());
            predictedValues.push(predictedCount);
            totalPredictedSum += predictedCount; // Add to the total sum
        }

        // Calculate the current transaction sum
        var currentTransactionSum = 0;
        <?php foreach ($transactions5 as $transaction) { ?>
            currentTransactionSum += <?php echo $transaction['paid_and_pending_count']; ?>;
        <?php } ?>

        // Display the predictions
        var resultsDiv = document.getElementById('prediction-results');
        for (var j = 0; j < predictedLabels.length; j++) {
            var predictionDate = new Date(predictedLabels[j]);
        }
        updateChart8(predictedLabels, predictedValues);
        updateChart9([totalPredictedSum, currentTransactionSum]);

    });

    
</script>


<script>
    var ctx10 = document.getElementById('transaction-chart10').getContext('2d');
     var transactionChart10 = new Chart(ctx10, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Predicted STD Total Income per Month',
                data: [],
                borderColor: 'rgb(114, 9, 183)',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                fill: true,
                cubicInterpolationMode: 'monotone'
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Display the X-axis
                    grid: {
                        display: false // Hide x-axis gridlines
                    }
                },
                y: {
                    display: true, // Display the Y-axis
                    beginAtZero: true, // Start Y-axis at 0
                     grid: {
                        display: false // Hide x-axis gridlines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            }
        }
    });
    
    // Function to update the chart data
    function updateChart10(labels, data) {
        transactionChart10.data.labels = labels;
        transactionChart10.data.datasets[0].data = data;
        transactionChart10.update();
    }


    var ctx11 = document.getElementById('transaction-chart11').getContext('2d');
    var transactionChart11 = new Chart(ctx11, {
        type: 'pie',
        data: {
            labels: ['Predicted Total Income STD', 'Current Total Income STD'],
            datasets: [{
                data: [],
                backgroundColor: ['rgb(114, 9, 183)', 'rgb(255, 77, 166)'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

function updateChart11(data) {
    transactionChart11.data.datasets[0].data = data;
    transactionChart11.update();
}

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    var alpha = 0.2; // Smoothing factor (0 < alpha < 1)
    var totalPredictedIncome = 0; // Total predicted income sum

    document.getElementById('prediction-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var years = parseFloat(document.getElementById('years').value);

        // Prepare the historical data for linear regression
        var dataPoints = [];
        <?php foreach ($transactions6 as $transaction) { ?>
            dataPoints.push([<?php  echo strtotime($transaction['month_date']) * 1000; ?>, <?php echo $transaction['total_amount_paid']; ?>]);
        <?php } ?>

        // Perform linear regression using a simple linear model (y = mx + b)
        function linearRegression(data) {
            var sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
            var n = data.length;
            
            for (var i = 0; i < n; i++) {
                sumX += data[i][0];
                sumY += data[i][1];
                sumXY += data[i][0] * data[i][1];
                sumX2 += data[i][0] * data[i][0];
            }
            
            var m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
            var b = (sumY - m * sumX) / n;
            
            return [m, b];
        }

        // Calculate linear regression coefficients
        var regressionCoefficients = linearRegression(dataPoints);

        // Calculate the predicted income amount for the entered number of years starting from next month
        var predictedIncomeLabels = [];
        var predictedIncomeValues = [];
        var nextMonthTimestamp = dataPoints[dataPoints.length - 1][0] + 2592000000; // Next month in milliseconds
        for (var i = 1; i <= years * 12; i++) {
            var futureTimestamp = nextMonthTimestamp + (i * 2592000000); // 30 days in milliseconds
            var predictedAmount = regressionCoefficients[0] * futureTimestamp + regressionCoefficients[1];
            
            // Apply exponential smoothing to predicted amounts (adjust alpha value as needed)
            if (predictedIncomeValues.length > 0) {
                predictedAmount = alpha * predictedAmount + (1 - alpha) * predictedIncomeValues[predictedIncomeValues.length - 1];
            }
            
            predictedIncomeLabels.push(new Date(futureTimestamp).toDateString());
            predictedIncomeValues.push(predictedAmount);
            totalPredictedIncome += predictedAmount; // Add to the total sum
        }

        var currentTotalIncome = 0;
        <?php foreach ($transactions6 as $transaction) { ?>
            currentTotalIncome += <?php echo $transaction['total_amount_paid']; ?>;
        <?php } ?>

        // Display the predictions for income
        var resultsDiv = document.getElementById('prediction-results1');
        var totalPredictedIncomeLoop = 0; // Initialize the total

        // Loop to display predicted income and calculate total
        for (var j = 0; j < predictedIncomeLabels.length; j++) {
            var predictionDate = new Date(predictedIncomeLabels[j]);
            var predictedValue = parseFloat(predictedIncomeValues[j].toFixed(0));
            
                totalPredictedIncomeLoop += predictedValue; // Add to the total
            
        }

        updateChart10(predictedIncomeLabels, predictedIncomeValues)

        updateChart11([totalPredictedIncomeLoop, currentTotalIncome]);
    });
</script>



