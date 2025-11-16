<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.payment".
 *
 * @property int $id
 * @property string $name
 * @property string $key
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $register_id
 * @property int|null $modify_id
 *
 * @property User $register
 * @property User $modify
 */
class Payment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'md_parking.payment';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'register_id', 'modify_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['key'], 'in', 'range' => ['cash', 'card', 'bank']],

            [['register_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class, 'targetAttribute' => ['register_id' => 'id']
            ],
            [['modify_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class, 'targetAttribute' => ['modify_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Nomi',
            'key'         => 'Turi',
            'status'      => 'Status',
            'created'     => 'Kiritildi',
            'updated'     => 'O`zgartirildi',
            'register_id' => 'Kiritdi',
            'modify_id'   => 'O`zgartirdi',
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
}
