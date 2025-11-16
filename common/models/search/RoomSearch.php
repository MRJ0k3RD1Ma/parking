<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Room;
use Yii;
/**
 * RoomSearch represents the model behind the search form of `common\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'departament_id', 'capacity', 'count_patient', 'user_id', 'status', 'register_id', 'modify_id'], 'integer'],
            [['name', 'state', 'created', 'updated'], 'safe'],
            [['price', 'price_food'], 'number'],
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
        $query = Room::find()->orderBy(['id'=>SORT_DESC]);

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
            'departament_id' => $this->departament_id,
            'capacity' => $this->capacity,
            'count_patient' => $this->count_patient,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'price_food' => $this->price_food,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'register_id' => $this->register_id,
            'modify_id' => $this->modify_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
