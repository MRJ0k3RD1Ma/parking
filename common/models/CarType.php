<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.car_type".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int|null $daily
 * @property int|null $onetime
 * @property int|null $hourly
 * @property int|null $hourly_enter
 * @property int|null $enter
 * @property int|null $free_time
 * @property int|null $status
 * @property int|null $register_id
 * @property int|null $modify_id
 * @property string|null $created
 * @property string|null $updated
 *
 * @property User $register
 * @property User $modify
 */
class CarType extends \yii\db\ActiveRecord
{
    public $plan;
    public static function tableName()
    {
        return 'car_type';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],

            [['daily', 'onetime', 'hourly', 'hourly_enter', 'enter', 'free_time', 'status', 'register_id', 'modify_id'], 'integer'],

            [['created', 'updated','plan'], 'safe'],

            [['name'], 'string', 'max' => 255],

            [['type'], 'in', 'range' => ['1D', '1T', '1H', '1HI']],

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
            'id'           => 'ID',
            'name'         => 'Nomi',
            'type'         => 'Turi',
            'daily'        => 'Kunlik narxi',
            'onetime'      => 'Bir martalik to`lov narxi',
            'hourly'       => 'Soatlik narxi',
            'hourly_enter' => 'Soatlik narxi',
            'enter'        => 'Kirish narxi',
            'free_time'    => 'Bepul minut',
            'status'       => 'Status',
            'register_id'  => 'Kiritdi',
            'modify_id'    => 'O`zgartirdi',
            'created'      => 'Kiritildi',
            'updated'      => 'O`zgartirildi',
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

    public function getPlans(){
        return $this->hasMany(CarTypePlan::class, ['type_id' => 'id']);
    }
}
