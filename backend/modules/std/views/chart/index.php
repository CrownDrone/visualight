<?php

$this->title = '';
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<!DOCTYPE html>
<html>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta name="description" content="">

<style>
    @font-face {
        font-family: 'Poppins';
        src: url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.ttf') format('truetype'),
            url('<?= Yii::$app->request->baseUrl ?>/fonts/Poppins-Light.woff') format('woff');

    }

    body {
        font-family: 'Poppins';
    }

    /* Default styles */
    .chart-container {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .aveTransactionDiv,
    .aveSalesDiv {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        text-align: center;
        /* You may adjust the margin as needed */
        margin: 0 2%;
        /* Reduced margin for better centering */
    }

    .custom-text {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        text-align: center;
        top: 80px;
        /* If you want to position it from the top, adjust as needed */
        right: 50px;
        /* If you want to position it from the right, adjust as needed */
        margin: 5% 10%;
        box-sizing: border-box;
        padding: 15px;
        width: 80%;
        /* Increase the width for better centering */
    }


    .aveTransactionDiv,
    .aveSalesDiv {
        background-color: #ff8101;
        color: white;
        width: 400px;
        height: 130px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 30px;
    }

    .aveTransactionDiv {
        background-color: #3499ff;
        /* Updated background color for .aveTransactionDiv */
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
        width: 30%;
        height: 7.875rem;
        border-radius: .635rem;
        background: #0073e6;
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


    #dailyTrans,
    #dailyIncome,
    #avgTrans {
        font-size: 3.375rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        letter-spacing: .5rem;
    }

    #valueIncrease {
        font-size: 1.2rem;
        font-weight: 400;
        letter-spacing: .1rem;
        text-align: left;
        padding-top: 2.5rem;
        padding-right: 0;

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
        font-family: 'Poppins', sans-serif;
        color: #F8B200;
        font-size: 1.3rem;
        letter-spacing: .30rem;
        /* Removed margins if present, and let flexbox handle the spacing */
    }

    .dropdown {
        position: relative;
        display: inline-block;
        /* Set to flex for inline-flex behavior */
    }

    .dropdown-content {
        min-width: 8rem;
        z-index: 1;
        text-align: center;
        border-radius: 0.5rem;
        /* Align dropdown content here if necessary */
    }

    .date_type {
        border-radius: 0.5rem;
        /* Additional styling for the date type elements */
    }

    .print_pdf {
        /* Removed padding and right positioning */
        display: flex;
        /* Set to flex to use the flex properties */
    }

    .print_pdf_label {
        border-radius: 1rem;
        background-color: #00BDB2;
        font-size: .7rem;
        text-align: center;
        margin-top: 10%;
        margin-left: 10%;
        padding: 0.2rem 1rem;
        /* Combined padding properties */
        color: white;
        width: 8rem;
        /* Adjust alignment if needed */
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

    #container {
        height: 500px;
        min-width: 310px;
        max-width: 800px;
        margin: 0 auto;
    }

    .loading {
        margin-top: 10em;
        text-align: center;
        color: gray;
    }


    .chart-container {
        margin: .62rem;
        padding: 3em;
        border-radius: .93rem;
        background-color: white;
        display: inline-block;
        height: 30rem;
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

    .reportTitle {
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
        z-index: 2000;
    }

    .popup-content {
        width: 69%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-40%, -46%);
        background: white;
        color: black;
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
        height: 85px;
        top: 10%;
        /* Half the height of the full dial */
        background-color: red;
        border-radius: 75px 75px 0 0;
        /* Round the top corners */
        position: relative;
        margin: 0 auto;
        overflow: hidden;

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

        /* target form */

        .form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 600px;
        margin: 0 auto;
    }

    .column {
        flex: 0 0 48%;
        margin-bottom: 20px;
        width: 20%;
    }

    /* background */
    .speedometer {
        background-color: #E2EBEC;
        position: absolute;
        right: 40%;
        top: 55%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 200px;
        justify-content: left;
        align-items: left;
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 1rem;
    }

    #toggleButton {
        background-color: #0073D8;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 1000px;
        margin-bottom: 10px;
        font-weight: bold;
        position: static;
        font-size: 20px;
        display: none;

    }

    #toggleButton:hover {
        background-color: #6BBAFF;
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
    ->where([
        'division' => '2',
        'transaction_status' => ['1'] //videlle bakit mo sinasama pending sa sales? Di pa nga bayad yon eh
    ])
    ->groupBy(['division', 'transaction_date'])
    ->orderBy(['transaction_date' => SORT_DESC])
    ->all();
// Prepare $SalesperDiv array (null pa to)
$SalesperDiv = [
    'labels' => [],
    'datasets' => [],
];

$divMapping = [
    "2" => "Standard and Testing Division",
];

foreach ($salesData as &$item) { //this renames division into actual division name
    if (isset($item['division']) && isset($divMapping[$item['division']])) {
        $item['division'] = $divMapping[$item['division']];
    }
}

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

$query = new Query();
// Fetch transaction data from the database 
$transactionData = $query->select(['division', 'transaction_date', 'COUNT(*) as transaction_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->where([
        'division' => '2'
    ])
    ->groupBy(['division', 'transaction_date'])
    ->orderBy(['transaction_date' => SORT_DESC])
    ->all();

foreach ($transactionData as &$item) { //this renames division into actual division name
    if (isset($item['division']) && isset($divMapping[$item['division']])) {
        $item['division'] = $divMapping[$item['division']];
    }
}

// Prepare $TransactionperDiv array (null pa// otw yung data HAHA)
$TransactionperDiv = [
    'labels' => [],
    'datasets' => [],
];

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


$query = new Query();
$addressData = $query->select(['c.address as address', 'COUNT(*) as customer_count']) //joined table of transaction and customer, 
    ->from('transaction bs')                                              //since both have id in their columns, aliases are used (bs and c)
    ->innerJoin('customer c', 'bs.customer_id = c.id')
    ->where(['bs.division' => ['1']])
    ->groupBy('c.address')
    ->orderBy('bs.transaction_date')
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

function debug_to_console($data) //dec 12 changed -Levi
{
    $output = $data;
    if ($data != null) {
        if (is_array($output)) {
            $output = implode(', ', $output[0]);
        }
    } else {
        $output = 0;
    };

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
debug_to_console($addressData);

//address from transaction table
$addressDatatransaction = (new \yii\db\Query())
    ->select(['customer.address', 'COUNT(*) as transaction_count'])
    ->from('transaction')
    ->join('INNER JOIN', 'customer', 'transaction.customer_id = customer.id')
    ->where(['transaction.division' => ['2']])
    // Add your additional conditions if needed
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer.address'])
    ->orderBy(['transaction_count' => SORT_DESC])
    ->all();

$provincestransaction = [
    'labels' => [],
    'datasets' => [],
];

foreach ($addressDatatransaction as $customeraddress) {
    $province = $customeraddress['address'];
    $transactioncount = $customeraddress['transaction_count'];

    // Check if the province is not already in labels
    if (!in_array($province, $provincestransaction['labels'])) {
        $provincestransaction['labels'][] = $province;
    }

    // Add the customer count directly to the datasets array
    $provincestransaction['datasets'][] = $transactioncount;
}

$addressDataincome = (new \yii\db\Query())
    ->select(['customer.address', 'SUM(amount) as total_amount'])
    ->from('transaction')
    ->join('INNER JOIN', 'customer', 'transaction.customer_id = customer.id')
    ->where(['transaction.division' => ['2']])
    // Add your additional conditions if needed
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer.address'])
    ->orderBy(['total_amount' => SORT_DESC])
    ->all();

$provincesincome = [
    'labels' => [],
    'datasets' => [],
];

foreach ($addressDataincome as $customeraddress) {
    $province = $customeraddress['address'];
    $transactioncount = $customeraddress['total_amount'];

    // Check if the province is not already in labels
    if (!in_array($province, $provincesincome['labels'])) {
        $provincesincome['labels'][] = $province;
    }

    // Add the customer count directly to the datasets array
    $provincesincome['datasets'][] = $transactioncount;
}


$query = new Query();
$customerTypeData = $query->select([
    'c.customer_type',
    'customer_count' => new \yii\db\Expression('COUNT(*)')
])
    ->from('transaction bs')
    ->innerJoin(['customer c'], 'bs.customer_id = c.id')
    ->where([
        'bs.division' => 2
    ])
    ->groupBy('c.customer_type')
    ->orderBy('bs.transaction_date')
    ->all();

$customerType_name = [
    "1" => "Student",
    "2" => "Individual",
    "3" => "Private",
    "4" => "Government",
    "5" => "Internal",
    "6" => "Academe",
    "7" => "Not Applicable",
];

$customerType = ['no customer'];
$customerscounts = [0];

foreach ($customerTypeData as $customersType) {
    if (isset($customersType['customer_type']) && isset($customerType_name[$customersType['customer_type']])) {
        $customersType['customer_type'] = $customerType_name[$customersType['customer_type']];
    }
    $customerType[] = $customersType['customer_type'];
    $customerscounts[] = $customersType['customer_count'];
}

// customer type from table transaction
$customerTypeDatatransaction = (new \yii\db\Query())
    ->select(['customer.customer_type', 'COUNT(*) as transaction_count'])
    ->from('transaction')
    ->join('INNER JOIN', 'customer', 'transaction.customer_id = customer.id')
    ->where([
        'transaction.division' => 2
    ])
    // Add your additional conditions if needed
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer.customer_type'])
    ->orderBy(['transaction_count' => SORT_DESC])
    ->all();
$customerTypetransaction = [];
$customerTypecounttransaction = [];

foreach ($customerTypeDatatransaction as $type) {
    if (isset($type['customer_type']) && isset($customerType_name[$type['customer_type']])) {
        $type['customer_type'] = $customerType_name[$type['customer_type']];
    }

    $customerTypetransaction[] = $type['customer_type'];
    $customerTypecounttransaction[] = $type['transaction_count'];
}


$customerTypeDataincome = (new \yii\db\Query())
    ->select(['customer.customer_type', 'SUM(amount) as total_amount'])
    ->from('transaction')
    ->join('INNER JOIN', 'customer', 'transaction.customer_id = customer.id')
    ->where([
        'transaction.division' => 1
    ])
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['customer.customer_type'])
    ->orderBy(['total_amount' => SORT_DESC])
    ->all();
$customerTypeincome = [];
$customerTypecountincome = [];

foreach ($customerTypeDataincome as $type) {
    if (isset($type['customer_type']) && isset($customerType_name[$type['customer_type']])) {
        $type['customer_type'] = $customerType_name[$type['customer_type']];
    }

    $customerTypeincome[] = $type['customer_type'];
    $customerTypecountincome[] = $type['total_amount'];
}

$query = new Query();
$transactionTypeData = $query->select(['transaction_type', 'COUNT(*) as customer_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->where([
        'division' => '2',
        //'transaction_status' => ['1']
    ])
    ->groupBy(['transaction_type'])
    ->orderBy(['customer_count' => SORT_DESC])
    ->all();

$transactionType = [];
$transactionTypecounts = [];

$transactionType_name = [
    "1" => "Technical Services",
    "2" => "NLIMS",
    "3" => "ULIMS",
];

foreach ($transactionTypeData as $type) {
    if (isset($type['transaction_type']) && isset($transactionType_name[$type['transaction_type']])) {
        $type['transaction_type'] = $transactionType_name[$type['transaction_type']];
    }

    $transactionType[] = $type['transaction_type'];
    $transactionTypecounts[] = $type['customer_count'];
}

$transactionTypeincomeData = $query->select(['transaction_type', 'SUM(amount) as total_amount'])
    ->from('transaction')
    ->where([
        'division' => '2',
        //'transaction_status' => ['1']
    ])
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->groupBy(['transaction_type'])
    ->orderBy(['total_amount' => SORT_DESC])
    ->limit(100000)
    ->all();
$transactionTypeincome = [];
$transactionTypesumincome = [];

foreach ($transactionTypeincomeData as $type) {
    if (isset($type['transaction_type']) && isset($transactionType_name[$type['transaction_type']])) {
        $type['transaction_type'] = $transactionType_name[$type['transaction_type']];
    }

    $transactionTypeincome[] = $type['transaction_type'];
    $transactionTypesumincome[] = $type['total_amount'];
}

//transaction used per customer type
$customerTypeDatapertransaction = (new \yii\db\Query())
    ->select([
        'ct.type as customer_type',
        'tt.type as transaction_type',
        'COUNT(*) as transaction_count',
        'SUM(t.amount) as total_amount',
        'ts.status as transaction_status',
        't.transaction_date',
        'pm.method as payment_method',
        'c.address',
        'd.division'
    ])
    ->from('transaction t')
    ->where(['t.division' => '2',])
    ->join('INNER JOIN', 'customer c', 't.customer_id = c.id')
    ->join('INNER JOIN', 'customer_type ct', 'c.customer_type = ct.id')
    ->join('INNER JOIN', 'transaction_type tt', 't.transaction_type = tt.id')
    ->join('INNER JOIN', 'transaction_status ts', 't.transaction_status = ts.id')
    ->join('INNER JOIN', 'payment_method pm', 't.payment_method = pm.id')
    ->join('INNER JOIN', 'division d', 't.division= d.id')
    ->groupBy(['ct.type', 'tt.type', 'ts.status', 't.transaction_date', 'pm.method', 'c.address', 'd.division'])
    ->orderBy(['transaction_count' => SORT_DESC])
    ->all();

$ctpt = [];
$ctct = [0];
$ctamt = [0];
$ctstatus = [''];
$cttd = [''];
$ctpm = [''];
$ctaddress = [];
$ctdivision = [];

foreach ($customerTypeDatapertransaction as $type) {
    $ctpt[] = $type['customer_type'];
    $ctct[] = $type['transaction_count'];
    $ctamt[] = $type['total_amount'];
    $ctstatus[] = $type['transaction_status'];
    $cttd[] = $type['transaction_date'];
    $ctpm[] = $type['payment_method'];
    $ctaddress[] = $type['address'];
    $ctdivision[] = $type['division'];
}


$TransactionYear = (new \yii\db\Query())
    ->select(['YEAR(t.transaction_date) as year'])
    ->distinct()
    ->from('transaction t')
    ->where(['t.division' => '2',])
    ->orderBy(['year' => SORT_ASC])
    ->all();

$distinctYears = array_column($TransactionYear, 'year');

$TransactionYear = (new \yii\db\Query())
    ->select(['YEAR(t.transaction_date) as year'])
    ->distinct()
    ->from('transaction t')
    ->orderBy(['year' => SORT_ASC])
    ->all();

$distinctYears = array_column($TransactionYear, 'year');

$query = new Query();
$transactionStatusData = $query->select(['transaction_status', 'COUNT(*) as customer_count'])
    ->from('transaction')
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->where([
        'division' => '2',
    ])
    ->groupBy(['transaction_status'])
    ->orderBy(['customer_count' => SORT_DESC])
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

$query = new Query();
$PaymentMethodData = $query->select(['payment_method', 'COUNT(*) as customer_count'])
    ->from('transaction')
    ->where(['payment_method' => ['1', '2', '3']])
    // ->where(['between', 'transaction_date', $fromDate, $toDate])
    ->where([
        'division' => '2',
        'transaction_status' => '1'
    ])
    ->groupBy(['payment_method'])
    ->orderBy(['customer_count' => SORT_DESC])
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

$transactionPerday = (new Query())
    ->select('transaction_date, COUNT(*) as transaction_count')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_status' => '1'
    ])
    ->groupBy('transaction_date');

$transactionPerday = $transactionPerday->all(); // Get the results with daily transaction counts
$totalDays = count($transactionPerday); // Total number of days
$totalTransactions = 0;

foreach ($transactionPerday as $result) {
    $totalTransactions += $result['transaction_count'];
}
if ($totalDays != 0) {
    $average = round($totalTransactions / $totalDays); // Calculate the average
}
$SalesAve = (new Query())
    ->select('transaction_date, SUM(amount) as transaction_count')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_status' => '1'
    ])
    ->groupBy('transaction_date');

$SalesAve = $SalesAve->all(); // Get the results with daily transaction counts
$totalDays = count($SalesAve); // Total number of days
$totalTransactions = 0;

foreach ($SalesAve as $result) {
    $totalTransactions += $result['transaction_count'];
}
if ($totalDays != 0) {
    $saleaverage = round($totalTransactions / $totalDays); // Calculate the average
} else {
    $saleaverage = 0;
}
if ($saleaverage >= 1000 && $saleaverage <= 999999) {
    $saleaverage = round(($saleaverage / 1000), 2) . 'K';
} else if ($saleaverage >= 1000000 && $saleaverage <= 999999999) {
    $saleaverage = round(($saleaverage / 1000000), 2) . 'M';
} else if ($saleaverage >= 1000000000) {
    $saleaverage = round(($saleaverage / 1000000000), 2) . 'B';
}

