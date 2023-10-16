@@ -1,2272 +1,2273 @@
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
        width: 30%;
        display: inline-block;
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

    .asOne {
        justify-content: space-between;
        width: 60%;
        right: 50%;
    }

    @media (max-width: 600px) {
        .custom-text {
            position: absolute;
            top: 25%;
            right: 10%;
            box-sizing: border-box;
            display: inline-block;
        }

        .uwu-text,
        .ehe-text {
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
            right: 50%;
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
        height: 28rem;
        width: 100%;
        max-width: 47%;
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }

    .containerBody {
        height: 100%;
        width: 200%;
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

// Fetch transaction data from the database (depends on how many transaction in same date and same div_name)
$transactionData = $query->select(['division', 'transaction_date', 'COUNT(*) as transaction_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['division', 'transaction_date'])
    ->orderBy(['transaction_date' => SORT_DESC])
    ->all();

// Prepare $TransactionperDiv array (null pa// otw yung data HAHA)
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
    ->limit(100000)
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


foreach ($customerTypeData as $customersType) {
    if (isset($customersType['customer_type']) && isset($customerType_name[$customersType['customer_type']]))
    {
        $customersType['customer_type']=$customerType_name[$customersType['customer_type']];
    }
    $customerType[] = $customersType['customer_type'];
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
    if (isset($type['transaction_type']) && isset($transactionType_name[$type['transaction_type']]))
    {
        $type['transaction_type']=$transactionType_name[$type['transaction_type']];
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
    if (isset($status['transaction_status']) && isset($transactionStatus_name[$status['transaction_status']]))
    {
        $status['transaction_status']=$transactionStatus_name[$status['transaction_status']];
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
    if (isset($method['payment_method']) && isset($paymentmethod_name[$method['payment_method']]))
    {
        $method['payment_method']=$paymentmethod_name[$method['payment_method']];
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
    var transactionDatas =<?php echo json_encode($transactionData); ?>;
    console.log(transactionDatas);//3bm60 log to console
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
        <div class="containerBody">
            <canvas id="combinedChart"></canvas>
        </div>
    </div>

    <div class="chart-container">
        <p id="reportTitle"> Transaction Per Division</p>
        <!-- <div class="containerBody"> -->
        <canvas id="transactionChart"></canvas>
        <!-- </div> -->
    </div>


    <div class="chart-container">
        <p id="reportTitle"> Sales per Division</p>
        <div class="containerBody">
            <canvas id="salesChart"></canvas>
        </div>
    </div>


    <div class="chart-container" id="avgSales">
        <p id="reportTitle">Average sales per day</p>
        <div class="asOne">
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
    </div>

    <!-- <div class="chart-container" id="avgSales">
        <div class="aveChart" style="display: grid; grid-template-columns: repeat(2,1fr); grid-gap:.1rem; grid-template-rows: auto auto;">
        <div class="chart"style="width: 90%; ">
        <p id="reportTitle">Average sales per day</p>
        <canvas id="myChart"></canvas>
        </div>
        <div class="label" style="width: 5%; padding-left:3rem; ">
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
        </div>
    </div> -->

    <!-- <div class="chart-container" style="max-width: 100%; height: 500px; overflow-x: scroll; text-align: center;">
                <p id="reportTitle">Total Customers per Province</p>
                <div class="ProvinceChart" style="display: grid; grid-template-columns: repeat(2,1fr); grid-gap:.1rem; grid-template-rows: auto auto;">
                <div class="scaleContainer" style="width: 10%; text-align: justtify;">
                <?php echo json_encode($customersCounts); ?>,
                </div>
                <div class="containerBody" style="width: 80%; height: 100%;">
                    <canvas id="Provinces"></canvas>
                </div>
            </div>
            </div> -->






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

        const bgColor = {
            id:'bgColor',
            beforeDraw: (chart, steps, options) => {
                const {ctx, width, height } = chart;
                ctx.fillStyle = options.backgroundColor;
                ctx.fillRect( 0, 0, width, height)
                ctx.restore();
            }

        };

        const bgColor1 = {
            id:'bgColor',
            beforeDraw: (chart, steps, options) => {
                const {ctx, width, height } = chart;
                ctx.fillStyle = options.backgroundColor;
                ctx.fillRect( 0, 0, width, height)
                ctx.restore();
            }

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
                            display: false
                        },
                        grid: {
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
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
                            drawOnChartArea: false,
                            drawTicks: false,
                        }
                    },
                },
                plugins: {
                    legend: {
                        position: 'top',
                        // display: false //para sa kinacancel sa taas
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
                    },

                    bgColor:{
                        backgroundColor: 'white'
                    }
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },

            },
            plugins:[bgColor],


        });




        // Creating horizontal bar graphs
        const transactionCtx = document.getElementById('transactionChart').getContext('2d');
        const transactionChart = new Chart(transactionCtx, {
            type: 'bar',
            data: TransactionperDiv,
            // {
            //     datasets: TransactionperDiv.datasets.map(dataset => ({
            //         ...dataset,
            //         data: dataset.data.slice(0, 7) // Display only the first 7 data points for each dataset
            //     })),
            //     labels: TransactionperDiv.labels.slice(0, 7)  // Assuming labels are defined in TransactionperDiv
            // },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false
                        },
                        min: 0,
                        max: 6,
                    },
                    x: {
                        grid: {
                            display: false,
                            drawOnChartArea: false
                        }
                    },
                },
                plugins: {
                    bgColor:{
                        backgroundColor: 'white'
                    }
                },
            },
             plugins:[bgColor],
        });

        function scroller(scroll, chart) {
            //console.log(scroll)

            if (scroll.deltaY > 0) {
                transactionChart.option.scales.y.min += 1;
                transactionChart.option.scales.y.max += 1;
            }
            transactionChart.update();
        }
        //wheel is for the gilid scroll
        transactionChart.canvas.addEventListener('wheel', (e) => {
            scroller(e, transactionChart)
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
                        min: 0,
                        max: 7,
                        grid: {
                            drawOnChartArea: false
                        }
                    }

                },

                 plugins: {
                    bgColor:{
                        backgroundColor: 'white'
                    }
                },

            },
              plugins:[bgColor],
        });

        // for scrolling
        const containerBody = document.querySelector('.containerBody');
        if (salesChart.data.labels.length > 7) {
            containerBody.style.width = '200%';
        }


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

        <div class="chart-container" style="max-width: 100%; height: 500px; overflow-x: scroll; text-align: center;">
            <p id="reportTitle">Total Customers per Province</p>
            <div class="containerBody">
                <canvas id="Provinces"></canvas>
            </div>
        </div>
    </div>

