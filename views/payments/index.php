<?php

use app\models\Payments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'transaction_id',
            'transaction_time',
            'business_short_code',
            //'bill_ref_number',
            //'invoice_number',
            //'third_party_transaction_id',
            'amount',
            'phone_number',
            'first_name',
            //'second_name',
            //'last_name',
            'account_balance',
            //'reversal_status',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Payments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            */
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
