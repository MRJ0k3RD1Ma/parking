<?php

namespace frontend\modules\cp\controllers;

use common\models\Client;
use common\models\ClientPaid;
use common\models\LocDistrict;
use common\models\search\ClientPaidSearch;
use common\models\search\ClientSearch;
use frontend\components\Common;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCredit()
    {
        $searchModel = new ClientSearch();
        $searchModel->show_type = 'credit';
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDebt()
    {
        $searchModel = new ClientSearch();
        $searchModel->show_type = 'debit';
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPay($id){
        $model = new ClientPaid();
        $model->client_id = $id;
        if($model->load($this->request->post())){
            $model->register_id = Yii::$app->user->id;
            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
                Common::calcPriceClient($id);
            }else{
                Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$id]);
        }
        return $this->renderAjax('_pay', [
            'model' => $model,
        ]);
    }
    public function actionPayUpdate($id){

        $model = ClientPaid::findOne($id);

        if($model->load($this->request->post())){
            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
                Common::calcPriceClient($model->client_id);
            }else{
                Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$model->client_id]);
        }
        return $this->renderAjax('_pay', [
            'model' => $model,
        ]);
    }

    public function actionPayDelete($id)
    {
        $model = ClientPaid::findOne($id);
        $model->status = -1;
        $model->modify_id = Yii::$app->user->id;
        if($model->save()){
            Yii::$app->session->setFlash('success','Amal bajarildi');
            Common::calcPriceClient($model->client_id);
        }else{
            Yii::$app->session->setFlash('error','Amalni bajarishda xatolik');
        }
        return $this->redirect(['view','id'=>$model->client_id]);
    }

    /**
     * Displays a single Client model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchPaidModel = new ClientPaidSearch();
        $searchPaidModel->client_id = $id;
        $dataPaidProvider = $searchPaidModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchPaidModel' => $searchPaidModel,
            'dataPaidProvider' => $dataPaidProvider,
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Client();
        $model->region_id = "1733";
        $model->district_id = "1733401";
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->register_id = Yii::$app->user->id;
                $model->modify_id = Yii::$app->user->id;
                if($model->save()){
                    if($model->source_id == 1){
                        $phone = Common::phoneNumber($model->phone);
                        $text = "Yangi referal \r\nIsmi:{$model->name} \r\nTel: {$phone}\r\n{$model->source->name}";
                        Common::sendInfoAboutReferal($text);
                    }
                    Yii::$app->session->setFlash('success','Ma`lumot muvoffaqiyatli saqlandi');
                    return $this->redirect(['view','id'=>$model->id]);

                }else{
                    Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $source_id = $model->source_id;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->source_id != 1 and $source_id == 1){
                $phone = Common::phoneNumber($model->phone);
                $text = "Referal ma`lumoti o`zgartirildi \r\nIsmi:{$model->name} \r\nTel: {$phone}\r\n{$model->source->name}";

                Common::sendInfoAboutReferal($text);
            }
            if($model->source_id == 1 and $source_id != 1){
                $phone = Common::phoneNumber($model->phone);
                $text = "Referal ma`lumoti o`zgartirildi \r\nIsmi:{$model->name} \r\nTel: {$phone}\r\n{$model->source->name}";

                Common::sendInfoAboutReferal($text);
            }
            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
            Yii::$app->session->setFlash('success','Ma`lumot muvoffaqiyatli saqlandi');
            }else{
            Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['view','id'=>$model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = -1;
        $model->modify_id = Yii::$app->user->id;
        if($model->save()){
            Yii::$app->session->setFlash('success','Ma`lumot o`chirildi');
        }else{
            Yii::$app->session->setFlash('success','Ma`lumotni o`chirishda xatolik');
        }
        return $this->redirect(['index']);
    }

    public function actionGetDistrictByRegionId($id){
        $model = LocDistrict::find()->where(['status'=>1])->all();
        $res = "";
        foreach ($model as $item){
            $res .= "<option value='".$item->id."'>".$item->name."</option>";
        }
        return $res;
    }


    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
