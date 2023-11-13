<?php
date_default_timezone_set("Asia/Hong_Kong");

$this->title = '';

$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<style>
    @font-face {
        font-family: 'Poppins';
        src: url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.ttf') format('truetype'),
            url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.woff') format('woff');

    }

    /* Default styles */
    .chart-container {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .average {
        position: absolute;
        top: 80px;
        right: 95px;
        text-align: center;
        width: 30%;
        display: inline-block;
    }

    .aveTransactionDiv,
    .aveSalesDiv {
        background-color: #B526C2;
        color: white;
        width: 20rem;
        height: 12rem;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 30px;
    }

    .aveTransactionDiv {
        background-color: #11A34C;
        /* Updated background color for .aveTransactionDiv */
    }

    .texty {
        margin: 0;
        font-weight: bold;
        font-size: 2rem;
        font-family: Poppins;
    }

    .number {
        margin: 0;
        font-family: Poppins;
        font-size: 4rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #myChart {
        position: absolute;
        left: 50px;
        top: 45px;
    }

    .asOne {
        justify-content: space-between;
        width: 40%;
        right: 40%;
        left: 60%;
    }

    @media (max-width: 600px) {
        .average {
            position: absolute;
            top: 25%;
            right: 10%;
            box-sizing: border-box;
            display: inline-block;
        }

        .aveTransactionDiv,
        .aveSalesDiv {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 15px;
        }

        #myChart {
            position: absolute;
            left: 50px;
            top: 150px;
            justify-content: space-between;
        }

        .asOne {
            justify-content: space-between;
            width: 60%;
            right: 45%;
        }
    }



    :root {
        font-size: 16px;
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
        letter-spacing: .15rem;
        display: wrap;

    }

    .deptransaction {
        width: 45%;
        height: 7.875rem;
        border-radius: .635rem;
        background: #11A34C;
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

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: .125rem;
        grid-template-rows: auto auto;

    }

    #dailyTrans {
        font-size: 3.375rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        letter-spacing: .5rem;
    }

    #valueIncrease {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: .15rem;
        grid-column: 3;
        text-align: right;
        padding-top: 2.5rem;

    }


    /* dropdown and datepicker */

    .date_filter {
        width: 100%;
        height: 5.8125rem;
        display: wrap;
        text-align: center;
    }

    .containers {
        width: 45%;
        height: 7.875rem;
        display: inline-block;
    }

    .dropdown_pdf_container {
        position: relative;
    }

    .date_dropdown {
        position: relative;
        padding-top: 1.1rem;
        padding-bottom: 1.1rem;
        float: left;
        overflow: hidden;
        z-index: 99;
    }

    .date_type_label {
        font-style: Poppins;
        color: #F8B200;
        font-size: 1.3rem;
        letter-spacing: .30rem;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        min-width: 8rem;
        z-index: 1;
        text-align: center;
        border-radius: 0.5rem;
    }

    .date_type {
        border-radius: 0.5rem
    }

    .print_pdf {
        padding-right: 8.7rem;
        padding-top: 1.3rem;
        padding-bottom: 1.1rem;
        right: 1rem;
    }

    .print_pdf_label {
        border-radius: 1rem;
        background-color: #00BDB2;
        font-size: .7rem;
        text-align: center;
        margin: auto;
        padding: 0.2rem;
        padding-left: 1rem;
        padding-right: 1rem;
        color: white;
        width: 7rem;
    }

    .datePicker_label {
        border-radius: 0.5rem;
        width: 8rem;
        text-align: center;
        font-size: 0.9rem;
    }

    .datePicker {
        text-align: right;
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
        height: 35rem;
        width: 100%;

    }



    .graph2 {
        width: 100%;
        text-align: center;
        display: wrap;
        background-color: white;
    }

    .chart-container2 {
        margin: .1rem;
        padding-top: 3rem;
        padding-bottom: 3rem;
        border-radius: .93rem;
        background-color: white;
        display: inline-block;
        height: 28rem;
        width: 49%;
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

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border: 1px solid #333;
        box-shadow: 2px 2px 10px #888;
        text-align: center;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }

    .half-speedometer {
        margin-top: 20px;
        text-align: center;
    }

    .speedometer-dial {
        width: 150px;
        height: 75px;
        /* Half the height of the full dial */
        background-color: red;
        border-radius: 75px 75px 0 0;
        /* Round the top corners */
        position: relative;
        margin: 0 auto;
    }

    .speedometer-reading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        font-weight: bold;
    }

    .speedometer-arrow {
        position: absolute;
        width: 2px;
        height: 30px;
        background-color: black;
        top: 45%;
        left: 50%;
        transform-origin: 50% 0;
        transform: translateX(-50%) rotate(0deg);
        transition: transform 1s ease;
    }




    /* responsiveness */

    /* daily transaction div */
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
    }

    /* graph responsiveness */
    @media (max-width: 900px) {
        .chart-container {
            flex-basis: 100%;
            max-width: 100%;
            width: 95%;
            height: 25rem;
            display: block;
        }

        .chart-container2 {
            flex-basis: 100%;
            max-width: 100%;
            width: 95%;
            height: 25rem;
            display: block;
        }
    }

    /* dropdown and date picker responsiveness */
    /* tablet ui */
    @media (min-width: 720),
    (max-width:1500px) {

        .date_filter {
            height: 2.8125rem;
        }

        .containers {
            height: 2.875rem;
        }

        .date_dropdown {
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
        }

        .date_type_label {
            font-size: .8rem;
            letter-spacing: 0.01rem;
        }

        .dropdown-content {
            z-index: 1;
            text-align: center;
            border-radius: 0.5rem;
            width: 0.02rem;
            height: 1.5rem;
            font-size: .8rem;
        }

        .date_type {
            border-radius: 1px;
        }

        .print_pdf {
            padding-right: 0rem;
            padding-top: .5rem;
            padding-bottom: .2rem;
        }

        .print_pdf_label {
            border-radius: 1rem;
            padding-left: 0rem;
            padding-right: 0rem;
            width: 9rem;
        }

        .datePicker_label {
            border-radius: 0.3rem;
            width: 6rem;
            font-size: .6rem;
        }

    }

    /* phone ui */
    @media (max-width: 719px) {
        .date_filter {
            height: 7.8125rem;

        }

        .containers {
            height: 4.875rem;
            width: 100%;
            display: inline-block;
        }


        .date_dropdown {
            /* padding-right: 3rem; */
            padding-top: .5rem;
            padding-bottom: .5rem;
        }

        .date_type_label {
            font-size: .8rem;
            letter-spacing: 0.01rem;
        }

        .dropdown-content {
            width: 0.02rem;
            height: 1.5rem;
            font-size: .8rem;
        }

        .date_type {
            border-radius: 1px;
        }

        .print_pdf {
            /* padding-right: 0rem; */
            padding-top: .5rem;
            padding-bottom: .2rem;
        }

        .print_pdf_label {
            padding-left: 0rem;
            padding-right: 0rem;
            width: 6rem;
        }

        .datePicker {
            font-size: .8rem;
            text-align: left;

        }

        .datePicker_label {
            border-radius: 0.3rem;
            width: 6rem;
            height: 1rem;
            text-align: center;
            font-size: .6rem;
        }
    }

    /* 
    .date_filter 
        {
        height: 2.8125rem;
        }

        .containers
        {
            height: 2.875rem;
        }

        .date_dropdown 
        {
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
        }

        .date_type_label {
            font-size: .8rem;
            letter-spacing: 0.01rem;
        }

        .dropdown-content 
        {
            z-index: 1;
            text-align: center;
            border-radius: 0.5rem;
            width: 0.02rem;
            height: 1.5rem;
            font-size: .8rem;
        }
        
        .date_type 
        {
            border-radius:1px;
        }

        .print_pdf 
        {
            padding-right: 0rem;
            padding-top:.5rem;
            padding-bottom:.2rem;
        }

        .print_pdf_label 
        {
            border-radius: 1rem;
            padding-left: 0rem;
            padding-right: 0rem;
            width: 6rem;
        }
        
        .datePicker_label 
        {
            border-radius: 0.3rem;
            width: 6rem;
            font-size: .6rem;
        }
    
    } */
</style>

<?php

use yii\db\Query;
use yii\bootstrap5\Html;
use controllers\SiteController;
// Fetch sales data from the database
// $fromDate = $_POST['startDate'];
// $toDate = $_POST['endDate'];

