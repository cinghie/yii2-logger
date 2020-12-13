<?php

/* @var $form yii\widgets\ActiveForm */
/* @var $model cinghie\logger\models\LoggersSearch */
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="logger-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]) ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entity_name') ?>

    <?= $form->field($model, 'entity_id') ?>

    <?= $form->field($model, 'action') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'data') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('traits', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('traits', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
