<?php
use yii\bootstrap5\Html;



?>

   <div class="prediction-index">
        <h1><?= Html::encode($this->title) ?></h1>

        <form id="prediction-form">
            <label for="years">Enter the number of years for predictions:</label>
            <input type="number" id="years" name="years" step="0.01" value="">
            <button type="submit">Compute Predictions</button>
        </form>

        <div id="predictions" style="font-weight: bold; "></div> <br>
        <div id="predictions1" style="font-weight: bold;"></div> 
        <div id="predictions2" style="font-weight: bold;"></div> <br>
        <div id="predictions3" style="font-weight: bold;"></div> 
        <div id="predictions4" style="font-weight: bold;"></div><br>
        <div id="predictions5" style="font-weight: bold;"></div>


    </div>


<?php
    $latestTimestamp = (new \yii\db\Query())
        ->select(['MAX(transacton_date) AS latest_timestamp'])
        ->from('operational_report')
        ->scalar();

    // Construct the Yii query
    $subquery = (new \yii\db\Query())
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

    $query = (new \yii\db\Query())
        ->select([
            'dates.date AS transacton_date',
            'IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count',
            'IFNULL(SUM(opr.amount), 0) AS total_sales'
        ])
        ->from([
            'dates' => $subquery
        ])
        ->leftJoin('operational_report opr', 'dates.date = opr.transacton_date AND opr.transaction_status = "paid"')
        ->groupBy('dates.date')
        ->orderBy(['dates.date' => SORT_ASC]);

    $transactions = $query->all();

    // Convert timestamps to Unix timestamps
    foreach ($transactions as &$transaction) {
        $transaction['transacton_date'] = strtotime($transaction['transacton_date']);
    }

    // Define $nextDayTimestamp using the latestTimestamp
    $nextDayTimestamp = strtotime('+1 day', strtotime($latestTimestamp));


    // Prepare data for prediction (transaction count)
    $timestampsForCount = array_column($transactions, 'transacton_date');
    $transactionCounts = array_column($transactions, 'transaction_count');

    // Calculate linear regression coefficients for transaction count prediction
    $n = count($timestampsForCount);
    $sumX = array_sum($timestampsForCount);
    $sumY = array_sum($transactionCounts);
    $sumXY = 0;
    $sumX2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumXY += $timestampsForCount[$i] * $transactionCounts[$i];
        $sumX2 += $timestampsForCount[$i] * $timestampsForCount[$i];
    }

    $slopeForCount = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
    $interceptForCount = ($sumY - $slopeForCount * $sumX) / $n;

    // Predict the next transaction count for the next day
    $predictedTransactionCount = $interceptForCount + $slopeForCount * $nextDayTimestamp;

    // Prepare data for prediction (total sales)
    $timestampsForSales = array_column($transactions, 'transacton_date');
    $totalSales = array_column($transactions, 'total_sales');

    // Calculate linear regression coefficients for total sales prediction
    $n = count($timestampsForSales);
    $sumX = array_sum($timestampsForSales);
    $sumY = array_sum($totalSales);
    $sumXY = 0;
    $sumX2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumXY += $timestampsForSales[$i] * $totalSales[$i];
        $sumX2 += $timestampsForSales[$i] * $timestampsForSales[$i];
    }

    $slopeForSales = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
    $interceptForSales = ($sumY - $slopeForSales * $sumX) / $n;

    $totalSalesSum = array_sum($totalSales);
    $averageSalesIncreasePerDay = $totalSalesSum / count($timestampsForSales);

    // Predict the next total sum of all total sales
    $predictedNextTotalSales = $totalSalesSum + $averageSalesIncreasePerDay;

    $totalTransactionCountSum = array_sum($transactionCounts);
    $averageTransactionCountIncreasePerDay = $totalTransactionCountSum / count($timestampsForCount);

    $queryPerYear = (new \yii\db\Query())
        ->select([
            'all_years.year AS year',
            'IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count',
            'IFNULL(SUM(opr.amount), 0) AS total_sales'
        ])
        ->from([
            'all_years' => (new \yii\db\Query())
                ->select(['DISTINCT YEAR(transacton_date) AS year'])
                ->from('operational_report')
                ->where(['>=', 'transacton_date', '2023-06-10'])
                ->union((new \yii\db\Query())
                        ->select(['DISTINCT YEAR(transacton_date) AS year'])
                        ->from('operational_report')
                        ->where(['YEAR(transacton_date)' => new \yii\db\Expression('YEAR(NOW())')])
                )
        ])
        ->leftJoin('operational_report opr', 'all_years.year = YEAR(opr.transacton_date) AND opr.transaction_status = "paid"')
        ->groupBy('all_years.year')
        ->orderBy(['all_years.year' => SORT_ASC]);

    $transactionsPerYear = $queryPerYear->all();

    // Prepare data for predictions (total paid transaction count and total paid sales)
    $years = array_column($transactionsPerYear, 'year');
    $transactionCountsPerYear = array_column($transactionsPerYear, 'transaction_count');
    $totalSalesPerYear = array_column($transactionsPerYear, 'total_sales');

    // Calculate historical averages based on the whole dataset for paid transaction count and total sales
    $totalTransactionCountSumPerYear = array_sum($transactionCountsPerYear);
    $averageTransactionCountIncreasePerYear = $totalTransactionCountSumPerYear / count($years);

    $totalSalesSumPerYear = array_sum($totalSalesPerYear);
    $averageSalesIncreasePerYear = $totalSalesSumPerYear / count($years);
    ?>


    <script>
        document.getElementById('prediction-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const years = parseFloat(document.getElementById('years').value);
            const days = Math.round(years * 365);

            // Calculate the timestamps for the next day and the predicted day
            const latestTimestamp = '<?= $latestTimestamp ?>';
            const nextDayTimestamp = new Date('<?= date('Y-m-d', $nextDayTimestamp) ?>');
            nextDayTimestamp.setDate(nextDayTimestamp.getDate() + days);

            const totalSalesSum = <?= $totalSalesSum ?>;
            const totalTransactionCountSum = <?= $totalTransactionCountSum ?>;

            // Define JavaScript variables with the values of totalSalesSum, averageSalesIncreasePerDay,
            // totalTransactionCountSum, and averageTransactionCountIncreasePerDay
            const averageSalesIncreasePerDay = <?= $averageSalesIncreasePerDay ?>;
            const averageTransactionCountIncreasePerDay = <?= $averageTransactionCountIncreasePerDay ?>;

            // Calculate historical averages based on the whole dataset for paid transaction count and total sales
            const totalTransactionCountSumPerYear = <?= $totalTransactionCountSumPerYear ?>;
            const averageTransactionCountIncreasePerYear = <?= $averageTransactionCountIncreasePerYear ?>;

            const totalSalesSumPerYear = <?= $totalSalesSumPerYear ?>;
            const averageSalesIncreasePerYear = <?= $averageSalesIncreasePerYear ?>;

            const nextYearTimestamp = new Date();
            nextYearTimestamp.setFullYear(nextYearTimestamp.getFullYear() + years);

            const slopeForCountPerYear = <?= $slopeForCount ?>;
            const interceptForCountPerYear = <?= $interceptForCount ?>;

            const slopeForSalesPerYear = <?= $slopeForSales ?>;
            const interceptForSalesPerYear = <?= $interceptForSales ?>;

            const predictedTransactionCountPerYear = Math.round(interceptForCountPerYear + slopeForCountPerYear * nextDayTimestamp.getTime() / 1000);
            const predictedTotalSalesPerYear = Math.round(interceptForSalesPerYear + slopeForSalesPerYear * nextDayTimestamp.getTime() / 1000);

            // Calculate predictions for total sum of paid transaction count and total paid sales per year
            const predictedNextTotalTransactionCountPerYear = Math.round(totalTransactionCountSumPerYear + averageTransactionCountIncreasePerYear * years);
            const predictedNextTotalSalesPerYear = Math.round(totalSalesSumPerYear + averageSalesIncreasePerYear * years);

            // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year
            const averagePredictedTotalTransactionCountPerYear = Math.round(predictedNextTotalTransactionCountPerYear / years);
            const averagePredictedTotalSalesPerYear = Math.round(predictedNextTotalSalesPerYear / years);

            // Function to add commas every three numbers
            function addCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            const transactionCounts = <?= json_encode(array_column($transactions, 'transaction_count')) ?>;

            // Convert timestamps to Unix timestamps
            const totalSales = <?= json_encode(array_column($transactions, 'total_sales')) ?>;

            const predictionsDiv = document.getElementById('predictions');
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
        });
    </script>


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

