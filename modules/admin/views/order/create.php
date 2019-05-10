<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = Yii::t('app', 'Создать');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customersName' => $customersName
    ]) ?>

</div>
