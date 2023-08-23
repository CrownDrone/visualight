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
            height: 25rem;
            width: 40%;
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
            <input type="number" id="years" name="years" step="0.001" value="">
            <button type="submit">Compute Predictions</button>
        </form>

        <div id="predictions" style="font-weight: bold; "></div> <br>
        <div id="predictions1" style="font-weight: bold;"></div> 
        <div id="predictions2" style="font-weight: bold;"></div> <br>
        <div id="predictions3" style="font-weight: bold;"></div> 
        <div id="predictions4" style="font-weight: bold;"></div><br>
        <div id="predictions5" style="font-weight: bold;"></div><br>
        <div id="predictions6" style="font-weight: bold;"></div><br>


    </div>


<?php

// $chartDb = Yii::$app->db_data;


// $sql = "
//     WITH RECURSIVE AllMonths AS (
//         SELECT MAX(DATE_FORMAT(transaction_date, '%Y-%m-01')) AS last_month
//         FROM transaction
//         UNION ALL
//         SELECT DATE_FORMAT(DATE_ADD(last_month, INTERVAL -1 MONTH), '%Y-%m-01')
//         FROM AllMonths
//         WHERE last_month >= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL -11 MONTH), '%Y-%m-01')  -- Show last 12 months
//     )
//     SELECT
//         AllMonths.last_month AS month_date,
//         IFNULL(SUM(CASE WHEN t.transaction_status = 1 OR t.transaction_status = 3 THEN 1 ELSE 0 END), 0) AS paid_and_pending_count
//     FROM AllMonths
//     LEFT JOIN transaction t ON DATE_FORMAT(t.transaction_date, '%Y-%m-01') = AllMonths.last_month
//     GROUP BY AllMonths.last_month
//     ORDER BY AllMonths.last_month;
// ";

// $transactions = $chartDb->createCommand($sql)->queryAll();

// var_dump($transactions);



?>



<?php

 //$chartDb = Yii::$app->db_data;

//  $sql = "
//     SELECT 
//         dates.date AS transacton_date,
//         IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count,
//         IFNULL(SUM(opr.amount), 0) AS total_sales
//     FROM (
//         SELECT DATE_ADD('2023-06-10', INTERVAL a.n + b.n * 10 + c.n * 100 DAY) AS date
//         FROM (
//             SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
//         ) AS a,
//         (
//             SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
//         ) AS b,
//         (
//             SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
//         ) AS c
//     ) AS dates
//     LEFT JOIN operational_report opr ON dates.date = opr.transacton_date AND opr.transaction_status = 'paid'
//     GROUP BY dates.date
//     ORDER BY dates.date ASC
// ";

//  $transactions = $chartDb->createCommand($sql)->queryAll();

// // Convert timestamps to Unix timestamps
// foreach ($transactions as &$transaction) {
//     $transaction['transacton_date'] = strtotime($transaction['transacton_date']);
// }

// $latestTimestamp = end($transactions)['transacton_date'];

// // Define $nextDayTimestamp using the latestTimestamp
// $nextDayTimestamp = strtotime('+1 day', $latestTimestamp);

// // Prepare data for prediction (transaction count)
// $timestampsForCount = array_column($transactions, 'transacton_date');
// $transactionCounts = array_column($transactions, 'transaction_count');
//     // Calculate linear regression coefficients for transaction count prediction
//     $n = count($timestampsForCount);
//     $sumX = array_sum($timestampsForCount);
//     $sumY = array_sum($transactionCounts);
//     $sumXY = 0;
//     $sumX2 = 0;

//     for ($i = 0; $i < $n; $i++) {
//         $sumXY += $timestampsForCount[$i] * $transactionCounts[$i];
//         $sumX2 += $timestampsForCount[$i] * $timestampsForCount[$i];
//     }



//     $slopeForCount = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
//     $interceptForCount = ($sumY - $slopeForCount * $sumX) / $n;
    
//     // Predict the next transaction count for the next day
//     $predictedTransactionCount = $interceptForCount + $slopeForCount * $nextDayTimestamp;

//     // Prepare data for prediction (total sales)
//     $timestampsForSales = array_column($transactions, 'transacton_date');
//     $totalSales = array_column($transactions, 'total_sales');

//     // Calculate linear regression coefficients for total sales prediction
//     $n = count($timestampsForSales);
//     $sumX = array_sum($timestampsForSales);
//     $sumY = array_sum($totalSales);
//     $sumXY = 0;
//     $sumX2 = 0;

//     for ($i = 0; $i < $n; $i++) {
//         $sumXY += $timestampsForSales[$i] * $totalSales[$i];
//         $sumX2 += $timestampsForSales[$i] * $timestampsForSales[$i];
//     }

