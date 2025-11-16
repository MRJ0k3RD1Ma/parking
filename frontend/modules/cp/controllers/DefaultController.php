<?php

namespace frontend\modules\cp\controllers;

use common\models\Client;
use frontend\components\Common;
use yii\web\Controller;
use Yii;
use yii\web\Response;

/**
 * Default controller for the `cp` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($year = null)
    {
        if(!$year){
            $year = date('Y');
            $month_number = date('m');
        }else{
            $month_number = 1;
        }
        return $this->render('index',[
            'year' => $year,
            'month_number'=>$month_number,
        ]);
    }



}
