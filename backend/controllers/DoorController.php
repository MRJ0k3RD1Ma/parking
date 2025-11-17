<?php

namespace backend\controllers;

use common\models\Camera;
use common\models\Car;
use common\models\CarType;
use common\models\CarTypePlan;
use common\models\Client;
use common\models\Payment;
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
class DoorController extends Controller
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

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];


        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\QueryParamAuth::class,
            'tokenParam' => 'token',
            'except' => ['options'],
        ];

        return $behaviors;
    }

    public function actionIndex(){
        $post = Yii::$app->request->post();
        $plate = isset($post['plate']) ? $post['plate'] : '';
        $type_id = isset($post['type_id']) ? $post['type_id'] : '';
        $ip = isset($post['ip']) ? $post['ip'] : '';
        $payment_id = isset($post['payment_id']) ? $post['payment_id'] : '';

        if($plate and $ip){

            if($camera = Camera::findOne(['ipaddress'=>$ip,'status'=>1])){

                if($camera->type == 'ENTER' and $type_id){

                    $model = new Car();
                    $model->register_id = Yii::$app->user->id;
                    $model->modify_id = Yii::$app->user->id;
                    $model->type_id = $type_id;
                    $model->number = $plate;
                    $model->enter_time = date('Y-m-d H:i:s');
                    $model->camera_id = $camera->id;
                    $model->save();

                    return [
                        'success'=>true,
                        'data'=>[
                            'id'=>$model->id,
                            'plate'=>$model->number,
                            'type_id'=>$model->type_id,
                            'type'=>$model->type->name,
                            'price'=>$model->price,
                            'enter_time'=>$model->enter_time,
                            'exit_time'=>$model->exit_time,
                            'payment_id'=>$model->payment_id,
                            'status'=>$model->status,
                            'created'=>$model->created,
                            'updated'=>$model->updated,
                            'register_id'=>$model->register_id,
                            'modify_id'=>$model->modify_id,
                            'camera_enter_id'=>$model->camera_id,
                            'camera_exit_id'=>$model->camera_out_id,
                            'terminal_id'=>null,
                            'date_time'=>null,
                            'fiscal_sign'=>null,
                            'applet_version'=>null,
                            'qr_code_url'=>null,
                        ]
                    ];

                }else{
                    if($model = Car::find()->where(['status'=>1,'number'=>$plate])->andWhere(['is','payment_id',null])->orderBy(['id'=>SORT_DESC])->one()){
                        $price = $this->Calc($model);
                        $model->exit_time = date('Y-m-d H:i:s');
                        $model->price = $price;
                        $model->modify_id = Yii::$app->user->id;
                        $model->camera_out_id = $camera->id;

                        if($model->save()){
                            return [
                                'success'=>true,
                                'data'=>[
                                    'id'=>$model->id,
                                    'plate'=>$model->number,
                                    'type_id'=>$model->type_id,
                                    'type'=>$model->type->name,
                                    'price'=>$model->price,
                                    'enter_time'=>$model->enter_time,
                                    'exit_time'=>$model->exit_time,
                                    'payment_id'=>$model->payment_id,
                                    'status'=>$model->status,
                                    'created'=>$model->created,
                                    'updated'=>$model->updated,
                                    'register_id'=>$model->register_id,
                                    'modify_id'=>$model->modify_id,
                                    'camera_enter_id'=>$model->camera_id,
                                    'camera_exit_id'=>$model->camera_out_id,
                                    'terminal_id'=>null,
                                    'date_time'=>null,
                                    'fiscal_sign'=>null,
                                    'applet_version'=>null,
                                    'qr_code_url'=>null,
                                ]
                            ];
                        }else{
                            Yii::$app->response->setStatusCode(400);
                            return [
                                'success'=>false,
                                'message'=>'Ma`lumotni saqlashda xatolik',
                                'errors'=>$model->errors
                            ];
                        }
                    }
                    Yii::$app->response->setStatusCode(400);
                    return [
                        'success'=>false,
                        'message'=>'Bunday moshina topilmadi'
                    ];

                }



            }else{
                Yii::$app->response->setStatusCode(400);
                return [
                    'success' => false,
                    'message'=>'Bunday IP manzilli kamera topilmadi'
                ];
            }

        }
        Yii::$app->response->setStatusCode(400);
        return [
            'success'=>false,
            'message'=>'Ma`lumotlar yetarli emas'
        ];
    }


    public function actionSetfiscal($id)
    {
        $post = Yii::$app->request->post();
        $model = Car::find()->where(['id'=>$id])->one();
        $payment_id = isset($post['payment_id']) ? $post['payment_id'].'' : '';
        $terminal_id = isset($post['terminal_id']) ? $post['terminal_id'].'' : '';
        $date_time = isset($post['date_time']) ? $post['date_time'].'' : '';
        $fiscal_sign = isset($post['fiscal_sign']) ? $post['fiscal_sign'].'' : '';
        $applet_version = isset($post['applet_version']) ? $post['applet_version'].'' : '';
        $qr_code_url = isset($post['qr_code_url']) ? $post['qr_code_url'] .'': '';

        if($terminal_id and $date_time and $fiscal_sign and $applet_version and $qr_code_url){
            $model->terminal_id = $terminal_id;
            $model->date_time = $date_time;
            $model->fiscal_sign = $fiscal_sign;
            $model->applet_version = $applet_version;
            $model->qr_code_url = $qr_code_url;
            $model->payment_id = $payment_id;
            $model->save(false);
            return [
                'success'=>true,
                'data'=>[
                    'id'=>$model->id,
                    'plate'=>$model->number,
                    'type_id'=>$model->type_id,
                    'type'=>$model->type->name,
                    'price'=>$model->price,
                    'enter_time'=>$model->enter_time,
                    'exit_time'=>$model->exit_time,
                    'payment_id'=>$model->payment_id,
                    'status'=>$model->status,
                    'created'=>$model->created,
                    'updated'=>$model->updated,
                    'register_id'=>$model->register_id,
                    'modify_id'=>$model->modify_id,
                    'camera_enter_id'=>$model->camera_id,
                    'camera_exit_id'=>$model->camera_out_id,
                    'terminal_id'=>$model->terminal_id,
                    'date_time'=>$model->date_time,
                    'fiscal_sign'=>$model->fiscal_sign,
                    'applet_version'=>$model->applet_version,
                    'qr_code_url'=>$model->qr_code_url,
                ]
            ];
        }
        Yii::$app->response->setStatusCode(400);
        return [
            'success'=>false,
            'message'=>'Ma`lumotlar yetarli emas'
        ];

    }
    
    function Calc($model){
        $free = false;
        if(Client::find()->where(['status'=>1,'number'=>$model->number])->andWhere(['>','deadline',date('Y-m-d H:i:s')])->exists()){
            $free = true;
        }
        $calctype = Yii::$app->params['calculatetype'];
        $price = 0;
        $plan = $model->type;
        if(!$free){
            $times = $this->calcTimes($model->enter_time,$model->exit_time);
            if($calctype == '1D'){
                $price = $times['days'] * $plan->daily;
            }
            if($calctype == '1T'){
                $price = $plan->onetime;
            }
            if($calctype == '1H' or $calctype == '1HI'){
                if($times['days'] > 1){
                    if($top = CarTypePlan::find()->where(['status'=>1,'type_id'=>$plan->id])->orderBy(['hour'=>SORT_DESC])->one()){
                        $price = $times['days'] * $top->price;
                    }else{
                        $price = 0;
                    }
                }elseif($times['hours'] > 1){
                    $top = CarTypePlan::find()->where(['status'=>1,'type_id'=>$plan->id])->andWhere('(`hour` > '.$times['hours'].') or ()')->orderBy(['hour'=>SORT_ASC])->one();
                    if(!$top){
                        $top = CarTypePlan::find()
                            ->where(['status' => 1, 'type_id' => $plan->id])
                            ->orderBy(['hour' => SORT_DESC])
                            ->one();
                    }
                    $price = $top->price;
                }else{
                    $min = CarTypePlan::find()->where(['status'=>1,'type_id'=>$plan->id])->orderBy(['hour'=>SORT_ASC])->one();
                    if($plan->free_time > $times['minutes']){
                        $price = 0;
                    }else{
                        $price = $min->price;
                    }
                }
            }
            if($calctype == '1HI'){
                $price += $plan->enter;
            }
        }
        return $price;
    }


    public function actionType()
    {
        $model = CarType::find()->where(['status'=>1,'type'=>Yii::$app->params['calculatetype']])->all();
        return [
            'success'=>true,
            'data'=>ArrayHelper::toArray($model)
        ];
    }

    public function actionPayment()
    {
        $model = Payment::find()->where(['status'=>1])->all();
        return [
            'success'=>true,
            'data'=>ArrayHelper::toArray($model)
        ];
    }
    function calcTimes($datetime_from,$datetime_to){
        $from = new \DateTime($datetime_from);
        $to   = new \DateTime($datetime_to);

        $diff = $from->diff($to);

// KUN
        $days = $diff->days;

// SOAT (faqat farqdagi soatlar)
        $hours = $diff->h + ($diff->days * 24);

// MINUT (faqat farqdagi minutlar)
        $minutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

        return [
            'days' => $days+1,
            'hours' => $hours,
            'minutes' => $minutes,
        ];
    }



}