<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->idItem;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idItem], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['cancel', 'id' => $model->idItem], ['class' => 'btn btn-warning']) ?>
        <?php if (Yii::$app->user->identity->isAdmin):?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idItem], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>

    </p>

    <?php 
      if(Yii::$app->user->identity->isAdmin){
          echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idItem',
                'idQueue',
                'idClient',
                'Status',
                'CreateDate',
                'StatusDate',
                'RestTime',
                'Position',
                'Comment'
            ],
          ]);
      }
      else{
          echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idItem',
                [
                    'label' => Yii::t('lg_common', 'Queue'),
                    'attribute' => 'idQueue',
                    'value' => $queue,
                ],
               // 'idClient',
                [
                    'attribute' => 'Status', 
                    'format' => 'raw',
                    'value' => function ($model) { 
                        return \yii\helpers\Html::tag('span',$model->getStatusText(),['class' => $model->getStatusLabel()] );
                        }, 
                ],
                'CreateDate',
                'StatusDate',
                [
                    'attribute' => 'RestTime', 
                    'format' => 'time',
                ],
                'Position',
                'Comment'
            ],
          ]);
      }
     ?>

</div>