// Function to add commas every three numbers
function addCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const transactionCounts2 = <?= json_encode(array_column($transactions2, 'transaction_count')) ?>;
const totalSales2 = <?= json_encode(array_column($transactions2, 'total_sales')) ?>;

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

            const transactionCounts1 = <?= json_encode(array_column($transactions1, 'transaction_count')) ?>;

            // Convert timestamps to Unix timestamps
            const totalSales1 = <?= json_encode(array_column($transactions1, 'total_sales')) ?>;

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




<?php
    $latestTimestamp3 = (new \yii\db\Query())
    ->select(['MAX(transacton_date) AS latest_timestamp'])
    ->from('operational_report')
    ->scalar();

    // Construct the new subquery
    $subquery3 = (new \yii\db\Query())
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
    $query3 = (new \yii\db\Query())
        ->select([
            'all_dates.date AS transaction_date',
            'IFNULL(COUNT(opr.transacton_date), 0) AS transaction_count',
            'IFNULL(SUM(opr.amount), 0) AS total_sales'
        ])
        ->from([
            'all_dates' => $subquery3
        ])
        ->leftJoin('operational_report opr', 'all_dates.date = opr.transacton_date AND opr.transaction_status = "paid" AND opr.division_name = "Standard and Testing Division"')
        ->groupBy('all_dates.date')
        ->orderBy(['all_dates.date' => SORT_ASC]);

    $transactions3 = $query3->all();

    // Convert timestamps to Unix timestamps
    foreach ($transactions3 as &$transaction3) {
        $transaction3['transaction_date'] = strtotime($transaction3['transaction_date']);
    }

    // Define $nextDayTimestamp using the latestTimestamp
    $nextDayTimestamp3 = strtotime('+3 day', strtotime($latestTimestamp3));


    $timestampsForCount3 = array_column($transactions3, 'transaction_date');
