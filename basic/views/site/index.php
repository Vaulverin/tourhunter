<?php

/* @var $this yii\web\View */
/* @var $usersDataProvider ActiveDataProvider */
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-1">
                <h2>Users</h2>
                <?=GridView::widget([
                    'dataProvider' => $usersDataProvider,
                    'columns'=> ['username', 'balance'],
                    'layout' => "{pager}\n{summary}\n{items}\n{pager}",
                    'summary' => 'Показано {count} из {totalCount}',
                    'summaryOptions' => [
                        'tag' => 'span',
                        'class' => 'my-summary'
                    ],
                    'emptyText' => 'Список пуст',
                ]);
                ?>
            </div>
        </div>

    </div>
</div>
