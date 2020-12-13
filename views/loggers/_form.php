<?php

/* @var $form yii\widgets\ActiveForm */
/* @var $model cinghie\logger\models\Loggers */
/* @var $this yii\web\View */

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;

?>

<div class="loggers-form">

    <?php $form = ActiveForm::begin() ?>

        <div class="row">

            <!-- action menu -->
            <div class="col-md-8">
		        </div>

            <div class="col-md-4">

                <?= $model->getExitButton() ?>

                <?= $model->getCancelButton() ?>

                <?= $model->getSaveButton() ?>

            </div>

        </div>

        <div class="separator"></div>

        <div class="row">

            <div class="col-md-3">

	            <?= $form->field($model, 'entity_name')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-3">

	            <?= $form->field($model, 'entity_id')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-3">

	            <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-3">

		        <?= $model->getCreatedByWidget($form) ?>

            </div>
    
            <div class="col-md-3">

		        <?= $model->getCreatedWidget($form) ?>

            </div>
    
            <div class="col-md-3">

	            <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

            </div>

        </div>

    <?php ActiveForm::end() ?>

</div>
