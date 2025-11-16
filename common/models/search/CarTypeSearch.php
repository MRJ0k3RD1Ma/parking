<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CarType;
use Yii;
/**
 * CarTypeSearch represents the model behind the search form of `common\models\CarType`.
 */
class CarTypeSearch extends CarType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'daily', 'onetime', 'hourly', 'hourly_enter', 'enter', 'free_time', 'status', 'register_id', 'modify_id'], 'integer'],
            [['name', 'type', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = CarType::find()->orderBy(['id'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);
        if($this->status == null){
            $this->status = 1;
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'daily' => $this->daily,
            'onetime' => $this->onetime,
            'hourly' => $this->hourly,
            'hourly_enter' => $this->hourly_enter,
            'enter' => $this->enter,
            'free_time' => $this->free_time,
            'status' => $this->status,
            'register_id' => $this->register_id,
            'modify_id' => $this->modify_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
