<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php use yii\helpers\Html;
use yii\widgets\Pjax;

Pjax::begin(['id' => 'pjaxContent']); ?>
<?= Html::a("Обновить", ['#'], ['class' => 'btn btn-lg btn-primary']) ?>
<h1>Сейчас: <?= $time ?></h1>
<?php Pjax::end(); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var i = 1;

        function myLoop() {
            setTimeout(function() {
                a = getarr();
                console.log(a);
                i++;                    //  increment the counter
                if (a!=0) {           //  if the counter < 10, call the loop function
                    myLoop();             //  ..  again which will trigger another
                }                       //  ..  setTimeout()
            }, 1000)
        }

        function getarr(){
            $.pjax.reload({container: '#pjaxContent'});
            return getRandomInt(30);
        }

        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        myLoop();
    });

</script>