//setting default colors for each department
$divisionColors = [
    'Standard and Testing Division' => [
        'backgroundColor' => '#7209b7',
        'borderWidth' => 2,
    ],
];

//dito yung pag lalagay nung naka set na color
foreach ($SalesperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['#ff9a34']) ? $divisionColors[$divisionName]['backgroundColor'] : '#ff9a34'; // Default background color if division not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#ff9a34'; // Default border color if division not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}

foreach ($TransactionperDiv['datasets'] as &$dataset) {
    $divisionName = $dataset['label'];
    $dataset['backgroundColor'] = isset($divisionColors[$divisionName]['#3499ff']) ? $divisionColors[$divisionName]['backgroundColor'] : '#3499ff'; // Default background color if division not found
    $dataset['borderColor'] = isset($divisionColors[$divisionName]['borderColor']) ? $divisionColors[$divisionName]['borderColor'] : '#0362BA'; // Default border color if division not found
    // $dataset['borderWidth'] = isset($divisionColors[$divisionName]['borderWidth']) ? $divisionColors[$divisionName]['borderWidth'] : '#0362BA';
}


//Dito yung para sa Total ng Daily Transaction (tinatype ko pa yung date kasi di ako marunong nung rekta connected sa calendar HAHAHAH)
date_default_timezone_set('Asia/Manila');

//Total Transaction everyday changes depending on date
$todaymettrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d') // Assuming you want the number of transactions for today
    ])
    ->scalar();

$lastmettrans = (new Query())
    ->select('COUNT(*)')
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d', strtotime('-1 day'))
    ])
    ->scalar();

if ($todaymettrans == 0) {
    $metdailytransincrease = 0;
} else {
    //dito magcocompute ng percentage ng increase or decrease ng number of past transaction at today's transaction (tinatype ko pa din yung sa last transaction kunwari kasi di pa ko marunong)
    $metdailytransincrease = (($todaymettrans - $lastmettrans) / $todaymettrans) * 100;
    $metdailytransincrease = number_format($metdailytransincrease);
}



//Here should be the sum of total sales everyday
$SalesToday = (new Query())
    ->select(['SUM(amount)'])
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d') // Using the current date in 'Y-m-d' format
    ])
    ->scalar();

$SalesYesterday = (new Query())
    ->select(['SUM(amount)'])
    ->from('transaction')
    ->where([
        'division' => '2',
        'transaction_date' => date('Y-m-d', strtotime('-1 day'))
    ])
    ->scalar();

if ($SalesToday == 0) {
    $SalesToday = 0;
    $SalesIncreasePercent = 0;
} else {

    $SalesIncreasePercent = (($SalesToday - $SalesYesterday) / $SalesToday) * 100;
    $SalesIncreasePercent = number_format($SalesIncreasePercent);
    if ($SalesToday >= 1000 && $SalesToday <= 999999) {
        $SalesToday = round(($SalesToday / 1000), 2) . 'K';
    } else if ($SalesToday >= 1000000 && $SalesToday <= 999999999) {
        $SalesToday = round(($SalesToday / 1000000), 2) . 'M';
    } else if ($SalesToday >= 1000000000) {
        $SalesToday =  round(($SalesToday / 1000000000), 2) . 'B';
    }
}


//Here is the average transaction daily
$transactionPerday = (new Query())
    ->select('transaction_date, COUNT(*) as transaction_count')
    ->from('transaction')
    ->where([
        'division' => '2',
    ])
    ->groupBy('transaction_date');

$transactionPerday = $transactionPerday->all(); // Get the results with daily transaction counts
$totalDays = count($transactionPerday); // Total number of days
$totalTransactions = 0;

foreach ($transactionPerday as $result) {
    $totalTransactions += $result['transaction_count'];
}

try {
    $average = round($totalTransactions / $totalDays); // Calculate the average
} catch (DivisionByZeroError $e) {
    $average = 0;
}

