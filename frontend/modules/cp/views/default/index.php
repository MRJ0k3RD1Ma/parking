<?php $this->title = 'Dashboard';

$this->registerJsFile('@web/design/src/plugins/apexcharts/apexcharts.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/design/src/plugins/apexcharts/apexcharts.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <a href="<?= Yii::$app->urlManager->createUrl(['/cp/paid/','PaidSearch[period_start]'=>date('Y-m-d'),'PaidSearch[period_end]'=>date('Y-m-t')])?>">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            <?= number_format(
                                    round(
                                           0
                                            ,0

                                    ),0,'.',' ')
                            ?> so'm</div>
                        <div class="font-14 text-secondary weight-500">
                            (<?= Yii::$app->params['month'][intval(date('m'))]?>) tushum
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-24-hours"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>
