<?php

/* @var $action string */
/* @var $created string */
/* @var $days array */
/* @var $entity_model string */
/* @var $items array */
/* @var $searchModel LoggersSearch */
/* @var $user_id int */
/* @var $this yii\web\View */

use cinghie\adminlte\widgets\Timeline;
use cinghie\logger\models\LoggersSearch;
use kartik\helpers\Html;
use yii\web\View;

$this->title = Yii::t('traits', 'Loggers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traits', 'Logger'), 'url' => ['/logger/default/index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()], 'defer'=>true]);
$this->registerJsFile('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
?>

<?php

$users = $searchModel->getUsersSelect2();

?>

<form action="">
    <div class="row">
        <div class="col-md-3" style="display:flex;">
            <select name="user_id" class="form-control">
                <option value="">Filtra per utente...</option>
                <?php
                foreach ($users as $key => $user):
                    $selected = "";
                    if ($user_id ===  $key) {
                        $selected = "selected";
                    }
                    echo '<option value="'.$key.'" '.$selected.'>'.$user.'</option>';
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-md-3" style="display:flex;">
            <?= $searchModel->getActionsSelect2($action) ?>
        </div>
        <div class="col-md-3" style="display:flex;">
            <?= $searchModel->getModelsSelect2($entity_model) ?>
        </div>
        <div class="col-md-3" style="display:flex;">
            <input placeholder="Filtra per data" type="text" name="created" class="form-control" id="created" value="<?php echo $created ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3" style="display:flex;">
            <button class="btn btn-primary" style="margin: 25px 0px;" type="submit">Filtra</button>
        </div>
    </div>
</form>

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

<?php 


// Register action buttons js
$this->registerJs('
    $(document).ready(function(){
         var drp =  jQuery(\'input[name="created"]\').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: \'Resetta\'
            }
         });
         drp.on(\'apply.daterangepicker\', function(ev, picker) {
            $(this).val(picker.startDate.format(\'YYYY-MM-DD\') + \' | \' + picker.endDate.format(\'YYYY-MM-DD\'));
        });
      
        drp.on(\'cancel.daterangepicker\', function(ev, picker) {
            $(this).val(\'\');
        });
    })
');
?>