Yii::$app->set('db', [ //revert default connection 
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=visualight2user',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);

$currentDate = new \DateTime();

$targetTransactiondata = Yii::$app->db->createCommand('
    SELECT quarter_1, quarter_2, quarter_3, quarter_4
    FROM stdtarget_transaction
    WHERE date = :year
', [':year' => $currentDate->format('Y')])->queryOne();

$targetTransaction = [
    (float)($targetTransactiondata['quarter_1'] ?? 0),
    (float)($targetTransactiondata['quarter_2'] ?? 0),
    (float)($targetTransactiondata['quarter_3'] ?? 0),
    (float)($targetTransactiondata['quarter_4'] ?? 0),
];

$targetIncomedata = Yii::$app->db->createCommand('
    SELECT quarter_1, quarter_2, quarter_3, quarter_4
    FROM stdtarget_income
    WHERE date = :year
', [':year' => $currentDate->format('Y')])->queryOne();

$targetIncome =
    [
        (float)($targetIncomedata['quarter_1'] ?? 0),
        (float)($targetIncomedata['quarter_2'] ?? 0),
        (float)($targetIncomedata['quarter_3'] ?? 0),
        (float)($targetIncomedata['quarter_4'] ?? 0),
    ];


?>

<div class="DailyTransaction">
    <br>

    <div class="deptransaction">
        <p>Total Transactions Daily</p>
        <div class="grid">
            <img src="/images/Total Sales.png" alt="icon1">
            <p id="dailyTrans"><?= $todaymettrans ?></p>
            <p id="valueIncrease">
                <?php
                if ($metdailytransincrease > 1) {
                    echo "+";
                } elseif ($metdailytransincrease < 1) {
                    echo "-";
                }
                echo $metdailytransincrease, "%";
                ?>
            </p>
        </div>
    </div>
    <div class="deptransaction">
        <p>Total Income Daily</p>
        <div class="grid">
            <img src="/images/Sales Performance.png" alt="icon2">
            <p id="dailyIncome"><?= $SalesToday ?></p>
            <p id="valueIncrease">
                <?php
                if ($SalesIncreasePercent > 1) {
                    echo "+";
                } elseif ($SalesIncreasePercent < 1) {
                    echo "-";
                }
                echo $SalesIncreasePercent, "%";
                ?>
            </p>
        </div>
    </div>
    <div class="deptransaction">
        <p>Average Transaction Daily</p>
        <div class="grid">
            <img src="/images/Calculator.png" alt="icon3">
            <p id="avgTrans"><?= $average ?></p>
        </div>
    </div>

</div>


<div id="sending-email-message" class="alert alert-info hidden" style="display:none;">
    PDF file is downloading, please wait...
</div>

<button id="toggleButton">—</button>

<!-- Date Filter Div -->
<div class="date_filter" id="prediction-form">

    <div class="containers">
        <div class="dropdown_pdf_container">
            <div class="date_dropdown">
                <form>
                    <label for="date_type" class="date_type_label">
                        <strong>Date Filter:</strong></label>
                    <select name="date_type" id="date_type" class="dropdown-content" onchange="dateChange()">
                        <option value="Days">Days</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
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
            <input type="date" id="startDate" name="startDate" class="datePicker_label" onchange="dateFilter(); updateChartContent()">
            <!-- </div>
    <div class="datePicker"> -->
            <label>&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
            <input type="date" id="endDate" name="endDate" class="datePicker_label" onchange="dateFilter(); updateChartContent()">
        </div>
        <!-- <input type="submit" value="Filter"> -->
        <!-- </form> -->
    </div>
</div>

<div class="date_filter" id="prediction-form">
    <div class="containers">
        <div class="dropdown_pdf_container">
            <div class="date_dropdown">
            <div class="navigation">
                    <label for="navigationDropdown">Navigate to:</label>
                    <select id="navigationDropdown" onchange="navigateToSection()">
                        <option value="transactionChart">Total Transaction</option>
                        <option value="salesChart">Total Income</option>
                        <option value="Provinces">Customers per Province</option>
                        <option value="customertransaction">Transactions</option>
                    </select>

                    <script>
                        function navigateToSection() {
                            var dropdown = document.getElementById("navigationDropdown");
                            var selectedOption = dropdown.options[dropdown.selectedIndex].value;

                            // Scroll to the selected section
                            var selectedSection = document.getElementById(selectedOption);
                            selectedSection.scrollIntoView({
                                behavior: "smooth"
                            });
                        }
                    </script>

                    <button onclick="openTargetPopup()" class="target">Set Targets</button>
                </div>
            </div>            
        </div>
    </div>
</div>
</div>
<div class="popup" id="targetPopup">
        <span class="close" onclick="closeTargetPopup()">&times;</span> 
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">

            <span style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 20px; color: #888;" onclick="closeTargetPopup()">&times;</span>

            <h2 style="color: #007bff; margin-bottom: 20px;">Set Targets</h2>
            <div>
            <label for="InputYear">Input Year:</label>
                    <input type="text" id="InputYear" name="InputYear" required> <br><br>
            </div> 
            <form class="form">
    
    <div class="column">
        <h5>Target Transactin <br> <br></h5>
        <label for="q1Income">Quarter 1:</label><br>
        <label for="q2Income">Quarter 2:</label><br>
        <label for="q1Income">Quarter 3:</label><br>
        <label for="q2Income">Quarter 4: </label><br>
    </div>
    <div class="column">
    <br><br><br>
    <input type="text" id="q1transaction" name="q1Income" required><br>
    <input type="text" id="q2transaction" name="q2Income" required><br>
    <input type="text" id="q3transaction" name="q1Income" required><br>
    <input type="text" id="q4transaction" name="q2Income" required> <br><br>
                    </div>
    <div class="column">
        <h5>Target Income <br> <br></h5>
        <label for="q1Income">Quarter 1:</label><br>
        <label for="q2Income">Quarter 2:</label><br>
        <label for="q1Income">Quarter 3:</label><br>
        <label for="q2Income">Quarter 4:</label><br>
    </div>
    <div class="column">
    <br><br><br>
    <input type="text" id="q1Income" name="q1Income" required><br>
    <input type="text" id="q2Income" name="q2Income" required><br>
    <input type="text" id="q3Income" name="q1Income" required><br>
    <input type="text" id="q4Income" name="q2Income" required><br>

    </div>

    <button type="button" onclick="submitTargets()">Submit</button>
</form>
        </div>
        <script>
        var targetPopup = document.getElementById('targetPopup');

        function openTargetPopup() {
            targetPopup.style.display = 'block';
        }

        function closeTargetPopup() {
            targetPopup.style.display = 'none';
        }

        function submitTargets() {
            // Get values from the form
            var InputYear = document.getElementById('InputYear').value;

            var q1Income = document.getElementById('q1Income').value;
            var q2Income = document.getElementById('q2Income').value;
            var q3Income = document.getElementById('q3Income').value;
            var q4Income = document.getElementById('q4Income').value;

            var q1Transactions = document.getElementById('q1Transactions').value;
            var q2Transactions = document.getElementById('q2Transactions').value;
            var q3Transactions = document.getElementById('q3Transactions').value;
            var q4Transactions = document.getElementById('q4Transactions').value;

           
            closeTargetPopup();
        }
        </script>
    </div></div>

<script>
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        var form = document.getElementById("prediction-form");
        var toggleButton = document.getElementById("toggleButton");
        var message = document.getElementById("sending-email-message");


        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            message.style.position = "fixed";
            message.style.zIndex = "1000";
            message.style.top = "7rem"; 
            message.style.width = "70%";
            message.style.maxHeight = "7rem"; // Set a maximum height
            message.style.marginBottom = "-50%";
            
            form.style.position = "fixed";
            form.style.top = "1rem"; 
            form.style.width = "68%";
            form.style.height = "5rem"; 
            form.style.maxHeight = "7rem"; // Set a maximum height
            form.style.marginBottom = "-50%";
            form.style.zIndex = "1000";
            form.style.background = "white";
            form.style.boxShadow = "-0.3rem 0.3rem 0.5rem rgba(0, 0, 0, 0.3), 0 0.1rem 0.5rem 0 rgba(0, 0, 0, 0.15)";
            form.style.left = "20%";

            toggleButton.style.display = "block";
            toggleButton.style.position = "fixed";
            toggleButton.style.top = "1rem"; 
            toggleButton.style.right = "10rem"; // Adjust this???
            toggleButton.style.zIndex = "1500";

            if (toggleButton.innerHTML == "+") {
                toggleButton.innerHTML = "+";
            }

        } else {
            message.style.position = "static";
            message.style.top = "0rem"; 
            message.style.width = "100%";
            message.style.height = "auto"; 
            message.style.marginBottom = "0"; 

            form.style.position = "static";
            form.style.top = "0rem"; 
            form.style.width = "100%";
            form.style.height = "auto"; 
            form.style.marginBottom = "0"; 
            form.style.background = "none";
            form.style.boxShadow = "none";
            toggleButton.style.display = "none";

            if (toggleButton.innerHTML == "+") {
                toggleButton.innerHTML = "+";
            }

        }
    }
    var form = document.getElementById("prediction-form");
    var toggleButton = document.getElementById("toggleButton");

    toggleButton.addEventListener("click", function() {
        form.style.display = (form.style.display === "none") ? "block" : "none";
        toggleButton.innerHTML = (form.style.display === "none") ? "+" : "—";

    });
</script>

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
        <p class="reportTitle" id="transaction">Total Transaction Report</p>
        <!-- <div class="containerBody"> -->
        <canvas id="transactionChart"></canvas>
        <!-- </div> -->
    </div>


    <div class="chart-container">
        <p class="reportTitle" id="sales"> Total Income Report</p>
        <canvas id="salesChart"></canvas>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" id="close-popup">&times;</span>

            <h2 id="PopupHeader"></h2>

            <div class="speedometer">
                <p><span style="color: #C70039 ">Low </span>
                    <span style="color: #FF5733 ">Moderate </span>
                    <span style="color: #FFC300 ">High </span>
                    <span style="color: #6ABF70">Satisfaction </span>
                </p>
                <div class="speedometer-dial">
                    <div class="speedometer-reading" id="speedometer-reading"></div>
                    <div class="speedometer-arrow" id="speedometer-arrow"></div>
                </div>
            </div>
            <p id="percentTransaction" style="position: absolute; bottom: 90px; width: 100%; right: 290px;"></p>

            <p id="targetTransaction"></p>


            <div style="text-align: right; margin: 0 auto; width: 80%;">
                <ul style="padding-left: 500px;">
                    <li>
                        <p id="highest"></p>
                    </li>
                    <li>
                        <p id="least"></p>
                    </li>
                    <li>
                        <p id="mostTransactionType"></p>
                    </li>
                    <li>
                        <p id="leastTransactionType"></p>
                    </li>
                    <li>
                        <p id="mostCustomerType"></p>
                    </li>
                    <li>
                        <p id="leastCustomerType"></p>
                    </li>
                    <li>
                        <p id="mostCustomerProvince"></p>
                    </li>
                    <li>
                        <p id="leastCustomerProvince"></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Reference datas
        const transaction = <?php echo json_encode($TransactionperDiv); ?>;
        const income = <?php echo json_encode($SalesperDiv); ?>;
        const targetValues = <?php echo json_encode($targetTransaction); ?>;
        const targetincomeValues = <?php echo json_encode($targetIncome); ?>;
        const province = <?php echo json_encode($provincestransaction); ?>;
        const provinceincome = <?php echo json_encode($provincesincome); ?>;

        const currentDate = new Date();
        const currentMonth = currentDate.getMonth();
        const currentYear = currentDate.getFullYear();


        const totaltransactionChart = document.getElementById("transaction");
        const totalsalesChart = document.getElementById("sales");
        const popup = document.getElementById("popup");
        const closePopup = document.getElementById("close-popup");
        const targetTransaction = document.getElementById("targetTransaction");
        const percentTransaction = document.getElementById("percentTransaction");
        const PopupHeader = document.getElementById("PopupHeader");
        const speedometerReading = document.getElementById("speedometer-reading");
        const speedometerArrow = document.getElementById("speedometer-arrow");
        const highest = document.getElementById("highest");
        const least = document.getElementById("least");
        const mostTransactionType = document.getElementById("mostTransactionType");
        const leastTransactionType = document.getElementById("leastTransactionType");
        const mostCustomerType = document.getElementById("mostCustomerType");
        const leastCustomerType = document.getElementById("leastCustomerType");
        const mostCustomerProvince = document.getElementById("mostCustomerProvince");
        const leastCustomerProvince = document.getElementById("leastCustomerProvince");

        const startDateElements = document.getElementById("startDate");
        const endDateElements = document.getElementById("endDate");

        startDateElements.valueAsDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        endDateElements.valueAsDate = currentDate;

        // Initialize data from PHP
        let technicalServicesData = <?php echo json_encode($customerTypeDatapertransaction); ?>;
        let DatacustomerType = [];

        function getMonthDateRange(year, month) {
            const startDate = new Date(year, month - 1, 1);
            const endDate = new Date(year, month, 0);
            return {
                startDate,
                endDate
            };
        }

        function updateData() {
            let startDate, endDate;
            const startInput = startDateElements.value.split('-');
            const endInput = endDateElements.value.split('-');

            // Start date
            if (startInput.length === 2) { // Format is 'mm-yyyy'
                const [startYear, startMonth] = startInput.map(Number);
                startDate = new Date(startYear, startMonth - 1, 1); // First day of the start month
            } else if (startInput.length === 1) { // Format is 'yyyy'
                startDate = new Date(startInput[0], 0, 1); // January 1st of the year
            } else {
                startDate = new Date(startDateElements.value); // Full date format
            }

            // End date
            if (endInput.length === 2) { // Format is 'mm-yyyy'
                const [endYear, endMonth] = endInput.map(Number);
                endDate = new Date(endYear, endMonth, 0); // Last day of the end month
            } else if (endInput.length === 1) { // Format is 'yyyy'
                endDate = new Date(endInput[0], 11, 31); // December 31st of the year
            } else {
                endDate = new Date(endDateElements.value); // Full date format
            }

            // Filter technicalServicesData based on the date range
            DatacustomerType = technicalServicesData.filter(item =>
                new Date(item.transaction_date) >= startDate &&
                new Date(item.transaction_date) <= endDate
            );

            processFilteredData();
            processFilteredDataAmount();
        }

        function processFilteredData() {
            const customerData = {};

            const filteredData = DatacustomerType.filter(
                item => item.transaction_status === 'Paid' || item.transaction_status === 'Pending'
            );

            filteredData.forEach(item => {
                const transactionDate = item.transaction_date;
                const transactionType = item.transaction_type;
                const customerType = item.customer_type;
                const address = item.address;
                const transactionCount = Number(item.transaction_count);
                const totalAmount = Number(item.total_amount);

                if (!customerData[transactionDate]) {
                    customerData[transactionDate] = {};
                }

                if (!customerData[transactionDate][transactionType]) {
                    customerData[transactionDate][transactionType] = {};
                }

                if (!customerData[transactionDate][transactionType][customerType]) {
                    customerData[transactionDate][transactionType][customerType] = {};
                }

                if (!customerData[transactionDate][transactionType][customerType][address]) {
                    customerData[transactionDate][transactionType][customerType][address] = {
                        transaction_count: 0,
                        total_amount: 0,
                    };
                }

                customerData[transactionDate][transactionType][customerType][address].transaction_count += transactionCount;
                customerData[transactionDate][transactionType][customerType][address].total_amount += totalAmount;
            });

            const processedData = {};

            for (const transactionDate in customerData) {
                if (!processedData[transactionDate]) {
                    processedData[transactionDate] = {};
                }

                const transactionTypes = customerData[transactionDate];
                for (const transactionType in transactionTypes) {
                    if (!processedData[transactionDate][transactionType]) {
                        processedData[transactionDate][transactionType] = {};
                    }

                    const customerTypes = transactionTypes[transactionType];
                    for (const customerType in customerTypes) {
                        if (!processedData[transactionDate][transactionType][customerType]) {
                            processedData[transactionDate][transactionType][customerType] = {};
                        }

                        const addresses = customerTypes[customerType];
                        for (const address in addresses) {
                            processedData[transactionDate][transactionType][customerType][address] = {
                                transaction_count: addresses[address].transaction_count,
                                total_amount: addresses[address].total_amount
                            };
                        }
                    }
                }
            }

            console.log(JSON.stringify(processedData, null, 2));
            if (!processedData || processedData.length === 0) {
                processedData.push({
                    transaction_date: ' ',
                    transaction_type: ' ',
                    customer_type: ' ',
                    province: ' ',
                    transaction_count: 0,
                    total_amount: 0,
                });
            }

            let maxTransactionCount = 0;
            let minTransactionCount = Infinity;
            let datesWithMaxTransaction = [];
            let datesWithMinTransaction = [];

            function findDatesWithExtremeTransactions(customerData) {
                Object.keys(customerData).forEach(date => {
                    let totalCountForDate = 0;

                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                totalCountForDate += customerData[date][type][customerType][address].transaction_count;
                            });
                        });
                    });

                    // Check for max transactions
                    if (totalCountForDate > maxTransactionCount) {
                        maxTransactionCount = totalCountForDate;
                        datesWithMaxTransaction = [date];
                    } else if (totalCountForDate === maxTransactionCount) {
                        datesWithMaxTransaction.push(date);
                    }

                    // Check for min transactions
                    if (totalCountForDate < minTransactionCount && totalCountForDate > 0) { // Assuming you don't want to consider days with zero transactions
                        minTransactionCount = totalCountForDate;
                        datesWithMinTransaction = [date];
                    } else if (totalCountForDate === minTransactionCount) {
                        datesWithMinTransaction.push(date);
                    }
                });
            }

            findDatesWithExtremeTransactions(customerData);

            //Transaction Type
            let maxTransactionCountByType = 0;
            let minTransactionCountByType = Infinity;
            let maxtransactionType = [];
            let minTransactionType = [];

            function findTransactionTypesWithExtremeTransactions(customerData) {
                let transactionCountByType = {};

                // Calculate total transactions for each transaction type
                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        transactionCountByType[type] = (transactionCountByType[type] || 0);

                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                transactionCountByType[type] += customerData[date][type][customerType][address].transaction_count;
                            });
                        });
                    });
                });

                Object.keys(transactionCountByType).forEach(type => {
                    const count = transactionCountByType[type];

                    // Max transactions
                    if (count > maxTransactionCountByType) {
                        maxTransactionCountByType = count;
                        maxtransactionType = [type];
                    } else if (count === maxTransactionCountByType) {
                        maxtransactionType.push(type);
                    }

                    // Min transactions 
                    if (count < minTransactionCountByType && count > 0) {
                        minTransactionCountByType = count;
                        minTransactionType = [type];
                    } else if (count === minTransactionCountByType) {
                        minTransactionType.push(type);
                    }
                });
            }

            findTransactionTypesWithExtremeTransactions(customerData);

            //customer type
            let maxTransactionCountByCustomerType = 0;
            let minTransactionCountByCustomerType = Infinity;
            let maxCustomerTypes = [];
            let minCustomerType = [];

            function findCustomerTypesWithExtremeTransactions(customerData) {
                let transactionCountByCustomerType = {};

                // Calculate total transactions for each customer type
                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            transactionCountByCustomerType[customerType] = (transactionCountByCustomerType[customerType] || 0);

                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                transactionCountByCustomerType[customerType] += customerData[date][type][customerType][address].transaction_count;
                            });
                        });
                    });
                });

                Object.keys(transactionCountByCustomerType).forEach(customerType => {
                    const count = transactionCountByCustomerType[customerType];

                    // Max transactions
                    if (count > maxTransactionCountByCustomerType) {
                        maxTransactionCountByCustomerType = count;
                        maxCustomerTypes = [customerType];
                    } else if (count === maxTransactionCountByCustomerType) {
                        maxCustomerTypes.push(customerType);
                    }

                    // Min transactions 
                    if (count < minTransactionCountByCustomerType && count > 0) {
                        minTransactionCountByCustomerType = count;
                        minCustomerType = [customerType];
                    } else if (count === minTransactionCountByCustomerType) {
                        minCustomerType.push(customerType);
                    }
                });
            }
            findCustomerTypesWithExtremeTransactions(customerData);

            let maxTransactionCountByProvince = 0;
            let minTransactionCountByProvince = Infinity;
            let highestprovinces = [];
            let leastprovinces = [];

            function findProvincesWithExtremeTransactions(customerData) {
                let transactionCountByProvince = {};

                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(province => {
                                transactionCountByProvince[province] = (transactionCountByProvince[province] || 0);
                                transactionCountByProvince[province] += customerData[date][type][customerType][province].transaction_count;
                            });
                        });
                    });
                });

                Object.keys(transactionCountByProvince).forEach(province => {
                    const count = transactionCountByProvince[province];

                    // Max transactions
                    if (count > maxTransactionCountByProvince) {
                        maxTransactionCountByProvince = count;
                        highestprovinces = [province];
                    } else if (count === maxTransactionCountByProvince) {
                        highestprovinces.push(province);
                    }

                    // Min transactions
                    if (count < minTransactionCountByProvince && count > 0) {
                        minTransactionCountByProvince = count;
                        leastprovinces = [province];
                    } else if (count === minTransactionCountByProvince) {
                        leastprovinces.push(province);
                    }
                });
            }
            findProvincesWithExtremeTransactions(customerData);

            //analyzation that should depends in the date filter or chart
            highest.innerHTML = "Highest transaction: <span style='color: red;'>" + datesWithMaxTransaction.join(', ') + "</span> with <span style='color: blue;'> " + maxTransactionCount + "</span> transaction/s.";
            least.innerHTML = "Least transaction: <span style='color: red;'>" + datesWithMinTransaction.join(', ') + "</span> with <span style='color: blue;'> " + minTransactionCount + "</span> transaction/s.";
            mostTransactionType.innerHTML = "Highest transaction type:  <span style='color:green;'>" + maxtransactionType.join(', ') + "</span> having  <span style='color: blue;'> " + maxTransactionCountByType + "</span> transaction/s.";
            leastTransactionType.innerHTML = "Least transaction type:   <span style='color:green;'>" + minTransactionType.join(', ') + "</span> having  <span style='color: blue;'> " + minTransactionCountByType + "</span> transaction/s.";
            mostCustomerType.innerHTML = "Highest customer type(s): <span style='color:green;'>" + maxCustomerTypes.join(', ') + "</span> having <span style='color: blue;'> " + maxTransactionCountByCustomerType + "</span> transaction/s.";
            leastCustomerType.innerHTML = "Least customer type: <span style='color:green;'>" + minCustomerType.join(', ') + "</span> having <span style='color: blue;'> " + minTransactionCountByCustomerType + "</span> transaction/s.";
            mostCustomerProvince.innerHTML = "Provinces with the highest transactions: <span style='color:green;'>" + highestprovinces.join(', ') + "</span> having <span style='color: blue;'> " + maxTransactionCountByProvince + "</span> transaction/s.";
            leastCustomerProvince.innerHTML = "Provinces with the least transactions: <span style='color:green;'>" + leastprovinces.join(', ') + "</span> having <span style='color: blue;'> " + minTransactionCountByProvince + "</span> transaction/s.";


        }

        function processFilteredDataAmount() {
            const customerData = {};

            const filteredData = DatacustomerType.filter(
                item => item.transaction_status === 'Paid' || item.transaction_status === 'Pending'
            );

            filteredData.forEach(item => {
                const transactionDate = item.transaction_date;
                const transactionType = item.transaction_type;
                const customerType = item.customer_type;
                const address = item.address;
                const transactionCount = Number(item.transaction_count);
                const totalAmount = Number(item.total_amount);

                if (!customerData[transactionDate]) {
                    customerData[transactionDate] = {};
                }

                if (!customerData[transactionDate][transactionType]) {
                    customerData[transactionDate][transactionType] = {};
                }

                if (!customerData[transactionDate][transactionType][customerType]) {
                    customerData[transactionDate][transactionType][customerType] = {};
                }

                if (!customerData[transactionDate][transactionType][customerType][address]) {
                    customerData[transactionDate][transactionType][customerType][address] = {
                        transaction_count: 0,
                        total_amount: 0,
                    };
                }

                customerData[transactionDate][transactionType][customerType][address].transaction_count += transactionCount;
                customerData[transactionDate][transactionType][customerType][address].total_amount += totalAmount;
            });

            const processedData = {};

            for (const transactionDate in customerData) {
                if (!processedData[transactionDate]) {
                    processedData[transactionDate] = {};
                }

                const transactionTypes = customerData[transactionDate];
                for (const transactionType in transactionTypes) {
                    if (!processedData[transactionDate][transactionType]) {
                        processedData[transactionDate][transactionType] = {};
                    }

                    const customerTypes = transactionTypes[transactionType];
                    for (const customerType in customerTypes) {
                        if (!processedData[transactionDate][transactionType][customerType]) {
                            processedData[transactionDate][transactionType][customerType] = {};
                        }

                        const addresses = customerTypes[customerType];
                        for (const address in addresses) {
                            processedData[transactionDate][transactionType][customerType][address] = {
                                transaction_count: addresses[address].transaction_count,
                                total_amount: addresses[address].total_amount
                            };
                        }
                    }
                }
            }

            console.log(JSON.stringify(processedData, null, 2));
            if (!processedData || processedData.length === 0) {
                processedData.push({
                    transaction_date: ' ',
                    transaction_type: ' ',
                    customer_type: ' ',
                    province: ' ',
                    transaction_count: 0,
                    total_amount: 0,
                });
            }

            //highest date
            let maxTransactionAmount = 0;
            let minTransactionAmount = Infinity;
            let datesWithMaxTransactionAmount = [];
            let datesWithMinTransactionAmount = [];

            function findDatesWithExtremeTransactionAmounts(customerData) {
                Object.keys(customerData).forEach(date => {
                    let totalAmountForDate = 0;

                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                totalAmountForDate += customerData[date][type][customerType][address].total_amount;
                            });
                        });
                    });

                    // Check for max transaction amount
                    if (totalAmountForDate > maxTransactionAmount) {
                        maxTransactionAmount = totalAmountForDate;
                        datesWithMaxTransactionAmount = [date];
                    } else if (totalAmountForDate === maxTransactionAmount) {
                        datesWithMaxTransactionAmount.push(date);
                    }

                    // Check for min transaction amount
                    if (totalAmountForDate < minTransactionAmount && totalAmountForDate > 0) {
                        minTransactionAmount = totalAmountForDate;
                        datesWithMinTransactionAmount = [date];
                    } else if (totalAmountForDate === minTransactionAmount) {
                        datesWithMinTransactionAmount.push(date);
                    }
                });
            }

            findDatesWithExtremeTransactionAmounts(customerData);

            //transaction type income
            let maxTransactionAmountByType = 0;
            let minTransactionAmountByType = Infinity;
            let maxTransactionTypeByAmount = [];
            let minTransactionTypeByAmount = [];

            function findTransactionTypesWithExtremeTransactionAmounts(customerData) {
                let transactionAmountByType = {};

                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        transactionAmountByType[type] = (transactionAmountByType[type] || 0);

                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                transactionAmountByType[type] += customerData[date][type][customerType][address].total_amount;
                            });
                        });
                    });
                });

                Object.keys(transactionAmountByType).forEach(type => {
                    const amount = transactionAmountByType[type];

                    // Max transaction amount
                    if (amount > maxTransactionAmountByType) {
                        maxTransactionAmountByType = amount;
                        maxTransactionTypeByAmount = [type];
                    } else if (amount === maxTransactionAmountByType) {
                        maxTransactionTypeByAmount.push(type);
                    }

                    // Min transaction amount
                    if (amount < minTransactionAmountByType && amount > 0) {
                        minTransactionAmountByType = amount;
                        minTransactionTypeByAmount = [type];
                    } else if (amount === minTransactionAmountByType) {
                        minTransactionTypeByAmount.push(type);
                    }
                });
            }
            findTransactionTypesWithExtremeTransactionAmounts(customerData);

            //customer type income 
            let maxTransactionAmountByCustomerType = 0;
            let minTransactionAmountByCustomerType = Infinity;
            let maxCustomerTypeByAmount = [];
            let minCustomerTypeByAmount = [];

            function findCustomerTypesWithExtremeTransactionAmounts(customerData) {
                let transactionAmountByCustomerType = {};

                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            transactionAmountByCustomerType[customerType] = (transactionAmountByCustomerType[customerType] || 0);

                            Object.keys(customerData[date][type][customerType]).forEach(address => {
                                transactionAmountByCustomerType[customerType] += customerData[date][type][customerType][address].total_amount;
                            });
                        });
                    });
                });

                Object.keys(transactionAmountByCustomerType).forEach(customerType => {
                    const amount = transactionAmountByCustomerType[customerType];

                    // Max transaction amount
                    if (amount > maxTransactionAmountByCustomerType) {
                        maxTransactionAmountByCustomerType = amount;
                        maxCustomerTypeByAmount = [customerType];
                    } else if (amount === maxTransactionAmountByCustomerType) {
                        maxCustomerTypeByAmount.push(customerType);
                    }

                    // Min transaction amount
                    if (amount < minTransactionAmountByCustomerType && amount > 0) {
                        minTransactionAmountByCustomerType = amount;
                        minCustomerTypeByAmount = [customerType];
                    } else if (amount === minTransactionAmountByCustomerType) {
                        minCustomerTypeByAmount.push(customerType);
                    }
                });
            }
            findCustomerTypesWithExtremeTransactionAmounts(customerData);

            //province income
            let maxTransactionAmountByProvince = 0;
            let minTransactionAmountByProvince = Infinity;
            let highestProvincesByAmount = [];
            let leastProvincesByAmount = [];

            function findProvincesWithExtremeTransactionAmounts(customerData) {
                let transactionAmountByProvince = {};

                // Calculate total transaction amounts for each province
                Object.keys(customerData).forEach(date => {
                    Object.keys(customerData[date]).forEach(type => {
                        Object.keys(customerData[date][type]).forEach(customerType => {
                            Object.keys(customerData[date][type][customerType]).forEach(province => {
                                transactionAmountByProvince[province] = (transactionAmountByProvince[province] || 0);
                                transactionAmountByProvince[province] += customerData[date][type][customerType][province].total_amount;
                            });
                        });
                    });
                });

                // Find the max and min transaction amounts for provinces
                Object.keys(transactionAmountByProvince).forEach(province => {
                    const amount = transactionAmountByProvince[province];

                    // Max transaction amount
                    if (amount > maxTransactionAmountByProvince) {
                        maxTransactionAmountByProvince = amount;
                        highestProvincesByAmount = [province];
                    } else if (amount === maxTransactionAmountByProvince) {
                        highestProvincesByAmount.push(province);
                    }

                    // Min transaction amount (ignoring provinces with zero transactions)
                    if (amount < minTransactionAmountByProvince && amount > 0) {
                        minTransactionAmountByProvince = amount;
                        leastProvincesByAmount = [province];
                    } else if (amount === minTransactionAmountByProvince) {
                        leastProvincesByAmount.push(province);
                    }
                });
            }
            findProvincesWithExtremeTransactionAmounts(customerData);


            //analyzation that should depends in the date filter or chart
            highest.innerHTML = "Highest income: <span style='color: red;'>" + datesWithMaxTransactionAmount.join(', ') + "</span> with <span style='color: blue;'> " + Number(maxTransactionAmount).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            least.innerHTML = "Least income: <span style='color: red;'>" + datesWithMinTransactionAmount.join(', ') + "</span> with <span style='color: blue;'> " + Number(minTransactionAmount).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            mostTransactionType.innerHTML = "Highest transaction type:  <span style='color:green;'>" + maxTransactionTypeByAmount.join(', ') + "</span> having  <span style='color: blue;'> " + Number(maxTransactionAmountByType).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            leastTransactionType.innerHTML = "Least transaction type:   <span style='color:green;'>" + minTransactionTypeByAmount.join(', ') + "</span> having  <span style='color: blue;'> " + Number(minTransactionAmountByType).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            mostCustomerType.innerHTML = "Highest customer type(s): <span style='color:green;'>" + maxCustomerTypeByAmount.join(', ') + "</span> having <span style='color: blue;'> " + Number(maxTransactionAmountByCustomerType).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            leastCustomerType.innerHTML = "Least customer type: <span style='color:green;'>" + minCustomerTypeByAmount.join(', ') + "</span> having <span style='color: blue;'> " + Number(minTransactionAmountByCustomerType).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span> total income.";
            mostCustomerProvince.innerHTML = "Provinces with the highest income: <span style='color:green;'>" + highestProvincesByAmount.join(', ') + "</span> having <span style='color: blue;'> " + Number(maxTransactionAmountByProvince).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span>.";
            leastCustomerProvince.innerHTML = "Provinces with the least income: <span style='color:green;'>" + leastProvincesByAmount.join(', ') + "</span> having <span style='color: blue;'> " + Number(minTransactionAmountByProvince).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span>.";
        }

        function refreshContent() {
            processFilteredData();
            processFilteredDataAmount();
        }
        startDateElements.addEventListener('change', function() {
            updateData();
            refreshContent();
        });
        endDateElements.addEventListener('change', function() {
            updateData();
            refreshContent();
        });

        updateData();
        refreshContent();
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
                    // Categorize transactions into quarters
                    switch (quarter) {
                        case 1:
                            quarter1.push(transaction.datasets[0].data[index]);
                            break;
                        case 2:
                            quarter2.push(transaction.datasets[0].data[index]);
                            break;
                        case 3:
                            quarter3.push(transaction.datasets[0].data[index]);
                            break;
                        case 4:
                            quarter4.push(transaction.datasets[0].data[index]);
                            break;
                    }
                }
            });
            // Calculate the sum of transactions for each quarter
            const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
            const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
            const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
            const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);

            // Get the appropriate target value based on the current month
            const targetValue = getTargetValue(currentMonth);

            // Function to determine the target value based on the current month
            function getTargetValue(month) {
                if (month >= 0 && month < 3) {
                    return targetValues[0]; // January to March
                } else if (month >= 3 && month < 6) {
                    return targetValues[1]; // April to June
                } else if (month >= 6 && month < 9) {
                    return targetValues[2]; // July to September
                } else {
                    return targetValues[3]; // October to December
                }
            }

            Target = targetValue;
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

            const needle = (Total / Target);
            let percentage = needle * 100;
            if (percentage > 100) {
                percentage = 100;
            } else {
                percentage = percentage;
            }

            speedometerReading.textContent = Total + " Transaction";

            //rotation of the needle 
            let rotation = (needle) * 180 - 90;
            if (rotation > 180) {
                rotation = 180 - 90;
            }

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
            //percentage text color
            let percentagecolor = '';
            if (percentage >= 76 && percentage <= 100) {
                percentagecolor = 'green';
            } else if (percentage >= 51 && percentage <= 75) {
                percentagecolor = 'yellow';
            } else if (percentage >= 26 && percentage <= 50) {
                percentagecolor = 'orange';
            } else {
                percentagecolor = 'red';
            }


            // Display the pop-up
            popup.style.display = "block";

            targetTransaction.innerHTML = "Target transaction for this quarter is <span style='color: blue;'>" + Target;
            percentTransaction.innerHTML = "Achieved <span style='color: " + percentagecolor + ";'>" + percentage + "%</span> of target transaction.";
            PopupHeader.innerHTML = "Total Transaction";
            processFilteredData();
        });
        updateData();
        refreshContent();


        closePopup.addEventListener("click", () => {
            // Close the pop-up when the close button is clicked
            popup.style.display = "none";
        });

        /// sales popup
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
                    // Categorize income into quarters
                    switch (quarter) {
                        case 1:
                            quarter1.push(income.datasets[0].data[index]);
                            break;
                        case 2:
                            quarter2.push(income.datasets[0].data[index]);
                            break;
                        case 3:
                            quarter3.push(income.datasets[0].data[index]);
                            break;
                        case 4:
                            quarter4.push(income.datasets[0].data[index]);
                            break;
                    }
                }
            });
            // Calculate the sum of income for each quarter
            const sumQuarter1 = quarter1.reduce((acc, value) => acc + value, 0);
            const sumQuarter2 = quarter2.reduce((acc, value) => acc + value, 0);
            const sumQuarter3 = quarter3.reduce((acc, value) => acc + value, 0);
            const sumQuarter4 = quarter4.reduce((acc, value) => acc + value, 0);

            // Get the appropriate target value based on the current month
            const targetincomeValue = getTargetValue(currentMonth);

            // Function to determine the target value based on the current month
            function getTargetValue(month) {
                if (month >= 0 && month < 3) {
                    return targetincomeValues[0]; // January to March
                } else if (month >= 3 && month < 6) {
                    return targetincomeValues[1]; // April to June
                } else if (month >= 6 && month < 9) {
                    return targetincomeValues[2]; // July to September
                } else {
                    return targetincomeValues[3]; // October to December
                }
            }

            Target = targetincomeValue;


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
            Total = Total.toFixed(2);

            const needle = (Total / Target);
            let percentage = needle * 100;
            if (percentage > 100) {
                percentage = 100;
            } else {
                percentage = percentage;
            }

            speedometerReading.textContent = Number(Total).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + " Income";

            // Simulate the speedometer arrow movement (you can replace this with actual data)
            let rotation = (needle) * 180 - 90;
            if (rotation > 180) {
                rotation = 180 - 90;
            }
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
            //percentage text color
            let percentagecolor = '';
            if (percentage >= 76 && percentage <= 100) {
                percentagecolor = 'green';
            } else if (percentage >= 51 && percentage <= 75) {
                percentagecolor = 'yellow';
            } else if (percentage >= 26 && percentage <= 50) {
                percentagecolor = 'orange';
            } else {
                percentagecolor = 'red';
            }


            // Display the pop-up
            popup.style.display = "block";

            targetTransaction.innerHTML = "Target income for this quarter is <span style='color: blue;'>" + Target;
            percentTransaction.innerHTML = "Achieved <span style='color: " + percentagecolor + ";'>" + percentage + "%</span> of target income";
            PopupHeader.innerHTML = "Total Income";
            processFilteredDataAmount();
        });
        updateData();
        refreshContent();
        closePopup.addEventListener("click", () => {
            // Close the pop-up when the close button is clicked
            popup.style.display = "none";
        });
    </script>





    <script>
        // Reference datas
        const TransactionperDiv = <?php echo json_encode($TransactionperDiv); ?>;
        const SalesperDiv = <?php echo json_encode($SalesperDiv); ?>;

        // Transaction bar graphs
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
                indexAxis: 'x',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false,
                            display: false,
                        },
                        min: 0,
                        max: 6,
                    },
                    y: {
                        grid: {
                            display: false,
                            drawOnChartArea: false
                        }
                    },
                },
                ticks: {
                    precision: 0,
                },
            }
        });

        // const barPosition = {
        //         id: 'barPosition',
        //         beforeDatasetsDraw: (chart, args, pluginOptions) => {
        //             const { ctx, data, chartArea: { top, bottom, left, right, width, height }, scales: { x, y } } = chart;

        //             // Calculate the width for each dataset based on the total number of datasets.
        //             // This assumes that the labels array length is equal to the number of x-axis categories.
        //             const barWidth = width / data.labels.length;

        //             // Loop through each dataset.
        //             data.datasets.forEach((dataset, datasetIndex) => {
        //             // Get the meta for the current dataset.
        //             const datasetMeta = chart.getDatasetMeta(datasetIndex);

        //             // Loop through each datapoint in the current dataset.
        //             datasetMeta.data.forEach((datapoint, index) => {
        //                 // Adjust the x position of the datapoint.
        //                 // This centers the bar within the allocated space for each x-axis category.
        //                 datapoint.x = left + (barWidth * (index + 0.5));
        //                 datapoint.x += (barWidth / data.datasets.length) * datasetIndex - (barWidth / 4);
        //             });
        //             });
        //         }
        //         };


        //sales bar graph
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: SalesperDiv,
            options: {
                tension: 0.4,
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false,
                            display: false,
                        }

                    },

                    x: {
                        min: 0,
                        max: 7,
                        grid: {
                            drawOnChartArea: false,
                            display: false,
                        }
                    }

                },
                ticks: {
                    precision: 0,
                },
            },
        });

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


        function dateChange() {
            const dateTypeSelect = document.getElementById('date_type');
            const selectedValue = dateTypeSelect.value;


            // if (selectedValue === 'Days') {

            // salesChart.config.type = "line";
            // salesChart.update();

            // salesChart.options.plugins.barPosition = false; // Or any other setting you wish to apply
            // salesChart.update(); 

            // }  

            if (selectedValue === 'Months') {

                document.getElementById('startDate').setAttribute('type', 'month');
                document.getElementById('endDate').setAttribute('type', 'month');

                const dX = new Date();
                let yearX = dX.getFullYear();
                var listers = []; //for months

                function updateThis() {
                    var chartLabelZ = (<?= json_encode($monthLabel) ?>);
                    var x = 0;
                    while (chartLabelZ[x] != null) {
                        var lab2 = chartLabelZ[x].month;
                        listers[x] = lab2;
                        x++;
                    }
                }
                updateThis()
                let janm = listers.slice(0, 1).toString().split("-");
                let janMonth = janm[1].toString();
                let currMonth = ("0" + (dX.getMonth() + 1)).slice(-2); //get current month

                document.getElementById('startDate').value = yearX + "-" + janMonth;
                document.getElementById('endDate').value = yearX + "-" + currMonth;

                // salesChart.config.type = "line";
                // salesChart.update();

                // salesChart.options.plugins.barPosition = false; // Or any other setting you wish to apply
                // salesChart.update(); 

            } else if (selectedValue === 'Years') {

                var yearLabelZ = (<?= json_encode($yearLabel) ?>);
                const dX = new Date();
                let yearX = dX.getFullYear();
                var listers = []; //for years

                function yearAssign() {
                    var x = 0;
                    while (yearLabelZ[x] != null) {
                        var lab3 = yearLabelZ[x].year;
                        listers[x] = lab3;
                        x++;
                    }
                }
                yearAssign();

                document.getElementById('startDate').setAttribute('type', 'number');
                document.getElementById('startDate').value = "2023";
                document.getElementById('endDate').setAttribute('type', 'number');
                document.getElementById('endDate').value = yearX;

                // salesChart.config.type = "bar";
                // salesChart.update();

                // salesChart.options.plugins.barPosition = true; // Or any other setting you wish to apply
                // salesChart.update(); 


                dateFilterRefresh();
            } else { //Days

                document.getElementById('startDate').setAttribute('type', 'date');
                document.getElementById('endDate').setAttribute('type', 'date');

                dateFilterRefresh();
            }
            dateFilter();
        };

        function dateFilterRefresh() { // asign current week's sunday and saturday to datepicker

            let dateTypeSelect = document.getElementById('date_type');
            let selectedValue = dateTypeSelect.value;
            if (selectedValue === 'Days') {

                //duh
                const today = new Date();
                //get date of this week's sunday
                const sunDay = new Date(
                    today.setDate(today.getDate() - today.getDay() + 1),
                );
                //get date of this week's saturday
                const satDay = new Date(
                    today.setDate(today.getDate() - today.getDay() + 7),
                );
                //"yyyy-mm-dd" format
                var toSunDay = sunDay.toISOString().slice(0, 10);
                var toSatDay = satDay.toISOString().slice(0, 10);

                //calculated dates as input values
                document.getElementById('startDate').value = toSunDay;
                document.getElementById('endDate').value = toSatDay;
            }
        }
        dateFilterRefresh();


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
    </script>


    <!-- All about customer graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-geo"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="customers_data">
        <div class="date_filter" style="text-align: left; padding-left: 8rem; padding-top: 0rem; padding-bottom: 2rem;">
            <div class="containers">
                <div class="date_dropdown">
                    <label for="chart_type" class="chart_type_label">
                        <strong>Chart Filter</strong></label>
                    <select name="chart_type" id="chart_type" class="dropdown-content" onchange="dateFilter()">
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
                    </select>
                    <div class="date_dropdown" style="top: 25%; left: 5%;">
                        <label for="customers_income" class="chart_type_label">
                            <strong>Select Type: </strong></label>
                        <select name="customers_income" id="customers_income" class="dropdown-content" onchange="dateFilter()">
                            <option value="customer">Customer Count</option>
                            <option value="income">Earned Amount</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <p class="reportTitle" id="Provincespopup">Total Customers per Province</p>
            <canvas id="Provinces" width="100%"></canvas>
        </div>
    </div>
