<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $transfersDataProvider yii\data\ActiveDataProvider */
/* @var $transferForm \app\models\TransferForm */
/* @var $user \app\models\User */

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;

$this->title = $user->username.' Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('transferSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>
    <?php else: ?>

        <p>Your balance: <h2><?=$user->balance?></h2></p>

        <p>
            There you can transfer your credits.
        </p>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin([
                    'id' => 'transfer-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "<div class=\"col-lg-2\">{label}</div><div class=\"col-lg-3\">{input}</div> <div class=\"col-lg-7\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>

                <?= $form->field($transferForm, 'recipient')->textInput(['autofocus' => true]) ?>
                <?= $form->field($transferForm, 'summ')->textInput() ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'transfer-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $transfersDataProvider,
                    'columns'=> [
                        [
                            'attribute' => 'sender',
                            'value' => 'sender.username'
                        ],
                        [
                            'attribute' => 'recipient',
                            'value' => 'recipient.username'
                        ],
                        'summ', 'transferDate'
                    ],
                    'layout' => "{pager}\n{summary}\n{items}\n{pager}",
                    'summary' => 'Показано {count} из {totalCount}',
                    'summaryOptions' => [
                        'tag' => 'span',
                        'class' => 'my-summary'
                    ],
                    'emptyText' => 'Список пуст',
                ]); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
