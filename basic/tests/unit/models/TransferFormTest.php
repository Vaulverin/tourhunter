<?php
namespace tests\models;
use app\models\LoginForm;
use app\models\TransferForm;
use app\models\User;

class TransferFormTest extends \Codeception\Test\Unit
{
    protected $username;
    protected function _before()
    {
        $this->username = uniqid();
        $model = new LoginForm([
            'username' => $this->username,
        ]);
        expect_that($model->login());
        expect_not(\Yii::$app->user->isGuest);
    }

    public function testWrongRecipient()
    {
        $model = new TransferForm(['recipient'=> '']);
        expect_not($model->transfer());
        $model = new TransferForm();
        expect_not($model->transfer());
    }

    public function testSummWithWrongFormat()
    {
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 'asdasd']);
        expect_not($model->transfer());
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> -123]);
        expect_not($model->transfer());
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 0]);
        expect_not($model->transfer());
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 13.345]);
        expect_not($model->transfer());
        $model = new TransferForm(['recipient'=> 'vova']);
        expect_not($model->transfer());
    }

    public function testGoodTransfer()
    {
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 150]);
        expect_that($model->transfer());
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 1000.99]);
        expect_that($model->transfer());
    }

    public function testVeryBigSumm()
    {
        $model = new TransferForm(['recipient'=> 'vova', 'summ'=> 15000000000090000000000000000]);
        expect_not($model->transfer());
    }

}