</div>

<div class="popup" id="ProvinceopenPopup">
    <div class="popup-content" style="width: 50%; height:auto">
        <span class="close" id="ProvinceclosePopup">&times;</span>

        <h1 id="header"></h1>
        <h5>Paid Transactions</h5>

        <div style="text-align: left; margin: 0 auto; width: 80%;">
            <label for="transactionTypeDropdown">Top 5 Provinces</label>
            <select id="provinceDropdown">
            </select> <br><br>


            <div style="text-align: left; margin: 0 auto; width: 80%;">
                <h4 id="typeprovince"></h4>
                <p id="contentprovince"></p>

            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provincesPopup = document.getElementById("Provincespopup");
        const ProvinceopenPopup = document.getElementById("ProvinceopenPopup");
        const ProvinceclosePopup = document.getElementById("ProvinceclosePopup");
        const header = document.getElementById("header");
        const provinceDropdown = document.getElementById("provinceDropdown");
        const typeprovince = document.getElementById("typeprovince");
        const contentprovince = document.getElementById("contentprovince");
        const startDateElement = document.getElementById("startDate");
        const endDateElement = document.getElementById("endDate");

        let technicalServicesData = <?php echo json_encode($customerTypeDatapertransaction); ?>;

        function filterDataByDateRange(inputStartDate, inputEndDate) {
            let startDate, endDate;
            const startInput = inputStartDate.split('-');
            const endInput = inputEndDate.split('-');

            // Start date
            if (startInput.length === 2) {
                const [startYear, startMonth] = startInput.map(Number);
                startDate = new Date(startYear, startMonth - 1, 1);
            } else if (startInput.length === 1) {
                startDate = new Date(startInput[0], 0, 1);
            } else {
                startDate = new Date(inputStartDate);
            }

            // End date
            if (endInput.length === 2) {
                const [endYear, endMonth] = endInput.map(Number);
                endDate = new Date(endYear, endMonth, 0);
            } else if (endInput.length === 1) {
                endDate = new Date(endInput[0], 11, 31);
            } else {
                endDate = new Date(inputEndDate);
            }

            return technicalServicesData.filter(item =>
                new Date(item.transaction_date) >= startDate &&
                new Date(item.transaction_date) <= endDate
            );
        }

        const customerstatpopup = `
            <style>
                .scrollable-table {
                    height: 20rem; /* Adjust the height as needed */
                    overflow-y: auto;
                }
                .scrollable-table table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .scrollable-table th, .scrollable-table td {
                    border: 1px solid black;
                    text-align: left;
                    padding: 8px;
                }
                .scrollable-table tr {
                    height: 100%;
                }
            </style>
        `;

        // Add this style to your HTML
        document.head.insertAdjacentHTML('beforeend', customerstatpopup);

        function updateProvinceData(customerTypeData, provinceName) {
            const formattedProvince = provinceName.charAt(0).toUpperCase() + provinceName.slice(1);
            const provinceData = customerTypeData.filter(item => item.address === formattedProvince);
            const provinceDataFiltered = provinceData.reduce((result, item) => {
                const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                if (existingTransactionTypeIndex !== -1) {
                    const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                        customer => customer.customer_type === item.customer_type
                    );

                    if (existingCustomerTypeIndex !== -1) {
                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                    } else {
                        result[existingTransactionTypeIndex].customer_types.push({
                            customer_type: item.customer_type,
                            transaction_count: Number(item.transaction_count),
                            total_amount: Number(item.total_amount)
                        });
                    }
                } else {
                    result.push({
                        transaction_type: item.transaction_type,
                        customer_types: [{
                            customer_type: item.customer_type,
                            transaction_count: Number(item.transaction_count),
                            total_amount: Number(item.total_amount)
                        }]
                    });
                }

                return result;
            }, []);

            // if null or empty dataset
            function handleNullDataset(dataset) {
                if (!dataset || dataset.length === 0) {
                    return [{
                        transaction_type: ' ',
                        customer_types: [{
                            customer_type: ' ',
                            transaction_count: 0,
                            total_amount: 0
                        }]
                    }];
                }
                return dataset;
            }
            let province1Transactions = handleNullDataset(provinceDataFiltered);
            let sumOfAllProvince1TransactionCounts = 0;
            let sumOfAllProvince1TransactionAmounts = 0;
            province1Transactions.forEach(transaction => {
                transaction.customer_types.forEach(customer => {
                    sumOfAllProvince1TransactionCounts += customer.transaction_count;
                    sumOfAllProvince1TransactionAmounts += customer.total_amount;
                });
            });

            const Provincewidths = {
                type: '25%',
                customer: '25%',
                count: '25%',
                amount: '25%'
            };

            let cancelledTableHeader = `<table style="border-collapse: collapse; width: 98%;">
                                <tr>
                                    <th style="border: 1px solid black; padding: 8px; width: ${Provincewidths.type}; text-align: left;">Transaction Type</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${Provincewidths.customer}; text-align: left;">Customer Type</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${Provincewidths.count}; text-align: left;">Transaction Count</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${Provincewidths.amount}; text-align: left;">Amount</th>
                                </tr>
                            </table>`;

            // Start of the scrollable table body
            let cancelledTableScrollable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;

            provinceDataFiltered.forEach(transaction => {
                let totalRowsForTransactionType = transaction.customer_types.length;
                transaction.customer_types.forEach((customer, customerIndex) => {
                    cancelledTableScrollable += '<tr style="border: 1px solid black;">';
                    if (customerIndex === 0) {
                        cancelledTableScrollable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${Provincewidths.type};">${transaction.transaction_type}</td>`;
                    }
                    cancelledTableScrollable += `
                                        <td style="border: 1px solid black; padding: 8px; width: ${Provincewidths.customer};">${customer.customer_type}</td>
                                        <td style="border: 1px solid black; padding: 8px; width: ${Provincewidths.count};">${customer.transaction_count}</td>
                                        <td style="border: 1px solid black; padding: 8px; width: ${Provincewidths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                    </tr>`;
                });
            });

            cancelledTableScrollable += '</table></div>';

            typeprovince.innerHTML = "<span style='color: Red;'>" + formattedProvince + " <br>";
            contentprovince.innerHTML = "Total " + formattedProvince + " Transaction: <span style='color: red;'>" + sumOfAllProvince1TransactionCounts + "</span> amounting of <span style='color: red;'>" + Number(sumOfAllProvince1TransactionAmounts).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + "</span><br><br>" + cancelledTableHeader + cancelledTableScrollable;
        }

        function updateDataAndPopup() {
            const startDate = startDateElement.value;
            const endDate = endDateElement.value;
            const customerTypeData = filterDataByDateRange(startDate, endDate);

            const provinceTransactionCounts = {};
            customerTypeData.forEach(item => {
                const province = item.address;
                if (!provinceTransactionCounts[province]) {
                    provinceTransactionCounts[province] = 0;
                }
                provinceTransactionCounts[province]++;
            });

            const sortedProvinces = Object.keys(provinceTransactionCounts).sort((a, b) =>
                provinceTransactionCounts[b] - provinceTransactionCounts[a]
            );

            const topProvinces = sortedProvinces.slice(0, 5);

            provinceDropdown.innerHTML = '';
            topProvinces.forEach(function(province) {
                var option = document.createElement('option');
                option.value = province;
                option.text = province.charAt(0).toUpperCase() + province.slice(1);
                provinceDropdown.add(option);
            });

            header.innerText = 'Top 5 Provinces';
            provinceDropdown.value = topProvinces[0];
            provinceDropdown.dispatchEvent(new Event('change'));
        }

        startDateElement.addEventListener('change', updateDataAndPopup);
        endDateElement.addEventListener('change', updateDataAndPopup);

        provinceDropdown.addEventListener("change", function() {
            const selectedValue = this.value;
            updateProvinceData(filterDataByDateRange(startDateElement.value, endDateElement.value), selectedValue);
        });

        provincesPopup.addEventListener("click", () => {
            updateDataAndPopup();
            ProvinceopenPopup.style.display = "block";
        });

        ProvinceclosePopup.addEventListener("click", () => {
            ProvinceopenPopup.style.display = "none";
        });

        updateDataAndPopup();
    });
