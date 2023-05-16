<?php

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel cinghie\logger\models\LoggersSearch */
/* @var $this yii\web\View */

use cinghie\adminlte\widgets\Timeline;
use kartik\helpers\Html;

$this->title = Yii::t('traits', 'Loggers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('logger', 'Logger'), 'url' => ['/logger/default/index']];
$this->params['breadcrumbs'][] = $this->title;

// Register action buttons js
$this->registerJs('$(document).ready(function()
    {'
    .$searchModel->getUpdateButtonJavascript('#w0')
    .$searchModel->getDeleteButtonJavascript('#w0').
    '});
');

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
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel
    ]) ?>


</div>
