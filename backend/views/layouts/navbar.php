<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<!-- <div style="position: relati; top: 0; width: 100%; z-index:50;"> -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link">Home</a> -->
        </li>

    </ul>
    </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <li class="nav-item">
            <img src="/images/LogoVL.png" alt="visLogo" style="height: 2rem; left: 10px;">

        </li>
        <li class="nav-item">
            <!-- <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a> -->
        </li>
        <li class="nav-item" >
            <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"> -->
            <!-- <i class="fas fa-th-large"></i> -->
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>


            </a>
        </li>
    </ul>
</nav>
<!-- </div> -->
<!-- /.navbar -->