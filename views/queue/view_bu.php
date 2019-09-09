<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */

$this->title = $model->idQueue;
$this->params['breadcrumbs'][] = ['label' => 'My Queues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="queue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?=Yii::t('common', 'Archive')  ?>
        <?= Html::a('Update', ['update', 'id' => $model->idQueue], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Archive', ['archive', 'id' => $model->idQueue], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to archive this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idQueue',
            'Description',
            'QueueShare',
            'idOwner',
            'FirstItem',
            'QueueLen',
            'Status',
            'AvgMin',
            'AutoTake',
        ],
    ]) ?>

</div>