Yii::$app->set('db', [ //reroute default connection 
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=visualight2data',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);


$query = new Query();

$salesData = $query->select(['division', 'transaction_date', 'SUM(amount) as total_amount'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    // ->where(['between', 'transaction_date', '2023-06-10', '2023-06-14'])
    ->groupBy(['division', 'transaction_date'])
    ->orderBy(['transaction_date' => SORT_DESC])
    ->all();

// Fetch transaction data from the database (depends on how many transaction in same date and same div)
$transactionData = $query->select(['division', 'transaction_date', 'COUNT(*) as transaction_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['division', 'transaction_date'])
    ->orderBy(['transaction_date' => SORT_DESC])
    ->all();

$TransactionperDiv = [
    'labels' => [],
    'datasets' => [],
];


$lotMapping = [
    "1" => "National Metrology Division",
    "2" => "Standards and Testing Division",
];

foreach ($transactionData as &$item) {
    if (isset($item['division']) && isset($lotMapping[$item['division']])) {
        $item['division'] = $lotMapping[$item['division']];
    }
}

foreach ($salesData as &$item) {
    if (isset($item['division']) && isset($lotMapping[$item['division']])) {
        $item['division'] = $lotMapping[$item['division']];
    }
}

//getting data for the $TransactionperDiv
foreach ($transactionData as $data) {
    $divisionName = $data['division'];
    $transactionDate = $data['transaction_date'];
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

$addressData = $query->select(['address', 'COUNT(*) as customer_count'])
    ->from('customer')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['address'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->all();

// // Prepare data for the chart
// $province = [];
// $customersCounts = [];
$provinces = [
    'labels' => [],
    'datasets' => [],
];

foreach ($addressData as $customeraddress) {
    $province[] = $customeraddress['address'];
    $customersCounts[] = $customeraddress['customer_count'];

    if (!in_array($province, $provinces['labels'])) {
        $provinces['labels'][] = $province;
    }
    $provinceIndex = array_search($province, array_column($provinces['datasets'], 'label'));
    if ($provinceIndex === false) {
        // Add a new dataset for the division if not already present
        $provinces['datasets'][] = [
            'label' => $province,
            'data' => [$customersCounts],
        ];
    } else {
        // If the dataset already exists, add the transaction count to the existing data
        $provinces['datasets'][$provinceIndex]['data'][] = $customersCounts;
    }
}

$customerTypeData = $query->select(['customer_type', 'COUNT(*) as customer_count'])
    ->from('customer')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer_type'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();
$customerType = [];
$customerscounts = [];

$customerType_name = [
    "1" => "Student",
    "2" => "Individual",
    "3" => "Private",
    "4" => "Government",
    "5" => "Internal",
    "6" => "Academe",
    "7" => "Not Applicable",
];


foreach ($customerTypeData as $type) {
    if (isset($type['customer_type']) && isset($customerType_name[$type['customer_type']])) {
        $type['customer_type'] = $customerType_name[$type['customer_type']];
    }

    $customerType[] = $type['customer_type'];
    $customerscounts[] = $type['customer_count'];
}

$transactionTypeData = $query->select(['transaction_type', 'COUNT(*) as customer_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['transaction_type'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();
$transactionType = [];
$transactionTypecounts = [];

$transactionType_name = [
    "1" => "Technical Services",
    "2" => "National Laboratory Information Management System",
    "3" => "Unified Laboratory Information Management System",
];

foreach ($transactionTypeData as $type) {
    if (isset($type['transaction_type']) && isset($transactionType_name[$type['transaction_type']])) {
        $type['transaction_type'] = $transactionType_name[$type['transaction_type']];
    }

    $transactionType[] = $type['transaction_type'];
    $transactionTypecounts[] = $type['customer_count'];
}

$transactionStatusData = $query->select(['transaction_status', 'COUNT(*) as customer_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['transaction_status'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();

$transactionStatus = [];
$transactionStatusDatacounts = [];

$transactionStatus_name = [
    "1" => "Paid",
    "2" => "Cancelled",
    "3" => "Pending",
];


foreach ($transactionStatusData as $status) {
    if (isset($status['transaction_status']) && isset($transactionStatus_name[$status['transaction_status']])) {
        $status['transaction_status'] = $transactionStatus_name[$status['transaction_status']];
    }
    $transactionStatus[] = $status['transaction_status'];
    $transactionStatusDatacounts[] = $status['customer_count'];
}

$PaymentMethodData = $query->select(['payment_method', 'COUNT(*) as customer_count'])
    ->from('transaction')
    ->where(['payment_method' => ['1', '2', '3']])
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['payment_method'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();

$PaymentMethod = [];
$PaymentMethodcounts = [];


$paymentmethod_name = [
    "1" => "Over the Counter",
    "2" => "Online Payment",
    "3" => "Cheque",
];

foreach ($PaymentMethodData as $method) {
    if (isset($method['payment_method']) && isset($paymentmethod_name[$method['payment_method']])) {
        $method['payment_method'] = $paymentmethod_name[$method['payment_method']];
    }
    $PaymentMethod[] = $method['payment_method'];
    $PaymentMethodcounts[] = $method['customer_count'];
}


// Prepare $SalesperDiv array (null pa to)
$SalesperDiv = [
    'labels' => [],
    'datasets' => [],
];



//dito kukuha ng data for $SalesperDiv
foreach ($salesData as $data) {
    $divisionName = $data['division'];
    $transactionDate = $data['transaction_date'];
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

$transactionPerday = (new Query())
    ->select('transaction_date, COUNT(*) as transaction_count')
    ->from('transaction')
    ->where(['transaction_status' => '1'])
    ->groupBy('transaction_date');

$transactionPerday = $transactionPerday->all(); // Get the results with daily transaction counts
$totalDays = count($transactionPerday); // Total number of days
$totalTransactions = 0;

foreach ($transactionPerday as $result) {
    $totalTransactions += $result['transaction_count'];
}
$average = round($totalTransactions / $totalDays); // Calculate the average

$SalesAve = (new Query())
    ->select('transaction_date, SUM(amount) as transaction_count')
    ->from('transaction')
    ->where(['transaction_status' => '1'])
    ->groupBy('transaction_date');

$SalesAve = $SalesAve->all(); // Get the results with daily transaction counts
$totalDays = count($SalesAve); // Total number of days
$totalTransactions = 0;

foreach ($SalesAve as $result) {
    $totalTransactions += $result['transaction_count'];
}
$saleaverage = round($totalTransactions / $totalDays); // Calculate the average
if ($saleaverage >= 1000 && $saleaverage <= 999999) {
    $saleaverage = round(($saleaverage / 1000), 2) . 'K';
} else if ($saleaverage >= 1000000 && $saleaverage <= 999999999) {
    $saleaverage = round(($saleaverage / 1000000), 2) . 'M';
} else if ($saleaverage >= 1000000000) {
    $saleaverage = round(($saleaverage / 1000000000), 2) . 'B';
}

//setting default colors for each department
$divisionColors = [
    'National Metrology Division' => [
        'backgroundColor' => '#06d6a0',
        'borderWidth' => 2,
    ],
    'Standards and Testing Division' => [
        'backgroundColor' => '#7209b7',
        'borderWidth' => 2,
    ],
];

//dito yung pag lalagay nung naka set na color
foreach ($SalesperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}

foreach ($TransactionperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}


//Dito yung para sa Total ng Daily Transaction (tinatype ko pa yung date kasi di ako marunong nung rekta connected sa calendar HAHAHAH)
date_default_timezone_set('Asia/Manila');
//Metrology transaction
//dito banda kukunin yung number of transaction tapos kung anong date
$todaymettrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '1',
        'transaction_date' => date('Y-m-d') // Assuming you want the number of transactions for today
    ])
    ->scalar();

$lastmettrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '1',
        'transaction_date' => date('Y-m-d', strtotime('-1 day'))
    ])
    ->scalar();

if ($todaymettrans == 0) {
    $metdailytransincrease = 0;
} else {
    //dito magcocompute ng percentage ng increase or decrease ng number of past transaction at today's transaction (tinatype ko pa din yung sa last transaction kunwari kasi di pa ko marunong)
    $metdailytransincrease = (($todaymettrans - $lastmettrans) / $todaymettrans) * 100;
    $metdailytransincrease = number_format($metdailytransincrease, 2);
    if ($metdailytransincrease > 1) {
        $metdailytransincrease = '+' . $metdailytransincrease . '%';
    } else {
        $metdailytransincrease = $metdailytransincrease . '%';
    }
}
//same scenario sa taas



//S&T transaction
$todaySandTtrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d')
    ])
    ->scalar();

$lastSandTtrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d', strtotime('-1 day'))
    ])
    ->scalar();

if ($todaySandTtrans == 0) {
    $SandTdailytransincrease = 0;
} else {

    $SandTdailytransincrease = (($todaySandTtrans - $lastSandTtrans) / $todaySandTtrans) * 100;
    $SandTdailytransincrease = number_format($SandTdailytransincrease, 2);
    if ($SandTdailytransincrease > 1) {
        $SandTdailytransincrease = '+' . $SandTdailytransincrease . '%';
    } else {
        $SandTdailytransincrease = $SandTdailytransincrease . '%';
    }
}

Yii::$app->set('db', [ //revert default connection 
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=visualight2user',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);

?>
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
    <div class="deptransaction" style="background-color:#7209b7;">
        <p>Standards and Testing</p>
        <div class="grid">
            <img src="/images/Pass Fail.png" alt="icon2">
            <p id="dailyTrans"><?= $todaySandTtrans ?></p>
            <p id="valueIncrease"><?= $SandTdailytransincrease ?></p>
        </div>
    </div>
</div>

<div id="sending-email-message" class="alert alert-info hidden" style="display:none;">
    PDF file is downloading, please wait...
</div>

<!-- Date Filter Div -->
<div class="date_filter">

    <div class="containers">
        <div class="dropdown_pdf_container">
            <div class="date_dropdown">
                <form>
                    <label for="date_type" class="date_type_label">
                        <strong>Date Filter:</strong></label>
                    <select name="date_type" id="date_type" class="dropdown-content" onchange="dateChange()">
                        <option value="_day">Days</option>
                        <option value="_week">Months</option>
                        <option value="_year">Years</option>
                    </select>
                </form>
            </div>

            <div class="print_pdf">
                <Button class="print_pdf_label" onclick="downloadPDF()"> Chart Download</Button>
            </div>
        </div>
    </div>
    <div class="containers">
        <div class="datePicker">
            <label>From: </label>
            <input type="date" id="startDate" name="startDate" class="datePicker_label" onchange="dateFilter()">
            <label>&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
            <input type="date" id="endDate" name="endDate" class="datePicker_label" onchange="dateFilter()">
        </div>
    </div>
</div>

<!-- graph Div, holder of graphs -->
<div class="graph">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/brain.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="chart-container">
        <p id="reportTitle"> Total Transaction</p>
        <canvas id="totaltransactionChart"></canvas>
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Total Income </p>
        <canvas id="totalsalesChart"></canvas>
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Transaction Per Division</p>
        <!-- <div class="containerBody"> -->
        <canvas id="transactionChart"></canvas>
        <!-- </div> -->
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Income per Division</p>
        <canvas id="salesChart"></canvas>
    </div>


    <div class="chart-container" id="avgSales">
        <p id="reportTitle">Average Income Daily </p>
        <div class="asOne">
            <canvas id="myChart"></canvas>
            <div class="average">
                <div class="aveTransactionDiv">
                    <p class="texty"> Average Transactions </p>
                    <p class="number"> <?= $average ?> </p>
                </div>
                <div class="aveSalesDiv">
                    <p class="texty"> Average Income </p>
                    <p class="number"> <?= $saleaverage ?> </p>
                </div>
            </div>
        </div>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" id="close-popup">&times;</span>

            <h2 id="PopupHeader"></h2>

            <div class="speedometer">
                <p>Color of speedometer will identify if the target is meet</p>
                <p><span style="color: red">Low </span>
                    <span style="color: orange">Moderate </span>
                    <span style="color: yellow">High </span>
                    <span style="color: green">Satisfaction </span>
                </p>
                <div class="speedometer-dial">
                    <div class="speedometer-reading" id="speedometer-reading"></div>
                    <div class="speedometer-arrow" id="speedometer-arrow"></div>
                </div>
            </div>
            <p id="targetTransaction"></p>
            <p id="percentTransaction"></p>
            <p></p>

            <!-- Input box and OK button for changing the target -->
            <input type="number" id="newTargetInput" placeholder="Enter new target value">
            <button id="changeTargetButton">OK</button>
        </div>
    </div>

    <script>
        // Reference datas
        const transaction = <?php echo json_encode($TransactionperDiv); ?>;
        const income = <?php echo json_encode($SalesperDiv); ?>;

        const currentDate = new Date();
        const currentMonth = currentDate.getMonth();
        const currentYear = currentDate.getFullYear();

        const totaltransactionChart = document.getElementById("totaltransactionChart");
        const totalsalesChart = document.getElementById("totalsalesChart");
        const popup = document.getElementById("popup");
        const closePopup = document.getElementById("close-popup");
        const targetTransaction = document.getElementById("targetTransaction");
        const percentTransaction = document.getElementById("percentTransaction");
        const PopupHeader = document.getElementById("PopupHeader");
        const speedometerReading = document.getElementById("speedometer-reading");
        const speedometerArrow = document.getElementById("speedometer-arrow");
        const changeTargetButton = document.getElementById("changeTargetButton");
        const newTargetInput = document.getElementById("newTargetInput");

        //totaltransaction popup
        totaltransactionChart.addEventListener("click", () => {

            // Initialize empty arrays for each quarter
            const quarter1 = [];
            const quarter2 = [];
            const quarter3 = [];
            const quarter4 = [];

            // Iterate through the transaction data
            transaction.labels.forEach((label, index) => {
                const date = new Date(label);
                const year = date.getFullYear();
                const quarter = Math.floor((date.getMonth() + 3) / 3);

                // Check if the transaction is from the current year
                if (year === currentYear) {
                    const sumValue = transaction.datasets[0].data[index] + transaction.datasets[1].data[index];
                    switch (quarter) {
                        case 1:
                            quarter1.push(sumValue);
                            break;
                        case 2:
                            quarter2.push(sumValue);
                            break;
                        case 3:
                            quarter3.push(sumValue);
                            break;
                        case 4:
                            quarter4.push(sumValue);
                            break;
                    }
                }
            });

            // Calculate the sum of transactions for each quarter
            const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
            const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
            const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
            const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);


            let Total;

            if (currentMonth >= 0 && currentMonth < 3) {
                Total = sumQuarter1; // January to March
            } else if (currentMonth >= 3 && currentMonth < 6) {
                Total = sumQuarter2; // April to June
            } else if (currentMonth >= 6 && currentMonth < 9) {
                Total = sumQuarter3; // July to September
            } else if (currentMonth >= 8 && currentMonth < 12) {
                Total = sumQuarter4; // October to December
            }

            // const targetValues = [100, 150, 200, 500];  

            // // Get the appropriate target value based on the current month
            // const targetValue = getTargetValue(currentMonth);

            // // Function to determine the target value based on the current month
            // function getTargetValue(month) {
            // if (month >= 0 && month < 3) {
            //     return targetValues[0]; // January to March
            // } else if (month >= 3 && month < 6) {
            //     return targetValues[1]; // April to June
            // } else if (month >= 6 && month < 9) {
            //     return targetValues[2]; // July to September
            // } else {
            //     return targetValues[3]; // October to December
            // }
            // }

            const Target = 0;

            changeTargetButton.addEventListener("click", () => {
                // Get the new target value from the input box
                const newTargetValue = parseFloat(newTargetInput.value);

                if (!isNaN(newTargetValue)) {
                    // Update the target value
                    const Target = newTargetValue;

                    const needle = (Total / Target);
                    const percentage = (needle * 100).toFixed(2);

                    speedometerReading.textContent = Total + " Transaction";

                    // Simulate the speedometer arrow movement (you can replace this with actual data)
                    const rotation = (needle) * 180 - 90;
                    speedometerArrow.style.transformOrigin = "50% 100%";
                    speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

                    const speedometerDial = document.querySelector('.speedometer-dial');

                    // Get the total/target value (you can replace this with your actual value)
                    const totalValue = needle; // Change this value as needed

                    // Function to update the background color based on the value
                    function updateBackgroundColor(value) {
                        if (value >= 0 && value <= 0.25) {
                            speedometerDial.style.backgroundColor = 'red';
                        } else if (value > 0.25 && value <= 0.5) {
                            speedometerDial.style.backgroundColor = 'orange';
                        } else if (value > 0.5 && value <= 0.75) {
                            speedometerDial.style.backgroundColor = 'yellow';
                        } else {
                            speedometerDial.style.backgroundColor = 'green';
                        }
                    }

                    // Call the updateBackgroundColor function with the initial total/target value
                    updateBackgroundColor(totalValue);
                    // Display the pop-up
                    popup.style.display = "block";

                    targetTransaction.textContent = "Target transaction for this quarter is " + Target;
                    percentTransaction.textContent = "Achieved " + percentage + "% of target transaction";
                    PopupHeader.textContent = "Total Transaction";
                }
            });

            const needle = (Total / Target);
            const percentage = (needle * 100).toFixed(2);

            speedometerReading.textContent = Total + " Transaction";

            // Simulate the speedometer arrow movement (you can replace this with actual data)
            const rotation = (needle) * 180 - 90;
            speedometerArrow.style.transformOrigin = "50% 100%";
            speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

            const speedometerDial = document.querySelector('.speedometer-dial');

            // Get the total/target value (you can replace this with your actual value)
            const totalValue = needle; // Change this value as needed

            // Function to update the background color based on the value
            function updateBackgroundColor(value) {
                if (value >= 0 && value <= 0.25) {
                    speedometerDial.style.backgroundColor = 'red';
                } else if (value > 0.25 && value <= 0.5) {
                    speedometerDial.style.backgroundColor = 'orange';
                } else if (value > 0.5 && value <= 0.75) {
                    speedometerDial.style.backgroundColor = 'yellow';
                } else {
                    speedometerDial.style.backgroundColor = 'green';
                }
            }

            // Call the updateBackgroundColor function with the initial total/target value
            updateBackgroundColor(totalValue);
            // Display the pop-up
            popup.style.display = "block";

            targetTransaction.textContent = "Target transaction for this quarter is " + Target;
            percentTransaction.textContent = "Achieved " + percentage + "% of target transaction";
            PopupHeader.textContent = "Total Transaction";

        });

        closePopup.addEventListener("click", () => {
            // Close the pop-up when the close button is clicked
            popup.style.display = "none";
        });

        // sales popup
        totalsalesChart.addEventListener("click", () => {


            // Initialize empty arrays for each quarter
            const quarter1 = [];
            const quarter2 = [];
            const quarter3 = [];
            const quarter4 = [];

            // Iterate through the income data
            income.labels.forEach((label, index) => {
                const date = new Date(label);
                const year = date.getFullYear();
                const quarter = Math.floor((date.getMonth() + 3) / 3);

                // Check if the income is from the current year
                if (year === currentYear) {
                    const sumValue = income.datasets[0].data[index] + income.datasets[1].data[index];
                    switch (quarter) {
                        case 1:
                            quarter1.push(sumValue);
                            break;
                        case 2:
                            quarter2.push(sumValue);
                            break;
                        case 3:
                            quarter3.push(sumValue);
                            break;
                        case 4:
                            quarter4.push(sumValue);
                            break;
                    }
                }
            });

            // Calculate the sum of income for each quarter
            const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
            const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
            const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
            const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);


            let Total;

            if (currentMonth >= 0 && currentMonth < 3) {
                Total = sumQuarter1; // January to March
            } else if (currentMonth >= 3 && currentMonth < 6) {
                Total = sumQuarter2; // April to June
            } else if (currentMonth >= 6 && currentMonth < 9) {
                Total = sumQuarter3; // July to September
            } else if (currentMonth >= 8 && currentMonth < 12) {
                Total = sumQuarter4; // October to December
            }

            const Target = 0;

            changeTargetButton.addEventListener("click", () => {
                // Get the new target value from the input box
                const newTargetValue = parseFloat(newTargetInput.value);

                if (!isNaN(newTargetValue)) {
                    // Update the target value
                    const Target = newTargetValue;

                    const needle = (Total / Target);
                    const percentage = (needle * 100).toFixed(2);

                    speedometerReading.textContent = Total + " Income";

                    // Simulate the speedometer arrow movement (you can replace this with actual data)
                    const rotation = (needle) * 180 - 90;
                    speedometerArrow.style.transformOrigin = "50% 100%";
                    speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

                    const speedometerDial = document.querySelector('.speedometer-dial');

                    // Get the total/target value (you can replace this with your actual value)
                    const totalValue = needle; // Change this value as needed

                    // Function to update the background color based on the value
                    function updateBackgroundColor(value) {
                        if (value >= 0 && value <= 0.25) {
                            speedometerDial.style.backgroundColor = 'red';
                        } else if (value > 0.25 && value <= 0.5) {
                            speedometerDial.style.backgroundColor = 'orange';
                        } else if (value > 0.5 && value <= 0.75) {
                            speedometerDial.style.backgroundColor = 'yellow';
                        } else {
                            speedometerDial.style.backgroundColor = 'green';
                        }
                    }

                    // Call the updateBackgroundColor function with the initial total/target value
                    updateBackgroundColor(totalValue);
                    // Display the pop-up
                    popup.style.display = "block";

                    targetTransaction.textContent = "Target income for this quarter is " + Target;
                    percentTransaction.textContent = "Achieved " + percentage + "% of target income";
                    PopupHeader.textContent = "Total Income";
                }
            });

            const needle = (Total / Target);
            const percentage = (needle * 100).toFixed(2);

            speedometerReading.textContent = Total + " Income";

            // Simulate the speedometer arrow movement (you can replace this with actual data)
            const rotation = (needle) * 180 - 90;
            speedometerArrow.style.transformOrigin = "50% 100%";
            speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

            const speedometerDial = document.querySelector('.speedometer-dial');

            // Get the total/target value (you can replace this with your actual value)
            const totalValue = needle; // Change this value as needed

            // Function to update the background color based on the value
            function updateBackgroundColor(value) {
                if (value >= 0 && value <= 0.25) {
                    speedometerDial.style.backgroundColor = 'red';
                } else if (value > 0.25 && value <= 0.5) {
                    speedometerDial.style.backgroundColor = 'orange';
                } else if (value > 0.5 && value <= 0.75) {
                    speedometerDial.style.backgroundColor = 'yellow';
                } else {
                    speedometerDial.style.backgroundColor = 'green';
                }
            }

            // Call the updateBackgroundColor function with the initial total/target value
            updateBackgroundColor(totalValue);
            // Display the pop-up
            popup.style.display = "block";

            targetTransaction.textContent = "Target income for this quarter is " + Target;
            percentTransaction.textContent = "Achieved " + percentage + "% of target income";
            PopupHeader.textContent = "Total Income";

        });

        closePopup.addEventListener("click", () => {
            // Close the pop-up when the close button is clicked
            popup.style.display = "none";
        });






        //     totaltransactionChart.addEventListener("click", () => {

        // // Initialize empty arrays for each quarter
        // const quarter1 = [];
        // const quarter2 = [];
        // const quarter3 = [];
        // const quarter4 = [];

        // // Iterate through the transaction data
        // transaction.labels.forEach((label, index) => {
        //     const date = new Date(label);
        //     const year = date.getFullYear();
        //     const quarter = Math.floor((date.getMonth() + 3) / 3);

        //     // Check if the transaction is from the current year
        //         if (year === currentYear) {
        // // Categorize transactions into quarters
        //         switch (quarter) {
        //             case 1:
        //                 quarter1.push(transaction.datasets[0].data[index]);
        //                 break;
        //             case 2:
        //                 quarter2.push(transaction.datasets[0].data[index]);
        //                 break;
        //             case 3:
        //                 quarter3.push(transaction.datasets[0].data[index]);
        //                 break;
        //             case 4:
        //                 quarter4.push(transaction.datasets[0].data[index]);
        //                 break;
        //         }
        //     }
        // });
        // // Calculate the sum of transactions for each quarter
        // const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
        // const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
        // const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
        // const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);


        // let Total;

        // if (currentMonth >= 0 && currentMonth < 3) {
        //     Total = sumQuarter1; // January to March
        // } else if (currentMonth >= 3 && currentMonth < 6) {
        //     Total = sumQuarter2; // April to June
        // } else if (currentMonth >= 6 && currentMonth < 9) {
        //     Total = sumQuarter3; // July to September
        // } else if (currentMonth >= 8 && currentMonth < 12) {
        //     Total = sumQuarter4; // October to December
        // }

        // const targetValues = [100, 150, 200, 500];  

        // // Get the appropriate target value based on the current month
        // const targetValue = getTargetValue(currentMonth);

        // // Function to determine the target value based on the current month
        // function getTargetValue(month) {
        // if (month >= 0 && month < 3) {
        //     return targetValues[0]; // January to March
        // } else if (month >= 3 && month < 6) {
        //     return targetValues[1]; // April to June
        // } else if (month >= 6 && month < 9) {
        //     return targetValues[2]; // July to September
        // } else {
        //     return targetValues[3]; // October to December
        // }
        // }

        // const Target = targetValue; 

        // const needle= (Total/Target);
        // const percentage= (needle * 100).toFixed(2);

        // speedometerReading.textContent = Total + " Transaction";

        // // Simulate the speedometer arrow movement (you can replace this with actual data)
        // const rotation = (needle) * 180 - 90;
        // speedometerArrow.style.transformOrigin = "50% 100%"; 
        // speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

        // const speedometerDial = document.querySelector('.speedometer-dial');

        // // Get the total/target value (you can replace this with your actual value)
        // const totalValue = needle; // Change this value as needed

        // // Function to update the background color based on the value
        // function updateBackgroundColor(value) {
        // if (value >= 0 && value <= 0.25) {
        //     speedometerDial.style.backgroundColor = 'red';
        // } else if (value > 0.25 && value <= 0.5) {
        //     speedometerDial.style.backgroundColor = 'orange';
        // } else if (value > 0.5 && value <= 0.75) {
        //     speedometerDial.style.backgroundColor = 'yellow';
        // } else {
        //     speedometerDial.style.backgroundColor = 'green';
        // }
        // }

        // // Call the updateBackgroundColor function with the initial total/target value
        // updateBackgroundColor(totalValue);
        // // Display the pop-up
        // popup.style.display = "block";

        // targetTransaction.textContent = "Target transaction for this quarter is "+Target;
        // percentTransaction.textContent = "Achieved " + percentage +"% of target transaction";
        // PopupHeader.textContent = "Total Transaction";

        // });

        // closePopup.addEventListener("click", () => {
        // // Close the pop-up when the close button is clicked
        // popup.style.display = "none";
        // });

        // // sales popup
        // totalsalesChart.addEventListener("click", () => {


        // // Initialize empty arrays for each quarter
        // const quarter1 = [];
        // const quarter2 = [];
        // const quarter3 = [];
        // const quarter4 = [];

        // // Iterate through the income data
        // income.labels.forEach((label, index) => {
        //     const date = new Date(label);
        //     const year = date.getFullYear();
        //     const quarter = Math.floor((date.getMonth() + 3) / 3);

        //     // Check if the income is from the current year
        //     if (year === currentYear) {
        //         // Categorize income into quarters
        //         switch (quarter) {
        //             case 1:
        //                 quarter1.push(income.datasets[0].data[index]);
        //                 break;
        //             case 2:
        //                 quarter2.push(income.datasets[0].data[index]);
        //                 break;
        //             case 3:
        //                 quarter3.push(income.datasets[0].data[index]);
        //                 break;
        //             case 4:
        //                 quarter4.push(income.datasets[0].data[index]);
        //                 break;
        //         }
        //     }
        // });
        // // Calculate the sum of income for each quarter
        // const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
        // const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
        // const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
        // const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);


        // let Total;

        // if (currentMonth >= 0 && currentMonth < 3) {
        //     Total = sumQuarter1; // January to March
        // } else if (currentMonth >= 3 && currentMonth < 6) {
        //     Total = sumQuarter2; // April to June
        // } else if (currentMonth >= 6 && currentMonth < 9) {
        //     Total = sumQuarter3; // July to September
        // } else if (currentMonth >= 8 && currentMonth < 12) {
        //     Total = sumQuarter4; // October to December
        // }

        // const targetValues = [10000, 150000, 200000, 500000];  

        // // Get the appropriate target value based on the current month
        // const targetValue = getTargetValue(currentMonth);

        // // Function to determine the target value based on the current month
        // function getTargetValue(month) {
        // if (month >= 0 && month < 3) {
        //     return targetValues[0]; // January to March
        // } else if (month >= 3 && month < 6) {
        //     return targetValues[1]; // April to June
        // } else if (month >= 6 && month < 9) {
        //     return targetValues[2]; // July to September
        // } else {
        //     return targetValues[3]; // October to December
        // }
        // }

        // const Target = targetValue; 

        // const needle= (Total/Target);
        // const percentage= (needle * 100).toFixed(2);

        // speedometerReading.textContent = Total + " Transaction";

        // // Simulate the speedometer arrow movement (you can replace this with actual data)
        // const rotation = (needle) * 180 - 90;
        // speedometerArrow.style.transformOrigin = "50% 100%"; 
        // speedometerArrow.style.transform = `translateX(-50%) rotate(${rotation}deg)`;

        // const speedometerDial = document.querySelector('.speedometer-dial');

        // // Get the total/target value (you can replace this with your actual value)
        // const totalValue = needle; // Change this value as needed

        // // Function to update the background color based on the value
        // function updateBackgroundColor(value) {
        // if (value >= 0 && value <= 0.25) {
        //     speedometerDial.style.backgroundColor = 'red';
        // } else if (value > 0.25 && value <= 0.5) {
        //     speedometerDial.style.backgroundColor = 'orange';
        // } else if (value > 0.5 && value <= 0.75) {
        //     speedometerDial.style.backgroundColor = 'yellow';
        // } else {
        //     speedometerDial.style.backgroundColor = 'green';
        // }
        // }

        // // Call the updateBackgroundColor function with the initial total/target value
        // updateBackgroundColor(totalValue);
        // // Display the pop-up
        // popup.style.display = "block";

        // targetTransaction.textContent = "Target income for this quarter is "+Target;
        // percentTransaction.textContent = "Achieved " + percentage +"% of target income";
        // PopupHeader.textContent = "Total Income";

        // });

        // closePopup.addEventListener("click", () => {
        // // Close the pop-up when the close button is clicked
        // popup.style.display = "none";
        // });
    </script>


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
            label: 'Total Income',
            data: sumSalesData,
        };

        //start of query from controller-----------------------

        //retrieve data from controller
        var totalTransaction = (<?= json_encode($queryAllDate) ?>);
        var chartLabels = (<?= json_encode($chartLabel) ?>);
        //preparing array to store the retrieved data
        var totalTransactionDataset = {
            datasets: [{
                backgroundColor: "rgba(255, 99, 132, 0.7)",
                label: 'Total Transaction',
                data: {}
            }, ],
        }

        //populate json; create child inside of another child, function to translate data of division and total transaction from controller
        function totalTransactionTranslate() {
            var x = 0;
            while (totalTransaction[x] != null) {
                var samp = totalTransaction[x].labels;
                var sampo = parseInt(totalTransaction[x].datasets);
                if (totalTransaction[x].label == 'National Metrology Division') {
                    //do nothing
                } else if (totalTransaction[x].label == 'Standards and Testing Division') {
                    //do nothing 
                } else {
                    totalTransactionDataset.datasets[0].data[samp] = sampo;
                }
                x++
            }
            x = 0;
        }

        var global_label_day = []; //use this label as duh label for all chart that uses yyyy-mm-dd format label

        function labelTranslate() {
            var x = 0;
            while (chartLabels[x] != null) {
                var lab = chartLabels[x].labels;
                global_label_day[x] = lab;
                x++;
            }
            x = 0;
        }

        totalTransactionTranslate(); //call the function to translate data to chartjs readable format
        labelTranslate();

        const totaltransactionCtx = document.getElementById('totaltransactionChart').getContext('2d');
        // dashboard total transaction
        const totaltransactionChartB = new Chart(totaltransactionCtx, {
            type: 'bar', // This specifies a bar chart
            data: {
                labels: global_label_day,
                datasets: totalTransactionDataset.datasets,
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                        },
                    },
                },
            },
        });

        var total_Income = (<?= json_encode($queryTotalSale) ?>);

        var totalSum = {
            datasets: [{
                backgroundColor: "rgba(255, 99, 132, 0.7)",
                label: 'Total Income',
                data: {}
            }]
        }

        function income_load() {
            var x = 0;
            while (total_Income[x] != null) {
                var samp = total_Income[x].labels;
                var sampo = parseInt(total_Income[x].datasets);
                if (total_Income[x].label == 'National Metrology Division') {
                    //do nuthin
                } else if (total_Income[x].label == 'Standards and Testing Division') {
                    //do nuthin
                } else {
                    totalSum.datasets[0].data[samp] = sampo;
                }
                x++
            }
            x = 0;
        }

        income_load();
        const totalsalesCtx = document.getElementById('totalsalesChart').getContext('2d');

        // dashboard total income
        const totalsalesChartB = new Chart(totalsalesCtx, {
            type: 'bar', // This specifies a bar chart
            data: {
                labels: global_label_day,
                datasets: totalSum.datasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        //what this for bruh?
        //Creating a combined data using the sumTransactionDataset and sumSalesDataset (to be used/call in creating combined chart)
        const combinedData = {
            labels: TransactionperDiv.labels,
            datasets: [{
                    ...sumSalesDataset,
                    type: 'line', // Use line type
                    backgroundColor: '#ba2ee8',
                    borderColor: '#00d498',
                    yAxisID: 'lineY', // Assign the line chart to a specific y-axis
                    cubicInterpolationMode: 'monotone'


                },
                {
                    ...sumTransactionDataset,
                    borderColor: 'rgba(127, 207, 250)',
                    backgroundColor: 'rgba(127, 207, 250)',
                    type: 'bar',
                    borderWidth: 2,
                    yAxisID: 'y-axis-bar', // Assign the line chart to a specific y-axis

                },
            ]
        };

        const bgColor = {
            id: 'bgColor',
            beforeDraw: (chart, steps, options) => {
                const {
                    ctx,
                    width,
                    height
                } = chart;
                ctx.fillStyle = options.backgroundColor;
                ctx.fillRect(0, 0, width, height)
                ctx.restore();
            }

        };

        const bgColor1 = {
            id: 'bgColor',
            beforeDraw: (chart, steps, options) => {
                const {
                    ctx,
                    width,
                    height
                } = chart;
                ctx.fillStyle = options.backgroundColor;
                ctx.fillRect(0, 0, width, height)
                ctx.restore();
            }

        };

        var tPerDivData = (<?= json_encode($queryAllDate) ?>); //retrieve data from controller
        var perDivData = { //prepare array for translated data
            datasets: [{
                    backgroundColor: "#06d6a0",
                    label: 'National Metrology Division',
                    data: {}
                },
                {
                    backgroundColor: "#7209b7",
                    label: 'Standards and Testing Division',
                    data: {}
                }
            ],
        }

        function perDivLoad() { //translate for chartjs 
            var x = 0;
            while (tPerDivData[x] != null) {
                var samp = tPerDivData[x].labels;
                var sampo = parseInt(tPerDivData[x].datasets);
                if (tPerDivData[x].label == 'National Metrology Division') {
                    perDivData.datasets[0].data[samp] = sampo;
                } else if (tPerDivData[x].label == 'Standards and Testing Division') {
                    perDivData.datasets[1].data[samp] = sampo;
                }
                x++
            }
            x = 0; //just in case while loop decided to be petty
        }
        perDivLoad(); //call the function to translate

        // dashboard transaction per division
        const transactionCtx = document.getElementById('transactionChart').getContext('2d');
        const transactionChartB = new Chart(transactionCtx, {
            type: 'bar',
            data: {
                labels: global_label_day,
                datasets: perDivData.datasets,
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
                            display: true,
                        },
                    },
                    x: {
                        ticks: {
                            autoSkip: true,
                        },
                        grid: {
                            display: true,
                        },
                    },
                },
                plugins: {
                    bgColor: {
                        backgroundColor: 'white'
                    }
                },
            },
            plugins: [bgColor],
        });

        var soldPerDivs = { //prepare array for translated data
            datasets: [{
                    backgroundColor: "#06d6a0",
                    label: 'National Metrology Division',
                    data: {}
                },
                {
                    backgroundColor: "#7209b7",
                    label: 'Standards and Testing Division',
                    data: {}
                }
            ]
        }

        function loadPerDivSales() { //translate for chartjs 
            var x = 0;
            while (total_Income[x] != null) {
                var samp = total_Income[x].labels;
                var sampo = parseInt(total_Income[x].datasets);
                if (total_Income[x].label == 'National Metrology Division') {
                    soldPerDivs.datasets[0].data[samp] = sampo;
                } else if (total_Income[x].label == 'Standards and Testing Division') {
                    soldPerDivs.datasets[1].data[samp] = sampo;
                }
                x++
            }
            x = 0; //just in case while loop decided to be petty
        }
        loadPerDivSales(); //call the function to translate

        //dashboard income per division
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: global_label_day,
                datasets: soldPerDivs.datasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                },

                plugins: {
                    bgColor: {
                        backgroundColor: 'white'
                    }
                },

            },
            plugins: [bgColor],
        });

        function dateFilterRefresh() { // asign current week's sunday and saturday to datepicker
            //duh
            const today = new Date();
            //get date of this week's sunday
            const sunDay = new Date(
                today.setDate(today.getDate() - today.getDay()),
            );
            //get date of this week's saturday
            const satDay = new Date(
                today.setDate(today.getDate() - today.getDay() + 6),
            );
            //"yyyy-mm-dd" format
            var toSunDay = sunDay.toISOString().slice(0, 10);
            var toSatDay = satDay.toISOString().slice(0, 10);

            //calculated dates as input values
            document.getElementById('startDate').value = toSunDay;
            document.getElementById('endDate').value = toSatDay;
        }
        dateFilterRefresh(); //call the function to update the pickerz

        // Function to calculate the average of an array of numbers
        const calculateAverage = (array) => {
            if (array.length === 0) return 0;
            const sum = array.reduce((total, num) => total + num, 0);
            return Math.round(sum / array.length);
        };


        // Calculate the average of each dataset
        const TransactionAverage = SalesperDiv.datasets.map(dataset => ({
            label: dataset.label,
            average: calculateAverage(dataset.data),
        }));

        // Find the maximum average value
        const maxAverage = Math.max(...TransactionAverage.map((average) => average.average));

        // Create a new dataset for each sales average
        const salesAverage = TransactionAverage.map((average, index) => {
            const datasetColors = ['rgba(0, 115, 199,1)', 'rgba(2, 165, 96,1)', 'rgba(242, 26, 156,1)']; // Array of specific colors
            const color = datasetColors[index % datasetColors.length]; // Assign color based on index

            return {
                label: `Average ${average.label}`,
                data: [average.average],
                borderWidth: 4, // previous:1
                circumference: (ctx) => ((ctx.dataset.data[0] / maxAverage) * 270),
                backgroundColor: color,
                borderColor: 'white', //borderColor: color (previous code)
            };
        });

        // Combine the existing datasets with the new datasets
        const allDatasets = [...TransactionAverage, ...salesAverage];

        // Define the data for the doughnut chart
        const data = {
            datasets: allDatasets,
        };
        const divisionName = {


        } // tsaka ko na to tutuloy yawa walang wifi

        // Config for the doughnut chart
        const config = {
            type: 'doughnut',
            data,
            options: {
                // cutout:'85%',
                borderRadius: 10,
                plugins: {
                    legend: {
                        display: false
                    }
                },

                // plugins:[divisionName] //to be continue
            },
            plugins: [{
                id: 'divisionName',
                afterDatasetsDraw(chart, args, options) {
                    const {
                        ctx,
                        data,
                        scales,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;

                    ctx.save();
                    ctx.font = 'bolder 15px Poppins';
                    ctx.fillStyle = 'rgb(3, 98, 186, 1)';
                    ctx.textAlign = 'center';
                    ctx.fillText('Average income Daily', width / 2.1, height / 2 + top);
                    //console.log(chart.getDatasetMeta(0))

                }

            }]
        };

        // Render the doughnut chart
        const myChart = new Chart(document.getElementById('myChart'), config);

        // Instantly assign Chart.js version
        const chartVersion = document.getElementById('chartVersion');

        var customerTypeData = <?php echo json_encode($customerTypeData); ?>;
        var paragraphElement = document.getElementById('customerTypeParagraph');
        //paragraphElement.textContent = 'Customer Type: ' + customerTypeData;
    </script>


    <!-- All about customer graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="customers_data">
        <div class="date_filter" style="text-align: left; padding-left: 8rem; padding-top: 0rem; padding-bottom: 2rem;">
            <div class="containers">
                <div class="date_dropdown">
                    <label for="chart_type" class="chart_type_label">
                        <strong>Select Region</strong></label>
                    <select name="chart_type" id="chart_type" class="dropdown-content" onChange="updateProvince()">
                        <!-- <option value="all-region">All Province</option> -->
                        <option value="ncr">National Capital Region</option>
                        <option value="region-1">Region-I</option>
                        <option value="region-2">Region-II</option>
                        <option value="region-3">Region-III</option>
                        <option value="region-4a">Region-IV-A</option>
                        <option value="mimaropa">MIMAROPA</option>
                        <option value="region-5">Region-V</option>
                        <option value="car">Cordillera Administrative Region</option>
                        <option value="region-6">Region-VI</option>
                        <option value="region-7">Region-VII</option>
                        <option value="region-8">Region-VII</option>
                        <option value="region-9">Region-IX</option>
                        <option value="region-10">Region-X</option>
                        <option value="region-11">Region-XI</option>
                        <option value="region-12">Region-XII</option>
                        <option value="region-13">Region-XIII</option>
                        <option value="barm">Bangsamoro</option>

                        <!-- <option value="horizontal_bar">Horizontal chart</option> -->
                    </select>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <p id="reportTitle">Total Customers per Province</p>
            <canvas id="Provinces"></canvas>
        </div>

        <!-- <div class="chart-container" style="width: 47%; text-align: center;">
            <p id="reportTitle">Type of Customers per Province</p>
            <canvas id="TCProvinces"></canvas>
        </div>
        <div class="chart-container" style="width: 47%; text-align: center;">
            <p id="reportTitle">Type of Transaction per Province</p>
            <div class="containerBody">
                <canvas id="TTProvinces"></canvas>
            </div>
        </div> -->
    </div>

</div>


<!-- scriptfor customers graph -->

<script>
    //3bm60

    // Get references to chart containers and the dropdown
    const provincesChartContainer = document.getElementById('Provinces').getContext('2d');
    const chartTypeDropdown = document.getElementById('chart_type');
    const provinces = <?php echo json_encode($provinces); ?>;
    const deselected_data = (<?= json_encode($queryTransactionTypePerProvince) ?>);
    const constprovincesChart = new Chart(provincesChartContainer, {
        type: 'bar',
        options: {
            data: deselected_data,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                    },
                    grid: {
                        display: true,
                    }
                },
                x: {
                    ticks: {
                        autoSkip: true,
                    },
                    grid: {
                        display: false,
                    }
                },
            },
            plugins: {
                legend: {
                    display: false
                },
                bgColor: {
                    backgroundColor: 'white'
                }
            }
        },
        legend: {
            display: false
        },
        plugins: [bgColor],

    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var provinceLabels = [];
    var provinceData = [];

    function updateProvince() {
        const selectedType = chartTypeDropdown.value;
        var selected_data;
        switch (selectedType) {
            case "ncr":
                selected_data = (<?= json_encode($custmerPerProvinceNCR) ?>);
                break;
            case "region-1":
                selected_data = (<?= json_encode($custmerPerProvinceRI) ?>);
                break;
            case "region-2":
                selected_data = (<?= json_encode($custmerPerProvinceRII) ?>);
                break;
            case "region-3":
                selected_data = (<?= json_encode($custmerPerProvinceRIII) ?>);
                break;
            case "region-4a":
                selected_data = (<?= json_encode($custmerPerProvinceRIVA) ?>);
                break;
            case "mimaropa":
                selected_data = (<?= json_encode($custmerPerProvinceMIMAROPA) ?>);
                break;
            case "region-5":
                selected_data = (<?= json_encode($custmerPerProvinceV) ?>);
                break;
            case "car":
                selected_data = (<?= json_encode($custmerPerProvinceCAR) ?>);
                break;
            case "region-6":
                selected_data = (<?= json_encode($custmerPerProvinceVI) ?>);
                break;
            case "region-7":
                selected_data = (<?= json_encode($custmerPerProvinceVII) ?>);
                break;
            case "region-8":
                selected_data = (<?= json_encode($custmerPerProvinceVIII) ?>);
                break;
            case "region-9":
                selected_data = (<?= json_encode($custmerPerProvinceIX) ?>);
                break;
            case "region-10":
                selected_data = (<?= json_encode($custmerPerProvinceX) ?>);
                break;
            case "region-11":
                selected_data = (<?= json_encode($custmerPerProvinceXI) ?>);
                break;
            case "region-12":
                selected_data = (<?= json_encode($custmerPerProvinceXII) ?>);
                break;
            case "region-13":
                selected_data = (<?= json_encode($custmerPerProvinceXIII) ?>);
                break;
            case "barm":
                selected_data = (<?= json_encode($custmerPerProvinceBARMM) ?>);
                break;
        }

        // Remove old data
        constprovincesChart.data.labels = [];
        constprovincesChart.data.datasets.forEach((dataset) => {
            dataset.data = [];
        });


        //convert data into usable chartjs labels
        var x = 0
        while (selected_data[x] != null) {
            var dataA = selected_data[x].label;
            var dataB = selected_data[x].data;
            var arrayZ = [{
                backgroundColor: getRandomColor(),
                data: {
                    [dataA]: parseInt(dataB)
                },
                label: dataA
            }]
            for (var i = 0; i < arrayZ.length; i++) {
                provinceData.push(arrayZ[i]);
            }
            x++
        }

        x = 0
        while (selected_data[x] != null) {
            var lab = selected_data[x].label;
            provinceLabels[x] = lab;
            x++
        }

        console.log("OC");
        console.log(selected_data);
        console.log("label");
        console.log(provinceLabels);
        console.log("data");
        console.log(provinceData);
        constprovincesChart.data.datasets = provinceData;
        console.log("chart");
        console.log(constprovincesChart.data.datasets);
        constprovincesChart.config.data.labels = provinceLabels;
        constprovincesChart.update();
        provinceLabels = [];
        provinceData = [];
    }
    updateProvince();
