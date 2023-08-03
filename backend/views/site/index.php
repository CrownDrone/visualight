<?php

$this->title = '';
?>

<style>
    @font-face {
        font-family: 'Poppins';
        src: url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.ttf') format('truetype'),
            url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.woff') format('woff');

    }

    :root {
        font-size: 16px;
    }

    /* header div css (Visualight logo and the "Dashboard text") */

    /* .header {
        color: #0362BA;
        font-family: Poppins;
        font-size: 2rem;
        font-weight: 600;
        line-height: normal;
        letter-spacing: 3px;
        border-top: solid 0.5vh;
        display: flex;   
        justify-content: space-between;

    } */

    /* .header img {
        float: right;
        height: 3rem;
        margin-bottom: 1rem;
    } */

    /* Daily transaction css */

    .DailyTransaction {
        width: 100%;
        height: 10.8125rem;
        border-radius: .635rem;
        background: #EFF5FF;
        text-align: center;
        color: #3A3835;
        font-family: Poppins;
        font-size: 1rem;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        letter-spacing: .15rem;
        display: wrap;

    }

    .deptransaction {
        width: 30%;
        height: 7.875rem;
        border-radius: .635rem;
        background: #0073C7;
        color: #FFF;
        font-family: Poppins;
        font-size: 1rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        letter-spacing: .15rem;
        display: inline-block;
    }

    .deptransaction img {
        margin-left: .625rem;
    }

    .deptransaction:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    #valueIncrease {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: .15rem;
        grid-column: 3;
        text-align: right;
        padding-top: 2.5rem;

    }

    #dailyTrans {
        font-size: 3.375rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        letter-spacing: .5rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: .125rem;
        grid-template-rows: auto auto;

    }

    /* graph div */
    .graph {
        width: 100%;
        text-align: center;
        display: wrap;
    }

    .chart-container {
        margin: .62rem;
        padding: 3em;
        border-radius: .93rem;
        background-color: white;
        display: inline-block;
        height: 30rem;
        width: 45%;
    }

    body.dark-mode .chart-container {
        background-color: black;

    }

    body.dark-mode .chart-container canvas {
        background-color: black;
        color: white;
    }

    #reportTitle {
        color: #0362BA;
        font-family: Poppins;
        font-size: .875rem;
        font-weight: 700;
        letter-spacing: .15rem;

    }

    /* responsiveness */

    @media (max-width: 900px) {
        .deptransaction {
            width: 80%;
            display: justify;
            /* Change to block to stack vertically */
            margin: 0 auto 1rem;


        }

        .DailyTransaction {
            height: auto;
        }

        .header {
            font-size: 1rem;
        }

        /* .header img {
            height: 2rem;
            margin-bottom: 1rem;
        } */

        /* graph responsiveness */
        @media (max-width: 900px) {
            .chart-container {
                flex-basis: 100%;
                max-width: 100%;
                width: 95%;
                height:25rem;
                display: block;

                /* Change to block to stack vertically */
            }
        }
    }
</style>

<?php
use yii\db\Query;

// Fetch sales data from the database
$query = new Query();
$salesData = $query->select(['division_name', 'transacton_date', 'SUM(amount) as total_amount'])
    ->from('operational_report')
    ->groupBy(['division_name', 'transacton_date'])
    ->all();

// Fetch transaction data from the database (depends on how many transaction in same date and same div_name)
$transactionData = $query->select(['division_name', 'transacton_date', 'COUNT(*) as transaction_count'])
    ->from('operational_report')
    ->groupBy(['division_name', 'transacton_date'])
    ->all();

// Prepare $SalesperDiv array (null pa to)
$SalesperDiv = [
    'labels' => [],
    'datasets' => [],
];

