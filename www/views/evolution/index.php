<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

ActiveForm::begin(['action' =>'/index.php?r=evolution/cycle', 'method' => 'get']); ?>
<?= Html::label('Количество строк', 'rows') ?>
<?=Html::textInput('rows', null, ['label' => ''])?>
<?= Html::label('Количество столбцов', 'cells') ?>
<?=Html::textInput('cells', null, ['label' => ''])?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Start', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();?>