</script>

<!-- All about customer graphs -->
<div class="customers_data">
    <div class="date_filter" style="text-align: left; padding-left: 8rem; padding-top: 0rem; padding-bottom: 2rem;">
        <div class="containers">
            <div class="date_dropdown">
                <label for="chart_type2" class="chart_type_label2">
                    <strong>Chart Filter</strong></label>
                <select name="chart_type2" id="chart_type2" class="dropdown-content">
                    <option value="doughnut">Doughnut</option>
                    <option value="pie">Pie</option>
                    <option value="bar">Bar</option>
                    <option value="line">Line</option>

                    <!-- <option value="horizontal_bar">Horizontal chart</option> -->
                </select>
            </div>
        </div>
    </div>

    <div class="graph2">
        <div class="chart-container2">
            <p id="reportTitle">Transaction Status</p>
            <canvas id="transactionStatus"></canvas>
        </div>
        <div class="chart-container2">
            <p id="reportTitle">Payment Method</p>
            <canvas id="paymendtMethod"></canvas>
        </div>
    </div>
    <div class="graph2">
        <div class="chart-container2">
            <p id="reportTitle">Type of Transaction</p>
            <canvas id="transactionType"></canvas>
        </div>

        <div class="chart-container2">
            <p id="reportTitle">Type of Customers</p>
            <canvas id="customerType"></canvas>
        </div>
    </div>
