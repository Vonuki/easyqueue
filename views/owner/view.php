<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Owner */

$this->title = $model->idOwner;
$this->params['breadcrumbs'][] = ['label' => 'Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="owner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idOwner], ['class' => 'btn btn-primary']) ?>
        <?php
          if(Yii::$app->user->identity->isAdmin){
            echo Html::a('Delete', ['delete', 'id' => $model->idOwner], [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
            ]);
          }
         ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idOwner',
            'Description',
            'idPerson',
            'Status',
        ],
    ]) ?>

</div>
