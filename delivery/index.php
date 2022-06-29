<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Доставка и оплата");
?>
    <div class="delivery">
        <div class="delivery__holder">
            <div class="container">
                <h1><?=$APPLICATION->GetTitle(true);?></h1>
                <div class="delivery__inner">
                    <div class="delivery__row">
                        <div class="delivery__cell">
                            <div class="delivery__cell-title">Доставка по Москве <br>и Московской области</div>
                        </div>
                        <div class="delivery__cell">
                            <div class="delivery__cell-inner">
                                <ul>
                                    <li>Доставка курьером грузов весом менее 10 кг в пределах МКАД&nbsp;-&nbsp;500&nbsp;руб.</li>
                                    <li>Доставка водителем грузов весом более 10 кг в пределах МКАД&nbsp;-&nbsp;1200&nbsp;руб.</li>
                                    <li>Доставка за пределы МКАД - 1 200 руб. + 30 руб. за 1 км.</li>
                                </ul>
                                <div class="delivery__cell-tx-big">Заказы стоимостью свыше 30 000 руб. доставляются
                                    бесплатно.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="delivery__row">
                        <div class="delivery__cell">
                            <div class="delivery__cell-title">Доставка по России</div>
                        </div>
                        <div class="delivery__cell">
                            <div class="delivery__cell-inner">
                                <p>Мы осуществляем доставку по России с помощью ведущих компаний-грузоперевозчиков.</p>
                                <p>Стоимость доставки складывается из стоимости доставки по Москве до
                                    компании-перевозчика (1200 руб.) +тариф перевозчика до Вашего города.</p>
                            </div>
                        </div>
                    </div>
                    <div class="delivery__row bg">
                        <div class="delivery__cell">
                            <div class="delivery__cell-title">Оплата</div>
                        </div>
                        <div class="delivery__cell">
                            <div class="delivery__cell-inner">
                                <p>Вы можете оплатить заказанный товар следующими способами:</p>
                                <ul>
                                    <li>Безналичным расчетом согласно выставленному счету.</li>
                                    <li>Наличными при получении товара.</li>
                                    <li>Банковской картой on-line.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
