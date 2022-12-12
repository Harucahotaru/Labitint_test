<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var array $evolution
 */
ActiveForm::begin(['action' =>'/index.php?r=evolution/update-life', 'id' => 'evolution']);
foreach ($evolution as $row => $cells):?>
    <?php foreach ($cells as $cell => $active): ?>
    <?php $style = 'width: 50px; height: 50px;display: inline-block;' ?>
        <?php $classname = ($active == 'alive') ? 'bg-success' : 'bg-dark'; ?>
    <?= Html::tag('div',null,[
            'class' => $classname,
            'style' => $style, 'id' => "div_{$row}_{$cell}"]);?>
        <?= Html::hiddenInput("cells[$row][$cell]", $active) ?>
    <?php endforeach; ?></br>
<?php endforeach; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="qq">
123
</div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Start', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        getAjax();
        function getAjax(){
            var data = $('#evolution').serialize();
            var res;
            console.log(data);
            $res = $.ajax({
                type: "POST",
                url: '/index.php?r=evolution/update-life',
                data: data,
                timeout:3000,
                success: function(data){
                    $.each(data, function (row, cells) {
                        $.each(cells, function (cell, status) {
                            $("[name^='cells["+row+"]["+cell+"]']").val(status);
                            $("#div_"+row+"_"+cell).addClass(status);
                        });
                    });
                    console.log(data);
                    if (data!=false) {
                        getAjax();
                    }
                    return data;
                }
            });
        }

        myLoop();
    });

</script>