$transactionCounts3 = array_column($transactions3, 'transaction_count');

// Calculate linear regression coefficients for transaction count prediction
$n3 = count($timestampsForCount3);
$sumX3 = array_sum($timestampsForCount3);
$sumY3 = array_sum($transactionCounts3);
$sumXY3 = 0;
$sumX23 = 0;

for ($i = 0; $i < $n3; $i++) {
    $sumXY3 += $timestampsForCount3[$i] * $transactionCounts3[$i];
    $sumX23 += $timestampsForCount3[$i] * $timestampsForCount3[$i];
}

$slopeForCount3 = ($n3 * $sumXY3 - $sumX3 * $sumY3) / ($n3 * $sumX23 - $sumX3 * $sumX3);
$interceptForCount3 = ($sumY3 - $slopeForCount3 * $sumX3) / $n3;

// Predict the next transaction count for the next day
$predictedTransactionCount3 = $interceptForCount3 + $slopeForCount3 * $nextDayTimestamp3;

$timestampsForSales3 = array_column($transactions3, 'transaction_date');
$totalSales3 = array_column($transactions3, 'total_sales');

// Calculate linear regression coefficients for total sales prediction
$n3 = count($timestampsForSales3);
$sumX3 = array_sum($timestampsForSales3);
$sumY3 = array_sum($totalSales3);
$sumXY3 = 0;
$sumX23 = 0;

