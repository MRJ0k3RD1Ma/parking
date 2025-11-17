<?php

namespace backend\controllers;

use common\models\Camera;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use common\models\User;

/**
 * User REST API Controller
 */
class CameraController extends Controller
{

    /**
     * Behaviors configuration
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // CORS - eng birinchi bo'lishi kerak!
        $behaviors['corsFilter']= [
            'class' => Cors::class,
        ];
        // Content negotiation - JSON formatda javob qaytaradi
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        // Bearer Token autentifikatsiya
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\QueryParamAuth::class,
            'tokenParam' => 'token',
            'except' => ['options'],
        ];

        return $behaviors;
    }

    public function actionIndex(){
        $model = Camera::find()->where(['status'=>1])->all();
        return [
            'success'=>true,
            'data'=>ArrayHelper::toArray($model),
        ];
    }

    public function actionByIp($ip){
        if($model = Camera::find()->where(['ipaddress'=>$ip,'status'=>1])->one()){
            return [
                'success'=>true,
                'data'=>$model->toArray(),
            ];
        }
        Yii::$app->response->statusCode = 404;
        return [
            'success'=>false,
            'message'=>'Kamera topilmadi'
        ];
    }

}