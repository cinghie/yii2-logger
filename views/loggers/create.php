<?php

/* @var $model cinghie\logger\models\Loggers */
/* @var $this yii\web\View */

use kartik\helpers\Html;

$this->title = Yii::t('traits', 'Create') . ' ' . Yii::t('traits', 'Loggers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Loggers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="logger-create">

    <?php if(Yii::$app->getModule('logger')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