//     $slopeForSales = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
//     $interceptForSales = ($sumY - $slopeForSales * $sumX) / $n;

//     $totalSalesSum = array_sum($totalSales);
//     $averageSalesIncreasePerDay = $totalSalesSum / count($timestampsForSales);

//     // Predict the next total sum of all total sales
//     $predictedNextTotalSales = $totalSalesSum + $averageSalesIncreasePerDay;

//     $totalTransactionCountSum = array_sum($transactionCounts);
//     $averageTransactionCountIncreasePerDay = $totalTransactionCountSum / count($timestampsForCount);

//     $queryPerYear = "SELECT
//     all_years.year AS year,
//     IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count,
//     IFNULL(SUM(opr.amount), 0) AS total_sales
//     FROM
//         (
//             SELECT DISTINCT YEAR(transacton_date) AS year
//             FROM operational_report
//             WHERE transacton_date >= '2023-06-10'
            
//             UNION
            
//             SELECT DISTINCT YEAR(transacton_date) AS year
//             FROM operational_report
//             WHERE YEAR(transacton_date) = YEAR(NOW())
//         ) AS all_years
//     LEFT JOIN operational_report opr ON all_years.year = YEAR(opr.transacton_date) AND opr.transaction_status = 'paid'
//     GROUP BY all_years.year
//     ORDER BY all_years.year ASC;
//     ";

//     $transactionsPerYear = $chartDb->createCommand($queryPerYear)->queryAll();

//     // Prepare data for predictions (total paid transaction count and total paid sales)
//     $years = array_column($transactionsPerYear, 'year');
//     $transactionCountsPerYear = array_column($transactionsPerYear, 'transaction_count');
//     $totalSalesPerYear = array_column($transactionsPerYear, 'total_sales');

//     // Calculate historical averages based on the whole dataset for paid transaction count and total sales
//     $totalTransactionCountSumPerYear = array_sum($transactionCountsPerYear);
//     $averageTransactionCountIncreasePerYear = $totalTransactionCountSumPerYear / count($years);