</script>


<!-- scriptfor customers graph -->

<script>
    // Get references to chart containers and the dropdown
    const provincesChartContainer = document.getElementById('Provinces').getContext('2d');
    const chartTypeDropdown = document.getElementById('chart_type');
    const constprovincesChart = new Chart(provincesChartContainer, {
        type: 'bar',
        options: {
            barThickness: 25,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false,
                    },
                },
                x: {
                    ticks: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
            },
            ticks: {
                precision: 0,
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 4,
                    display: 'auto',
                    color: 'white',
                },
                bgColor: {
                    backgroundColor: 'white'
                }
            },
        },
    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var provinceData = [];
    //look for updateChartContent(response)
</script>

<!-- All about customer graphs -->
<script src="path/to/Chart.min.js"></script>
<div class="customers_data">
    <div class="date_filter" style="text-align: left; padding-left: 8rem; padding-top: 0rem; padding-bottom: 2rem;">
        <div class="containers">
            <div class="date_dropdown">
                <label for="chart_type2" class="chart_type_label2">
                    <strong>Chart Filter</strong></label>
                <select name="chart_type2" id="chart_type2" class="dropdown-content" onchange="changeChart()">
                    <option value="doughnut">Doughnut</option>
                    <option value="pie">Pie</option>
                    <option value="bar">Bar</option>

                    <!-- <option value="horizontal_bar">Horizontal chart</option> -->
                </select>
            </div>
        </div>
    </div>
    <div class="graph2" id="customertransaction" style="margin-top:20px">
        <div class="chart-container2">
            <p class="reportTitle" id="transactionStatuspopup">Transaction Status</p>
            <canvas id="transactionStatus"></canvas>
        </div>
        <div class="chart-container2">
            <p class="reportTitle" id="paymentMethodpopup">Payment Method</p>
            <canvas id="paymendtMethod"></canvas>
        </div>
    </div>
    <div class="graph2">
        <div class="chart-container2">
            <p class="reportTitle" id="transactionTypepoppup">Type of Transaction</p>
            <canvas id="transactionType"></canvas>
        </div>

        <div class="chart-container2">
            <p class="reportTitle" id="customerTypepoppup">Type of Customers</p>
            <canvas id="customerType"></canvas>
        </div>
    </div>

    <!-- Pop-up for transaction type -->
    <!-- Transaction status popup -->
    <div class="popup" id="customerpopup">
        <div class="popup-content">
            <span class="close" id="close">&times;</span>

            <h2 id="header"></h2>

            <div style="text-align: left; margin: 0 auto; width: 80%;">
                <div id="transactionTypeDropdownContainer">
                    <label for="transactionTypeDropdown"></label>
                    <select id="transactionTypeDropdown">

                    </select> <br><br>
                </div>

                <div style="text-align: left; margin: 0 auto; width: 80%;">
                    <h4 id="type1"></h4>
                    <p id="hightype1"></p>

                </div>
            </div>
        </div>

    </div>

    <!-- Transaction Type popup -->
    <div class="popup" id="customerpopup2">
        <div class="popup-content">
            <span class="close" id="close2">&times;</span>

            <h2 id="header2"></h2>

            <div style="text-align: left; margin: 0 auto; width: 80%;">
                <label for="transactionTypeDropdown2"></label>
                <select id="transactionTypeDropdown2">
                </select> <br><br>

                <div style="text-align: left; margin: 0 auto; width: 80%;">
                    <h4 id="type2"></h4>
                    <p id="hightype2"></p>

                </div>
            </div>
        </div>

    </div>

    <!-- Transaction Type popup -->
    <div class="popup" id="customerpopup3">
        <div class="popup-content">
            <span class="close" id="close3">&times;</span>

            <h2 id="header3"></h2>

            <div style="text-align: left; margin: 0 auto; width: 80%;">
                <label for="transactionTypeDropdown3"></label>
                <select id="transactionTypeDropdown3">
                    <option value="ts">Technical Services</option>
                    <option value="nlims">National Laboratory Information Management System</option>
                    <option value="ulims">Unified Laboratory Information Management System</option>


                </select> <br><br>

                <div style="text-align: left; margin: 0 auto; width: 80%;">
                    <h4 id="type3"></h4>
                    <p id="hightype3"></p>

                </div>
            </div>
        </div>

    </div>


    <!-- Customer type popup -->
    <div class="popup" id="customerpopup4">
        <div class="popup-content">
            <span class="close" id="close4">&times;</span>

            <h2 id="header4"></h2>

            <div id="yearPickerContainer" style="margin-bottom: 20px;">
                <label for="yearPicker">Select Year:</label>
                <select id="yearPicker">
                    <?php foreach ($distinctYears as $year) : ?>
                        <option value="<?php echo htmlspecialchars($year); ?>">
                            <?php echo htmlspecialchars($year); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="text-align: left; margin: 0 auto; width: 80%;">
                <h4 id="type"></h4>
                <p id="hightype"></p>

            </div>
        </div>
    </div>