</div>


<!-- scriptfor customers graph -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to chart containers and the dropdown
        const transactionStatusChartContainer = document.getElementById('transactionStatus');
        const paymendtMethodChartContainer = document.getElementById('paymendtMethod');
        const transactionTypeChartContainer = document.getElementById('transactionType');
        const customerTypeChartContainer = document.getElementById('customerType');
        const chartTypeDropdown = document.getElementById('chart_type2');

        //     function generateRandomColor() {
        //   const randomColor = `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
        //   return randomColor;
        // }

        // const randomColor = generateRandomColor();
        // Initialize charts (empty)
        let transactionStatusChart = null;
        let paymendtMethodChart = null;
        let transactionTypeChart = null;
        let customerTypeChart = null;


        // Update charts based on selected chart type
        function updateCharts() {
            const selectedChartType = chartTypeDropdown.value;

            // Destroy existing charts if they exist
            if (transactionStatusChart) {
                transactionStatusChart.destroy();
            }
            if (paymendtMethodChart) {
                paymendtMethodChart.destroy();
            }
            if (transactionTypeChart) {
                transactionTypeChart.destroy();
            }
            if (customerTypeChart) {
                customerTypeChart.destroy();
            }

            const doughnutOptions = {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'

                    },
                    bgColor: {
                        backgroundColor: 'white'
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            // Display the label based on the selected data (e.g., transaction type or payment method)
                            return context.chart.data.labels[context.dataIndex];
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Adjust the size of the doughnut hole

            };

            if (selectedChartType === 'doughnut') {
                // For doughnut and pie charts, use the custom options
                transactionStatusChart = new Chart(transactionStatusChartContainer, {
                    type: selectedChartType,
                    options: doughnutOptions,
                    data: {
                        labels: <?php echo json_encode($transactionStatus); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionStatusDatacounts); ?>,
                            backgroundColor: ['rgba(0, 215, 132, 0.2)',
                                'rgba(229, 247, 48, 0.2)',
                                'rgba(241, 37, 150, 0.2)',
                            ],
                            borderColor: ['rgba(0, 215, 132, 0.93)',
                                'rgba(229, 247, 48, 0.8)',
                                'rgba(241, 37, 150, 0.8)',
                            ],
                            borderWidth: 2
                        }],
                    },
                    plugins: [bgColor],
                });

                paymendtMethodChart = new Chart(paymendtMethodChartContainer, {
                    type: selectedChartType,
                    options: doughnutOptions,
                    data: {
                        labels: <?php echo json_encode($PaymentMethod); ?>,
                        datasets: [{
                            data: <?php echo json_encode($PaymentMethodcounts); ?>,
                            backgroundColor: ['rgba(0, 21, 215, 0.2)',
                                'rgba(0, 215, 132, 0.2)',
                                'rgba(118, 0, 186, 0.2)',
                            ],
                            borderColor: ['rgba(0, 21, 215, 0.93)',
                                'rgba(0, 215, 132, 1)',
                                'rgba(118, 0, 186, 0.93)',
                            ],
                            borderWidth: 2
                        }],
                    },
                    plugins: [bgColor],
                });
                transactionTypeChart = new Chart(transactionTypeChartContainer, {
                    type: selectedChartType,
                    options: doughnutOptions,
                    data: {
                        labels: <?php echo json_encode($transactionType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionTypecounts); ?>,
                            backgroundColor: ['rgba(186, 0, 0, 0.2)',
                                'rgba(250, 154, 37, 0.2)',
                                'rgba(37, 202, 247, 0.2)',
                            ],
                            borderColor: ['rgba(186, 0, 0, 0.93)',
                                'rgba(250, 154, 37, 0.81)',
                                'rgba(37, 202, 247, 0.81)',
                            ],
                            borderWidth: 2
                        }],
                    },
                    plugins: [bgColor],
                });

                customerTypeChart = new Chart(customerTypeChartContainer, {
                    type: selectedChartType,
                    options: doughnutOptions,
                    data: {
                        labels: <?php echo json_encode($customerType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($customerscounts); ?>,
                            backgroundColor: ['rgba(247, 37, 149, 0.2)',
                                'rgba(166, 37, 247, 0.2)',
                                'rgba(255, 155, 22, 0.2)',
                                'rgba(255, 213, 22, 0.2)',
                                'rgba(49, 255, 22, 0.2)',
                                'rgba(73, 0, 242, 0.2)',
                                'rgba(0, 220, 242, 0.2)'

                            ],
                            borderColor: ['rgba(247, 37, 149, 0.81)',
                                'rgba(166, 37, 247, 0.83)',
                                'rgba(255, 155, 22, 0.83)',
                                'rgba(255, 213, 22, 0.83)',
                                'rgba(49, 255, 22, 0.83)',
                                'rgba(73, 0, 242, 0.83)',
                                'rgba(0, 220, 242, 0.83)'
                            ],
                            borderWidth: 2
                        }],
                    },
                    plugins: [bgColor],
                });
            } else if (selectedChartType === 'pie') {
                transactionStatusChart = new Chart(transactionStatusChartContainer, {
                    type: selectedChartType,
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'

                            },
                            bgColor: {
                                backgroundColor: 'white'
                            },

                            datalabels: {
                                formatter: (value, context) => {
                                    // Display the label based on the selected data (e.g., transaction type or payment method)
                                    return context.chart.data.labels[context.dataIndex];
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($transactionStatus); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionStatusDatacounts); ?>,
                            backgroundColor: ['rgba(0, 215, 132, 0.2)',
                                'rgba(229, 247, 48, 0.2)',
                                'rgba(241, 37, 150, 0.2)',
                            ],
                            borderColor: ['rgba(0, 215, 132, 0.93)',
                                'rgba(229, 247, 48, 0.8)',
                                'rgba(241, 37, 150, 0.8)',
                            ],
                            borderWidth: 2
                        }],
                    }
                });

                paymendtMethodChart = new Chart(paymendtMethodChartContainer, {
                    type: selectedChartType,
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'

                            },
                            bgColor: {
                                backgroundColor: 'white'
                            },

                            datalabels: {
                                formatter: (value, context) => {
                                    // Display the label based on the selected data (e.g., transaction type or payment method)
                                    return context.chart.data.labels[context.dataIndex];
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($PaymentMethod); ?>,
                        datasets: [{
                            data: <?php echo json_encode($PaymentMethodcounts); ?>,
                            backgroundColor: ['rgba(0, 21, 215, 0.2)',
                                'rgba(0, 215, 132, 0.2)',
                                'rgba(118, 0, 186, 0.2)',
                            ],
                            borderColor: ['rgba(0, 21, 215, 0.93)',
                                'rgba(0, 215, 132, 1)',
                                'rgba(118, 0, 186, 0.93)',
                            ],
                            borderWidth: 2
                        }],
                    }
                });
                transactionTypeChart = new Chart(transactionTypeChartContainer, {
                    type: selectedChartType,
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'

                            },
                            datalabels: {
                                formatter: (value, context) => {
                                    // Display the label based on the selected data (e.g., transaction type or payment method)
                                    return context.chart.data.labels[context.dataIndex];
                                }
                            },

                            bgColor: {
                                backgroundColor: 'white'
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        },
                    },
                    plugins: [bgColor],

                    data: {
                        labels: <?php echo json_encode($transactionType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionTypecounts); ?>,
                            backgroundColor: ['rgba(186, 0, 0, 0.2)',
                                'rgba(250, 154, 37, 0.2)',
                                'rgba(37, 202, 247, 0.2)',
                            ],
                            borderColor: ['rgba(186, 0, 0, 0.93)',
                                'rgba(250, 154, 37, 0.81)',
                                'rgba(37, 202, 247, 0.81)',
                            ],
                            borderWidth: 2
                        }],
                    }
                });

                customerTypeChart = new Chart(customerTypeChartContainer, {
                    type: selectedChartType,
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'

                            },
                            datalabels: {
                                formatter: (value, context) => {
                                    // Display the label based on the selected data (e.g., transaction type or payment method)
                                    return context.chart.data.labels[context.dataIndex];
                                }
                            },
                            bgColor: {
                                backgroundColor: 'white'
                            }

                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($customerType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($customerscounts); ?>,
                            backgroundColor: ['rgba(247, 37, 149, 0.2)',
                                'rgba(166, 37, 247, 0.2)',
                                'rgba(255, 155, 22, 0.2)',
                                'rgba(255, 213, 22, 0.2)',
                                'rgba(49, 255, 22, 0.2)',
                                'rgba(73, 0, 242, 0.2)',
                                'rgba(0, 220, 242, 0.2)'

                            ],
                            borderColor: ['rgba(247, 37, 149, 0.81)',
                                'rgba(166, 37, 247, 0.83)',
                                'rgba(255, 155, 22, 0.83)',
                                'rgba(255, 213, 22, 0.83)',
                                'rgba(49, 255, 22, 0.83)',
                                'rgba(73, 0, 242, 0.83)',
                                'rgba(0, 220, 242, 0.83)'
                            ],
                            borderWidth: 2
                        }],
                    }
                });
            } else {

                // Create new charts based on selected chart type
                transactionStatusChart = new Chart(transactionStatusChartContainer, {
                    type: selectedChartType,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawOnChartArea: false
                                }

                            },

                        },
                        plugins: {

                            bgColor: {
                                backgroundColor: 'white'

                            }
                        },
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($transactionStatus); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionStatusDatacounts); ?>,
                            backgroundColor: ['rgba(0, 215, 132, 0.2)',
                                'rgba(229, 247, 48, 0.2)',
                                'rgba(241, 37, 150, 0.2)',
                            ],
                            borderColor: ['rgba(0, 215, 132, 0.93)',
                                'rgba(229, 247, 48, 0.8)',
                                'rgba(241, 37, 150, 0.8)',
                            ],
                            borderWidth: 2
                        }],
                    }
                });


                paymendtMethodChart = new Chart(paymendtMethodChartContainer, {
                    type: selectedChartType,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawOnChartArea: false
                                }

                            },
                        },
                        plugins: {

                            bgColor: {
                                backgroundColor: 'white'

                            }
                        },

                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($PaymentMethod); ?>,
                        datasets: [{
                            data: <?php echo json_encode($PaymentMethodcounts); ?>,
                            backgroundColor: ['rgba(0, 21, 215, 0.2)',
                                'rgba(0, 215, 132, 0.2)',
                                'rgba(118, 0, 186, 0.2)',
                            ],
                            borderColor: ['rgba(0, 21, 215, 0.93)',
                                'rgba(0, 215, 132, 1)',
                                'rgba(118, 0, 186, 0.93)',
                            ],
                            borderWidth: 2
                        }]
                    },
                });

                //uwu

                // Create new charts based on selected chart type
                transactionTypeChart = new Chart(transactionTypeChartContainer, {
                    type: selectedChartType,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawOnChartArea: false
                                }

                            },
                        },
                        plugins: {

                            bgColor: {
                                backgroundColor: 'white'

                            }
                        },
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($transactionType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($transactionTypecounts); ?>,
                            backgroundColor: ['rgba(186, 0, 0, 0.2)',
                                'rgba(250, 154, 37, 0.2)',
                                'rgba(37, 202, 247, 0.2)',
                            ],
                            borderColor: ['rgba(186, 0, 0, 0.93)',
                                'rgba(250, 154, 37, 0.81)',
                                'rgba(37, 202, 247, 0.81)',
                            ],
                            borderWidth: 2
                        }],
                    }
                });

                customerTypeChart = new Chart(customerTypeChartContainer, {
                    type: selectedChartType,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawOnChartArea: false
                                }

                            },
                        },
                        plugins: {

                            bgColor: {
                                backgroundColor: 'white'

                            }
                        },
                    },
                    plugins: [bgColor],
                    data: {
                        labels: <?php echo json_encode($customerType); ?>,
                        datasets: [{
                            data: <?php echo json_encode($customerscounts); ?>,
                            backgroundColor: ['rgba(247, 37, 149, 0.2)',
                                'rgba(166, 37, 247, 0.2)',
                                'rgba(255, 155, 22, 0.2)',
                                'rgba(255, 213, 22, 0.2)',
                                'rgba(49, 255, 22, 0.2)',
                                'rgba(73, 0, 242, 0.2)',
                                'rgba(0, 220, 242, 0.2)'

                            ],
                            borderColor: ['rgba(247, 37, 149, 0.81)',
                                'rgba(166, 37, 247, 0.83)',
                                'rgba(255, 155, 22, 0.83)',
                                'rgba(255, 213, 22, 0.83)',
                                'rgba(49, 255, 22, 0.83)',
                                'rgba(73, 0, 242, 0.83)',
                                'rgba(0, 220, 242, 0.83)'
                            ],
                            borderWidth: 2
                        }]
                    },

                });
            }
        }


        // Listen for changes in the dropdown and update charts
        chartTypeDropdown.addEventListener('change', updateCharts);

        updateCharts();
    });

    // dashboard design end
