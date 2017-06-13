<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TransferForm extends Model
{
    public $recipient;
    public $summ;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['recipient', 'required', 'message'=> 'Recipient required'],
            ['recipient', 'trim'],
            ['recipient', function($attribute, $params)
            {
                if ($this->$attribute == User::current()->username){
                    $this->addError($attribute, "You can't transfer credits to yourself!");
                }
            }],
            ['summ', 'required', 'message'=> 'Summ required'],
            ['summ', 'double', 'max'=> 10000000],
            ['summ', 'compare', 'compareValue'=> 0, 'operator'=> '>', 'type' => 'double'],
            ['summ', function($attribute, $params) {
                if (strlen(substr(strrchr($this->$attribute , "."), 1)) > 2){
                    $this->addError($attribute, "Too much digits after point!");
                }
            }]
        ];
    }

    public function transfer()
    {
        if ($this->validate()) {
            $recipient = $this->getRecipient();
            $currentUser = User::current();
            $transfer = new Transfer();
            $transfer->sender_id = $currentUser->id;
            $transfer->recipient_id = $recipient->id;
            $transfer->summ = $this->summ;
            if ($transfer->save()) {
                $recipient->balance += $this->summ;
                $recipient->save();
                $currentUser->balance -= $this->summ;
                $currentUser->save();
                return true;
            }
            $this->addError('error', 'Some errors occur while transferring credits');
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getRecipient()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->recipient);
        }

        return $this->_user;
    }
}