for ($i = 0; $i < $n3; $i++) {
    $sumXY3 += $timestampsForSales3[$i] * $totalSales3[$i];
    $sumX23 += $timestampsForSales3[$i] * $timestampsForSales3[$i];
}

$slopeForSales3 = ($n3 * $sumXY3 - $sumX3 * $sumY3) / ($n3 * $sumX23 - $sumX3 * $sumX3);
$interceptForSales3 = ($sumY3 - $slopeForSales3 * $sumX3) / $n3;

$totalSalesSum3 = array_sum($totalSales3);
$averageSalesIncreasePerDay3 = $totalSalesSum3 / count($timestampsForSales3);

// Predict the next total sum of all total sales
$predictedNextTotalSales3 = $totalSalesSum3 + $averageSalesIncreasePerDay3;

$totalTransactionCountSum3 = array_sum($transactionCounts3);
$averageTransactionCountIncreasePerDay3 = $totalTransactionCountSum3 / count($timestampsForCount3);

$queryPerYear3 = (new \yii\db\Query())
    ->select([
        'all_years3.year AS year',
        'IFNULL(COUNT(opr3.transacton_date), 0) AS transaction_count3',
        'IFNULL(SUM(opr3.amount), 0) AS total_sales3'
    ])
    ->from([
        'all_years3' => (new \yii\db\Query())
            ->select(['DISTINCT YEAR(transacton_date) AS year'])
            ->from('operational_report')
            ->where(['>=', 'transacton_date', '2023-06-10'])
            ->union((new \yii\db\Query())
                ->select(['DISTINCT YEAR(transacton_date) AS year'])
                ->from('operational_report')
                ->where(['YEAR(transacton_date)' => new \yii\db\Expression('YEAR(NOW())')])
            )
    ])
    ->leftJoin('operational_report opr3', 'all_years3.year = YEAR(opr3.transacton_date) AND opr3.transaction_status = "paid" AND opr3.division_name = "Standard and Testing Division"')
    ->groupBy('all_years3.year')
    ->orderBy(['all_years3.year' => SORT_ASC]);

$transactionsPerYear3 = $queryPerYear3->all();

// Prepare data for predictions (total paid transaction count and total paid sales)
$years3 = array_column($transactionsPerYear3, 'year');
$transactionCountsPerYear3 = array_column($transactionsPerYear3, 'transaction_count3');
$totalSalesPerYear3 = array_column($transactionsPerYear3, 'total_sales3');

// Calculate historical averages based on the whole dataset for paid transaction count and total sales
$totalTransactionCountSumPerYear3 = array_sum($transactionCountsPerYear3);
$averageTransactionCountIncreasePerYear3 = $totalTransactionCountSumPerYear3 / count($years3);

