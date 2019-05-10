<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Покупатели');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1>Редактирование таблицы <?= Html::encode($this->title) ?></h1>
    <div style="margin-bottom: 20px">
        <a href="/admin">Переключить на Order</a>
    </div>

    <p>
        <?= Html::a(Yii::t('app', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