//dito kukuha ng data for $SalesperDiv
foreach ($salesData as $data) {
    $divisionName = $data['division_name'];
    $transactionDate = $data['transacton_date'];
    $totalAmount = (float) $data['total_amount'];

    // Add unique dates to the labels array
    if (!in_array($transactionDate, $SalesperDiv['labels'])) {
        $SalesperDiv['labels'][] = $transactionDate;
    }

    // Find the index of the division in the datasets array
    $divisionIndex = array_search($divisionName, array_column($SalesperDiv['datasets'], 'label'));

    if ($divisionIndex === false) {
        // Add a new dataset for the division if not already present
        $SalesperDiv['datasets'][] = [
            'label' => $divisionName,
            'data' => [$totalAmount],
        ];
    } else {
        // If the dataset already exists, add the amount to the existing data
        $SalesperDiv['datasets'][$divisionIndex]['data'][] = $totalAmount;
    }
}


// Prepare $TransactionperDiv array (null pa// otw yung data HAHA)
$TransactionperDiv = [
    'labels' => [],
    'datasets' => [],
];

//getting data for the $TransactionperDiv
foreach ($transactionData as $data) {
    $divisionName = $data['division_name'];
    $transactionDate = $data['transacton_date'];
    $transactionCount = (int) $data['transaction_count'];

    // Add unique dates to the labels array
    if (!in_array($transactionDate, $TransactionperDiv['labels'])) {
        $TransactionperDiv['labels'][] = $transactionDate;
    }

    // Find the index of the division in the datasets array
    $divisionIndex = array_search($divisionName, array_column($TransactionperDiv['datasets'], 'label'));

    if ($divisionIndex === false) {
        // Add a new dataset for the division if not already present
        $TransactionperDiv['datasets'][] = [
            'label' => $divisionName,
            'data' => [$transactionCount],
        ];
    } else {
        // If the dataset already exists, add the transaction count to the existing data
        $TransactionperDiv['datasets'][$divisionIndex]['data'][] = $transactionCount;
    }
}


//setting default colors for each department
$divisionColors = [
    'National Metrology Department' => [
        'backgroundColor' => 'rgba(54, 162, 255, 0.3)',
        'borderColor' => 'rgba(54, 162, 255, 1)',
        'borderWidth' => 2,
    ],
    'Standard and Testing Division' => [
        'backgroundColor' => 'rgba(0, 128, 0, 0.3)',
        'borderColor' => 'rgba(0, 128, 0, 1)', 
        'borderWidth' => 2,
    ],
    'Technological Services Division' => [
        'backgroundColor' => 'rgba(245, 40, 145, 0.2)',
        'borderColor' => 'rgba(245, 40, 145, 1)', 
        'borderWidth' => 2,
    ],
];

//dito yung pag lalagay nung naka set na color
foreach ($SalesperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division_name not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division_name not found
    $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}

foreach ($TransactionperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division_name not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division_name not found
    $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}


//Dito yung para sa Total ng Daily Transaction (tinatype ko pa yung date kasi di ako marunong nung rekta connected sa calendar HAHAHAH)

//Metrology transaction
//dito banda kukunin yung number of transaction tapos kung anong date
$metlatestTransactions = (new Query())
->select('COUNT(*)')
->from('operational_report')
->where([
    'division_name' => 'National Metrology Department',
    'transacton_date' => date('2023-06-16') // Assuming you want the number of transactions for today
])
->scalar();

//dito magcocompute ng percentage ng increase or decrease ng number of past transaction at today's transaction (tinatype ko pa din yung sa last transaction kunwari kasi di pa ko marunong)
$lastmettrans = 5;
$todaymettrans = $metlatestTransactions;
$metdailytransincrease = (($todaymettrans - $lastmettrans) / $todaymettrans) * 100;
$metdailytransincrease = number_format($metdailytransincrease, 2);
if ($metdailytransincrease > 1) {
    $metdailytransincrease = '+' . $metdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}

//same scenario sa taas
//S&T transaction
$SandTlatestTransactions = (new Query())
->select('COUNT(*)')
->from('operational_report')
->where([
    'division_name' => 'Standard and Testing Division',
    'transacton_date' => date('2023-06-16') // Assuming you want the number of transactions for today
])
->scalar();

$lastSandTtrans = 1;
$todaySandTtrans = $SandTlatestTransactions ;
$SandTdailytransincrease = (($todaySandTtrans - $lastSandTtrans) / $todaySandTtrans) * 100;
$SandTdailytransincrease = number_format($SandTdailytransincrease, 2);
if ($SandTdailytransincrease > 1) {
    $SandTdailytransincrease = '+' . $SandTdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}

