<?php

namespace tests\models;

use app\models\LoginForm;
use Codeception\Specify;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        \Yii::$app->user->logout();
    }
    protected $username;
    public function testLogin()
    {
        $this->username = uniqid();
        $this->model = new LoginForm([
            'username' => $this->username,
        ]);
        expect_that($this->model->login());
        expect_not(\Yii::$app->user->isGuest);
        $this->_after();

        $this->model = new LoginForm([
            'username' => $this->username,
        ]);
        codecept_debug($this->model);
        codecept_debug($this->username);
        expect_that($this->model->login());
        expect_not(\Yii::$app->user->isGuest);
    }

}
