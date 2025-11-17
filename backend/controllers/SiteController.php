<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\User;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter'=>[
                'class' => Cors::class,
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }
    public function actionOptions()
    {
        if (Yii::$app->request->method === 'OPTIONS') {
            Yii::$app->response->statusCode = 200;
            return null;
        }
    }
    public function getphone($phone){
        $phone_new = "";
        if(strlen($phone) < 9 ){
            return false;
        }
        for ($i=0; $i<strlen($phone);  $i++){
            if('0'<=$phone[$i] and $phone[$i] <= '9'){
                $phone_new.= $phone[$i];
            }
        }
        if(strlen($phone_new) > 9){
            if($phone_new[0]=='9' and $phone_new[1]=='9' and $phone_new[2]=='8'){
                $phone_new = substr($phone_new,3,strlen($phone_new));
            }else{
                return false;
            }
        }
//        (99)967-0395

        return '('.substr($phone_new,0,2).')'.substr($phone_new,2,3).'-'.substr($phone_new,5,4);
    }
    public function actionLogin(){

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->getBodyParams(),'')) {
            if($model->login()){

                $user = Yii::$app->user->identity;

                $token = Yii::$app->security->generateRandomString(64);

                $user->access_token = $token;
                $user->save(false);
                return [
                    'success'=>true,
                    'token' => (string) $token,
                    'data' => $user,
                    'fiscal'=>[
                        'mxik'=>Yii::$app->params['fiscal']['mxik'],
                        "inn"=>Yii::$app->params['fiscal']['inn'],
                        'company_name' => Yii::$app->params['fiscal']['company_name'],
                        'vat_percent'=>Yii::$app->params['fiscal']['vat_percent'],
                        'mxik_name'=>Yii::$app->params['fiscal']['mxik_name'],
                    ],
                ];
            }else{
                return [$model->getFirstErrors()];
            }
        } else {
            throw new HttpException(400, 'Bad request');
        }
    }

    public function actionLoginPin()
    {
        $post = Yii::$app->request->post();
        $pin = $post['pin'];
        $model = new LoginForm();
        $user = User::findOne(['pin'=>$pin]);
        if($user){

            $token = Yii::$app->security->generateRandomString(64);
            $user->access_token = $token;
            $user->save(false);

            return [
                'success'=>true,
                'token' => (string) $token,
                'data' => $user,
                'fiscal'=>[
                    'mxik'=>Yii::$app->params['fiscal']['mxik'],
                    "inn"=>Yii::$app->params['fiscal']['inn'],
                    'comapny_name' => Yii::$app->params['fiscal']['company_name'],
                    'vat_percent'=>Yii::$app->params['fiscal']['vat_percent'],
                    'mxik_name'=>Yii::$app->params['fiscal']['mxik_name']
                ],
            ];
        }else{
            Yii::$app->response->statusCode = 401;
            return [
                'success'=>false,
                'message'=>'Pin kod xato'
            ];
        }
    }



    public function actionSoliq()
    {
        $post = Yii::$app->request->post();
        $method = $post['method'];
        if($method == 'sale-services'){
            return [
                "msg"=> "succes",
                "code"=> "0",
                "resInfo"=> [
                    "jsonrpc"=> "2.0",
                    "result"=> [
                        "TerminalID"=> "UZ191211501012",
                        "ReceiptSeq"=> "1847",
                        "DateTime"=> "20241014121646",
                        "FiscalSign"=> "454042927337",
                        "AppletVersion"=> "0323",
                        "QRCodeURL"=> "https://ofd.soliq.uz/check?t=UZ191211501012&r=1847&c=20241014121646&s=454042927337"
                    ],
                    "id"=> 1
                ]
            ];
        }else{
            return [
                "msg"=> "succes",
                "code"=> "0",
                "resInfo"=> [
                    "token"=> "00120000010b02056a200014003100314090",
                    "date"=> "2024-10-14 10:12:43"
                ]
            ];
        }

    }

}