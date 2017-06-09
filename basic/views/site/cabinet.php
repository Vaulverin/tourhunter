<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $transfersDataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\data\ActiveDataProvider;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('transferSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>
    <?php else: ?>

        <p>
            There you can transfer your credits.
        </p>

        <div class="row">
            <div class="col-lg-5">
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $transfersDataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                    ],
                ]); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
