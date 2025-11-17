<?php

namespace frontend\modules\cp\controllers;

use common\models\CarType;
use common\models\CarTypePlan;
use common\models\search\CarTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * CarTypeController implements the CRUD actions for CarType model.
 */
class CarTypeController extends Controller
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
     * Lists all CarType models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CarTypeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarType model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CarType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CarType();
        $model->type = Yii::$app->params['calculatetype'];
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->register_id = Yii::$app->user->id;
                $model->modify_id = Yii::$app->user->id;
                if($model->save()){
                    if($model->type == "1H" or $model->type == "1HI"){
                        $plan = $model->plan;
                        foreach ($plan as $key => $value) {
                            $m = new CarTypePlan();
                            $m->register_id = $model->register_id;
                            $m->modify_id = $model->modify_id;
                            $m->type_id = $model->id;
                            $m->hour = $value['hour'];
                            $m->price = $value['price'];
                            $m->save();
                        }
                    }
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
     * Updates an existing CarType model.
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
                    if($model->type == "1H" or $model->type == "1HI"){
                        foreach ($model->plans as $key => $value) {
                            $value->status = -1;
                            $value->save(false);
                        }
                        $plan = $model->plan;
                        foreach ($plan as $key => $value) {
                            if($m = CarTypePlan::find()->where(['id'=>$key,'type_id'=>$model->id])->one()){
                                $m->modify_id = $model->modify_id;
                                $m->type_id = $model->id;
                                $m->hour = $value['hour'];
                                $m->price = $value['price'];
                                $m->status = 1;
                                $m->save();
                            }else{
                                $m = new CarTypePlan();
                                $m->register_id = $model->register_id;
                                $m->modify_id = $model->modify_id;
                                $m->type_id = $model->id;
                                $m->hour = $value['hour'];
                                $m->price = $value['price'];
                                $m->save();
                            }
                        }
                    }
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
     * Deletes an existing CarType model.
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

    /**
     * Finds the CarType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CarType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarType::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
