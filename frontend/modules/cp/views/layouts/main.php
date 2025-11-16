<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>


        <style>
            .pagination a, .pagination span {
                text-decoration: none;
                color: #000;
                float: left;
                padding: 8px 16px;
            }

            .pagination li.active a {
                background-color: #4CAF50;
                color: #FFF;
                border-radius: 5px;
            }
            .pagination a:hover:not(.active) {
                background-color: #DDD;
                border-radius: 5px;
            }
            .oneline{
                flex: 1 1 auto;       /* kengayadi, qolgan joyni oladi */
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
                display: block;
                line-height: 1.4;
                max-width: 250px;
                word-break: normal; /* so'zlarni kesishni nazorat qilish */
                transition: max-height 0.25s ease; /* ixtiyoriy vizual yumshatuvchi effekt */
            }
            /* tooltip stili (hoverda paydo bo'ladi) */
            .oneline[data-full]:hover::after{
                content: attr(data-full);
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                bottom: 100%; /* element ustida paydo bo'ladi */
                margin-bottom: 8px;
                white-space: normal; /* ko'pi bilan yangi qatorlarga o'tsin */
                max-width: 400px; /* tooltip kengligi */
                width:300px;
                padding: 8px 10px;
                border-radius: 6px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.25);
                background: #222;
                color: #fff;
                font-size: 13px;
                line-height: 1.3;
                z-index: 9999;
            }

            /* kichik uchburchak (tooltip ostida) */
            .oneline[data-full]:hover::before{
                content: "";
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                bottom: 100%;
                margin-bottom: 2px;
                border-width: 6px;
                border-style: solid;
                border-color: transparent transparent #222 transparent;
                z-index: 9999;
            }
            @media (hover: none){
                .oneline[data-full]:active::after,
                .oneline[data-full]:active::before{ display: block; }
            }
        </style>
    </head>
    <body class="sidebar-light header-white">
    <?php $this->beginBody() ?>






    <?= $this->render('_header'); ?>


    <?= $this->render('_left_sidebar')?>


    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4><?= $this->title ?></h4>
                            </div>

                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="mb-30">
                    <div class="pb-20">

                        <?= $content?>

                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                MEDICRM.UZ - <a href="tel:+998335130007" target="_blank">Ruslan Raximberganov TEL: +998(33)513-00-07</a> All rights reserved &copy;<?= date('Y')?>
            </div>
        </div>

    </div>


    <div class="modal" id="md-modalcreate" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yangi ma'lumot qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-modalcreate">

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="md-modalupdate" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Ma'lumotlarni yangilash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-modalupdate">

                </div>
            </div>
        </div>
    </div>



    <?php
        $this->registerJs("
            $('.md-btncreate').click(function(){
                var val = $(this).val();
                $('#md-modalcreate').modal('show').find('.modal-body.md-modalcreate').load(val);
            });
             $('.md-btnupdate').click(function(){
                var val = $(this).val();
                $('#md-modalupdate').modal('show').find('.modal-body.md-modalupdate').load(val);
            })
        ");
    ?>

    <?php
    if(Yii::$app->session->hasFlash('error')){
        $txt = Yii::$app->session->getFlash('error');
        $this->registerJs("
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '{$txt}',
        })
    ");
    }
    if(Yii::$app->session->hasFlash('success')){
        $txt = Yii::$app->session->getFlash('success');
        $this->registerJs("
        Swal.fire({
          icon: 'success',
          title: 'Good job!',
          text: '{$txt}',
        })
    ");
    }

    ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
