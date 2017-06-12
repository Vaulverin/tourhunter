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
            // username and password are both required
            [['username', 'summ'], 'required'],
            // rememberMe must be a boolean value
            ['summ', 'float'],
        ];
    }

    public function transfer()
    {
        $transfer = new Transfer();
        $transfer->sender = Yii::$app->user->id;
        $transfer->recipient = $this->getUser()->id;
        $transfer->summ = $this->summ;
        $transfer->save();
        return true;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->recipient);
        }

        return $this->_user;
    }
}
