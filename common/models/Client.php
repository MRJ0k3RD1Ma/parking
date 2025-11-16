<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.client".
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property string|null $number
 * @property int|null $type_id
 * @property int|null $price
 * @property string|null $deadline
 * @property string|null $contract_type
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $register_id
 * @property int|null $modify_id
 *
 * @property User $register
 * @property User $modify
 * @property CarType $type
 */
class Client extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'client';
    }

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['phone', 'type_id', 'price', 'status', 'register_id', 'modify_id'], 'integer'],
            [['deadline', 'created', 'updated','contract_type',], 'safe'],

            [['name', 'number'], 'string', 'max' => 255],

            [['register_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['register_id' => 'id']
            ],
            [['modify_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['modify_id' => 'id']
            ],
            [['type_id'], 'exist', 'skipOnError' => true,
                'targetClass' => CarType::class,
                'targetAttribute' => ['type_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Nomi',
            'phone'       => 'Telefon',
            'number'      => 'Moshina raqami',
            'type_id'     => 'Turi',
            'price'       => 'Narxi',
            'deadline'    => 'Muddat',
            'status'      => 'Status',
            'created'     => 'Kiritildi',
            'updated'     => 'O`zgartirildi',
            'register_id' => 'Kiritdi',
            'modify_id'   => 'O`zgartirdi',
            'contract_type'   => 'Shartnoma turi',
        ];
    }

    public function getRegister()
    {
        return $this->hasOne(User::class, ['id' => 'register_id']);
    }

    public function getModify()
    {
        return $this->hasOne(User::class, ['id' => 'modify_id']);
    }

    public function getType()
    {
        return $this->hasOne(CarType::class, ['id' => 'type_id']);
    }
}
