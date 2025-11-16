<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Visit;
use Yii;
/**
 * VisitSearch represents the model behind the search form of `common\models\Visit`.
 */
class VisitSearch extends Visit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'departament_id', 'status', 'register_id', 'modify_id', 'is_emergency', 'is_onetime_payment'], 'integer'],
            [['price'], 'number'],
            [['description', 'state', 'created', 'updated', 'emergency_car', 'visit_date'], 'safe'],
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
        $query = Visit::find()->orderBy(['id'=>SORT_DESC]);

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
            'client_id' => $this->client_id,
            'departament_id' => $this->departament_id,
            'price' => $this->price,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'register_id' => $this->register_id,
            'modify_id' => $this->modify_id,
            'is_emergency' => $this->is_emergency,
            'is_onetime_payment' => $this->is_onetime_payment,
            'visit_date' => $this->visit_date,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'emergency_car', $this->emergency_car]);

        return $dataProvider;
    }
}
