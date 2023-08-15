<?php

$this->title = '';
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

    .custom-text {
        position: absolute;
        top: 80px;
        right: 50px;
        text-align: center;
        width: 220px;
    }

    .uwu-text,
    .ehe-text {
        background-color: #B526C2;
        color: white;
        width: 220px;
        height: 130px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 30px;
    }

    .uwu-text {
        background-color: #11A34C;
        /* Updated background color for .uwu-text */
    }

    .texty {
        margin: 0;
        font-weight: bold;
        font-size: 16px;
        font-family: Poppins;
    }

    .number {
        margin: 0;
        font-family: Poppins;
        font-size: 45px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #myChart {
        position: absolute;
        left: 50px;
        top: 45px;
    }

    @media (max-width: 900px) {
        .custom-text {
            position: absolute;
            top: 70px;
            right: 50px;
            text-align: center;
            width: 220px;
            box-sizing: border-box;
            padding: 15px;
            display: inline-block;
        }

        .uwu-text,
        .ehe-text {
            width: 220px;
            height: 130px;
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 15px;
        }

        #myChart {
            position: absolute;
            left: 50px;
            top: 100px;
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
        height: 28rem;
        width: 47%;
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
// Fetch sales data from the database
// $fromDate = $_POST['startDate'];
// $toDate = $_POST['endDate'];

$query = new Query();

$salesData = $query->select(['division_name', 'transacton_date', 'SUM(amount) as total_amount'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    // ->where(['between', 'transacton_date', '2023-06-10', '2023-06-14'])
    ->groupBy(['division_name', 'transacton_date'])
    ->all();

// Fetch transaction data from the database (depends on how many transaction in same date and same div_name)
$transactionData = $query->select(['division_name', 'transacton_date', 'COUNT(*) as transaction_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['division_name', 'transacton_date'])
    ->all();

$topCustomers = $query->select(['last_name', 'COUNT(*) as transaction_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['last_name'])
    ->orderBy(['transaction_count' => SORT_DESC])
    ->limit(5)
    ->all();

$addressData = $query->select(['address', 'COUNT(*) as customer_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['address'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();

// Prepare data for the chart
$province = [];
$customersCounts = [];

foreach ($addressData as $customeraddress) {
    $province[] = $customeraddress['address'];
    $customersCounts[] = $customeraddress['customer_count'];
}

$customerTypeData = $query->select(['customer_type', 'COUNT(*) as customer_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer_type'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();
$customerType = [];
$customerscounts = [];

foreach ($customerTypeData as $customersType) {
    $customerType[] = $customersType['customer_type'];
    $customerscounts[] = $customersType['customer_count'];
}

$transactionTypeData = $query->select(['transaction_type', 'COUNT(*) as customer_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['transaction_type'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();
$transactionType = [];
$transactionTypecounts = [];

foreach ($transactionTypeData as $type) {
    $transactionType[] = $type['transaction_type'];
    $transactionTypecounts[] = $type['customer_count'];
}
$transactionStatusData = $query->select(['transaction_status', 'COUNT(*) as customer_count'])
    ->from('operational_report')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['transaction_status'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();

$transactionStatus = [];
$transactionStatusDatacounts = [];

foreach ($transactionStatusData as $status) {
    $transactionStatus[] = $status['transaction_status'];
    $transactionStatusDatacounts[] = $status['customer_count'];
}

$PaymentMethodData = $query->select(['payment_method', 'COUNT(*) as customer_count'])
    ->from('operational_report')
    ->where(['payment_method' => ['Check', 'Over the counter', 'Online Payment']])
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['payment_method'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->limit(100000)
    ->all();

$PaymentMethod = [];
$PaymentMethodcounts = [];

foreach ($PaymentMethodData as $method) {
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

// Prepare data for the chart
$lastNames = [];
$transactionCounts = [];

foreach ($topCustomers as $customer) {
    $lastNames[] = $customer['last_name'];
    $transactionCounts[] = $customer['transaction_count'];
}

$transactionPerday = (new Query())
    ->select('transacton_date, COUNT(*) as transaction_count')
    ->from('operational_report')
    ->groupBy('transacton_date');

$transactionPerday = $transactionPerday->all(); // Get the results with daily transaction counts
$totalDays = count($transactionPerday); // Total number of days
$totalTransactions = 0;

foreach ($transactionPerday as $result) {
    $totalTransactions += $result['transaction_count'];
}
$average = round($totalTransactions / $totalDays); // Calculate the average

$SalesAve = (new Query())
    ->select('transacton_date, SUM(amount) as transaction_count')
    ->from('operational_report')
    ->groupBy('transacton_date');

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
    'National Metrology Department' => [
        'backgroundColor' => 'rgba(54, 162, 255, 1)',
        'borderWidth' => 2,
    ],
    'Standard and Testing Division' => [
        'backgroundColor' => 'rgba(2, 165, 96, 1)',
        'borderWidth' => 2,
    ],
    'Technological Services Division' => [
        'backgroundColor' => 'rgba(245, 40, 145, 1)',
        'borderWidth' => 2,
    ],
];

//dito yung pag lalagay nung naka set na color
foreach ($SalesperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division_name not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division_name not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}

foreach ($TransactionperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['backgroundColor']) ? $divisionColors[$divisionName]['backgroundColor'] : '#EFF5FF'; // Default background color if division_name not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division_name not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}


//Dito yung para sa Total ng Daily Transaction (tinatype ko pa yung date kasi di ako marunong nung rekta connected sa calendar HAHAHAH)
date_default_timezone_set('Asia/Manila');
//Metrology transaction
//dito banda kukunin yung number of transaction tapos kung anong date
$todaymettrans = (new Query())
    ->select('COUNT(*)')
    ->from('operational_report')
    ->where([
        'division_name' => 'National Metrology Department',
        'transacton_date' => date('Y-m-d') // Assuming you want the number of transactions for today
    ])
    ->scalar();

$lastmettrans = (new Query())
    ->select('COUNT(*)')
    ->from('operational_report')
    ->where([
        'division_name' => 'National Metrology Department',
        'transacton_date' => date('Y-m-d', strtotime('-1 day'))
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
    ->from('operational_report')
    ->where([
        'division_name' => 'Standard and Testing Division',
        'transacton_date' => date('Y-m-d')
    ])
    ->scalar();

$lastSandTtrans = (new Query())
    ->select('COUNT(*)')
    ->from('operational_report')
    ->where([
        'division_name' => 'Standard and Testing Division',
        'transacton_date' => date('Y-m-d', strtotime('-1 day'))
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
//T&S transaction

$todayTandStrans = (new Query())
    ->select('COUNT(*)')
    ->from('operational_report')
    ->where([
        'division_name' => 'Technological Services Division',
        'transacton_date' => date('Y-m-d')
    ])
    ->scalar();

$lastTandStrans = (new Query())
    ->select('COUNT(*)')
    ->from('operational_report')
    ->where([
        'division_name' => 'Technological Services Division',
        'transacton_date' => date('Y-m-d', strtotime('-1 day'))
    ])
    ->scalar();

if ($todayTandStrans == 0) {
    $TandSdailytransincrease = 0;
} else {
    $TandSdailytransincrease = (($todayTandStrans - $lastTandStrans) / $todayTandStrans) * 100;
    $TandSdailytransincrease = number_format($TandSdailytransincrease, 2);
    if ($TandSdailytransincrease > 1) {
        $TandSdailytransincrease = '+' . $TandSdailytransincrease . '%';
    } else {
        $TandSdailytransincrease = $TandSdailytransincrease . '%';
    }
}


?>
<!-- 
<div class="header">
    <div class="header-grid">
    <p>Dashboard</p>
    <img src="/images/LogoVL.png" alt="visLogo">
    </div>
</div> <br> -->

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

</div>

<!-- Date Filter Div -->
<div class="date_filter">

    <div class="containers">
        <div class="dropdown_pdf_container">
            <div class="date_dropdown">
                <form>
                    <label for="date_type" class="date_type_label">
                        <strong>Date Filter:</strong></label>
                    <select name="date_type" id="date_type" class="dropdown-content">
                        <option value="_day">Daily</option>
                        <option value="_week">Weekly</option>
                        <option value="_month">Monthly</option>
                    </select>
                </form>
            </div>

            <div class="print_pdf">
                <Button class="print_pdf_label" onclick="downloadPDF()"> Chart Download</Button>
            </div>
        </div>
    </div>
    <div class="containers">
        <!-- <form method="post" action="process_data.php"> Replace with your processing script -->
        <div class="datePicker">
            <label>From: </label>
            <input type="date" id="startDate" name="startDate" class="datePicker_label">
            <!-- </div>
    <div class="datePicker"> -->
            <label>&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
            <input type="date" id="endDate" name="endDate" class="datePicker_label">
        </div>
        <!-- <input type="submit" value="Filter"> -->
        <!-- </form> -->
    </div>
</div>

<script>
    // Attach an event listener to the date picker fields
    document.getElementById("startDate").addEventListener("change", updateFilteredData);
    document.getElementById("endDate").addEventListener("change", updateFilteredData);

    function updateFilteredData() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        // Convert the date format to match the database format (YYYY-MM-DD)
        const formattedStartDate = new Date(startDate).toISOString().split('T')[0];
        const formattedEndDate = new Date(endDate).toISOString().split('T')[0];

        // Update the data using AJAX or fetch
        // ...
    }
</script>


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
        <p id="reportTitle"> Total Transaction and Sales</p>
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

    <div class="chart-container" id="avgSales">
        <p id="reportTitle">Average sales per day</p>
        <canvas id="myChart"></canvas>
        <div class="custom-text">
            <div class="uwu-text">
                <p class="texty"> Average Transactions </p>
                <p class="number"> <?= $average ?> </p>
            </div>
            <div class="ehe-text">
                <p class="texty"> Average Sales </p>
                <p class="number"> <?= $saleaverage ?> </p>
            </div>
        </div>
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

        // Creating combined chart
        const combinedCtx = document.getElementById('combinedChart').getContext('2d');

        const combinedChart = new Chart(combinedCtx, {
            type: 'line', // Start as bar chart
            data: combinedData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: false,
                            drawOnChartArea: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawOnChartArea: false,
                            type: 'category',
                            display: 'auto', // Enable auto-scaling of x-axis labels
                        }
                    },
                    'y-axis-bar': {
                        position: 'right', // Show the primary y-axis on the left side (sumTransactionDataset)
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    'lineY': {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Customize the step size as needed
                        },
                        grid: {
                            display: false,
                            drawOnChartArea: false
                        }
                    },
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x'
                        },
                        zoom: {
                            enabled: true,
                            mode: 'x'
                        }
                    }
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




        // Creating horizontal bar graphs
        const transactionCtx = document.getElementById('transactionChart').getContext('2d');
        const transactionChart = new Chart(transactionCtx, {
            type: 'bar',
            data: TransactionperDiv,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
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
                }
            }
        });

        //vertical bar graph
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: SalesperDiv,
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

                    x: {
                        grid: {
                            drawOnChartArea: false
                        }
                    }

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

        // // Calculate the average of each dataset
        // const salesAverage = SalesperDiv.datasets.map(dataset => ({
        //     label: dataset.label,
        //     average: calculateAverage(dataset.data),
        // }));


        // Calculate the average of each dataset
        const TransactionAverage = SalesperDiv.datasets.map(dataset => ({
            label: dataset.label,
            average: calculateAverage(dataset.data),
        }));
        // Find the maximum average value
        const maxAverage = Math.max(...TransactionAverage.map((average) => average.average));

        // Create a new dataset for each sales average
        const newDatasets = TransactionAverage.map((average, index) => {
            const datasetColors = ['rgba(0, 115, 199,1)', 'rgba(2, 165, 96,1)', 'rgba(242, 26, 156,1)']; // Array of specific colors
            const color = datasetColors[index % datasetColors.length]; // Assign color based on index

            return {
                label: `Average ${average.label}`,
                data: [average.average],
                borderWidth: 1,
                circumference: (ctx) => ((ctx.dataset.data[0] / maxAverage) * 270),
                backgroundColor: color,
                borderColor: color,
            };
        });

        // Combine the existing datasets with the new datasets
        const allDatasets = [...TransactionAverage, ...newDatasets];

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
                    ctx.fillText('Average sales per day', width / 2.1, height / 2 + top);
                    console.log(chart.getDatasetMeta(0))

                }

            }]
        };

        // Render the doughnut chart
        const myChart = new Chart(document.getElementById('myChart'), config);

        // Instantly assign Chart.js version
        const chartVersion = document.getElementById('chartVersion');
        chartVersion.innerText = Chart.version;

        var customerTypeData = <?php echo json_encode($customerTypeData); ?>;
        var paragraphElement = document.getElementById('customerTypeParagraph');
        paragraphElement.textContent = 'Customer Type: ' + customerTypeData;
    </script>


    <!-- All about customer graphs -->
    <div class="customers_data">
        <div class="date_filter" style="text-align: left; padding-left: 8rem; padding-top: 0rem; padding-bottom: 2rem;">
            <div class="containers">
                <div class="date_dropdown">
                    <label for="chart_type" class="chart_type_label">
                        <strong>Chart Filter</strong></label>
                    <select name="chart_type" id="chart_type" class="dropdown-content">
                        <option value="bar">Bar</option>
                        <option value="doughnut">Doughnut</option>
                        <option value="line">Line</option>
                        <option value="pie">Pie</option>
                        <!-- <option value="horizontal_bar">Horizontal chart</option> -->
                    </select>
                </div>
            </div>
        </div>


        <div class="graph">
            <div class="chart-container">
                <p id="reportTitle">Top 5 Customers</p>
                <canvas id="topCustomersChart"></canvas>
            </div>
            <div class="chart-container">
                <p id="reportTitle">Total Customers per Province</p>
                <canvas id="Provinces"></canvas>
            </div>
        </div>
    </div>


    <!-- scriptfor customers graph -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to chart containers and the dropdown
            const topCustomersChartContainer = document.getElementById('topCustomersChart');
            const provincesChartContainer = document.getElementById('Provinces');
            const chartTypeDropdown = document.getElementById('chart_type');

            //     function generateRandomColor() {
            //   const randomColor = `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
            //   return randomColor;
            // }

            // const randomColor = generateRandomColor();
            // Initialize charts (empty)
            let topCustomersChart = null;
            let provincesChart = null;

            // Update charts based on selected chart type
            function updateCharts() {
                const selectedChartType = chartTypeDropdown.value;

                // Destroy existing charts if they exist
                if (topCustomersChart) {
                    topCustomersChart.destroy();
                }
                if (provincesChart) {
                    provincesChart.destroy();
                }

                // Create new charts based on selected chart type
                topCustomersChart = new Chart(topCustomersChartContainer, {
                    type: selectedChartType,
                    options: {
                        indexAxis: 'y',
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
                        }
                    },

                    data: {
                        labels: <?php echo json_encode($lastNames); ?>,
                        datasets: [{
                            label: 'Transaction Count',
                            data: <?php echo json_encode($transactionCounts); ?>,
                            backgroundColor: ['rgba(75, 192, 192, 0.2)',
                                'rgba(20, 241, 56, 0.2)',
                                'rgba(241, 61, 183, 0.2)',
                                'rgba(233, 241, 78, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: ['rgba(75, 192, 192, 1)',
                                'rgba(20, 241, 56, 1)',
                                'rgba(241, 61, 183,1)',
                                'rgba(233, 241, 78, 1)',
                                'rgba(255, 159, 64,1)'
                            ],
                            borderWidth: 2
                        }],
                    }
                });

                provincesChart = new Chart(provincesChartContainer, {
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
                            }
                        }
                    },
                    data: {
                        labels: <?php echo json_encode($province); ?>,
                        datasets: [{
                            label: 'Customer Count',
                            data: <?php echo json_encode($customersCounts); ?>,
                            backgroundColor: generateRandomColors(<?php echo count($customersCounts); ?>, 1),
                            borderColor: 'rgba(0, 0, 0, 0.2)',
                            borderWidth: 1
                        }]
                    },
                });

                function generateRandomColors(count, alpha) {
                    const colors = [];
                    for (let i = 0; i < count; i++) {
                        colors.push(generateRandomColor(alpha));
                    }
                    return colors;
                }

                function generateRandomColor(alpha) {
                    const r = Math.floor(Math.random() * 256);
                    const g = Math.floor(Math.random() * 256);
                    const b = Math.floor(Math.random() * 256);
                    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
                }
            }

            // Listen for changes in the dropdown and update charts
            chartTypeDropdown.addEventListener('change', updateCharts);

            updateCharts();
        });
    </script>

    <!-- All about customer graphs -->
    <script src="path/to/Chart.min.js"></script>
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
                        }
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
                        }
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
                        }
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
                        }
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
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        },
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
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        },
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

                            }
                        },

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
                            }

                        },
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
                            }
                        },

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


                        },
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
        function downloadPDF() {
            const combinedChart = document.getElementById('combinedChart');
            const transactionChart = document.getElementById('transactionChart');
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

            domtoimage.toPng(combinedChart, options)
                .then(function(combinedChartImg) {
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
                                                                                    const pdf = new jsPDF();

                                                                                    pdf.setFontSize(12);
                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 122, 204);
                                                                                    pdf.text('Total Transaction and Sales', 40, 25);
                                                                                    pdf.text('Transaction per Division', 40, 115);
                                                                                    pdf.text('Sales per Division', 40, 215);

                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 41, 102);
                                                                                    pdf.setFontSize(14);
                                                                                    pdf.text('Visualight-Dashboard', 83, 10);

                                                                                    pdf.addImage(combinedChartImg, 'PNG', 40, 30, 130, 70);
                                                                                    pdf.addImage(transactionChartImg, 'PNG', 40, 123, 130, 70);
                                                                                    pdf.addImage(salesChartImg, 'PNG', 40, 220, 130, 70);

                                                                                    pdf.addPage();

                                                                                    pdf.setFontSize(12);
                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 122, 204);
                                                                                    pdf.text('Average Sales Daily', 40, 25);

                                                                                    pdf.addImage(myChartImg, 'PNG', 50, 20, 110, 70);

                                                                                    pdf.text('Type of Customers', 40, 115);

                                                                                    pdf.addImage(customerTypeChartImg, 'PNG', 40, 120, 130, 70);

                                                                                    pdf.text('Total Customers per Province', 40, 215);

                                                                                    pdf.addImage(provincesChartImg, 'PNG', 40, 225, 130, 70);

                                                                                    pdf.addPage();

                                                                                    pdf.setFontSize(12);
                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 122, 204);
                                                                                    pdf.text('Transaction Status', 40, 18);

                                                                                    pdf.addImage(transactionStatusChartImg, 'PNG', 60, 25, 100, 80);

                                                                                    pdf.text('Payment Method', 40, 115);

                                                                                    pdf.addImage(paymentChartImg, 'JPEG', 60, 115, 100, 80);


                                                                                    pdf.text('Transaction Type', 40, 215);

                                                                                    pdf.addImage(transactionTypeChartImg, 'PNG', 60, 215, 100, 80);


                                                                                    pdf.save('Visualight-Dashboard.pdf');
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
        }
    </script>

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

    <div class="prediction-index">
        <h1><?= Html::encode($this->title) ?></h1>

        <form id="prediction-form">
            <label for="years">Enter the number of years for predictions:</label>
            <input type="number" id="years" name="years" step="0.01" value="">
            <button type="submit">Compute Predictions</button>
        </form>

        <div id="predictions" style="font-weight: bold; "></div> <br>
        <div id="predictions1" style="font-weight: bold;"></div> <br>
        <div id="predictions2" style="font-weight: bold;"></div>

    </div>

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

            const predictedTransactionCountPerYear= Math.round(interceptForCountPerYear + slopeForCountPerYear * nextDayTimestamp.getTime() / 1000);
            const predictedTotalSalesPerYear = Math.round(interceptForSalesPerYear+ slopeForSalesPerYear * nextDayTimestamp.getTime() / 1000);

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
    <br>
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
->leftJoin('operational_report opr', 'all_dates.date = opr.transacton_date AND opr.transaction_status = "paid" AND opr.division_name = "National Metrology Department"')
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
    ->leftJoin('operational_report opr1', 'all_years1.year = YEAR(opr1.transacton_date) AND opr1.transaction_status = "paid" AND opr1.division_name = "National Metrology Department"')
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

