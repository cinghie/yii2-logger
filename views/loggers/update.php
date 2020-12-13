<?php

/* @var $model cinghie\logger\models\Loggers */
/* @var $this yii\web\View */

use kartik\helpers\Html;

$this->title = Yii::t('traits', 'Update') . ' ' . Yii::t('traits', 'Loggers') . ' ' . $model->id ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Loggers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('traits', 'Update');

?>

<div class="logger-update">

	<?php if(Yii::$app->getModule('logger')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
