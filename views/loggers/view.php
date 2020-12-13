<?php

/* @var $model cinghie\logger\models\Loggers */
/* @var $this yii\web\View */

use kartik\detail\DetailView;
use kartik\helpers\Html;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('logger', 'Logger'), 'url' => ['/logger/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Loggers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">

    <!-- action menu -->
    <div class="col-md-8">
		</div>

    <!-- action buttons -->
    <div class="col-md-4">

		<?= $model->getDeleteButton() ?>

		<?= $model->getUpdateButton() ?>

		<?= $model->getCreateButton() ?>

	    <?= $model->getExitButton() ?>

    </div>

</div>

<div class="separator"></div>

<div class="logger-view row">

	<?php if(Yii::$app->getModule('logger')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
		<?php endif ?>
	
    <div class="col-md-6">

        <?= DetailView::widget([
            'model' => $model,
            'condensed' => true,
            'enableEditMode' => false,
            'deleteOptions' => false,
            'hover' => true,
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'after' => false,
                'before' => false,
                'footer' => false,
                'heading' => Yii::t('traits', 'Task Informations'),
                'type' => DetailView::TYPE_INFO,
            ],
            'attributes' => [
                    [
                    'attribute' => 'id',
                ],
                [
                    'attribute' => 'entity_name',
                ],
                [
                    'attribute' => 'entity_id',
                ],
                [
                    'attribute' => 'action',
                ],
                [
                    'attribute' => 'data:ntext',
                ],
            ],
        ]) ?>

    </div>

    
    <div class="col-md-6">

	    <?= DetailView::widget([
            'model' => $model,
            'condensed' => true,
            'enableEditMode' => false,
            'deleteOptions' => false,
            'hover' => true,
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'after' => false,
                'before' => false,
                'footer' => false,
                'heading' => Yii::t('traits', 'Entry Informations'),
                'type' => DetailView::TYPE_INFO,
            ],
            'attributes' => [
                $model->getCreatedByDetailView(),
                $model->getCreatedDetailView(),
                ],
        ]) ?>

    </div>

    
</div>
