<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var       $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y") {
    $APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>

<? if (!empty($arResult["ORDER"])): ?>
    <div class="order__title"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/check4.svg" alt=""><span>Ваш заказ успешно оформлен</span>
    </div>
    <div class="order__list">
        <div class="order__list-item"><span class="order__list-item-title">Номер заказа:</span><span
                    class="order__list-item-tx"><?= $arResult["ORDER"]["ACCOUNT_NUMBER"] ?></span></div>
        <div class="order__list-item"><span class="order__list-item-title">Дата и время оформления заказа:</span><span
                    class="order__list-item-tx"><?= $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i') ?></span>
        </div>
        <? if (!empty($arResult['ORDER']["PAYMENT_ID"])) { ?>
            <div class="order__list-item"><span class="order__list-item-title">Номер вашей оплаты:</span><span
                        class="order__list-item-tx"><?= $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER'] ?></span></div>
        <? } ?>
    <?
    if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y') {
        if (!empty($arResult["PAYMENT"])) {
            foreach ($arResult["PAYMENT"] as $payment) {
                if ($payment["PAID"] != 'Y') {
                    if (!empty($arResult['PAY_SYSTEM_LIST'])
                        && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                    ) {
                        $arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

                        if (empty($arPaySystem["ERROR"])) {
                            ?>
                            <div class="order__list-item"><span class="order__list-item-title">Оплата
                                    заказа:</span><span class="order__list-item-tx">
                                    <? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y"
                                        && $arPaySystem["IS_CASH"] != "Y") { ?>
                                        <?
                                        $orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                                        $paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
                                        ?>
                                        <script>
										window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
									</script>
									<?= Loc::getMessage("SOA_PAY_LINK",
                                        array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&PAYMENT_ID=" . $paymentAccountNumber)) ?>
                                        <? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']) { ?>
                                        <br/>
                                            <?= Loc::getMessage("SOA_PAY_PDF",
                                                array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&pdf=1&DOWNLOAD=Y")) ?>
                                        <? } ?>
                                    <? } else { ?>
                                        <?= $arPaySystem["NAME"] ?> <?= $arPaySystem["BUFFERED_OUTPUT"] ?>
                                    <? } ?>
                                    </span>
                            </div>
                            <?
                        } else {
                            ?>
                            <div class="alert alert-danger"
                                 role="alert"><?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?></div>
                            <?
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert"><?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?></div>
                        <?
                    }
                }
            }
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert"><?= $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] ?></div>
        <?
    }
    ?>
    </div><a class="button button-primary" href="/"><span>Вернуться на главную страницу</span></a>

<? else: ?>


    <div class="row mb-2">
        <div class="col">
            <div class="alert alert-danger" role="alert"><strong><?= Loc::getMessage("SOA_ERROR_ORDER") ?></strong><br/>
                <?= Loc::getMessage("SOA_ERROR_ORDER_LOST",
                    ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])]) ?><br/>
                <?= Loc::getMessage("SOA_ERROR_ORDER_LOST1") ?></div>
        </div>
    </div>

<? endif ?>