$totalSalesSumPerYear3 = array_sum($totalSalesPerYear3);
$averageSalesIncreasePerYear3 = $totalSalesSumPerYear3 / count($years3);
?>

    <script>
        document.getElementById('prediction-form').addEventListener('submit', function(event) {
            event.preventDefault();

           // Rest of your code...

            // Calculate predictions for paid transaction count and paid sales per year

            const years3 = parseFloat(document.getElementById('years').value);
            const days3 = Math.round(years3 * 365);

            // Calculate the timestamps for the next day and the predicted day
            const latestTimestamp3 = '<?= $latestTimestamp3 ?>';
            const nextDayTimestamp3 = new Date('<?= date('Y-m-d', $nextDayTimestamp3) ?>');
            nextDayTimestamp3.setDate(nextDayTimestamp3.getDate() + days3);

            const totalSalesSum3 = <?= $totalSalesSum3 ?>;
            const totalTransactionCountSum3 = <?= $totalTransactionCountSum3 ?>;

            // Define JavaScript variables with the values of totalSalesSum3, averageSalesIncreasePerDay3,
            // totalTransactionCountSum3, and averageTransactionCountIncreasePerDay3
            const averageSalesIncreasePerDay3 = <?= $averageSalesIncreasePerDay3 ?>;
            const averageTransactionCountIncreasePerDay3 = <?= $averageTransactionCountIncreasePerDay3 ?>;

            // Calculate historical averages based on the whole dataset for paid transaction count and total sales
            const totalTransactionCountSumPerYear3 = <?= $totalTransactionCountSumPerYear3 ?>;
            const averageTransactionCountIncreasePerYear3 = <?= $averageTransactionCountIncreasePerYear3 ?>;

            const totalSalesSumPerYear3 = <?= $totalSalesSumPerYear3 ?>;
            const averageSalesIncreasePerYear3 = <?= $averageSalesIncreasePerYear3 ?>;

            // Calculate predictions for paid transaction count and paid sales per year

            const slopeForCountPerYear3 = <?= $slopeForCount3 ?>;
            const interceptForCountPerYear3 = <?= $interceptForCount3 ?>;

            const slopeForSalesPerYear3 = <?= $slopeForSales3 ?>;
            const interceptForSalesPerYear3 = <?= $interceptForSales3 ?>;

            const nextYearTimestamp3 = new Date();
            nextYearTimestamp3.setFullYear(nextYearTimestamp3.getFullYear() + years3);

            // Calculate predictions for transaction count and total sales for the next year
            const predictedTransactionCountPerYear3 = Math.round(interceptForCountPerYear3 + slopeForCountPerYear3 * nextYearTimestamp3.getTime() / 1000);
            const predictedTotalSalesPerYear3 = Math.round(interceptForSalesPerYear3 + slopeForSalesPerYear3 * nextYearTimestamp3.getTime() / 1000);

            // Calculate predictions for total sum of paid transaction count and total paid sales per year
            const predictedNextTotalTransactionCountPerYear3 = Math.round(totalTransactionCountSumPerYear3 + averageTransactionCountIncreasePerYear3 * years3);
            const predictedNextTotalSalesPerYear3 = Math.round(totalSalesSumPerYear3 + averageSalesIncreasePerYear3 * years3);

            // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year
            const averagePredictedTotalTransactionCountPerYear3 = Math.round(predictedNextTotalTransactionCountPerYear3 / years3);
            const averagePredictedTotalSalesPerYear3 = Math.round(predictedNextTotalSalesPerYear3 / years3);

            // Calculate the average of the predicted total sum of paid transaction count and total paid sales per year

            // Function to add commas every three numbers
            function addCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            const transactionCounts3 = <?= json_encode(array_column($transactions3, 'transaction_count')) ?>;

            // Convert timestamps to Unix timestamps
            const totalSales3 = <?= json_encode(array_column($transactions3, 'total_sales')) ?>;

const predictionsDiv2 = document.getElementById('predictions5');
predictionsDiv2.innerHTML = `
<p>Predicted transaction count of the STD on the <span style="color:#0080ff">${days3}-day (${years3} year(s))</span> mark: 
        <span style="color:${predictedTransactionCountPerYear3 >= transactionCounts3[transactionCounts3.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTransactionCountPerYear3)}
            (${predictedTransactionCountPerYear3 >= transactionCounts3[transactionCounts3.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total transaction count of STD on the <span style="color:#0080ff">${days3}-day (${years3} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalTransactionCountPerYear3 >= transactionCounts3[transactionCounts3.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalTransactionCountPerYear3)}
            (${averagePredictedTotalTransactionCountPerYear3 >= transactionCounts3[transactionCounts3.length - 1] ? 'Increased' : 'Decreased '})
        </span>
    </p>
    <p>Predicted income of STD on the <span style="color:#0080ff">${days3}-day (${years3} year(s))</span> mark: 
        <span style="color:${predictedTotalSalesPerYear3 >= totalSales3[totalSales3.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTotalSalesPerYear3)}
            (${predictedTotalSalesPerYear3 >= totalSales3[totalSales3.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total income of STD on the <span style="color:#0080ff">${days3}-day (${years3} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalSalesPerYear3 >= totalSales3[totalSales3.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalSalesPerYear3)}
            (${averagePredictedTotalSalesPerYear3 >= totalSales3[totalSales3.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
`;

    });
</script>