</div>


<!-- scriptfor customers graph -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to chart containers and the dropdown
        const provincesChartContainer = document.getElementById('Provinces');
        const chartTypeDropdown = document.getElementById('chart_type');
        const provinces = <?php echo json_encode($provinces); ?>;
        //     function generateRandomColor() {
        //   const randomColor = `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
        //   return randomColor;
        // }

        // const randomColor = generateRandomColor();
        // Initialize charts (empty)
        let provincesChart = null;

        // Update charts based on selected chart type
        function updateCharts() {
            const selectedChartType = chartTypeDropdown.value;

            if (provincesChart) {
                provincesChart.destroy();
            }



            provincesChart = new Chart(provincesChartContainer, {
                type: selectedChartType,
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
                            min: 0,
                            max: 6,
                            grid: {
                                display: false,
                                drawOnChartArea: false
                            }
                        },
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                          bgColor:{
                        backgroundColor: 'white'
                    }
                    }
                },
                plugins:[bgColor],
                data: {
                    labels: <?php echo json_encode($province); ?>,
                    datasets: [{
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
        // // Calculate and set the width of the chart container for scrolling
        // const chartContainer = document.getElementById('.containerBody');
        // if (Provinces.data.labels.length > 7) {
        //     containerBody.style.width = '200%'; // Adjust as needed
        // }

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
                      bgColor:{
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
                    plugins:[bgColor],
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
                    plugins:[bgColor],
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
                    plugins:[bgColor],
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
                    plugins:[bgColor],
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
                            bgColor:{
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
                    },plugins:[bgColor],
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
                              bgColor:{
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
                    },plugins:[bgColor],
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

                            bgColor:{
                                backgroundColor: 'white'
                                },
                        responsive: true,
                        maintainAspectRatio: false,
                    },  
                    },
                    plugins:[bgColor],

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
                              bgColor:{
                        backgroundColor: 'white'
                    }

                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    },plugins:[bgColor],
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

                        bgColor:{
                            backgroundColor: 'white'

                                }
                    },
                },plugins:[bgColor],
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

                        bgColor:{
                            backgroundColor: 'white'

                                }
                    },

                    },plugins:[bgColor],
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

                        bgColor:{
                            backgroundColor: 'white'

                                }
                    },
                    },
                    plugins:[bgColor],
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

                            bgColor:{
                                backgroundColor: 'white'

                                    }
                            },
                    },plugins:[bgColor],
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

                                                                                    pdf.addImage(combinedChartImg, 'PNG', 40, 30, 130, 70, undefined, 'FAST');
                                                                                    pdf.addImage(transactionChartImg, 'PNG', 40, 123, 130, 70, undefined, 'FAST');
                                                                                    pdf.addImage(salesChartImg, 'PNG', 40, 220, 130, 70, undefined, 'FAST');

                                                                                    pdf.addPage();

                                                                                    pdf.setFontSize(12);
                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 122, 204);
                                                                                    pdf.text('Average Sales Daily', 40, 25);

                                                                                    pdf.addImage(myChartImg, 'PNG', 50, 20, 110, 70, undefined, 'FAST');

                                                                                    pdf.text('Type of Customers', 40, 115);

                                                                                    pdf.addImage(customerTypeChartImg, 'PNG', 40, 120, 130, 70, undefined, 'FAST');

                                                                                    pdf.text('Total Customers per Province', 40, 215);

                                                                                    pdf.addImage(provincesChartImg, 'PNG', 40, 225, 130, 70, undefined, 'FAST');

                                                                                    pdf.addPage();

                                                                                    pdf.setFontSize(12);
                                                                                    pdf.setFont('helvetica', 'bold');
                                                                                    pdf.setTextColor(0, 122, 204);
                                                                                    pdf.text('Transaction Status', 40, 18);

                                                                                    pdf.addImage(transactionStatusChartImg, 'PNG', 60, 25, 100, 80, undefined, 'FAST');

                                                                                    pdf.text('Payment Method', 40, 115);

                                                                                    pdf.addImage(paymentChartImg, 'JPEG', 60, 115, 100, 80, undefined, 'FAST');


                                                                                    pdf.text('Transaction Type', 40, 215);

                                                                                    pdf.addImage(transactionTypeChartImg, 'PNG', 60, 215, 100, 80, undefined, 'FAST');


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