</script>
<script>
    //script for date filter, at the bottom so all functions can be called
    var newTotalTransaction = {
        datasets: []
    };
    newTotalTransaction.datasets = totalTransactionDataset.datasets.map(a => {
        return {
            ...a
        }
    }); //total transaction modified json

    var newTotalSum = {
        datasets: []
    };
    newTotalSum.datasets = totalSum.datasets.map(a => {
        return {
            ...a
        }
    }) //total income modified json


    var new_divData = {
        datasets: []
    };
    new_divData.datasets = perDivData.datasets.map(a => {
        return {
            ...a
        }
    })

    var newSoldPerDivs = {
        datasets: []
    };
    newSoldPerDivs.datasets = soldPerDivs.datasets.map(a => {
        return {
            ...a
        }
    }); //total income per division modified json

    //reserve as backup dataset, cuz OG gets modified---------------------------------------------------------------
    const cacheTotalTransaction = {
        datasets: []
    };
    cacheTotalTransaction.datasets = totalTransactionDataset.datasets.map(a => {
        return {
            ...a
        }
    });

    const cacheTotalSum = {
        datasets: []
    };
    cacheTotalSum.datasets = totalSum.datasets.map(a => {
        return {
            ...a
        }
    });

    const cachePerDivData = {
        datasets: []
    };
    cachePerDivData.datasets = perDivData.datasets.map(a => {
        return {
            ...a
        }
    });

    const cacheSoldPerDivs = {
        datasets: []
    };
    cacheSoldPerDivs.datasets = soldPerDivs.datasets.map(a => {
        return {
            ...a
        }
    });
    //--------------------------------------------------------------------------------------------------------------

    var dateTypeSelect = document.getElementById('date_type');

    function dateChange() {
        var selectedValue = dateTypeSelect.value;
        if (selectedValue === '_day') {
            document.getElementById('startDate').setAttribute('type', 'date');
            document.getElementById('endDate').setAttribute('type', 'date');

            dateFilterRefresh();
            dateFilter();
        }
    };
