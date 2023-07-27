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
    .header
    {
        color: #0362BA;
        font-family: Poppins;
        font-size: 2rem;
        font-weight: 600;
        line-height: normal;
        letter-spacing: 3px;
        border-bottom: solid 0.2vh;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header img
    {
        float: right;
        height: 3rem;
    }
    
    .DailyTransaction
    {
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

        
    }
    .deptransaction
    {
        width: 32%;
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
        display:inline-block;
    }
    .deptransaction img
    {
        float: left;
        margin-left: .625rem;
    }
    #valueIncrease
    {
        font-size: 1.5rem;
        font-weight: 400;
        letter-spacing: 3.6px;
        grid-column: 3; /* Position this div in the second column */
        text-align: right; /* Align the text to the right (bottom right) */
        padding-top: 40px;
       
    }
    #dailyTrans
    {
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

</style>
<?= 
    $m="";
    // metrology transaction
    $lastmettrans=5;
    $todaymettrans=3;
    $metdailytransincrease = (($todaymettrans - $lastmettrans) /$todaymettrans) * 100;
    $metdailytransincrease = number_format($metdailytransincrease, 2);
    if($metdailytransincrease>1)
    {
        $metdailytransincrease = '+'.$metdailytransincrease . '%';

        
    }
    else
    {
        $metdailytransincrease = $metdailytransincrease . '%';
    }

    //S&T transaction
    $lastSandTtrans=2;
    $todaySandTtrans=10;
    $SandTdailytransincrease = (($todaySandTtrans - $lastSandTtrans) / $todaySandTtrans) * 100;
    $SandTdailytransincrease = number_format( $SandTdailytransincrease, 2);
    if($SandTdailytransincrease>1)
    {
        $SandTdailytransincrease = '+'.$SandTdailytransincrease . '%';
    }
    else
    {
        $metdailytransincrease = $metdailytransincrease . '%';
    }
    //T&S transaction
    $lastTandStrans=6;
    $todayTandStrans=100;
    $TandSdailytransincrease = (($todayTandStrans - $lastTandStrans) / $todayTandStrans) * 100;
    $TandSdailytransincrease = number_format( $TandSdailytransincrease, 2);
    if($TandSdailytransincrease>1)
    {
        $TandSdailytransincrease = '+'.$TandSdailytransincrease . '%';
    }
    else
    {
        $metdailytransincrease = $metdailytransincrease . '%';
    }


    ?>

    <div class="header">
        <!-- <div class="header-grid"> -->
            <p>Dashboard</p>
            <img src="/images/LogoVL.png" alt="visLogo" >
        <!-- </div> -->
    </div> <br>

<div class="DailyTransaction">
    <p>Total Transactions Daily</p>

    <div class="deptransaction">
        <p>National Metrology</p>
        <div class="grid">
        <img src="/images/Pressure Gauge.png" alt="icon1">
        <p id="dailyTrans"><?=$todaymettrans?></p>
        <p id="valueIncrease"><?= $metdailytransincrease?></p>
        </div>
    </div>
    <div class="deptransaction" style="background-color:#02A560;">
        <p>Standards and Testing</p>
        <div class="grid">
        <img src="/images/Pass Fail.png" alt="icon2">
        <p id="dailyTrans"><?=$todaySandTtrans?></p>
        <p id="valueIncrease"><?= $SandTdailytransincrease?></p>
        </div>
    </div>
    <div class="deptransaction" style="background-color:#F21A9C;">
        <p>Technological Services</p>
        <div class="grid">
        <img src="/images/Service.png" alt="icon3">
        <p id="dailyTrans"><?=$todayTandStrans?></p>
        <p id="valueIncrease"><?= $TandSdailytransincrease?></p>
        </div>
    </div>

</div>





<div class="container-fluid">
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
                'id' => $infoBox->id.'-ribbon',
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
                'id' => $smallBox->id.'-ribbon',
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
</div>