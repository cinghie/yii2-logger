<?php

/* @var $days array */
/* @var $items array */
/* @var $this yii\web\View */

use cinghie\adminlte\widgets\Timeline;
use kartik\helpers\Html;

$this->title = Yii::t('traits', 'Loggers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('logger', 'Logger'), 'url' => ['/logger/default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-8"></div>

    <!-- action buttons -->
    <div class="col-md-4"></div>

</div>

<div class="separator"></div>

<div class="logger-index">

	<?php if(Yii::$app->getModule('logger')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>
	
    <?php // echo $this->render('_search', ['model' => $searchModel]) ?>

    <?= Timeline::widget([
        'days' => $days,
        'items' => $items
    ]) ?>

</div>