</script>
<script>
    function dateFilter() {
        var selectedValue = dateTypeSelect.value;
        if (selectedValue === '_day') {
            const dateList = [...global_label_day];

            //get the contents of the html datepicker
            const fromDateValue = document.getElementById('startDate');
            const toDatevalue = document.getElementById('endDate');

            //get the index of the labels array based on the value of datepicker
            //both array value and date picker value must be matching cAsE sEnSiTiVe to give a result
            const sunIndex = dateList.indexOf(fromDateValue.value);
            const satIndex = dateList.indexOf(toDatevalue.value);

            //slice the labels array based on the sunIndex and satIndex
            const new_dayList = dateList.slice(sunIndex, satIndex + 1);

            totaltransactionChartB.config.data.labels = new_dayList; //assign new label to the chart
            transactionChartB.config.data.labels = new_dayList;
            totalsalesChartB.config.data.labels = new_dayList;
            salesChart.config.data.labels = new_dayList;

            //new json for new dataset iterates through all object "data"
            //if date is not accurate remove the -7 on both sunIndex and satIndex, some machines are retarded
            //------------------------------------------------1st
            newTotalTransaction.datasets.forEach(function(datasets) {
                var originalDataLog = datasets.data;
                var newDataLog = {};
                var keys = Object.keys(originalDataLog);
                for (var i = sunIndex - 7; i <= satIndex - 7 && i < keys.length; i++) { //fetch all values based from sunIndex to satIndex
                    var key = keys[i];
                    newDataLog[key] = originalDataLog[key];
                }
                datasets.data = newDataLog;
            });
            totaltransactionChartB.config.data.datasets = newTotalTransaction.datasets; //replace the current chart dataset
            //now repeating the process for the other chart---2nd
            newTotalSum.datasets.forEach(function(datasets) {
                var originalDataLog = datasets.data;
                var newDataLog = {};
                var keys = Object.keys(originalDataLog);
                for (var i = sunIndex - 7; i <= satIndex - 7 && i < keys.length; i++) { //fetch all values based from sunIndex to satIndex
                    var key = keys[i];
                    newDataLog[key] = originalDataLog[key];
                }
                datasets.data = newDataLog;
            });
            totalsalesChartB.config.data.datasets = newTotalSum.datasets
            //------------------------------------------------3rd

            new_divData.datasets.forEach(function(dataset) {
                dataset.data = Object.keys(dataset.data)
                    .filter((date) => date >= fromDateValue.value && date <= toDatevalue.value)
                    .reduce((obj, date) => {
                        obj[date] = dataset.data[date];
                        return obj;
                    }, {});
            });
            transactionChartB.config.data.datasets = new_divData.datasets;
            //------------------------------------------------4th

            newSoldPerDivs.datasets.forEach(function(dataset) {
                dataset.data = Object.keys(dataset.data)
                    .filter((date) => date >= fromDateValue.value && date <= toDatevalue.value)
                    .reduce((obj, date) => {
                        obj[date] = dataset.data[date];
                        return obj;
                    }, {});
            });
            salesChart.config.data.datasets = newSoldPerDivs.datasets;

            totaltransactionChartB.update(); //udpate the chart
            totalsalesChartB.update();
            transactionChartB.update();
            salesChart.update();

            newTotalTransaction = JSON.parse(JSON.stringify(cacheTotalTransaction)); //reverts the value of the newTotalTransaction prior to modification
            newTotalSum = JSON.parse(JSON.stringify(cacheTotalSum));
            new_divData = JSON.parse(JSON.stringify(cachePerDivData));
            newSoldPerDivs = JSON.parse(JSON.stringify(cacheSoldPerDivs));
        }

    }
    dateFilter();
