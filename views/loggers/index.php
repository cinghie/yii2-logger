<?php

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel cinghie\logger\models\LoggersSearch */
/* @var $this yii\web\View */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::class,
                'width' => '3%'
            ],
            [
                'attribute' => 'entity_name',
                'hAlign' => 'center',
                'width' => '8%',
            ],
            [
                'attribute' => 'entity_id',
                'hAlign' => 'center',
                'width' => '8%',
            ],
            [
                'attribute' => 'action',
                'hAlign' => 'center',
                'width' => '8%',
            ],
            [
                'attribute' => 'data',
                'format' => 'text',
                'hAlign' => 'center',
            ],
            [
                'attribute' => 'created_by',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $searchModel->getUsersSelect2(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => ''],
                'format' => 'html',
                'hAlign' => 'center',
                'width' => '6%',
                'value' => function ($model) {
                    /** @var cinghie\logger\models\Loggers $model */
                    return $model->getCreatedByGridView();
                }
            ],
            [
                'attribute' => 'created',
                'hAlign' => 'center',
                'width' => '8%',
            ],
            [
                'attribute' => 'id',
                'hAlign' => 'center',
                'width' => '4%',
            ],
        ],
        'bordered' => true,
        'condensed' => true,
        'hover' => true,
        'pjax' => true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'responsive' => true,
        'responsiveWrap' => true,
        'striped' => true,
        'panel' => [
            //'after' => false,
            //'before' => false,
            'heading' => '<h3 class="panel-title"><i class="fa fa-list"></i></h3>',
            'type' => 'success',
            'showFooter' => false
        ],
        // 'afterHeader' => false,
        // 'beforeHeader' => false,
        // 'afterFooter' => false,
        // 'beforeHeader' => false,
        // 'showPageSummary' => true,
        // 'toolbar' => false
    ]) ?>


</div>
