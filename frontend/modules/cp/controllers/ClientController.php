<?php

namespace frontend\modules\cp\controllers;

use common\models\Client;
use common\models\ClientPaid;
use common\models\search\ClientPaidSearch;
use common\models\search\ClientSearch;
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

    /**
     * Displays a single Client model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ClientPaidSearch();
        $searchModel->client_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
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
        $model->deadline = date('Y-m-d');

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->register_id = Yii::$app->user->id;
                $model->modify_id = Yii::$app->user->id;
                if($model->save()){
                    Yii::$app->session->setFlash('success','Ma`lumot muvoffaqiyatli saqlandi');
                }else{
                    Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
                }
                return $this->redirect(['index']);
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

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
            Yii::$app->session->setFlash('success','Ma`lumot muvoffaqiyatli saqlandi');
            }else{
            Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
            }
            return $this->redirect(['index']);
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

    public function actionPay($id)
    {
        $model = new ClientPaid();
        $model->client_id = $id;
        $model->date = date('Y-m-d');
        $model->deadline = date('Y-m-d');
        if($model->load($this->request->post())){
            $model->register_id = Yii::$app->user->id;
            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
                $client = $model->client;
                $client->deadline = $model->deadline;
                $client->save(false);
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
            }else{
                Yii::$app->session->setFlash('error','Ma`lumot saqlashda xatolik');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->renderAjax('pay', [
            'model' => $model,
        ]);
    }

    public function actionPayupdate($id)
    {
        $model = ClientPaid::findOne($id);
        if($model->load($this->request->post())){
            $model->register_id = Yii::$app->user->id;
            $model->modify_id = Yii::$app->user->id;
            if($model->save()){
                $client = $model->client;
                $client->deadline = $model->deadline;
                $client->save(false);
                Yii::$app->session->setFlash('success','Ma`lumot saqlandi');
            }else{
                Yii::$app->session->setFlash('error','Ma`lumot saqlashda xatolik');
            }
            return $this->redirect(['view', 'id' => $model->client_id]);
        }
        return $this->renderAjax('pay', [
            'model' => $model,
        ]);
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