</script>
<script>
    function downloadPDF() {

        document.getElementById('sending-email-message').style.display = 'block';

        const totaltransactionChart = document.getElementById('totaltransactionChart');
        const transactionChart = document.getElementById('transactionChart');
        const totalsalesChart = document.getElementById('totalsalesChart');
        const salesChart = document.getElementById('salesChart');
        const myChart = document.getElementById('myChart');
        const provincesChart = document.getElementById('Provinces');
        const transactionStatusChart = document.getElementById('transactionStatus'); // New chart element
        const paymentChart = document.getElementById('paymendtMethod'); // New chart element
        const transactionTypeChart = document.getElementById('transactionType'); // New chart element
        const customerTypeChart = document.getElementById('customerType'); // New chart element


        const options = {
            quality: 5,
            width: 800,
            height: 600
        };

        domtoimage.toPng(totaltransactionChart, options)
            .then(function(totaltransactionChartImg) {
                domtoimage.toPng(transactionChart, options)
                    .then(function(transactionChartImg) {
                        domtoimage.toPng(salesChart, options)
                            .then(function(salesChartImg) {
                                domtoimage.toPng(myChart, options)
                                    .then(function(myChartImg) {
                                        domtoimage.toPng(provincesChart, options)
                                            .then(function(provincesChartImg) {
                                                domtoimage.toPng(transactionStatusChart, options)
                                                    .then(function(transactionStatusChartImg) {
                                                        domtoimage.toPng(transactionTypeChart, options)
                                                            .then(function(transactionTypeChartImg) {
                                                                domtoimage.toPng(paymentChart, options)
                                                                    .then(function(paymentChartImg) {
                                                                        domtoimage.toPng(customerTypeChart, options)
                                                                            .then(function(customerTypeChartImg) {
                                                                                domtoimage.toPng(totalsalesChart, options)
                                                                                    .then(function(totalsalesChartImg) {
                                                                                        const pdf = new jsPDF();

                                                                                        pdf.setFontSize(12);
                                                                                        pdf.setFont('helvetica', 'bold');
                                                                                        pdf.setTextColor(0, 122, 204);
                                                                                        pdf.text('Total Transactions', 40, 25);
                                                                                        pdf.text('Total Income', 40, 115);
                                                                                        pdf.text('Transaction per Division', 40, 215);

                                                                                        pdf.setFont('helvetica', 'bold');
                                                                                        pdf.setTextColor(0, 41, 102);
                                                                                        pdf.setFontSize(14);
                                                                                        pdf.text('Visualight-Dashboard', 83, 10);

                                                                                        pdf.addImage(totaltransactionChartImg, 'PNG', 40, 30, 130, 70, undefined, 'FAST');
                                                                                        pdf.addImage(totalsalesChartImg, 'PNG', 40, 123, 130, 70, undefined, 'FAST');
                                                                                        pdf.addImage(transactionChartImg, 'PNG', 40, 220, 130, 70, undefined, 'FAST');

                                                                                        pdf.addPage();

                                                                                        pdf.setFontSize(12);
                                                                                        pdf.setFont('helvetica', 'bold');
                                                                                        pdf.setTextColor(0, 122, 204);
                                                                                        pdf.text('Income per Division', 40, 25);

                                                                                        pdf.addImage(salesChartImg, 'PNG', 40, 30, 140, 70, undefined, 'FAST');

                                                                                        pdf.text('Average Income Daily', 40, 115);

                                                                                        pdf.addImage(myChartImg, 'PNG', 40, 120, 105, 80, undefined, 'FAST');

                                                                                        pdf.text('Total Customers per Province', 40, 210);

                                                                                        pdf.addImage(provincesChartImg, 'PNG', 40, 220, 130, 70, undefined, 'FAST');

                                                                                        pdf.addPage();

                                                                                        pdf.setFontSize(12);
                                                                                        pdf.setFont('helvetica', 'bold');
                                                                                        pdf.setTextColor(0, 122, 204);
                                                                                        pdf.text('Transaction Status', 40, 18);

                                                                                        pdf.addImage(transactionStatusChartImg, 'PNG', 60, 25, 110, 70, undefined, 'FAST');

                                                                                        pdf.text('Payment Method', 40, 110);

                                                                                        pdf.addImage(paymentChartImg, 'JPEG', 60, 115, 110, 70, undefined, 'FAST');


                                                                                        pdf.text('Transaction Type', 40, 205);

                                                                                        pdf.addImage(transactionTypeChartImg, 'PNG', 60, 215, 110, 70, undefined, 'FAST');

                                                                                        pdf.addPage();

                                                                                        pdf.setFontSize(12);
                                                                                        pdf.setFont('helvetica', 'bold');
                                                                                        pdf.setTextColor(0, 122, 204);
                                                                                        pdf.text('Customer Type', 40, 18);

                                                                                        pdf.addImage(customerTypeChartImg, 'PNG', 60, 25, 110, 70, undefined, 'FAST');



                                                                                        pdf.save('Visualight-Dashboard.pdf');
                                                                                    });
                                                                            });

                                                                    });
                                                            });
                                                    });
                                            });
                                    });
                            });
                    });
            })
            .catch(function(error) {
                console.error('Error generating PDF:', error);
            });

        setTimeout(function() {
            document.getElementById('sending-email-message').style.display = 'none';
        }, 5000);
    }
</script>