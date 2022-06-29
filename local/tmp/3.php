<table class="table">
    <?

    if (!empty($arResult["SHOW_OFFER_FIELDS"])) {
        foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp) {
            $showRow = true;
            if ($arResult['DIFFERENT']) {
                $arCompare = array();
                foreach ($arResult["ITEMS"] as $arElement) {
                    $Value = $arElement["OFFER_FIELDS"][$code];
                    if (is_array($Value)) {
                        sort($Value);
                        $Value = implode(" / ", $Value);
                    }
                    $arCompare[] = $Value;
                }
                unset($arElement);
                $showRow = (count(array_unique($arCompare)) > 1);
            }
            if ($showRow) {
                ?>
                <tr>
                    <th><?= GetMessage("IBLOCK_OFFER_FIELD_" . $code) ?></th>
                    <? foreach ($arResult["ITEMS"] as $arElement) {
                        ?>
                        <td>
                            <? switch ($code) {
                                case 'PREVIEW_PICTURE':
                                case 'DETAIL_PICTURE':
                                    if (!empty($arElement["OFFER_FIELDS"][$code]) && is_array($arElement["OFFER_FIELDS"][$code])) {
                                        ?>
                                        <img
                                        border="0"
                                        src="<?= $arElement["OFFER_FIELDS"][$code]["SRC"] ?>"
                                        width="auto"
                                        height="150"
                                        alt="<?= $arElement["OFFER_FIELDS"][$code]["ALT"] ?>"
                                        title="<?= $arElement["OFFER_FIELDS"][$code]["TITLE"] ?>"
                                        /><?
                                    }
                                    break;
                                default:
                                    ?><?= (is_array($arElement["OFFER_FIELDS"][$code]) ? implode("/ ",
                                    $arElement["OFFER_FIELDS"][$code]) : $arElement["OFFER_FIELDS"][$code]);
                                    break;
                            }
                            ?>
                        </td>
                        <?
                    }
                    unset($arElement);
                    ?>
                </tr>
                <?
            }
        }
    }
    ?>

    <tr>
        <th><?= GetMessage('CATALOG_COMPARE_PRICE'); ?></th>
        <? foreach ($arResult["ITEMS"] as $arElement) {
            if (isset($arElement['MIN_PRICE']) && is_array($arElement['MIN_PRICE'])) {
                ?>
                <td><? echo $arElement['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></td>
                <?
            } elseif (!empty($arElement['PRICE_MATRIX']) && is_array($arElement['PRICE_MATRIX'])) {
                ?>
                <td><?
                $matrix = $arElement['PRICE_MATRIX'];
                $rows = $matrix['ROWS'];
                $rowsCount = count($rows);
                if ($rowsCount > 0) {
                    ?>
                    <table class="compare-price"><?
                    if (count($rows) > 1) {
                        foreach ($rows as $index => $rowData) {
                            if (empty($matrix['MIN_PRICES'][$index])) {
                                continue;
                            }
                            if ($rowData['QUANTITY_FROM'] == 0) {
                                $rowTitle = GetMessage('CP_TPL_CCR_RANGE_TO',
                                    array('#TO#' => $rowData['QUANTITY_TO']));
                            } elseif ($rowData['QUANTITY_TO'] == 0) {
                                $rowTitle = GetMessage('CP_TPL_CCR_RANGE_FROM',
                                    array('#FROM#' => $rowData['QUANTITY_FROM']));
                            } else {
                                $rowTitle = GetMessage(
                                    'CP_TPL_CCR_RANGE_FULL',
                                    array(
                                        '#FROM#' => $rowData['QUANTITY_FROM'],
                                        '#TO#'   => $rowData['QUANTITY_TO'],
                                    )
                                );
                            }
                            echo '<tr><td>' . $rowTitle . '</td><td>';
                            echo \CCurrencyLang::CurrencyFormat($matrix['MIN_PRICES'][$index]['PRICE'],
                                $matrix['MIN_PRICES'][$index]['CURRENCY']);
                            echo '</td></tr>';
                            unset($rowTitle);
                        }
                        unset($index, $rowData);
                    } else {
                        $currentPrice = current($matrix['MIN_PRICES']);
                        echo '<tr><td class="simple">' . \CCurrencyLang::CurrencyFormat($currentPrice['PRICE'],
                                $currentPrice['CURRENCY']) . '</td></tr>';
                        unset($currentPrice);
                    }
                    ?></table><?
                }
                unset($rowsCount, $rows, $matrix);
                ?></td><?
            } else {
                ?>
                <td>&nbsp;</td><?
            }
        }
        unset($arElement);
        ?>
    </tr>

    <? if (!empty($arResult["SHOW_PROPERTIES"])) {
        foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty) {
            $showRow = true;
            if ($arResult['DIFFERENT']) {
                $arCompare = array();
                foreach ($arResult["ITEMS"] as $arElement) {
                    $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                    if (is_array($arPropertyValue)) {
                        sort($arPropertyValue);
                        $arPropertyValue = implode(" / ", $arPropertyValue);
                    }
                    $arCompare[] = $arPropertyValue;
                }
                unset($arElement);
                $showRow = (count(array_unique($arCompare)) > 1);
            }

            if ($showRow) {
                ?>
                <tr>
                    <th><?= $arProperty["NAME"] ?></th>
                    <? foreach ($arResult["ITEMS"] as $arElement) {
                        ?>
                        <td>
                            <?= (is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ",
                                $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) : $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                        </td>
                        <?
                    }
                    unset($arElement);
                    ?>
                </tr>
                <?
            }
        }
    }

    if (!empty($arResult["SHOW_OFFER_PROPERTIES"])) {
        foreach ($arResult["SHOW_OFFER_PROPERTIES"] as $code => $arProperty) {
            $showRow = true;
            if ($arResult['DIFFERENT']) {
                $arCompare = array();
                foreach ($arResult["ITEMS"] as $arElement) {
                    $arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
                    if (is_array($arPropertyValue)) {
                        sort($arPropertyValue);
                        $arPropertyValue = implode(" / ", $arPropertyValue);
                    }
                    $arCompare[] = $arPropertyValue;
                }
                unset($arElement);
                $showRow = (count(array_unique($arCompare)) > 1);
            }
            if ($showRow) {
                ?>
                <tr>
                    <th><?= $arProperty["NAME"] ?></th>
                    <? foreach ($arResult["ITEMS"] as $arElement) {
                        ?>
                        <td>
                            <?= (is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ",
                                $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) : $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                        </td>
                        <?
                    }
                    unset($arElement);
                    ?>
                </tr>
                <?
            }
        }
    }
    ?>
    <tr>
        <th></th>
        <? foreach ($arResult["ITEMS"] as $arElement) {
            ?>
            <td>
                <a class="text-danger"
                   onclick="CatalogCompareObj.delete('<?= CUtil::JSEscape($arElement['~DELETE_URL']) ?>');"
                   href="javascript:void(0)"><?= GetMessage("CATALOG_REMOVE_PRODUCT") ?></a>
            </td>
            <?
        }
        unset($arElement);
        ?>
    </tr>
</table>