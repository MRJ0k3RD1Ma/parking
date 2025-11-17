<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.car".
 *
 * @property int $id
 * @property int|null $number
 * @property int|null $type_id
 * @property float|null $price
 * @property string|null $enter_time
 * @property string|null $exit_time
 * @property int|null $payment_id
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $register_id
 * @property int|null $modify_id
 * @property int|null $camera_id
 * @property int|null $camera_out_id
 *
 * @property CarType $type
 * @property Payment $payment
 * @property User $register
 * @property User $modify
 */
class Car extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'car';
    }

    public function rules()
    {
        return [
            [['type_id', 'payment_id', 'status', 'register_id', 'modify_id','camera_id','camera_out_id'], 'integer'],
            [['price'], 'number'],

            [['enter_time', 'exit_time', 'created', 'updated','number', 'terminal_id','date_time','fiscal_sign','applet_version','qr_code_url'], 'safe'],

            [['type_id'], 'exist', 'skipOnError' => true,
                'targetClass' => CarType::class,
                'targetAttribute' => ['type_id' => 'id']
            ],

            [['payment_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Payment::class,
                'targetAttribute' => ['payment_id' => 'id']
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
            'number'      => 'Moshina raqami',
            'type_id'     => 'Turi',
            'price'       => 'Summa',
            'enter_time'  => 'Kirish vaqti',
            'exit_time'   => 'Chiqish vaqti',
            'payment_id'  => 'To`lov turi',
            'status'      => 'Status',
            'created'     => 'Kiritildi',
            'updated'     => 'O`zgartirildi',
            'register_id' => 'Kiritdi',
            'modify_id'   => 'O`zgartirdi',
            'camera_id'   => 'Kirish kamera',
            'camera_out_id'   => 'Chiqish kamera',
        ];
    }

    public function getType()
    {
        return $this->hasOne(CarType::class, ['id' => 'type_id']);
    }

    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }

    public function getRegister()
    {
        return $this->hasOne(User::class, ['id' => 'register_id']);
    }

    public function getModify()
    {
        return $this->hasOne(User::class, ['id' => 'modify_id']);
    }

    public function getCamera(){
        return $this->hasOne(Camera::class, ['id' => 'camera_id']);
    }
    public function getCameraOut(){
        return $this->hasOne(Camera::class, ['id' => 'camera_out_id']);
    }
}
