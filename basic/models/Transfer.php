<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property integer $id
 * @property integer $sender
 * @property integer $recipient
 * @property double $summ
 * @property string $transferDate
 *
 * @property User $recipient0
 * @property User $sender0
 */
class Transfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'recipient', 'summ'], 'required'],
            [['sender', 'recipient'], 'integer'],
            [['summ'], 'number'],
            [['transferDate'], 'safe'],
            [['recipient'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient' => 'id']],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender' => 'Sender',
            'recipient' => 'Recipient',
            'summ' => 'Summ',
            'transferDate' => 'Transfer Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient0()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }
}