const predictionsDiv1 = document.getElementById('predictions1');
predictionsDiv1.innerHTML = `
<p>Predicted transaction count of the NMD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${predictedTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTransactionCountPerYear1)}
            (${predictedTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total transaction count of the NMD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalTransactionCountPerYear1)}
            (${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'Increased' : 'Decreased '})
        </span>
    </p>
    <br>
    <p>Predicted income of the NMD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTotalSalesPerYear1)}
            (${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total income of the NMD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalSalesPerYear1)}
            (${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
`;

    });
</script>


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
    <p>Predicted total transaction count of the STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalTransactionCountPerYear1)}
            (${averagePredictedTotalTransactionCountPerYear1 >= transactionCounts1[transactionCounts1.length - 1] ? 'Increased' : 'Decreased '})
        </span>
    </p>
    <br>
    <p>Predicted income of the STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(predictedTotalSalesPerYear1)}
            (${predictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
    <p>Predicted total income of the STD on the <span style="color:#0080ff">${days1}-day (${years1} year(s))</span> mark: 
        <span style="color:${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'green' : 'red'}">
            ${addCommas(averagePredictedTotalSalesPerYear1)}
            (${averagePredictedTotalSalesPerYear1 >= totalSales1[totalSales1.length - 1] ? 'Increased' : 'Decreased'})
        </span>
    </p>
`;

    });
</script>