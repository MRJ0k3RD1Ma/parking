<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "md_parking.camera".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $ipaddress
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $register_id
 * @property int|null $modify_id
 *
 * @property User $register
 * @property User $modify
 */
class Camera extends ActiveRecord
{
    public static function tableName()
    {
        return 'camera';
    }

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['status', 'register_id', 'modify_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'ipaddress'], 'string', 'max' => 255],
            [['type'], 'in', 'range' => ['ENTER', 'EXIT']],
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
            'id' => 'ID',
            'name' => 'Kamera nomi',
            'type' => 'Turi',
            'ipaddress' => 'IP manzil',
            'status' => 'Status',
            'created' => 'Kiritilgan',
            'updated' => 'O‘zgartirilgan',
            'register_id' => 'Kiritdi',
            'modify_id' => 'O`zgartirdi',
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
