<?php

/* @var $this yii\web\View 
Русская статическая страница...
*/

use yii\helpers\Html;
use yii\helpers\Markdown;


$this->title = Yii::t('lg_common', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $myText = file_get_contents(__DIR__ .'/about_ru.md', FILE_USE_INCLUDE_PATH);
        echo $myHtml = Markdown::process($myText, 'gfm');
     ?> 
  
</div>
