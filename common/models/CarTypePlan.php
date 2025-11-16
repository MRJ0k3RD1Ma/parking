<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.car_type_plan".
 *
 * @property int $id
 * @property int|null $type_id
 * @property int|null $hour
 * @property int|null $price
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status
 * @property int|null $register_id
 * @property int|null $modify_id
 *
 * @property CarType $type
 * @property User $register
 * @property User $modify
 */
class CarTypePlan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'car_type_plan';
    }

    public function rules()
    {
        return [
            [['type_id', 'hour', 'status', 'register_id', 'modify_id','price'], 'integer'],
            [['created', 'updated'], 'safe'],

            [['type_id'], 'exist', 'skipOnError' => true,
                'targetClass' => CarType::class,
                'targetAttribute' => ['type_id' => 'id']
            ],

            [['register_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['register_id' => 'id']
            ],

            [['modify_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['modify_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'type_id'     => 'Moshina turi',
            'hour'        => 'Soat',
            'price'       => 'narxi',
            'created'     => 'Kiritildi',
            'updated'     => 'O`zgartirildi',
            'status'      => 'Status',
            'register_id' => 'Kiritdi',
            'modify_id'   => 'O`zgartirdi',
        ];
    }

    public function getType()
    {
        return $this->hasOne(CarType::class, ['id' => 'type_id']);
    }

    public function getRegister()
    {
        return $this->hasOne(User::class, ['id' => 'register_id']);
    }

    public function getModify()
    {
        return $this->hasOne(User::class, ['id' => 'modify_id']);
    }
}
