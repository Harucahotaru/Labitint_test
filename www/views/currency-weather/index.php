<?php
/**
 * @var array $currency
 * @var array $weather
 */
?>

<div class="container">
    <div class="row py-3">
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Погода сейчас</h5>
                    <div class="row">
                        <div class="card-text col-lg-5 align-self-center whether-location"> <?=$weather['location']?></div>
                        <div class="card-text col-lg-5 whether-time"> <?=$weather['time']?> </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-9">Температура</div>
                            <div class="col-lg-3 whether-temp"><?=$weather['temp']?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-9">Ощущается как</div>
                            <div class="col-lg-3 whether-feelslik"><?=$weather['feelslik']?></div>
                        </div>
                    </li>
                    <li class="list-group-item whether-condition"><?=$weather['condition']?></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10"></div>
        <div class="col-lg-2">
            <button class="btn btn-info button-update">Старт</button>
        </div>
    </div>
    <div class="row">
        <?php foreach ($currency as $item): ?>
        <div class="col-lg-2 py-4">
            <div class="card" style="width: 11rem;">
                <div class="card-body">
                    <h6 class="card-title"><?=$item->Name?></h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1 <?=$item->CharCode?> = <span class="<?=$item->CharCode?>-value"><?=(int)$item->Value?></span> RUB</li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
