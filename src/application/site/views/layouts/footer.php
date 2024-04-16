<?php

use application\common\helpers\DateTimeHelper;
use application\common\enums\DateTimeFormatEnums;

$year = (DateTimeHelper::getDateTime())
    ->format(DateTimeFormatEnums::FORMAT_YEAR->value);

?>

<div class="container">
    <div class="row">
        <div class="col-8">

        </div>
        <div class="col-4">
            <img src="https://new.banki.shop/img/Logo-desktop.458a8654.svg" alt="Logo"
                 width="350" height="80" class="d-inline-block align-text-top"/>
        </div>
        <div class="col-12">
            <p>Все права защищены. <?= $year ?> г.</p>
        </div>
    </div>
</div>