//T&S transaction
$TandSlatestTransactions = (new Query())
->select('COUNT(*)')
->from('operational_report')
->where([
    'division_name' => 'Standard and Testing Division',
    'transacton_date' => date('2023-06-16') // Assuming you want the number of transactions for today
])
->scalar();
$lastTandStrans = 1;
$todayTandStrans = $TandSlatestTransactions;
$TandSdailytransincrease = (($todayTandStrans - $lastTandStrans) / $todayTandStrans) * 100;
$TandSdailytransincrease = number_format($TandSdailytransincrease, 2);
if ($TandSdailytransincrease > 1) {
    $TandSdailytransincrease = '+' . $TandSdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}



?>

<!-- DailyTransaction Div, will hold the "Total Transaction Daily" -->
<div class="DailyTransaction">
    <p>Total Transactions Daily</p>

    <div class="deptransaction">
        <p>National Metrology</p>
        <div class="grid">
            <!-- Icon holder -->
            <img src="/images/Pressure Gauge.png" alt="icon1">
            <!-- Will call the variable set in the php above -->
            <p id="dailyTrans"><?= $todaymettrans ?></p> 
            <p id="valueIncrease"><?= $metdailytransincrease ?></p>
        </div>
    </div>
    <div class="deptransaction" style="background-color:#02A560;">
        <p>Standards and Testing</p>
        <div class="grid">
            <!-- same scenarios -->
            <img src="/images/Pass Fail.png" alt="icon2">
            <p id="dailyTrans"><?= $todaySandTtrans ?></p>
            <p id="valueIncrease"><?= $SandTdailytransincrease ?></p>
        </div>
    </div>
    <div class="deptransaction" style="background-color:#F21A9C;">
        <p>Technological Services</p>
        <div class="grid">
            <img src="/images/Service.png" alt="icon3">
            <p id="dailyTrans"><?= $todayTandStrans ?></p>
            <p id="valueIncrease"><?= $TandSdailytransincrease ?></p>
        </div>
    </div>

</div> <br>

