<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "md_parking.client_paid".
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $price
 * @property int|null $payment_id
 * @property string|null $description
 * @property string|null $date
 * @property string|null $deadline
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $register_id
 * @property int|null $modify_id
 *
 * @property Client $client
 * @property Payment $payment
 * @property User $register
 * @property User $modify
 */
class ClientPaid extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'client_paid';
    }

    public function rules()
    {
        return [
            [['client_id', 'price', 'payment_id', 'status', 'register_id', 'modify_id'], 'integer'],
            [['description'], 'string'],
            [['date', 'deadline', 'created', 'updated'], 'safe'],

            [['client_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Client::class,
                'targetAttribute' => ['client_id' => 'id']
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
            'client_id'   => 'Mijoz',
            'price'       => 'Summa',
            'payment_id'  => 'To`lov turi',
            'description' => 'Izoh',
            'date'        => 'To`lov sanasi',
            'deadline'    => 'Muddat',
            'status'      => 'Status',
            'created'     => 'Kiritildi',
            'updated'     => 'O`zgartirildi',
            'register_id' => 'Kiritdi',
            'modify_id'   => 'O`zgartirdi',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
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
}
