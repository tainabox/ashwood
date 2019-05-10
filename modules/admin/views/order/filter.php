<?php
use yii\grid\GridView;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'sum',
        'status',
        [
            'attribute' => 'customer_id',
            'value' => function($data){
                return $data->customer->name ?? 'Неизвестно';
            },
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

<p>ИТОГО: <?=$total?></p>