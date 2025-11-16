<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VisitRoom;
use Yii;
/**
 * VisitRoomSearch represents the model behind the search form of `common\models\VisitRoom`.
 */
class VisitRoomSearch extends VisitRoom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'visit_id', 'client_id', 'card_id', 'status', 'register_id', 'modify_id', 'is_food_connected', 'doctor_id'], 'integer'],
            [['card_number', 'date_start', 'date_end', 'state', 'created', 'updated'], 'safe'],
            [['price', 'price_count'], 'number'],
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
        $query = VisitRoom::find()->orderBy(['id'=>SORT_DESC]);

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
            'room_id' => $this->room_id,
            'visit_id' => $this->visit_id,
            'client_id' => $this->client_id,
            'card_id' => $this->card_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'register_id' => $this->register_id,
            'modify_id' => $this->modify_id,
            'is_food_connected' => $this->is_food_connected,
            'price' => $this->price,
            'price_count' => $this->price_count,
            'doctor_id' => $this->doctor_id,
        ]);

        $query->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
