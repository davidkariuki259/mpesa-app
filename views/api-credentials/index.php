<?php

use app\models\ApiCredentials;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Api Credentials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-credentials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Api Credentials'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'consumer_key',
            'consumer_secret',
            'token',
            'last_updated',
            //'short_code',
            //'confirmation_url:url',
            //'validation_url:url',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ApiCredentials $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
