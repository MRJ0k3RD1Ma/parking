<?php

namespace backend\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;
use common\models\User;

/**
 * User REST API Controller
 */
class UserController extends Controller
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

    public function actionOptions()
    {
        if (Yii::$app->request->method === 'OPTIONS') {
            Yii::$app->response->statusCode = 200;
            return null;
        }
    }

    public function actionMe(){
        $user = Yii::$app->user->identity;
        return [
            'success'=>true,
            'data'=>$user,
            'fiscal'=>[
                'mxik'=>Yii::$app->params['mxik'],
                "inn"=>Yii::$app->params['inn'],
                'comapny_name' => Yii::$app->params['company_name'],
                'vat_percent'=>Yii::$app->params['vat_percent']
            ],
        ];
    }

    public function actionLogout(){
        $user = Yii::$app->user->identity;
        $user->access_token = null;
        $user->save(false);
        Yii::$app->user->logout();
        return [
            'success'=>true,
            'message'=>'User logged out',
        ];
    }

}