//     $totalSalesSumPerYear = array_sum($totalSalesPerYear);
//     $averageSalesIncreasePerYear = $totalSalesSumPerYear / count($years);
    ?>

    
    <!-- <script>
        document.getElementById('prediction-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let years = parseFloat(document.getElementById('years').value);
            let days = Math.round(years * 365);
            
            let transactionCounts = <?php //json_encode(array_column($transactions, 'transaction_count')) ?>;

            // Convert timestamps to Unix timestamps
            let totalSales = <?php //json_encode(array_column($transactions, 'total_sales')) ?>;

            // Calculate the timestamps for the next day and the predicted day
            let latestTimestamp = '<?php //$latestTimestamp ?>';
            let nextDayTimestamp = new Date('<?php //date('Y-m-d', $nextDayTimestamp) ?>');
            nextDayTimestamp.setDate(nextDayTimestamp.getDate() + days);

            let totalSalesSum = <?php //$totalSalesSum ?>;
            let totalTransactionCountSum = <?php //$totalTransactionCountSum ?>;

            // Define JavaScript variables with the values of totalSalesSum, averageSalesIncreasePerDay,
            // totalTransactionCountSum, and averageTransactionCountIncreasePerDay
            let averageSalesIncreasePerDay = <?php //$averageSalesIncreasePerDay ?>;
            let averageTransactionCountIncreasePerDay = <?php //$averageTransactionCountIncreasePerDay ?>;

            // Calculate historical averages based on the whole dataset for paid transaction count and total sales
            let totalTransactionCountSumPerYear = <?php //$totalTransactionCountSumPerYear ?>;
            let averageTransactionCountIncreasePerYear = <?php //$averageTransactionCountIncreasePerYear ?>;

            let totalSalesSumPerYear = <?php //$totalSalesSumPerYear ?>;
            let averageSalesIncreasePerYear = <?php //$averageSalesIncreasePerYear ?>;

            let nextYearTimestamp = new Date();
            nextYearTimestamp.setFullYear(nextYearTimestamp.getFullYear() + years);

            let slopeForCountPerYear = <?php //$slopeForCount ?>;
            let interceptForCountPerYear = <?php //$interceptForCount ?>;

            let slopeForSalesPerYear = <?php //$slopeForSales ?>;
            let interceptForSalesPerYear = <?php //$interceptForSales ?>;

            let predictedTransactionCountPerYear = Math.round(interceptForCountPerYear + slopeForCountPerYear * nextDayTimestamp.getTime() / 1000);
            let predictedTotalSalesPerYear = Math.round(interceptForSalesPerYear + slopeForSalesPerYear * nextDayTimestamp.getTime() / 1000);

            console.log(transactionCounts[transactionCounts.length - 4])

            // Calculate predictions for total sum of paid transaction count and total paid sales per year
            let predictedNextTotalTransactionCountPerYear = Math.round(totalTransactionCountSumPerYear + averageTransactionCountIncreasePerYear * years);
            let predictedNextTotalSalesPerYear = Math.round(totalSalesSumPerYear + averageSalesIncreasePerYear * years);

            // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year
            let averagePredictedTotalTransactionCountPerYear = Math.round(predictedNextTotalTransactionCountPerYear / years);
            let averagePredictedTotalSalesPerYear = Math.round(predictedNextTotalSalesPerYear / years);
                    
            function addCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            let predictionsDiv = document.getElementById('predictions');
            predictionsDiv.innerHTML = `
            <p>Predicted transaction count on the <span style="color:#0080ff">${days}-day (${years} year(s))</span> mark: 
        <span style="color:${predictedTransactionCountPerYear >= transactionCounts[transactionCounts.length - 1] ? 'green' : 'red'}">
             ${addCommas(predictedTransactionCountPerYear)}
            (${predictedTransactionCountPerYear >= transactionCounts[transactionCounts.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total transaction count on the <span style="color:#0080ff">${days}-day (${years} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalTransactionCountPerYear >= averageTransactionCountIncreasePerYear ? 'green' : 'red'}">
             ${addCommas(averagePredictedTotalTransactionCountPerYear)}
            (${averagePredictedTotalTransactionCountPerYear >= averageTransactionCountIncreasePerYear ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted income on the <span style="color:#0080ff">${days}-day (${years} year(s))</span> mark: 
        <span style="color:${predictedTotalSalesPerYear >= totalSales[totalSales.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTotalSalesPerYear)}
            (${predictedTotalSalesPerYear >= totalSales[totalSales.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total income on the <span style="color:#0080ff">${days}-day (${years} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalSalesPerYear >= averageSalesIncreasePerYear ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalSalesPerYear)}
            (${averagePredictedTotalSalesPerYear >= averageSalesIncreasePerYear ? 'Increased' : 'Decreased'})
        </span>
    </p>
    `;

    var doughnutCanvas = document.getElementById('doughnutChart');            
        // Create the doughnut chart
                    var doughnutChart = new Chart(doughnutCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Transaction Count Daily in ' + years +' year(s)', ' Current Total Average Transaction Count Daily'],
                            datasets: [{
                                data: [predictedTransactionCountPerYear,transactionCounts[transactionCounts.length - 1]], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });

                    var doughnutCanvas1 = document.getElementById('doughnutChart1');            
        // Create the doughnut chart
                    var doughnutChart1 = new Chart(doughnutCanvas1, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Average Transaction Count in ' + years +' year(s)', ' Current Total Average Transaction Count'],
                            datasets: [{
                                data: [averagePredictedTotalTransactionCountPerYear,averageTransactionCountIncreasePerYear], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });



                    const doughnutCanvas2 = document.getElementById('doughnutChart2');            
        // Create the doughnut chart
                    const doughnutChart2 = new Chart(doughnutCanvas2, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Sales Daily in ' + years +' year(s)', ' Current Total Average Sales '],
                            datasets: [{
                                data: [predictedTotalSalesPerYear,totalSales[totalSales.length - 1]], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });

                    const doughnutCanvas3 = document.getElementById('doughnutChart3');            
        // Create the doughnut chart
                    const doughnutChart3 = new Chart(doughnutCanvas3, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Average Sales ' + years +' year(s)', ' Current Total Average Sales'],
                            datasets: [{
                                data: [averagePredictedTotalSalesPerYear,averageSalesIncreasePerYear], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });

        });
        
    </script> -->


    <!-- NMD -->

    <?php
    $latestTimestamp2 = (new \yii\db\Query())
    ->select(['MAX(transacton_date) AS latest_timestamp'])
    ->from('operational_report')
    ->scalar();

// Construct the new subquery
$subquery2 = (new \yii\db\Query())
    ->select(['DATE_ADD("2023-06-10", INTERVAL n DAY) AS date'])
    ->from(['numbers' => '(
SELECT a.n + b.n * 10 + c.n * 100 AS n
FROM (
    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
) AS a,
(
    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
) AS b,
(
    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
) AS c
)'])
    ->where(['<=', 'DATE_ADD("2023-06-10", INTERVAL n DAY)', new \yii\db\Expression('NOW()')]);

// New main query
$query2 = (new \yii\db\Query())
    ->select([
        'all_dates.date AS transaction_date',
        'IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count',
        'IFNULL(SUM(opr.amount), 0) AS total_sales'
    ])
    ->from([
        'all_dates' => $subquery2
    ])
    ->leftJoin('operational_report opr', 'all_dates.date = opr.transacton_date AND opr.transaction_status = "paid" AND opr.division_name = "National Metrology Department"')
    ->groupBy('all_dates.date')
    ->orderBy(['all_dates.date' => SORT_ASC]);

$transactions2 = $query2->all();

// Convert timestamps to Unix timestamps
foreach ($transactions2 as &$transaction2) {
    $transaction2['transaction_date'] = strtotime($transaction2['transaction_date']);
}

// Define $nextDayTimestamp using the latestTimestamp
$nextDayTimestamp2 = strtotime('+1 day', strtotime($latestTimestamp2));

// Prepare data for prediction (transaction count)
$timestampsForCount2 = array_column($transactions2, 'transaction_date');
$transactionCounts2 = array_column($transactions2, 'transaction_count');

// Calculate linear regression coefficients for transaction count prediction
$n2 = count($timestampsForCount2);
$sumX2 = array_sum($timestampsForCount2);
$sumY2 = array_sum($transactionCounts2);
$sumXY2 = 0;
$sumX22 = 0;

for ($i = 0; $i < $n2; $i++) {
    $sumXY2 += $timestampsForCount2[$i] * $transactionCounts2[$i];
    $sumX22 += $timestampsForCount2[$i] * $timestampsForCount2[$i];
}

$slopeForCount2 = ($n2 * $sumXY2 - $sumX2 * $sumY2) / ($n2 * $sumX22 - $sumX2 * $sumX2);
$interceptForCount2 = ($sumY2 - $slopeForCount2 * $sumX2) / $n2;

// Predict the next transaction count for the next day
$predictedTransactionCount2 = $interceptForCount2 + $slopeForCount2 * $nextDayTimestamp2;

// Prepare data for prediction (total sales)
$timestampsForSales2 = array_column($transactions2, 'transaction_date');
$totalSales2 = array_column($transactions2, 'total_sales');

// Calculate linear regression coefficients for total sales prediction
$n2 = count($timestampsForSales2);
$sumX2 = array_sum($timestampsForSales2);
$sumY2 = array_sum($totalSales2);
$sumXY2 = 0;
$sumX22 = 0;

for ($i = 0; $i < $n2; $i++) {
    $sumXY2 += $timestampsForSales2[$i] * $totalSales2[$i];
    $sumX22 += $timestampsForSales2[$i] * $timestampsForSales2[$i];
}

$slopeForSales2 = ($n2 * $sumXY2 - $sumX2 * $sumY2) / ($n2 * $sumX22 - $sumX2 * $sumX2);
$interceptForSales2 = ($sumY2 - $slopeForSales2 * $sumX2) / $n2;

$totalSalesSum2 = array_sum($totalSales2);
$averageSalesIncreasePerDay2 = $totalSalesSum2 / count($timestampsForSales2);

// Predict the next total sum of all total sales
$predictedNextTotalSales2 = $totalSalesSum2 + $averageSalesIncreasePerDay2;

$totalTransactionCountSum2 = array_sum($transactionCounts2);
$averageTransactionCountIncreasePerDay2 = $totalTransactionCountSum2 / count($timestampsForCount2);

$queryPerYear2 = (new \yii\db\Query())
    ->select([
        'all_years2.year AS year',
        'IFNULL(COUNT(opr2.transacton_date), 0) AS transaction_count2',
        'IFNULL(SUM(opr2.amount), 0) AS total_sales2'
    ])
    ->from([
        'all_years2' => (new \yii\db\Query())
            ->select(['DISTINCT YEAR(transacton_date) AS year'])
            ->from('operational_report')
            ->where(['>=', 'transacton_date', '2023-06-10'])
            ->union((new \yii\db\Query())
                    ->select(['DISTINCT YEAR(transacton_date) AS year'])
                    ->from('operational_report')
                    ->where(['YEAR(transacton_date)' => new \yii\db\Expression('YEAR(NOW())')])
            )
    ])
    ->leftJoin('operational_report opr2', 'all_years2.year = YEAR(opr2.transacton_date) AND opr2.transaction_status = "paid" AND opr2.division_name = "National Metrology Department"')
    ->groupBy('all_years2.year')
    ->orderBy(['all_years2.year' => SORT_ASC]);

$transactionsPerYear2 = $queryPerYear2->all();

// Prepare data for predictions (total paid transaction count and total paid sales)
$years2 = array_column($transactionsPerYear2, 'year');
$transactionCountsPerYear2 = array_column($transactionsPerYear2, 'transaction_count2');
$totalSalesPerYear2 = array_column($transactionsPerYear2, 'total_sales2');

// Calculate historical averages based on the whole dataset for paid transaction count and total sales
$totalTransactionCountSumPerYear2 = array_sum($transactionCountsPerYear2);
$averageTransactionCountIncreasePerYear2 = $totalTransactionCountSumPerYear2 / count($years2);

$totalSalesSumPerYear2 = array_sum($totalSalesPerYear2);
$averageSalesIncreasePerYear2 = $totalSalesSumPerYear2 / count($years2);
    ?>

    <script>
        document.getElementById('prediction-form').addEventListener('submit', function(event) {
            event.preventDefault();

        const years2 = parseFloat(document.getElementById('years').value);
        const days2 = Math.round(years2 * 365);

        const transactionCounts2 = <?= json_encode(array_column($transactions2, 'transaction_count')) ?>;
        const totalSales2 = <?= json_encode(array_column($transactions2, 'total_sales')) ?>;
        // Calculate the timestamps for the next day and the predicted day
        const latestTimestamp2 = '<?= $latestTimestamp2 ?>';
        const nextDayTimestamp2 = new Date('<?= date('Y-m-d', $nextDayTimestamp2) ?>');
        nextDayTimestamp2.setDate(nextDayTimestamp2.getDate() + days2);

        const totalSalesSum2 = <?= $totalSalesSum2 ?>;
        const totalTransactionCountSum2 = <?= $totalTransactionCountSum2 ?>;

        // Define JavaScript variables with the values of totalSalesSum2, averageSalesIncreasePerDay2,
        // totalTransactionCountSum2, and averageTransactionCountIncreasePerDay2
        const averageSalesIncreasePerDay2 = <?= $averageSalesIncreasePerDay2 ?>;
        const averageTransactionCountIncreasePerDay2 = <?= $averageTransactionCountIncreasePerDay2 ?>;

        // Calculate historical averages based on the whole dataset for paid transaction count and total sales
        const totalTransactionCountSumPerYear2 = <?= $totalTransactionCountSumPerYear2 ?>;
        const averageTransactionCountIncreasePerYear2 = <?= $averageTransactionCountIncreasePerYear2 ?>;

        const totalSalesSumPerYear2 = <?= $totalSalesSumPerYear2 ?>;
        const averageSalesIncreasePerYear2 = <?= $averageSalesIncreasePerYear2 ?>;

        // Calculate predictions for paid transaction count and paid sales per year
        const slopeForCountPerYear2 = <?= $slopeForCount2 ?>;
        const interceptForCountPerYear2 = <?= $interceptForCount2 ?>;

        const slopeForSalesPerYear2 = <?= $slopeForSales2 ?>;
        const interceptForSalesPerYear2 = <?= $interceptForSales2 ?>;

        const nextYearTimestamp2 = new Date();
        nextYearTimestamp2.setFullYear(nextYearTimestamp2.getFullYear() + years2);

        // Calculate predictions for transaction count and total sales for the next year
        const predictedTransactionCountPerYear2 = Math.round(interceptForCountPerYear2 + slopeForCountPerYear2 * nextYearTimestamp2.getTime() / 1000);
        const predictedTotalSalesPerYear2 = Math.round(interceptForSalesPerYear2 + slopeForSalesPerYear2 * nextYearTimestamp2.getTime() / 1000);

        // Calculate predictions for total sum of paid transaction count and total paid sales per year
        const predictedNextTotalTransactionCountPerYear2 = Math.round(totalTransactionCountSumPerYear2 + averageTransactionCountIncreasePerYear2 * years2);
        const predictedNextTotalSalesPerYear2 = Math.round(totalSalesSumPerYear2 + averageSalesIncreasePerYear2 * years2);

        // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year
        const averagePredictedTotalTransactionCountPerYear2 = Math.round(predictedNextTotalTransactionCountPerYear2 / years2);
        const averagePredictedTotalSalesPerYear2 = Math.round(predictedNextTotalSalesPerYear2 / years2);

        
        const doughnutCanvas4 = document.getElementById('doughnutChart4');            
        // Create the doughnut chart
                    const doughnutChart4 = new Chart(doughnutCanvas4, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Transaction Count Daily for NMD in ' + years +' year(s)', ' Current Total Average Transaction Count Daily for NMD'],
                            datasets: [{
                                data: [predictedTransactionCountPerYear2,transactionCounts2[transactionCounts2.length - 1]], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });

                    const doughnutCanvas5 = document.getElementById('doughnutChart5');            
        // Create the doughnut chart
                    const doughnutChart5 = new Chart(doughnutCanvas5, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Average Transaction Count for NMD in ' + years2 +' year(s)', ' Current Total Average Transaction Count for NMD'],
                            datasets: [{
                                data: [averagePredictedTotalTransactionCountPerYear2,averageTransactionCountIncreasePerYear2], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });



                    const doughnutCanvas6 = document.getElementById('doughnutChart6');            
        // Create the doughnut chart
                    const doughnutChart6 = new Chart(doughnutCanvas6, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Sales Daily for NMD in ' + years2 +' year(s)', ' Current Total Average Sales for NMD '],
                            datasets: [{
                                data: [predictedTotalSalesPerYear2,totalSales2[totalSales2.length - 1]], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });

                    const doughnutCanvas7 = document.getElementById('doughnutChart7');            
        // Create the doughnut chart
                    const doughnutChart7 = new Chart(doughnutCanvas7, {
                        type: 'doughnut',
                        data: {
                            labels: ['Predicted Total Average Sales for NMD in ' + years2 +' year(s)', ' Current Total Average Sales for NMD'],
                            datasets: [{
                                data: [averagePredictedTotalSalesPerYear2,averageSalesIncreasePerYear2], // 100 - predictedTotalSalesPerYear1 represents the remaining portion
                                backgroundColor: ['#0080ff', '#e0e0e0'] // You can set your desired colors here
                            }]
                        },
                        options: {
                            responsive: true,
                            cutoutPercentage: 70, // Adjust the cutout percentage as needed
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        }
                    });


        // Function to add commas every three numbers
        function addCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        const predictionsDiv1 = document.getElementById('predictions1');
        predictionsDiv1.innerHTML = `
        <p>Predicted transaction count of the NMD on the <span style="color:#0080ff">${days2}-day (${years2} year(s))</span> mark: 
                <span style="color:${predictedTransactionCountPerYear2 >= transactionCounts2[transactionCounts2.length - 1] ? 'green' : 'red'}">
                    ${addCommas(predictedTransactionCountPerYear2)}
                    (${predictedTransactionCountPerYear2 >= transactionCounts2[transactionCounts2.length - 1] ? 'Increased' : 'Decreased'})
                </span>
            </p>
            <p>Predicted total transaction count of NMD on the <span style="color:#0080ff">${days2}-day (${years2} year(s))</span> mark: 
                <span style="color:${averagePredictedTotalTransactionCountPerYear2 >= transactionCounts2[transactionCounts2.length - 1] ? 'green' : 'red'}">
                    ${addCommas(averagePredictedTotalTransactionCountPerYear2)}
                    (${averagePredictedTotalTransactionCountPerYear2 >= transactionCounts2[transactionCounts2.length - 1] ? 'Increased' : 'Decreased '})
                </span>
            </p>
        `;

        const predictionsDiv3 = document.getElementById('predictions3');
        predictionsDiv3.innerHTML = `
            <p>Predicted income of NMD on the <span style="color:#0080ff">${days2}-day (${years2} year(s))</span> mark: 
                <span style="color:${predictedTotalSalesPerYear2 >= totalSales2[totalSales2.length - 1] ? 'green' : 'red'}">
                    ${addCommas(predictedTotalSalesPerYear2)}
                    (${predictedTotalSalesPerYear2 >= totalSales2[totalSales2.length - 1] ? 'Increased' : 'Decreased'})
                </span>
            </p>
            <p>Predicted total income of NMD on the <span style="color:#0080ff">${days2}-day (${years2} year(s))</span> mark: 
                <span style="color:${averagePredictedTotalSalesPerYear2 >= totalSales2[totalSales2.length - 1] ? 'green' : 'red'}">
                    ${addCommas(averagePredictedTotalSalesPerYear2)}
                    (${averagePredictedTotalSalesPerYear2 >= totalSales2[totalSales2.length - 1] ? 'Increased' : 'Decreased'})
                </span>
            </p>
        `;

                });
            </script>

<!-- STD -->

    <?php
    $latestTimestamp1 = (new \yii\db\Query())
        ->select(['MAX(transacton_date) AS latest_timestamp'])
        ->from('operational_report')
        ->scalar();

    // Construct the new subquery
    $subquery1 = (new \yii\db\Query())
        ->select(['DATE_ADD("2023-06-10", INTERVAL n DAY) AS date'])
        ->from(['numbers' => '(
    SELECT a.n + b.n * 10 + c.n * 100 AS n
    FROM (
        SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS a,
    (
        SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS b,
    (
        SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
    ) AS c
)'])
        ->where(['<=', 'DATE_ADD("2023-06-10", INTERVAL n DAY)', new \yii\db\Expression('NOW()')]);

    // New main query
    $query1 = (new \yii\db\Query())
        ->select([
            'all_dates.date AS transaction_date',
            'IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count',
            'IFNULL(SUM(opr.amount), 0) AS total_sales'
        ])
        ->from([
            'all_dates' => $subquery1
        ])
        ->leftJoin('operational_report opr', 'all_dates.date = opr.transacton_date AND opr.transaction_status = "paid" AND opr.division_name = "Standard and Testing Division"')
        ->groupBy('all_dates.date')
        ->orderBy(['all_dates.date' => SORT_ASC]);

    $transactions1 = $query1->all();

    // Convert timestamps to Unix timestamps
    foreach ($transactions1 as &$transaction1) {
        $transaction1['transaction_date'] = strtotime($transaction1['transaction_date']);
    }

    // Define $nextDayTimestamp using the latestTimestamp
    $nextDayTimestamp1 = strtotime('+1 day', strtotime($latestTimestamp1));


    // Prepare data for prediction (transaction count)
    $timestampsForCount1 = array_column($transactions1, 'transaction_date');
    $transactionCounts1 = array_column($transactions1, 'transaction_count');


    // Calculate linear regression coefficients for transaction count prediction
    $n1 = count($timestampsForCount1);
    $sumX1 = array_sum($timestampsForCount1);
    $sumY1 = array_sum($transactionCounts1);
    $sumXY1 = 0;
    $sumX21 = 0;

    for ($i = 0; $i < $n1; $i++) {
        $sumXY1 += $timestampsForCount1[$i] * $transactionCounts1[$i];
        $sumX21 += $timestampsForCount1[$i] * $timestampsForCount1[$i];
    }

    $slopeForCount1 = ($n1 * $sumXY1 - $sumX1 * $sumY1) / ($n1 * $sumX21 - $sumX1 * $sumX1);
    $interceptForCount1 = ($sumY1 - $slopeForCount1 * $sumX1) / $n1;

    // Predict the next transaction count for the next day
    $predictedTransactionCount1 = $interceptForCount1 + $slopeForCount1 * $nextDayTimestamp1;

    // Prepare data for prediction (total sales)
    $timestampsForSales1 = array_column($transactions1, 'transaction_date');
    $totalSales1 = array_column($transactions1, 'total_sales');

    // Calculate linear regression coefficients for total sales prediction
    $n1 = count($timestampsForSales1);
    $sumX1 = array_sum($timestampsForSales1);
    $sumY1 = array_sum($totalSales1);
    $sumXY1 = 0;
    $sumX21 = 0;

    for ($i = 0; $i < $n1; $i++) {
        $sumXY1 += $timestampsForSales1[$i] * $totalSales1[$i];
        $sumX21 += $timestampsForSales1[$i] * $timestampsForSales1[$i];
    }

    $slopeForSales1 = ($n1 * $sumXY1 - $sumX1 * $sumY1) / ($n1 * $sumX21 - $sumX1 * $sumX1);
    $interceptForSales1 = ($sumY1 - $slopeForSales1 * $sumX1) / $n1;

    $totalSalesSum1 = array_sum($totalSales1);
    $averageSalesIncreasePerDay1 = $totalSalesSum1 / count($timestampsForSales1);

    // Predict the next total sum of all total sales
    $predictedNextTotalSales1 = $totalSalesSum1 + $averageSalesIncreasePerDay1;

    $totalTransactionCountSum1 = array_sum($transactionCounts1);
    $averageTransactionCountIncreasePerDay1 = $totalTransactionCountSum1 / count($timestampsForCount1);

    $queryPerYear1 = (new \yii\db\Query())
        ->select([
            'all_years1.year AS year',
            'IFNULL(COUNT(opr1.transacton_date), 0) AS transaction_count1',
            'IFNULL(SUM(opr1.amount), 0) AS total_sales1'
        ])
        ->from([
            'all_years1' => (new \yii\db\Query())
                ->select(['DISTINCT YEAR(transacton_date) AS year'])
                ->from('operational_report')
                ->where(['>=', 'transacton_date', '2023-06-10'])
                ->union((new \yii\db\Query())
                        ->select(['DISTINCT YEAR(transacton_date) AS year'])
                        ->from('operational_report')
                        ->where(['YEAR(transacton_date)' => new \yii\db\Expression('YEAR(NOW())')])
                )
        ])
        ->leftJoin('operational_report opr1', 'all_years1.year = YEAR(opr1.transacton_date) AND opr1.transaction_status = "paid" AND opr1.division_name = "Standard and Testing Division"')
        ->groupBy('all_years1.year')
        ->orderBy(['all_years1.year' => SORT_ASC]);

    $transactionsPerYear1 = $queryPerYear1->all();

    // Prepare data for predictions (total paid transaction count and total paid sales)
    $years1 = array_column($transactionsPerYear1, 'year');
    $transactionCountsPerYear1 = array_column($transactionsPerYear1, 'transaction_count1');
    $totalSalesPerYear1 = array_column($transactionsPerYear1, 'total_sales1');

    // Calculate historical averages based on the whole dataset for paid transaction count and total sales
    $totalTransactionCountSumPerYear1 = array_sum($transactionCountsPerYear1);
    $averageTransactionCountIncreasePerYear1 = $totalTransactionCountSumPerYear1 / count($years1);

$totalSalesSumPerYear1 = array_sum($totalSalesPerYear1);
$averageSalesIncreasePerYear1 = $totalSalesSumPerYear1 / count($years1);
?>

    <script>
        document.getElementById('prediction-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const years1 = parseFloat(document.getElementById('years').value);
            const days1 = Math.round(years1 * 365);

            const transactionCounts1 = <?= json_encode(array_column($transactions1, 'transaction_count')) ?>;

            // Convert timestamps to Unix timestamps
            const totalSales1 = <?= json_encode(array_column($transactions1, 'total_sales')) ?>;
            // Calculate the timestamps for the next day and the predicted day
            const latestTimestamp1 = '<?= $latestTimestamp1 ?>';
            const nextDayTimestamp1 = new Date('<?= date('Y-m-d', $nextDayTimestamp1) ?>');
            nextDayTimestamp1.setDate(nextDayTimestamp1.getDate() + days1);

            const totalSalesSum1 = <?= $totalSalesSum1 ?>;
            const totalTransactionCountSum1 = <?= $totalTransactionCountSum1 ?>;

            // Define JavaScript variables with the values of totalSalesSum1, averageSalesIncreasePerDay1,
            // totalTransactionCountSum1, and averageTransactionCountIncreasePerDay1
            const averageSalesIncreasePerDay1 = <?= $averageSalesIncreasePerDay1 ?>;
            const averageTransactionCountIncreasePerDay1 = <?= $averageTransactionCountIncreasePerDay1 ?>;

            // Calculate historical averages based on the whole dataset for paid transaction count and total sales
            const totalTransactionCountSumPerYear1 = <?= $totalTransactionCountSumPerYear1 ?>;
            const averageTransactionCountIncreasePerYear1 = <?= $averageTransactionCountIncreasePerYear1 ?>;

            const totalSalesSumPerYear1 = <?= $totalSalesSumPerYear1 ?>;
            const averageSalesIncreasePerYear1 = <?= $averageSalesIncreasePerYear1 ?>;

            // Calculate predictions for paid transaction count and paid sales per year


            const slopeForCountPerYear1 = <?= $slopeForCount1 ?>;
            const interceptForCountPerYear1 = <?= $interceptForCount1 ?>;

            const slopeForSalesPerYear1 = <?= $slopeForSales1 ?>;
            const interceptForSalesPerYear1 = <?= $interceptForSales1 ?>;

            const nextYearTimestamp1 = new Date();
            nextYearTimestamp1.setFullYear(nextYearTimestamp1.getFullYear() + years1);

            // Calculate predictions for transaction count and total sales for the next year
            const predictedTransactionCountPerYear1 = Math.round(interceptForCountPerYear1 + slopeForCountPerYear1 * nextYearTimestamp1.getTime() / 1000);
            const predictedTotalSalesPerYear1 = Math.round(interceptForSalesPerYear1 + slopeForSalesPerYear1 * nextYearTimestamp1.getTime() / 1000);

            // Calculate predictions for total sum of paid transaction count and total paid sales per year
            const predictedNextTotalTransactionCountPerYear1 = Math.round(totalTransactionCountSumPerYear1 + averageTransactionCountIncreasePerYear1 * years1);
            const predictedNextTotalSalesPerYear1 = Math.round(totalSalesSumPerYear1 + averageSalesIncreasePerYear1 * years1);

            // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year
            const averagePredictedTotalTransactionCountPerYear1 = Math.round(predictedNextTotalTransactionCountPerYear1 / years1);
            const averagePredictedTotalSalesPerYear1 = Math.round(predictedNextTotalSalesPerYear1 / years1);
                        // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year

            // Function to add commas every three numbers
            function addCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }


const predictionsDiv2 = document.getElementById('predictions2');
predictionsDiv2.innerHTML = `
<p>Predicted transaction count of the STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${predictedTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTransactionCountPerYear1)}
            (${predictedTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total transaction count of STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalTransactionCountPerYear1)}
            (${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'Increased' : 'Decreased '})
        </span>
    </p>
`;

const predictionsDiv4 = document.getElementById('predictions4');
predictionsDiv4.innerHTML = `
    <p>Predicted income of STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTotalSalesPerYear1)}
            (${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total income of STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalSalesPerYear1)}
            (${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
`;

    });

    
</script>



<div class="chart-container">
        <canvas id="doughnutChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart1"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart2"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart3"></canvas>
    </div>


    
<div class="chart-container">
        <canvas id="doughnutChart4"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart5"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart6"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="doughnutChart7"></canvas>
    </div>





