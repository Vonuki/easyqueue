<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lg_common', 'Queues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lg_common', 'Create Queue'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php 
          if (Yii::$app->user->identity->isAdmin) {
              $actions_string = '{view} {update} {archive} {delete}'; 
          }
          else{ 
              $actions_string = '{view} {update} {archive}'; 
          }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'idQueue',
            'Description',
            [ 'attribute' => 'QueueShare', 'value' => function ($model, $key, $index, $column) { return $model->getQueueShareTxt();},],
            [ 'attribute' => 'OwnerDescription','visible' => \Yii::$app->user->identity->isAdmin,],
            //[ 'attribute' => 'FirstItem','visible' => \Yii::$app->user->identity->isAdmin,],
            'QueueLen',
            [ 'attribute' => 'Status', 'format' => 'raw',
              'value' => 
                function ($model, $key, $index, $column) {
                  return \yii\helpers\Html::tag('span',$model->getStatusText(),['class' => $model->getStatusLabel()] );
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
             'template' => $actions_string,
             'buttons' => [
                'archive' => function ($url,$model,$key) { return Html::a(Yii::t('lg_common', 'Archive'), $url); },
              ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