<!-- graph Div, holder of graphs -->
<div class="graph">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="chart-container">
        <p id="reportTitle"> Physical Report of Operation</p>
        <canvas id="combinedChart"></canvas>
    </div>

    <div class="chart-container">
        <p id="reportTitle"> Transaction Per Division</p>
        <canvas id="transactionChart"></canvas>
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Sales per Division</p>
        <canvas id="salesChart"></canvas>
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Average Sales per Day </p>
        <canvas id="semiCircleChart"></canvas>
    </div>



    <script>
        // Reference datas
        const TransactionperDiv = <?php echo json_encode($TransactionperDiv); ?>;
        const SalesperDiv = <?php echo json_encode($SalesperDiv); ?>;

        // getting the sum of the transactions per day (from the data of $TransactionperDiv)
        const sumTransaction = TransactionperDiv.labels.map((label, index) => {
            let sum = 0;
            TransactionperDiv.datasets.forEach(dataset => {
                sum += dataset.data[index];
            });
            return sum;
        });

        // Create a new data set named sumTransactionDataset from what we got from sumTransaction
        const sumTransactionDataset = {
            label: 'Total Transaction',
            data: sumTransaction,

        };

        // creating bar graph for the sumTransactionDataset
        // const barCtx = document.getElementById('barChart').getContext('2d');

        // const barChart = new Chart(barCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: TransactionperDiv.labels,
        //         datasets: [sumTransactionDataset],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // getting the sum of the sales per day (from the data of $SalesperDiv)
        const sumSalesData = SalesperDiv.labels.map((label, index) => {
            let sum = 0;
            SalesperDiv.datasets.forEach(dataset => {
                sum += dataset.data[index];
            });
            return sum;
        });

        // Create a new data set named sumSalesDataset from what we got from sumSalesData
        const sumSalesDataset = {
            label: 'Total Sales',
            data: sumSalesData,
        };

        //Creating a combined data using the sumTransactionDataset and sumSalesDataset (to be used/call in creating combined chart)
        const combinedData = {
            labels: TransactionperDiv.labels,
            datasets: [{
                    ...sumSalesDataset,
                    type: 'line', // Use line type
                    backgroundColor: 'black',
                    borderColor: '#e75480',
                    yAxisID: 'lineY', // Assign the line chart to a specific y-axis
                    cubicInterpolationMode: 'monotone'


                },
                {
                    ...sumTransactionDataset,
                    borderColor: 'black',
                    backgroundColor: '#87CEEB',
                    type: 'bar',
                    borderWidth: 1,
                    yAxisID: 'y-axis-bar', // Assign the line chart to a specific y-axis

                },
            ]
        };

        // Createing combined chart
        const combinedCtx = document.getElementById('combinedChart').getContext('2d');

        const combinedChart = new Chart(combinedCtx, {
            type: 'line', // Start as bar chart
            data: combinedData,
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: false
                        }
                    },
                    'y-axis-bar': {
                        position: 'right', // Show the primary y-axis on the left side (sumTransactionDataset)
                    },
                    'lineY': {
                        position: 'left', // Show the secondary y-axis on the right side (sumSalesDataset)
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Customize the step size as needed
                        },
                        grid: {
                            display: false
                        }
                    },
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                },
            },
        });



        // Creating bar graphs
        const transactionCtx = document.getElementById('transactionChart').getContext('2d');
        const salesCtx = document.getElementById('salesChart').getContext('2d');

        const transactionChart = new Chart(transactionCtx, {
            type: 'bar',
            data: TransactionperDiv,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //creating line graph
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: SalesperDiv,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,


                    },

                },
                elements: {
                    line: {
                        borderColor: ['blue', '#e75480', 'green'], // Change the color of the lines
                        borderWidth: 2, // Adjust the width of the lines
                    },
                    point: {
                        backgroundColor: 'red', // Change the color of the dots
                        borderColor: 'red', // Change the border color of the dots
                        borderWidth: 1, // Adjust the width of the border of the dots
                        radius: 4, // Adjust the size of the dots
                        hoverRadius: 6, // Adjust the size of the dots on hover
                    },
                },


            }
        });

        // Function to calculate the average of an array of numbers
        const calculateAverage = (array) => {
            if (array.length === 0) return 0;
            const sum = array.reduce((total, num) => total + num, 0);
            return Math.round(sum / array.length);
        };

        // Calculate the average of each dataset
        const salesAverage = SalesperDiv.datasets.map(dataset => ({
            label: dataset.label,
            average: calculateAverage(dataset.data),
        }));

        const semiCircleCtx = document.getElementById('semiCircleChart').getContext('2d');

        const semiCircleChart = new Chart(semiCircleCtx, {
            type: 'doughnut',
            data: {
                labels: salesAverage.map(data => data.label),
                datasets: [{
                    data: salesAverage.map(data => data.average),
                    backgroundColor: ['blue', 'green', 'pink'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Adjust this value to control the size of the "doughnut hole" (semi-circle)
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom', // Adjust legend position as needed
                    },
                    datalabels: {
                        color: 'white', // Set the color of data labels (values) inside each segment
                        font: {
                            size: 14, // Adjust the font size of data labels as needed
                        }
                    }
                }
            }
        });

        //creating horizontal bar graph (kaso ayaw lumabas HAHAHAHAH)
        // const horizontalCtx = document.getElementById('horizontalChart').getContext('2d');

        // const horizontalChart = new Chart(horizontalCtx, {
        //     type: 'bar',
        //     data: TotalTransaction,
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
    </script>






    <!-- <div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
            <?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'CPU Traffic',
                'number' => '10 <small>%</small>',
                'icon' => 'fas fa-cog',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '410',
                'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Uploads',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '41,410',
                'icon' => 'far fa-bookmark',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Likes',
                'number' => '41,410',
                'theme' => 'success',
                'icon' => 'far fa-thumbs-up',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id . '-ribbon',
                'text' => 'Ribbon',
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Events',
                'number' => '41,410',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-calendar-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ],
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id . '-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
</div> -->