</div>
<!-- popup script for customers -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateElement = document.getElementById("startDate");
        const endDateElement = document.getElementById("endDate");
        const transactionTypeDropdown = document.getElementById("transactionTypeDropdown");
        const transactionTypeDropdown2 = document.getElementById("transactionTypeDropdown2");
        const transactionTypeDropdown3 = document.getElementById("transactionTypeDropdown3");
        //for clickable reference
        const transactionStatuspopup = document.getElementById("transactionStatuspopup");
        const paymentMethodpopup = document.getElementById("paymentMethodpopup");
        const transactionTypepoppup = document.getElementById("transactionTypepoppup");
        const customerTypepoppup = document.getElementById("customerTypepoppup");
        const customerpopup = document.getElementById("customerpopup");
        const close = document.getElementById("close");
        const customerpopup2 = document.getElementById("customerpopup2");
        const close2 = document.getElementById("close2");
        const customerpopup3 = document.getElementById("customerpopup3");
        const close3 = document.getElementById("close3");
        const customerpopup4 = document.getElementById("customerpopup4");
        const close4 = document.getElementById("close4");

        // Set default dates
        const currentDate = new Date();
        startDateElement.valueAsDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        endDateElement.valueAsDate = currentDate;

        // Initialize data
        let technicalServicesData = <?php echo json_encode($customerTypeDatapertransaction); ?>;
        let customerTypeData = [];

        // Function to update customerTypeData based on date range
        function getMonthDateRange(year, month) {
            const startDate = new Date(year, month - 1, 1);
            const endDate = new Date(year, month, 0);
            return {
                startDate,
                endDate
            };
        }

        function updateData() {
            let startDate, endDate;
            const startInput = startDateElement.value.split('-');
            const endInput = endDateElement.value.split('-');

            //start date
            if (startInput.length === 2) { // Format is 'mm-yyyy'
                const [startYear, startMonth] = startInput.map(Number);
                startDate = new Date(startYear, startMonth - 1, 1); // First day of the start month
            } else if (startInput.length === 1) { // Format is 'yyyy'
                startDate = new Date(startInput[0], 0, 1); // January 1st of the year
            } else {
                startDate = new Date(startDateElement.value); // Full date format
            }

            // end date
            if (endInput.length === 2) { // Format is 'mm-yyyy'
                const [endYear, endMonth] = endInput.map(Number);
                endDate = new Date(endYear, endMonth, 1); // Last day of the end month
            } else if (endInput.length === 1) { // Format is 'yyyy'
                endDate = new Date(endInput[0], 11, 31); // December 31st of the year
            } else {
                endDate = new Date(endDateElement.value); // Full date format
            }

            customerTypeData = technicalServicesData.filter(item =>
                new Date(item.transaction_date) >= startDate &&
                new Date(item.transaction_date) <= endDate
            );
            updatePopupContent();
        }

        function refreshPopupContent() {
            const selectedTransactionType = transactionTypeDropdown.value;
            updatePopupContent(selectedTransactionType);
            const selectedTransactionType2 = transactionTypeDropdown2.value;
            updatePopupContent(selectedTransactionType2);
            const selectedTransactionType3 = transactionTypeDropdown3.value;
            updatePopupContent(selectedTransactionType3);

        }

        // Event listeners for date changes
        startDateElement.addEventListener('change', function() {
            updateData();
            refreshPopupContent();
        });

        endDateElement.addEventListener('change', function() {
            updateData();
            refreshPopupContent();
        });

        // Transaction status pop-up analyzation
        if (transactionStatuspopup) {

            const customerstatpopup = `
            <style>
                .scrollable-table {
                    height: 100%; /* Adjust the height as needed */
                    overflow-y: auto;
                }
                .scrollable-table table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .scrollable-table th, .scrollable-table td {
                    border: 1px solid black;
                    text-align: left;
                    padding: 8px;
                }
                .scrollable-table tr {
                    height: 100%;
                }
            </style>
        `;

            // Add this style to your HTML
            document.head.insertAdjacentHTML('beforeend', customerstatpopup);

            transactionStatuspopup.addEventListener("click", () => {
                const dropdown = document.getElementById("transactionTypeDropdown");

                // Clear existing options and add new options: Paid, Pending, Cancelled
                dropdown.innerHTML = '';
                const options = ["Paid", "Pending", "Cancelled"];
                options.forEach(option => {
                    let opt = document.createElement('option');
                    opt.value = option.toLowerCase();
                    opt.innerHTML = option;
                    dropdown.appendChild(opt);
                });

                header.innerHTML = "Transaction Status <br>";

                // Initialize the dropdown value to 'paid' and dispatch the change event
                dropdown.value = 'paid';
                dropdown.dispatchEvent(new Event('change'));
                updateData();

                // Update and display popup content for 'paid'
                updatePopupContent('paid'); // Directly call with 'paid'
                customerpopup.style.display = "block";

                // Handle the change event for the dropdown
                document.getElementById("transactionTypeDropdown").addEventListener("change", (event) => {
                    const selectedTransactionType = event.target.value;
                    updatePopupContent(selectedTransactionType);
                });
            });

            function updatePopupContent(selectedTransactionType) {
                switch (selectedTransactionType) {
                    case "paid":
                        const paiddata = customerTypeData.filter(item => item.transaction_status === 'Paid');

                        const paiddatafiltered = paiddata.reduce((result, item) => {
                            const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                            if (existingTransactionTypeIndex !== -1) {
                                const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                    customer => customer.customer_type === item.customer_type
                                );

                                if (existingCustomerTypeIndex !== -1) {
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(
                                        item.transaction_count
                                    );
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(
                                        item.total_amount
                                    );
                                } else {
                                    result[existingTransactionTypeIndex].customer_types.push({
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount),
                                    });
                                }
                            } else {
                                result.push({
                                    transaction_type: item.transaction_type,
                                    customer_types: [{
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount),
                                    }, ],
                                });
                            }

                            return result;
                        }, []);

                        // assumming transaction_count for each transaction_type
                        const transactionTypeSum = paiddatafiltered.map(entry => ({
                            transaction_type: entry.transaction_type,
                            total_transaction_count: entry.customer_types.reduce((sum, customer) => sum + customer.transaction_count, 0),
                            total_transaction_income: entry.customer_types.reduce((sum, customer) => sum + customer.total_amount, 0),
                        }));
                        const customertypepaid = paiddatafiltered.map(item => item.customer_types.map(customer => customer.customer_type));
                        const totalAmountpaiddata = transactionTypeSum.map(item => item.total_transaction_income);
                        const transactionTypepaid = transactionTypeSum.map(item => item.transaction_type);
                        const customertypepaiddata = transactionTypeSum.map(item => item.total_transaction_count);

                        const customertransactiontypePaid = [];
                        for (let i = 0; i < customertypepaid.length; i++) {
                            customertransactiontypePaid.push({
                                label: customertypepaid[i],
                                data: customertypepaiddata[i],
                                totalAmount: totalAmountpaiddata[i],
                                transactionType: transactionTypepaid[i]
                            });
                        }

                        function handleNullDataset(dataset) {
                            if (!dataset || dataset.length === 0) {
                                return [{
                                    label: 'no customer',
                                    data: 0,
                                    totalAmount: 0,
                                    transactionType: 'no transaction'
                                }];
                            }
                            return dataset;
                        }

                        let paidTransactions = customertransactiontypePaid;
                        paidTransactions = handleNullDataset(paidTransactions);
                        const totalpaidTransaction = customertransactiontypePaid.reduce((sum, item) => sum + item.data, 0);
                        const totalpaidAmount = customertransactiontypePaid.reduce((sum, item) => sum + item.totalAmount, 0);
                        const highestPaidTransaction = paidTransactions.reduce((max, current) => (current.totalAmount > max.totalAmount) ? current : max, paidTransactions[0]);
                        const leastPaidTransaction = paidTransactions.reduce((min, current) => (current.totalAmount < min.totalAmount) ? current : min, paidTransactions[0]);
                        const highestlabelPaidransaction = paidTransactions.filter(obj => obj.totalAmount === highestPaidTransaction.totalAmount).map(obj => obj.label);
                        const leastlabelPaidTransaction = paidTransactions.filter(obj => obj.totalAmount === leastPaidTransaction.totalAmount).map(obj => obj.label);
                        const highestlabelPaidransactionTY = paidTransactions.filter(obj => obj.totalAmount === highestPaidTransaction.totalAmount).map(obj => obj.transactionType);
                        const leastlabelPaidTransactionTY = paidTransactions.filter(obj => obj.totalAmount === leastPaidTransaction.totalAmount).map(obj => obj.transactionType);

                        //get the highest & lowest customer type with paid transaction (customer, transaction, amount, transaction type)
                        type1.innerHTML = "<span style='color: green;'> Paid Transaction <br> </span>" + "<span style='font-size:1rem'>Total of Paid transaction: <span style='color: red;'>" + totalpaidTransaction + "</span> with the amount of <span style='color: red;'>" + Number(totalpaidAmount).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        let paidtransactions = `<div class="scrollable-table">`;

                        paidtransactions += "</span>The highest paying transaction type: <span style='color: blue;'>" + highestlabelPaidransactionTY.join(' , ') + "</span> with total income of <span style='color: red;'>" + Number(highestPaidTransaction.totalAmount).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) +
                            "</span> for <span style='color: red;'>" + highestPaidTransaction.data + "</span> transactions from customers; <br> <br> Customers with highest paying transactions: <span style='color: blue;'> " + highestlabelPaidransaction.join(', ') +
                            "</span><br><br><br>The Least paying transaction type: <span style='color: blue;'>" + leastlabelPaidTransactionTY.join(' , ') + "</span> with total income of <span style='color: red;'>" + Number(leastPaidTransaction.totalAmount).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) +
                            "</span> for <span style='color: red;'>" + leastPaidTransaction.data + "</span> transactions from customers; <br> <br> Customers with least paying transactions: <span style='color: blue;'> " + leastlabelPaidTransaction.join(', ');

                        paidtransactions += "</div>";
                        hightype1.innerHTML = paidtransactions;
                        break;

                    case "pending":
                        const pendingdata = customerTypeData.filter(item => item.transaction_status === 'Pending');

                        const pendingdatafiltered = pendingdata.reduce((result, item) => {
                            const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                            if (existingTransactionTypeIndex !== -1) {
                                const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                    customer => customer.customer_type === item.customer_type
                                );

                                if (existingCustomerTypeIndex !== -1) {
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                                } else {
                                    result[existingTransactionTypeIndex].customer_types.push({
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount)
                                    });
                                }
                            } else {
                                result.push({
                                    transaction_type: item.transaction_type,
                                    customer_types: [{
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount)
                                    }]
                                });
                            }

                            return result;
                        }, []);

                        // if null or empty dataset
                        function handleNullDataset(dataset) {
                            if (!dataset || dataset.length === 0) {
                                return [{
                                    transaction_type: ' ',
                                    customer_types: [{
                                        customer_type: ' ',
                                        transaction_count: 0,
                                        total_amount: 0
                                    }]
                                }];
                            }
                            return dataset;
                        }

                        let pendingTransactions = handleNullDataset(pendingdatafiltered);
                        let sumOfAllPendingTransactionCounts = 0;
                        let sumOfAllPendingTransactionAmounts = 0;
                        pendingTransactions.forEach(transaction => {
                            transaction.customer_types.forEach(customer => {
                                sumOfAllPendingTransactionCounts += customer.transaction_count;
                                sumOfAllPendingTransactionAmounts += customer.total_amount;
                            });
                        });

                        const colWidths = {
                            type: '25%',
                            customer: '25%',
                            count: '25%',
                            amount: '25%'
                        };


                        let pendingTableHeader = `<table style="border-collapse: collapse; width: 98%;">
                            <tr>
                                <th style="border: 1px solid black; padding: 8px; width: ${colWidths.type}; text-align: left;">Transaction Type</th>
                                <th style="border: 1px solid black; padding: 8px; width: ${colWidths.customer}; text-align: left;">Customer Type</th>
                                <th style="border: 1px solid black; padding: 8px; width: ${colWidths.count}; text-align: left;">Transaction Count</th>
                                <th style="border: 1px solid black; padding: 8px; width: ${colWidths.amount}; text-align: left;">Amount</th>
                            </tr>
                        </table>`;

                        // Start of the scrollable table body
                        let pendingTableScrollable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;

                        // Adding rows for each transaction type
                        pendingTransactions.forEach(transaction => {
                            let totalRowsForTransactionType = transaction.customer_types.length;
                            transaction.customer_types.forEach((customer, customerIndex) => {
                                pendingTableScrollable += '<tr style="border: 1px solid black;">';
                                if (customerIndex === 0) {
                                    pendingTableScrollable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${colWidths.type};">${transaction.transaction_type}</td>`;
                                }
                                pendingTableScrollable += `
                                    <td style="border: 1px solid black; padding: 8px; width: ${colWidths.customer};">${customer.customer_type}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${colWidths.count};">${customer.transaction_count}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${colWidths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                </tr>`;
                            });
                        });

                        pendingTableScrollable += '</table></div>';

                        type1.innerHTML = "<span style='color: Yellow;'>Pending Transaction </span><br>";
                        hightype1.innerHTML = "Total Pending Transaction: <span style='color: red;'>" + sumOfAllPendingTransactionCounts + "</span> amounting of <span style='color: red;'>" + Number(sumOfAllPendingTransactionAmounts).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</span><br><br>" + pendingTableHeader + pendingTableScrollable;

                        break;

                    case "cancelled":
                        const cancelleddata = customerTypeData.filter(item => item.transaction_status === 'Cancelled');

                        const cancelleddatafiltered = cancelleddata.reduce((result, item) => {
                            const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                            if (existingTransactionTypeIndex !== -1) {
                                const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                    customer => customer.customer_type === item.customer_type
                                );

                                if (existingCustomerTypeIndex !== -1) {
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                                    result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                                } else {
                                    result[existingTransactionTypeIndex].customer_types.push({
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount)
                                    });
                                }
                            } else {
                                result.push({
                                    transaction_type: item.transaction_type,
                                    customer_types: [{
                                        customer_type: item.customer_type,
                                        transaction_count: Number(item.transaction_count),
                                        total_amount: Number(item.total_amount)
                                    }]
                                });
                            }

                            return result;
                        }, []);

                        // if null or empty dataset
                        function handleNullDataset(dataset) {
                            if (!dataset || dataset.length === 0) {
                                return [{
                                    transaction_type: ' ',
                                    customer_types: [{
                                        customer_type: ' ',
                                        transaction_count: 0,
                                        total_amount: 0
                                    }]
                                }];
                            }
                            return dataset;
                        }

                        let cancelledTransactions = handleNullDataset(cancelleddatafiltered);
                        let sumOfAllCancelledTransactionCounts = 0;
                        let sumOfAllCancelledTransactionAmounts = 0;
                        cancelledTransactions.forEach(transaction => {
                            transaction.customer_types.forEach(customer => {
                                sumOfAllCancelledTransactionCounts += customer.transaction_count;
                                sumOfAllCancelledTransactionAmounts += customer.total_amount;
                            });
                        });

                        // Explicit widths for each column
                        const widths = {
                            type: '25%',
                            customer: '25%',
                            count: '25%',
                            amount: '25%'
                        };

                        let cancelledTableHeader = `<table style="border-collapse: collapse; width: 98%;">
                                <tr>
                                    <th style="border: 1px solid black; padding: 8px; width: ${widths.type}; text-align: left;">Transaction Type</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${widths.customer}; text-align: left;">Customer Type</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${widths.count}; text-align: left;">Transaction Count</th>
                                    <th style="border: 1px solid black; padding: 8px; width: ${widths.amount}; text-align: left;">Amount</th>
                                </tr>
                            </table>`;

                        // Start of the scrollable table body
                        let cancelledTableScrollable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;

                        // Adding rows for each transaction type
                        cancelledTransactions.forEach(transaction => {
                            let totalRowsForTransactionType = transaction.customer_types.length;
                            transaction.customer_types.forEach((customer, customerIndex) => {
                                cancelledTableScrollable += '<tr style="border: 1px solid black;">';
                                if (customerIndex === 0) {
                                    cancelledTableScrollable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${widths.type};">${transaction.transaction_type}</td>`;
                                }
                                cancelledTableScrollable += `
                                        <td style="border: 1px solid black; padding: 8px; width: ${widths.customer};">${customer.customer_type}</td>
                                        <td style="border: 1px solid black; padding: 8px; width: ${widths.count};">${customer.transaction_count}</td>
                                        <td style="border: 1px solid black; padding: 8px; width: ${widths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                    </tr>`;
                            });
                        });

                        cancelledTableScrollable += '</table></div>';

                        type1.innerHTML = "<span style='color: Yellow;'>Cancelled Transaction </span><br>";
                        hightype1.innerHTML = "Total Cancelled Transaction: <span style='color: red;'>" + sumOfAllCancelledTransactionCounts + "</span> amounting of <span style='color: red;'>" + Number(sumOfAllCancelledTransactionAmounts).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</span><br><br>" + cancelledTableHeader + cancelledTableScrollable;

                        break;

                }
            }

            // Initial data setup
            updateData();
            refreshPopupContent();

        }

        // Transaction status pop-up analyzation
        if (paymentMethodpopup) {

            const customerstatpopup = `
            <style>
                .scrollable-table {
                    height: 100%; /* Adjust the height as needed */
                    overflow-y: auto;
                }
                .scrollable-table table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .scrollable-table th, .scrollable-table td {
                    border: 1px solid black;
                    text-align: left;
                    padding: 8px;
                }
                .scrollable-table tr {
                    height: 100%;
                }
            </style>
        `;

            // Add this style to your HTML
            document.head.insertAdjacentHTML('beforeend', customerstatpopup);

            paymentMethodpopup.addEventListener("click", () => {
                const dropdown = document.getElementById("transactionTypeDropdown2");
                dropdown.innerHTML = '';
                const paymenMethod = [{
                        value: "otc",
                        text: "Ove the Counter"
                    },
                    {
                        value: "op",
                        text: "Online Payment"
                    },
                    {
                        value: "cheque",
                        text: "Cheque"
                    }
                ];
                paymenMethod.forEach(option => {
                    let opt = document.createElement('option');
                    opt.value = option.value;
                    opt.innerHTML = option.text;
                    dropdown.appendChild(opt);
                });
                header2.innerHTML = "Transaction Type <br>";


                // Initialize the dropdown value to 'paid' and dispatch the change event
                dropdown.value = 'otc';
                dropdown.dispatchEvent(new Event('change'));
                updateData();

                customerpopup2.style.display = "block";


                // Handle the change event for the dropdown
                document.getElementById("transactionTypeDropdown2").addEventListener("change", (event) => {
                    const selectedTransactionType2 = event.target.value;

                    switch (selectedTransactionType2) {
                        case "otc":
                            const otcdata = customerTypeData.filter(item => item.transaction_status === 'Paid' && item.payment_method === 'Over the Counter');

                            const otcdatafiltered = otcdata.reduce((result, item) => {
                                const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                                if (existingTransactionTypeIndex !== -1) {
                                    const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                        customer => customer.customer_type === item.customer_type
                                    );

                                    if (existingCustomerTypeIndex !== -1) {
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                                    } else {
                                        result[existingTransactionTypeIndex].customer_types.push({
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        });
                                    }
                                } else {
                                    result.push({
                                        transaction_type: item.transaction_type,
                                        customer_types: [{
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        }]
                                    });
                                }

                                return result;
                            }, []);

                            // if null or empty dataset
                            function handleNullDataset(dataset) {
                                if (!dataset || dataset.length === 0) {
                                    return [{
                                        transaction_type: ' ',
                                        customer_types: [{
                                            customer_type: ' ',
                                            transaction_count: 0,
                                            total_amount: 0
                                        }]
                                    }];
                                }
                                return dataset;
                            }

                            let otcTransactions = handleNullDataset(otcdatafiltered);
                            let sumOfAllOTCTransactionCounts = 0;
                            let sumOfAllOTCTransactionAmounts = 0;
                            otcTransactions.forEach(transaction => {
                                transaction.customer_types.forEach(customer => {
                                    sumOfAllOTCTransactionCounts += customer.transaction_count;
                                    sumOfAllOTCTransactionAmounts += customer.total_amount;
                                });
                            });

                            const widths = {
                                type: '25%',
                                customer: '25%',
                                count: '25%',
                                amount: '25%'
                            };

                            // Fixed Header Table
                            let otcTable = `<table style="border-collapse: collapse; width: 98%;">
                            <tr>
                                <th style="border: 1px solid black; width: ${widths.type}; padding: 8px; text-align: left;">Transaction Type</th>
                                <th style="border: 1px solid black; width: ${widths.customer}; padding: 8px; text-align: left;">Customer Type</th>
                                <th style="border: 1px solid black; width: ${widths.count}; padding: 8px; text-align: left;">Transaction Count</th>
                                <th style="border: 1px solid black; width: ${widths.amount}; padding: 8px; text-align: left;">Amount</th>
                            </tr>
                        </table>`;

                            // Scrollable Table for the Body
                            let scrollableotcTable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;

                            // Add rows to the scrollable body table
                            otcTransactions.forEach(transaction => {
                                let totalRowsForTransactionType = transaction.customer_types.length;
                                transaction.customer_types.forEach((customer, customerIndex) => {
                                    scrollableotcTable += '<tr style="border: 1px solid black;">';
                                    if (customerIndex === 0) {
                                        scrollableotcTable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${widths.type};">${transaction.transaction_type}</td>`;
                                    }
                                    scrollableotcTable += `
                                    <td style="border: 1px solid black; padding: 8px; width: ${widths.customer};">${customer.customer_type}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${widths.count};">${customer.transaction_count}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${widths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                </tr>`;
                                });
                            });

                            scrollableotcTable += '</table></div>';

                            // Update the innerHTML of your display container
                            type2.innerHTML = "<span style='color: blue;'>Over the Counter Payment<br>";
                            hightype2.innerHTML = "Total Over the Counter Payment: <span style='color: red;'>" + sumOfAllOTCTransactionCounts + "</span> amounting of <span style='color: red;'>" + Number(sumOfAllOTCTransactionAmounts).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + "</span><br><br>" + otcTable + scrollableotcTable;

                            break;

                        case "op":
                            const opdata = customerTypeData.filter(item => item.transaction_status === 'Paid' && item.payment_method === 'Online Payment');

                            const opdatafiltered = opdata.reduce((result, item) => {
                                const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                                if (existingTransactionTypeIndex !== -1) {
                                    const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                        customer => customer.customer_type === item.customer_type
                                    );

                                    if (existingCustomerTypeIndex !== -1) {
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                                    } else {
                                        result[existingTransactionTypeIndex].customer_types.push({
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        });
                                    }
                                } else {
                                    result.push({
                                        transaction_type: item.transaction_type,
                                        customer_types: [{
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        }]
                                    });
                                }

                                return result;
                            }, []);

                            // if null or empty dataset
                            function handleNullDataset(dataset) {
                                if (!dataset || dataset.length === 0) {
                                    return [{
                                        transaction_type: ' ',
                                        customer_types: [{
                                            customer_type: ' ',
                                            transaction_count: 0,
                                            total_amount: 0
                                        }]
                                    }];
                                }
                                return dataset;
                            }

                            let opTransactions = handleNullDataset(opdatafiltered);
                            let sumOfAllOPTransactionCounts = 0;
                            let sumOfAllOPTransactionAmounts = 0;
                            opTransactions.forEach(transaction => {
                                transaction.customer_types.forEach(customer => {
                                    sumOfAllOPTransactionCounts += customer.transaction_count;
                                    sumOfAllOPTransactionAmounts += customer.total_amount;
                                });
                            });

                            const opwidths = {
                                type: '25%',
                                customer: '25%',
                                count: '25%',
                                amount: '25%'
                            };

                            // Fixed Header Table
                            let opTable = `<table style="border-collapse: collapse; width: 98%;">
                            <tr>
                                <th style="border: 1px solid black; width: ${opwidths.type}; padding: 8px; text-align: left;">Transaction Type</th>
                                <th style="border: 1px solid black; width: ${opwidths.customer}; padding: 8px; text-align: left;">Customer Type</th>
                                <th style="border: 1px solid black; width: ${opwidths.count}; padding: 8px; text-align: left;">Transaction Count</th>
                                <th style="border: 1px solid black; width: ${opwidths.amount}; padding: 8px; text-align: left;">Amount</th>
                            </tr>
                        </table>`;

                            // Scrollable Table for the Body
                            let scrollableOPTable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;

                            // column/row each transaction type
                            opTransactions.forEach(transaction => {
                                let totalRowsForTransactionType = transaction.customer_types.length;
                                transaction.customer_types.forEach((customer, customerIndex) => {
                                    scrollableOPTable += '<tr style="border: 1px solid black;">';
                                    if (customerIndex === 0) {
                                        scrollableOPTable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${opwidths.type};">${transaction.transaction_type}</td>`;
                                    }
                                    scrollableOPTable += `
                                    <td style="border: 1px solid black; padding: 8px; width: ${opwidths.customer};">${customer.customer_type}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${opwidths.count};">${customer.transaction_count}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${opwidths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                </tr>`;
                                });
                            });

                            scrollableOPTable += '</table></div>';
                            type2.innerHTML = "<span style='color: Blue;'>Online Payment<br>";
                            hightype2.innerHTML = "Total Online Payment:  <span style='color: red;'>" + sumOfAllOPTransactionCounts + "</span> amounting of  <span style='color: red;'>" + Number(sumOfAllOPTransactionAmounts).toLocaleString('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) +
                                "</span><br><br>" + opTable + scrollableOPTable;

                            break;

                        case "cheque":
                            const chequedata = customerTypeData.filter(item => item.transaction_status === 'Paid' && item.payment_method === 'Cheque');

                            const chequedatafiltered = chequedata.reduce((result, item) => {
                                const existingTransactionTypeIndex = result.findIndex(entry => entry.transaction_type === item.transaction_type);

                                if (existingTransactionTypeIndex !== -1) {
                                    const existingCustomerTypeIndex = result[existingTransactionTypeIndex].customer_types.findIndex(
                                        customer => customer.customer_type === item.customer_type
                                    );

                                    if (existingCustomerTypeIndex !== -1) {
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].transaction_count += Number(item.transaction_count);
                                        result[existingTransactionTypeIndex].customer_types[existingCustomerTypeIndex].total_amount += Number(item.total_amount);
                                    } else {
                                        result[existingTransactionTypeIndex].customer_types.push({
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        });
                                    }
                                } else {
                                    result.push({
                                        transaction_type: item.transaction_type,
                                        customer_types: [{
                                            customer_type: item.customer_type,
                                            transaction_count: Number(item.transaction_count),
                                            total_amount: Number(item.total_amount)
                                        }]
                                    });
                                }

                                return result;
                            }, []);

                            // if null or empty dataset
                            function handleNullDataset(dataset) {
                                if (!dataset || dataset.length === 0) {
                                    return [{
                                        transaction_type: ' ',
                                        customer_types: [{
                                            customer_type: ' ',
                                            transaction_count: 0,
                                            total_amount: 0
                                        }]
                                    }];
                                }
                                return dataset;
                            }

                            let chequeTransactions = handleNullDataset(chequedatafiltered);
                            let sumOfAllChequeTransactionCounts = 0;
                            let sumOfAllChequeTransactionAmounts = 0;
                            chequeTransactions.forEach(transaction => {
                                transaction.customer_types.forEach(customer => {
                                    sumOfAllChequeTransactionCounts += customer.transaction_count;
                                    sumOfAllChequeTransactionAmounts += customer.total_amount;
                                });
                            });

                            const Chequewidths = {
                                type: '25%',
                                customer: '25%',
                                count: '25%',
                                amount: '25%'
                            };

                            // Fixed Header Table
                            let ChequeTable = `<table style="border-collapse: collapse; width: 98%;">
                            <tr>
                                <th style="border: 1px solid black; width: ${Chequewidths.type}; padding: 8px; text-align: left;">Transaction Type</th>
                                <th style="border: 1px solid black; width: ${Chequewidths.customer}; padding: 8px; text-align: left;">Customer Type</th>
                                <th style="border: 1px solid black; width: ${Chequewidths.count}; padding: 8px; text-align: left;">Transaction Count</th>
                                <th style="border: 1px solid black; width: ${Chequewidths.amount}; padding: 8px; text-align: left;">Amount</th>
                            </tr>
                        </table>`;

                            // Scrollable Table for the Body
                            let scrollableChequeTable = `<div class="scrollable-table"><table style="border-collapse: collapse; width: 100%;">`;


                            // column/row each transaction type
                            chequeTransactions.forEach(transaction => {
                                let totalRowsForTransactionType = transaction.customer_types.length;
                                transaction.customer_types.forEach((customer, customerIndex) => {
                                    scrollableChequeTable += '<tr style="border: 1px solid black;">';
                                    if (customerIndex === 0) {
                                        scrollableChequeTable += `<td rowspan="${totalRowsForTransactionType}" style="border: 1px solid black; padding: 8px; width: ${Chequewidths.type};">${transaction.transaction_type}</td>`;
                                    }
                                    scrollableChequeTable += `
                                    <td style="border: 1px solid black; padding: 8px; width: ${Chequewidths.customer};">${customer.customer_type}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${Chequewidths.count};">${customer.transaction_count}</td>
                                    <td style="border: 1px solid black; padding: 8px; width: ${Chequewidths.amount};">${customer.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                </tr>`;
                                });
                            });

                            scrollableChequeTable += '</table></div>';
                            type2.innerHTML = "<span style='color: Blue;'>Cheque Payment<br>";
                            hightype2.innerHTML = "Total Cheque Payment:  <span style='color: red;'>" + sumOfAllChequeTransactionCounts + "</span> amounting of  <span style='color: red;'>" + Number(sumOfAllChequeTransactionAmounts).toLocaleString('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) +
                                "</span><br><br>" + ChequeTable + scrollableChequeTable;

                            break;
                    }
                });
                transactionTypeDropdown2.value = 'otc';
                transactionTypeDropdown2.dispatchEvent(new Event('change'));

                customerpopup2.style.display = "block";
            });
            // Initial data setup
            updateData();
            refreshPopupContent();
        }



        if (transactionTypepoppup) {
            function updatePopupContent() {
                const selectedTransactionType3 = transactionTypeDropdown3.value;
                let content = '';

                switch (selectedTransactionType3) {
                    case "ts":
                        content = processTransactionData('Technical Services');
                        break;
                    case "nlims":
                        content = processTransactionData('National Laboratory Information Management System');
                        break;
                    case "ulims":
                        content = processTransactionData('Unified Laboratory Information Management System');
                        break;
                    default:
                        content = "<div>No data available for the selected type.</div>";
                }

                hightype3.innerHTML = content;
            }

            //scrollable table
            const style = `
            <style>
                .scrollable-table {
                    height: 10rem; /* Adjust the height as needed */
                    overflow-y: auto;
                }
                .scrollable-table table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .scrollable-table th, .scrollable-table td {
                    border: 1px solid black;
                    text-align: left;
                    padding: 8px;
                }
                .scrollable-table tr {
                    height: 2rem; /* Fixed height for table rows */
                }
            </style>
        `;
            document.head.insertAdjacentHTML('beforeend', style);

            function processTransactionData(transactionType) {
                const filteredData = customerTypeData.filter(item => item.transaction_type === transactionType);

                // Aggregate data by customer type and transaction status
                const summary = filteredData.reduce((acc, item) => {
                    const key = item.customer_type + '-' + item.transaction_status;
                    if (!acc[key]) {
                        acc[key] = {
                            customer_type: item.customer_type,
                            transaction_status: item.transaction_status,
                            transaction_count: 0,
                            total_amount: 0
                        };
                    }
                    acc[key].transaction_count += Number(item.transaction_count);
                    acc[key].total_amount += Number(item.total_amount);
                    return acc;
                }, {});

                let content = `<strong>${transactionType} Transactions</strong><br>`;

                ['Paid', 'Cancelled', 'Pending'].forEach(status => {
                    // Find the highest transaction count for the status
                    let maxTransactionCount = Math.max(...Object.values(summary)
                        .filter(item => item.transaction_status === status)
                        .map(item => item.transaction_count));

                    // Filter out customer types that have the highest transaction count
                    let highestTransactions = Object.values(summary)
                        .filter(item => item.transaction_status === status && item.transaction_count === maxTransactionCount);

                    let leastTransactionCount = Math.min(...Object.values(summary)
                        .filter(item => item.transaction_status === status)
                        .map(item => item.transaction_count));

                    // Filter out customer types that have the highest transaction count
                    let leastTransactions = Object.values(summary)
                        .filter(item => item.transaction_status === status && item.transaction_count === leastTransactionCount);

                        let color;
                    switch (status) {
                        case 'Paid':
                            color = 'Green';
                            break;
                        case 'Pending':
                            color = '#ff8c1a';
                            break;
                        case 'Cancelled':
                            color = 'Red';
                            break;
                        default:
                            color = 'Black'; // Default color if none of the statuses match
                    }

                        let tableHeader = `<div><br><span style="color:${color}">${status}:</span>`;
                    tableHeader += `<table border="1" style="width:98%;"><tr>
                          <th style="width: 30%; color:white; background: #0298e3; padding-left: 2%">Customer Type</th>
                          <th style="width: 30%; color:white; background: #0298e3; padding-left: 2%">Transaction Count</th>
                          <th style="width: 31%; color:white; background: #0298e3; padding-left: 2%">Total Amount</th>
                        </tr></table></div>`;

                    // Table body - scrollable
                    let tableBody = `<div class="scrollable-table"><table border="1" style="width:100%;">`;

                    // Rows for highest transactions
                    tableBody += `<tr><td colspan="3" style="color:green;text-align:center;">Highest Transactions</td></tr>`;
                    highestTransactions.forEach(item => {
                        tableBody += `<tr>
                            <td style="width: 33%;">${item.customer_type}</td>
                            <td style="width: 33%;">${item.transaction_count}</td>
                            <td style="width: 34%;">${item.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        </tr>`;
                    });

                    // Rows for least transactions
                    tableBody += `<tr><td colspan="3" style="color:red;text-align:center;">Least Transactions</td></tr>`;
                    leastTransactions.forEach(item => {
                        tableBody += `<tr>
                            <td style="width: 33%;">${item.customer_type}</td>
                            <td style="width: 33%;">${item.transaction_count}</td>
                            <td style="width: 34%;">${item.total_amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        </tr>`;
                    });

                    tableBody += `</table></div>`;

                    // Combine header and body
                    content += tableHeader + tableBody;
                });

                return content;
            }

            transactionTypeDropdown3.addEventListener("change", updatePopupContent);

            refreshPopupContent();
            updateData();

            document.getElementById("transactionTypepoppup").addEventListener("click", () => {

                customerpopup3.style.display = "block";
            });
        }



        // customertype pop-up analyzation
        if (customerTypepoppup) {
            customerTypepoppup.addEventListener("click", () => {
                customerpopup4.style.display = "block";
                header4.innerHTML = "Customer Type";
                type.innerHTML = "Top Customer Transaction per Month";
                document.getElementById("yearPicker").addEventListener("change", function() {
                    const selectedYear = this.value;
                    const filteredData = technicalServicesData.filter(item => {
                        const transactionYear = new Date(item.transaction_date).getFullYear();
                        return item.transaction_status === 'Paid' && transactionYear.toString() === selectedYear;
                    });

                    let monthlyDataAggregated = {};
                    filteredData.forEach(item => {
                        const transactionMonth = new Date(item.transaction_date).getMonth() + 1;
                        const key = item.customer_type;

                        if (!monthlyDataAggregated[transactionMonth]) {
                            monthlyDataAggregated[transactionMonth] = {};
                        }

                        if (!monthlyDataAggregated[transactionMonth][key]) {
                            monthlyDataAggregated[transactionMonth][key] = {
                                transaction_count: 0,
                                total_amount: 0
                            };
                        }

                        monthlyDataAggregated[transactionMonth][key].transaction_count += Number(item.transaction_count);
                        monthlyDataAggregated[transactionMonth][key].total_amount += Number(item.total_amount);
                    });

                    // Find the customer type with the highest transaction count for each month
                    let highestTransactionsPerMonth = {};
                    for (const month in monthlyDataAggregated) {
                        let maxCount = 0;
                        let customerTypeWithMaxCount = '';
                        let maxIncome = 0;

                        for (const customerType in monthlyDataAggregated[month]) {
                            const {
                                transaction_count,
                                total_amount
                            } = monthlyDataAggregated[month][customerType];

                            if (transaction_count > maxCount) {
                                maxCount = transaction_count;
                                customerTypeWithMaxCount = customerType;
                                maxIncome = total_amount; // Set the max income for the current customer type
                            }
                        }

                        highestTransactionsPerMonth[month] = {
                            customer_type: customerTypeWithMaxCount,
                            transaction_count: maxCount,
                            income: maxIncome.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }),
                        };
                    }

                    // Generate table HTML
                    let tableHtml = '<table style="width: 100%; text-align: center;">';
                    tableHtml += `
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">Month</th>
                    <th style="border: 1px solid black; padding: 8px; ">Customer Type</th>
                    <th style="border: 1px solid black; padding: 8px; ">Transaction Count</th>
                    <th style="border: 1px solid black; padding: 8px; ">Income</th>
                </tr>`;

                    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                    Object.entries(highestTransactionsPerMonth).forEach(([month, data]) => {
                        const monthName = monthNames[parseInt(month) - 1]; // Convert numeric month to month name
                        tableHtml += `
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 8px;">${monthName}</td>
                        <td style="border: 1px solid black; padding: 8px;">${data.customer_type}</td>
                        <td style="border: 1px solid black; padding: 8px;">${data.transaction_count}</td>
                        <td style="border: 1px solid black; padding: 8px;">${data.income}</td>
                    </tr>`;
                    });

                    tableHtml += '</table>';
                    hightype.innerHTML = tableHtml;
                });

                const year = new Date().getFullYear(); // This will set 'year' to the current year
                document.getElementById("yearPicker").value = year;

                document.getElementById("yearPicker").dispatchEvent(new Event('change'));
            });
        }

        function handleNullDataset(dataset) {
            for (const month in dataset) {
                if (dataset[month].length === 0) {
                    dataset[month].push({
                        customer_type: 'None',
                        transaction_count: 0,
                        total_amount: 0
                    });
                }
            }
            return dataset;
        }

        // Close button functionality
        if (close) {
            close.addEventListener("click", () => {
                customerpopup.style.display = "none";
            });
            close2.addEventListener("click", () => {
                customerpopup2.style.display = "none";
            });
            close3.addEventListener("click", () => {
                customerpopup3.style.display = "none";
            });
            close4.addEventListener("click", () => {
                // Close the popup when the close button is clicked
                customerpopup4.style.display = "none";

            });

        }


    });
