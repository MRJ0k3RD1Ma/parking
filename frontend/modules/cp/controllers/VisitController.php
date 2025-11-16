<?php

namespace frontend\modules\cp\controllers;

use common\models\Client;
use common\models\LocDistrict;
use common\models\Visit;
use common\models\search\VisitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * VisitController implements the CRUD actions for Visit model.
 */
class VisitController extends Controller
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
     * Lists all Visit models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VisitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Visit model.
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
     * Creates a new Visit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Visit();
        $client = new Client();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->register_id = Yii::$app->user->id;
                $model->modify_id = Yii::$app->user->id;
                if($model->save()){
                    Yii::$app->session->setFlash('success','Ma`lumot muvoffaqiyatli saqlandi');
                }else{
                    Yii::$app->session->setFlash('error','Ma`lumotni saqlashda xatolik');
                }
                return $this->redirect(['view','id'=>$model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'client' => $client,
        ]);
    }

    public function actionSearch($name = null, $phone = null)
    {
        $model = Client::find()->where(['status'=>1]);
        if($name){
            $model->andFilterWhere(['like','name',$name]);
        }
        if($phone){
            $model->andFilterWhere(['like','phone',str_replace('_', '', $phone)]);
        }
        $model = $model->all();
        if(count($model)>0){
            $res = "";
            foreach ($model as $item){
                $words = explode(' ', $item->name);
                $result = '';

                foreach ($words as $word) {
                    $result .= mb_substr($word, 0, 2); // har bir so‘zning 2 ta harfini oladi
                }

                $res .= "<li class='liveuser-item' onclick='setUser( {$item->id} )'>
                    <div class='avatar'>{$result}</div>
                    <div class='info'>
                        <div class='title'>{$item->name}</div>
                        <div class='sub'>{$item->phone}</div>
                    </div>
                </li>";

            }
            return $res;
        }else{
            return -1;
        }
    }

    public function actionGetuser($id){
        $model = Client::findOne($id);
        if($model){
            $dist = LocDistrict::find()->where(['region_id'=>$model->region_id])->all();
            $res = "";
            foreach ($dist as $item){
                $res .= "<option value='{$item->id}'>{$item->name}</option>";
            }
            return json_encode([
                'id'=>$model->id,
                'name'=>$model->name,
                'phone'=>$model->phone,
                'group_id'=>$model->group_id,
                'gender'=>$model->gender,
                'birthday'=>$model->birthday,
                'region_id'=>$model->region_id,
                'district_id'=>$model->district_id,
                'districts'=>$res,
                'address'=>$model->address,
                'source_id'=>$model->source_id,
                'description'=>$model->description,
            ]);
        }else{
            return -1;
        }
    }


    /**
     * Updates an existing Visit model.
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
            return $this->redirect(['view','id'=>$model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Visit model.
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
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
