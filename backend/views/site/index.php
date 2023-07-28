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

    .header {
        color: #0362BA;
        font-family: Poppins;
        font-size: 2rem;
        font-weight: 600;
        line-height: normal;
        letter-spacing: 3px;
        border-bottom: solid 0.2vh;
        display: flex;
        justify-content: space-between;

    }

    .header img {
        float: right;
        height: 3rem;
        margin-bottom: 1rem;
    }

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
        letter-spacing: 2.4px;
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
        letter-spacing: 2.4px;
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
        letter-spacing: 3.6px;
        grid-column: 3;
        text-align: right;
        padding-top: 2.5rem;

    }

    #dailyTrans {
        font-size: 3.375rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        letter-spacing: 8.1px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: .125rem;
        grid-template-rows: auto auto;

    }

    /* graph div */
    .graph
    {
        width: 100%;
        text-align: center;
        display: wrap;
    }
    .chart-container {
            margin: 10px;
            padding: 3em;
            border-radius: 15px;
            background-color: white;
            display: inline-block;
            height: 40vh;
            width:40%;
        }

        body.dark-mode .chart-container {
            background-color: black;

        }
        body.dark-mode .chart-container canvas {
            background-color: black;
            color: white;
        }

        #reportTitle
        {
            color: #0362BA;
            font-family: Poppins;
            font-size: .875rem;
            font-weight: 700;
            letter-spacing: 2.1px;
            
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
        height:auto;
        }

        .header {
            font-size: 1rem;
        }

        .header img {
            height: 2rem;
            margin-bottom: 1rem;
        }
            
        /* graph responsiveness */
        @media (max-width: 900px) {
            .chart-container {
                flex-basis: 100%;
                max-width: 100%;
                width: 100%;
                display: block; /* Change to block to stack vertically */
            }
        }
    }
</style>

<?=
$m = "";
// metrology transaction
$lastmettrans = 5;
$todaymettrans = 3;
$metdailytransincrease = (($todaymettrans - $lastmettrans) / $todaymettrans) * 100;
$metdailytransincrease = number_format($metdailytransincrease, 2);
if ($metdailytransincrease > 1) {
    $metdailytransincrease = '+' . $metdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}

//S&T transaction
$lastSandTtrans = 2;
$todaySandTtrans = 10;
$SandTdailytransincrease = (($todaySandTtrans - $lastSandTtrans) / $todaySandTtrans) * 100;
$SandTdailytransincrease = number_format($SandTdailytransincrease, 2);
if ($SandTdailytransincrease > 1) {
    $SandTdailytransincrease = '+' . $SandTdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}
//T&S transaction
$lastTandStrans = 6;
$todayTandStrans = 100;
$TandSdailytransincrease = (($todayTandStrans - $lastTandStrans) / $todayTandStrans) * 100;
$TandSdailytransincrease = number_format($TandSdailytransincrease, 2);
if ($TandSdailytransincrease > 1) {
    $TandSdailytransincrease = '+' . $TandSdailytransincrease . '%';
} else {
    $metdailytransincrease = $metdailytransincrease . '%';
}


?>

<div class="header">
    <!-- <div class="header-grid"> -->
    <p>Dashboard</p>
    <img src="/images/LogoVL.png" alt="visLogo">
    <!-- </div> -->
</div> <br>

<div class="DailyTransaction">
    <p>Total Transactions Daily</p>

    <div class="deptransaction">
        <p>National Metrology</p>
        <div class="grid">
            <img src="/images/Pressure Gauge.png" alt="icon1">
            <p id="dailyTrans"><?= $todaymettrans ?></p>
            <p id="valueIncrease"><?= $metdailytransincrease ?></p>
        </div>
    </div>
    <div class="deptransaction" style="background-color:#02A560;">
        <p>Standards and Testing</p>
        <div class="grid">
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

<?php
//transactions data
$SalesperDiv = [
    'labels' => ['06/10/2023', '06/11/2023', '06/12/2023', '06/13/2023', '06/14/2023', '06/15/2023','06/16/2023'],
    'datasets' => [
        [
            'label' => 'NMD',
            'data' => [500000, 80000, 270000, 100000, 410000, 120000, 200000],
        ],
        [
            'label' => 'STD',
            'data' => [200000, 80000, 400000, 500000, 120000, 230000, 300000],
         
        ],
        [
            'label' => 'TSD',
            'data' => [450000, 80000, 350000, 120000, 410000, 120000, 280000],
            
        ],
    ],
];
$TransactionperDiv = [
    'labels' => ['06/10/2023', '06/11/2023', '06/12/2023', '06/13/2023', '06/14/2023', '06/15/2023','06/16/2023'],
    'datasets' => [
        [
            'label' => 'NMD',
            'data' => [5, 1, 2, 4, 3, 2, 3],
           
            
        ],
        [
            'label' => 'STD',
            'data' => [1, 1, 3, 4, 2, 2, 2],
         
        ],
        [
            'label' => 'TSD',
            'data' => [5, 1, 3, 1, 3, 1, 3],
           
        ],
    ],
];

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>
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

    <!-- <div class="chart-container">
        <p id="reportTitle"> Sales per Division</p>
        <canvas id="horizontalChart"></canvas>
    </div> -->


    <div class="chart-container">
        <p id="reportTitle"> Sales per Division</p>
        <canvas id="salesChart"></canvas>
    </div>
    
    <!-- <div class="chart-container" >
        <p id="reportTitle"> Total transaction</p>
        <canvas id="barChart"></canvas>
    </div> -->

    <div class="chart-container" >
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
            datasets: [
                {
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
                     y: 
                        {
                      beginAtZero: true,
                      ticks: {
                        stepSize: 1
                    },
                    grid: {
                        display: false
                    }   
                         },
                     'y-axis-bar':
                        {
                       position: 'right', // Show the primary y-axis on the left side (sumTransactionDataset)
                        },
                     'lineY':
                        {
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
                      legend:
                        {
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
                borderColor: ['blue','#e75480','green'], // Change the color of the lines
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

        // //data set
        // const salesAverageDataset = {
        //  labels: salesAverage.map(data => data.label),
        //  datasets: [{
        //   data: salesAverage.map(data => data.average),
        //  backgroundColor: ['blue', 'green', 'pink'], // Add colors for each dataset
        //      label: 'Average Sales'
        //     }]
        //     };

//             const salesAverage = [
//   { label: 'NMD', average: 5 },
//   { label: 'STD', average: 4 },
//   { label: 'TSD', average: 3 },
// ];

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