</script>

<!-- scriptfor customers graph -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //3bm75
    // Get references to chart containers and the dropdown
    const transactionStatusChartContainer = document.getElementById('transactionStatus');
    const paymendtMethodChartContainer = document.getElementById('paymendtMethod');
    const transactionTypeChartContainer = document.getElementById('transactionType');
    const customerTypeChartContainer = document.getElementById('customerType');
    const chartTypeDropdown2 = document.getElementById('chart_type2');


    const selectedChartType = chartTypeDropdown2.value;

    const doughnutOptions = {
        plugins: {
            scales: {
                y: {
                    grid: {
                        display: false,
                    }
                },
                x: {
                    grid: {
                        display: false,
                    }
                },
                ticks: {
                    precision: 0,
                },
            },
            legend: {
                display: true,
            },
            bgColor: {
                backgroundColor: 'white',
            },
            datalabels: {
                color: 'black',
                fontSize: 10,
            },
        },
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',

    };

    const transactionTypeElement = document.getElementById("transactionType");
    transactionTypeElement.style.marginLeft = "0px";
    // For doughnut and pie charts, use the custom options
    transactionStatusChart = new Chart(transactionStatusChartContainer, {
        type: 'doughnut',
        options: doughnutOptions,
        plugins: [bgColor, ChartDataLabels],
        data: {
            labels: <?php echo json_encode($transactionStatus); ?>,
            datasets: [{
                data: <?php echo json_encode($transactionStatusDatacounts); ?>,
                backgroundColor: ['rgba(229, 247, 48, 0.2)', //red
                    'rgba(241, 37, 150, 0.2)', //yellow
                    'rgba(0, 215, 132, 0.2)', //green
                ],
                borderColor: ['rgba(229, 247, 48, 0.8)', //red
                    'rgba(241, 37, 150, 0.8)', //yellow
                    'rgba(0, 215, 132, 0.93)', //green
                ],
                borderWidth: 2
            }],
        },
    });

    paymendtMethodChart = new Chart(paymendtMethodChartContainer, {
        type: 'doughnut',
        options: doughnutOptions,
        plugins: [bgColor, ChartDataLabels],
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
    });
    transactionTypeChart = new Chart(transactionTypeChartContainer, {
        type: 'doughnut',
        options: doughnutOptions,
        plugins: [bgColor, ChartDataLabels],
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
    });
    customerTypeChart = new Chart(customerTypeChartContainer, {
        type: 'doughnut',
        options: doughnutOptions,
        plugins: [bgColor, ChartDataLabels],
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
    });

    // dashboard design end

    function changeChart() {
        var type = document.getElementById('chart_type2');
        var typeSelect = type.value;

        // Remove cutout if the selected type is 'bar'
        doughnutOptions.cutout = typeSelect === 'pie' ? 0 : '70%';

        if (typeSelect === 'bar') {
            // Remove gridlines for x and y axes
            doughnutOptions.plugins.scales.x.grid.display = false;
            doughnutOptions.plugins.scales.y.grid.display = false;
            doughnutOptions.plugins.legend.display = false;

        } else {
            // For other chart types, display gridlines
            doughnutOptions.plugins.scales.x.grid.display = true;
            doughnutOptions.plugins.scales.y.grid.display = true;
            doughnutOptions.plugins.legend.display = true;
        }


        transactionStatusChart.config.type = typeSelect;
        paymendtMethodChart.config.type = typeSelect;
        transactionTypeChart.config.type = typeSelect;
        customerTypeChart.config.type = typeSelect;

        transactionStatusChart.options = JSON.parse(JSON.stringify(doughnutOptions));
        paymendtMethodChart.options = JSON.parse(JSON.stringify(doughnutOptions));
        transactionTypeChart.options = JSON.parse(JSON.stringify(doughnutOptions));
        customerTypeChart.options = JSON.parse(JSON.stringify(doughnutOptions));

        transactionStatusChart.update();
        paymendtMethodChart.update();
        transactionTypeChart.update();
        customerTypeChart.update();

        typeSelect = "";
    }
