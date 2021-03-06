<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
      Pjax::begin();
      if (Yii::$app->user->identity->isAdmin) {
          $actions_string = '{view} {update} {cancel} {delete}'; 
      }
      else{ 
          $actions_string = '{view} {update} {cancel}'; 
      }
      

      echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'idItem',
            'QueueDescription',
            ['attribute' => 'OwnerDescription','visible' => \Yii::$app->user->identity->isAdmin,],
            ['attribute' => 'Status', 'format' => 'raw',
              'value' => 
                function ($model, $key, $index, $column) { 
                  return \yii\helpers\Html::tag('span',$model->getStatusText(),['class' => $model->getStatusLabel()] );
                }, 
            ],
            'CreateDate',
            'StatusDate',
            'Comment',
            ['attribute' => 'RestTime', 'value' => function ($model, $key, $index, $column) { return date("d \d\a\y\s H:i:s",$model->RestTime);}, ],
            'Position',
          
            ['class' => 'yii\grid\ActionColumn',
              'template' => $actions_string,
              'buttons' => [
                'update' => function ($url, $model,$key) {
                    if($model->Status>0){
                      return '';
                    }
                    else{
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('lg_common', 'Update'),'data-pjax' => '0',]);
                    }
                },
                'cancel' => function ($url, $model,$key) {
                    if($model->Status>0){
                      return '';
                    }
                    else{
                      return Html::a('Cancel', $url, ['title' => Yii::t('lg_common', 'Cancel'),'data-pjax' => '0',]);
                    }
                },
              ]
            ],
          ],
       ]); 

    
      Pjax::end(); 
    ?>
</div>
