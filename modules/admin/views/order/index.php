<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1>Редактирование таблицы <?= Html::encode($this->title) ?></h1>
    <div style="margin-bottom: 20px">
        <a href="admin/customer">Переключить на Customer</a>
    </div>

    <p>
        <?= Html::a(Yii::t('app', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <script>
        $(document).ready(function() {
            $('#filterOrder').on('click', function () {
                var value = $('#nameId').val();
                $.ajax({
                    type: 'POST',
                    url: 'admin/order/filter',
                    data:'id='+value,
                    success: function (data) {
                        $('#mydiv').html(data);
                    }
                });
            });
        });

    </script>


    <p>
        <select id="nameId">
            <option disabled>Выберите имя</option>
            <?php foreach ($customersName as $id => $name) : ?>
                <option value="<?= $id ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p><input type="submit" id="filterOrder" value="Отфильтровать"></p>

    <div id="mydiv">
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
    </div>

</div>