</script>

<script>
    function dateFilter() {
        var dateTypeSelect = document.getElementById('date_type');
        var selectedValue = dateTypeSelect.value;

        var customers_income = document.getElementById('customers_income');
        var ciVal = customers_income.value;
        var qVal = ""

        if (ciVal === "customer") {
            document.getElementById('Provincespopup').innerHTML = "Customers per Region"
            qVal = "A"
        } else {
            document.getElementById('Provincespopup').innerHTML = "Income per Region"
            qVal = "B"
        }

        if (selectedValue === 'Days') {

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //get the contents of the html datepicker
            const fromDateValue = document.getElementById('startDate');
            const toDatevalue = document.getElementById('endDate');

            const fDate = fromDateValue.value;
            const tDate = toDatevalue.value;

            console.log(fDate + " to " + tDate);

            //send datepicker data to controller, 
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/chart/day' ?>', // from index to controller then action
                method: 'POST',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                dataType: 'json',
                data: {
                    fromDate: fDate,
                    toDate: tDate,
                    qVal: qVal
                },
                success: function(response) {
                    updateChartContent(response);
                    //assign new value from controller to variables
                },
                error: function(error) {
                    console.error(error);
                    console.log("=== day error");
                }
            });

        } else if (selectedValue === 'Months') {

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //get the contents of the html datepicker
            const fromDateValue = document.getElementById('startDate');
            const toDatevalue = document.getElementById('endDate');

            const fDate = fromDateValue.value;
            const tDate = toDatevalue.value;

            //send datepicker data to controller, 
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/chart/month' ?>', // from index to controller then action
                method: 'POST',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                dataType: 'json',
                data: {
                    fromDate: fDate,
                    toDate: tDate,
                    qVal: qVal
                },
                success: function(response) {
                    updateChartContent(response);
                    //assign new value from controller to variables
                },
                error: function(error) {
                    console.error(error);
                    console.log("=== month error");
                }
            });
        } else { //years

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //get the contents of the html datepicker
            const fromDateValue = document.getElementById('startDate');
            const toDatevalue = document.getElementById('endDate');

            const fDate = fromDateValue.value;
            const tDate = toDatevalue.value;

            //send datepicker data to controller, 
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/chart/year' ?>', // from index to controller then action
                method: 'POST',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                dataType: 'json',
                data: {
                    fromDate: fDate,
                    toDate: tDate,
                    qVal: qVal
                },
                success: function(response) {
                    updateChartContent(response);
                    //assign new value from controller to variables
                },
                error: function(error) {
                    console.error(error);
                    console.log("=== year error");
                }
            });
        }
    }
    dateFilter();

    function updateChartContent(response) {

        var dateTypeSelect = document.getElementById('date_type');
        var selectedValue = dateTypeSelect.value;

        var x = 0;

        //------------------------------------------------1st//3bm60
        // Remove old data
        transactionChart.data.datasets.forEach((dataset) => {
            dataset.data = [];
        });

        var totalTransactionDataset = {
            datasets: [{
                backgroundColor: '#3499ff',
                label: 'Standard and Testing Division',
                data: {}
            }, ],
        }

        function totalTransactionTranslate() {
            x = 0;
            while (response.queryAllDate[x] != null) {
                var samp = response.queryAllDate[x].labels;
                var sampo = parseInt(response.queryAllDate[x].datasets);
                if (response.queryAllDate[x].label === "Standard and Testing Division") {

                    totalTransactionDataset.datasets[0].data[samp] = sampo;
                }
                x++
            }
            x = 0;
        }
        totalTransactionTranslate();

        transactionChart.config.data.datasets = totalTransactionDataset.datasets; //replace the current chart dataset
        console.log('transaction data: ')
        console.log(transactionChart.config.data.datasets)
        //------------------------------------------------2nd//3bm40
        // Remove old data
        salesChart.data.datasets.forEach((dataset) => {
            dataset.data = [];
        });

        var totalIncomeDataset = {
            datasets: [{
                backgroundColor: '#ff9a34',
                label: 'Standard and Testing Division',
                data: {}
            }, ],
        }

        function totalIncomeTranslate() {
            x = 0;
            while (response.queryTotalSale[x] != null) {
                var samp = response.queryTotalSale[x].labels;
                var sampo = parseInt(response.queryTotalSale[x].datasets);
                if (response.queryTotalSale[x].label === "Standard and Testing Division") {

                    totalIncomeDataset.datasets[0].data[samp] = sampo;
                }
                x++
            }
            x = 0;
        }
        totalIncomeTranslate();

        salesChart.config.data.datasets = totalIncomeDataset.datasets; //replace the current chart dataset

        const dateList = [];
        const monthList = [];
        const yearList = []

        if (selectedValue === 'Days') {
            while (response.chartLabel[x] != null) {
                var lab1 = response.chartLabel[x].labels;
                dateList[x] = lab1;
                x++;
            }

        } else if (selectedValue === 'Months') {
            while (response.monthLabel[x] != null) {
                var lab1 = response.monthLabel[x].labels;
                monthList[x] = lab1;
                x++;
            }
        } else {
            while (response.yearLabel[x] != null) {
                var lab1 = response.yearLabel[x].labels;
                yearList[x] = lab1;
                x++;
            }
        }

        x = 0;
        transactionChart.config.data.labels = [];
        salesChart.config.data.labels = [];

        if (selectedValue === 'Days') {
            transactionChart.config.data.labels = dateList;
            salesChart.config.data.labels = dateList;

        } else if (selectedValue === 'Months') {
            transactionChart.config.data.labels = monthList;
            salesChart.config.data.labels = monthList;
        } else {
            transactionChart.config.data.labels = yearList;
            salesChart.config.data.labels = yearList;
        }

        transactionChart.update();
        salesChart.update();

        const selectedType = chartTypeDropdown.value;
        var selected_data;
        switch (selectedType) {
            case "ncr":
                selected_data = response.custmerPerProvinceNCR
                break;
            case "region-1":
                selected_data = response.custmerPerProvinceRI
                break;
            case "region-2":
                selected_data = response.custmerPerProvinceRII
                break;
            case "region-3":
                selected_data = response.custmerPerProvinceRIII
                break;
            case "region-4a":
                selected_data = response.custmerPerProvinceRIVA
                break;
            case "mimaropa":
                selected_data = response.custmerPerProvinceMIMAROPA
                break;
            case "region-5":
                selected_data = response.custmerPerProvinceV
                break;
            case "car":
                selected_data = response.custmerPerProvinceCAR
                break;
            case "region-6":
                selected_data = response.custmerPerProvinceVI
                break;
            case "region-7":
                selected_data = response.custmerPerProvinceVII
                break;
            case "region-8":
                selected_data = response.custmerPerProvinceVIII
                break;
            case "region-9":
                selected_data = response.custmerPerProvinceIX
                break;
            case "region-10":
                selected_data = response.custmerPerProvinceX
                break;
            case "region-11":
                selected_data = response.custmerPerProvinceXI
                break;
            case "region-12":
                selected_data = response.custmerPerProvinceXII
                break;
            case "region-13":
                selected_data = response.custmerPerProvinceXIII
                break;
            case "barm":
                selected_data = response.custmerPerProvinceBARMM
                break;
        }
        // Remove old data
        constprovincesChart.data.labels = [];
        constprovincesChart.data.datasets.forEach((dataset) => {
            dataset.data = [];
        });

        //convert data into usable chartjs labels
        x = 0
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

        constprovincesChart.data.datasets = provinceData;
        constprovincesChart.config.data.labels = [];
        constprovincesChart.update();
        provinceData = [];

        // for transactionStatusChart / Transaction Status
        x = 0
        var TSChart1 = response.forTransactionStatusChart;

        var data1 = TSChart1.map(item => item.data);

        transactionStatusChart.config.data = {
            labels: ["Paid", "Cancelled", "Pending"],
            datasets: [{
                data: data1,
                backgroundColor: [
                    'rgba(0, 215, 132, 0.2)', //green
                    'rgba(241, 37, 150, 0.2)', //yellow
                    'rgba(229, 247, 48, 0.2)', //red


                ],
                borderColor: [
                    'rgba(0, 215, 132, 0.93)', //green
                    'rgba(241, 37, 150, 0.8)', //yellow
                    'rgba(229, 247, 48, 0.8)', //red


                ],
                borderWidth: 2
            }],
        }
        transactionStatusChart.update();

        //paymendtMethodChart
        x = 0
        var TSChart2 = response.forPaymendtMethodChart;

        var data2 = TSChart2.map(item => item.data);

        paymendtMethodChart.config.data = {
            labels: ["Over the Counter", "Online Payment", "Cheque"],
            datasets: [{
                data: data2,
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
        paymendtMethodChart.update();

        //transactionTypeChart
        x = 0
        var TSChart3 = response.forTransactionTypeChart;

        var data3 = TSChart3.map(item => item.data);

        transactionTypeChart.config.data = {
            labels: ["Technical Services", "NLIMS", "ULIMS"],
            datasets: [{
                data: data3,
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
        transactionTypeChart.update();

        //customerTypeChart
        x = 0
        var TSChart4 = response.forCustomerTypeChart;

        var data4 = TSChart4.map(item => item.data);

        customerTypeChart.config.data = {
            labels: ["Student", "Individual", "Private", "Government", "Internal", "Academe", "Not Applicable", ],
            datasets: [{
                data: data4,
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
        customerTypeChart.update();

        //myChart
        // myChart.config.data.datasets[2].data[0] = response.forMyChart[0].data;
        // myChart.config.data.datasets[3].data[0] = response.forMyChart[1].data;
        // myChart.update();

        let fDate = new Date(document.getElementById('startDate').value);
        let tDate = new Date(document.getElementById('endDate').value);

        const timeDifference = tDate.getTime() - fDate.getTime();
        const numberOfDays = Math.floor(timeDifference / (1000 * 3600 * 24)) + 1;
        const digi = response.forMyChartAvgTransaction[0].data
        const avgThis = Math.ceil(digi / numberOfDays);
        console.log(`Math.ceil( AVG: ${response.forMyChartAvgTransaction[0].data} / ${numberOfDays} = ${avgThis} )`); // mema lang to di yan actual formula

        document.getElementById('dailyTrans').innerHTML = digi;
        document.getElementById('avgTrans').innerHTML = avgThis;
        let number = parseInt(response.forMyChart[0].data)
        let fixedNumber = Math.round(number * 100) / 100;
        document.getElementById('dailyIncome').innerHTML = fixedNumber.toLocaleString("en-US");
    }
</script>

<script>
    function downloadPDF() {

        document.getElementById('sending-email-message').style.display = 'block';

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

        domtoimage.toPng(transactionChart, options)
            .then(function(transactionChartImg) {
                domtoimage.toPng(salesChart, options)
                    .then(function(salesChartImg) {
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
                                                                pdf.text('Total Transaction Report', 40, 25);
                                                                pdf.text('Total Income Report', 40, 115);
                                                                pdf.text('Total Customer Per Province', 40, 215);

                                                                pdf.setFont('helvetica', 'bold');
                                                                pdf.setTextColor(0, 41, 102);
                                                                pdf.setFontSize(14);
                                                                pdf.text('Visualight-Standards and Testing', 75, 10);

                                                                pdf.addImage(transactionChartImg, 'PNG', 40, 30, 130, 70, undefined, 'FAST');
                                                                pdf.addImage(salesChartImg, 'PNG', 40, 123, 130, 70, undefined, 'FAST');
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



                                                                pdf.save('Visualight-Standards and Testing.pdf');
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