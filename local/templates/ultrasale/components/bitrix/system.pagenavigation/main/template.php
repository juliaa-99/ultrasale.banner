<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ClientID = 'navigation_' . $arResult['NavNum'];

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
?>

<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
if ($arResult["bDescPageNumbering"] === true)
{
// to show always first and last pages
    $arResult["nStartPage"] = $arResult["NavPageCount"];
    $arResult["nEndPage"] = 1;

    $sPrevHref = '';
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
        $bPrevDisabled = false;
        if ($arResult["bSavePage"]) {
            $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
        } else {
            if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
            } else {
                $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
            }
        }
    } else {
        $bPrevDisabled = true;
    }

    $sNextHref = '';
    if ($arResult["NavPageNomer"] > 1) {
        $bNextDisabled = false;
        $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
    } else {
        $bNextDisabled = true;
    }
    ?>


    <?
    $bFirst = true;
    $bPoints = false;
    do {
        $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
        if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                ?>
                <li class="active"><a href="#"><?= $NavRecordGroupPrint ?></a></li>
            <?
            elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
                ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
            <?
            else:
                ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
            <?
            endif;
            $bFirst = false;
            $bPoints = true;
        } else {
            if ($bPoints) {
                ?>...<?
                $bPoints = true;
            }
        }
        $arResult["nStartPage"]--;
    } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);
}
else
{
// to show always first and last pages
$arResult["nStartPage"] = 1;
$arResult["nEndPage"] = $arResult["NavPageCount"];

$sPrevHref = '';
if ($arResult["NavPageNomer"] > 1) {
    $bPrevDisabled = false;

    if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2) {
        $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
    } else {
        $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
    }
} else {
    $bPrevDisabled = true;
}

$sNextHref = '';
if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
    $bNextDisabled = false;
    $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
} else {
    $bNextDisabled = true;
}
?>
<div class="pagination-bl">
    <ul class="pagination">
        <? if (!$bPrevDisabled): ?>
            <li class="page-item prev active"><a class="page-link" href="<?= $sPrevHref; ?>" class="page-link">
                    <span class="ar"><svg><use
                                    xlink:href="#arrow2"></use></svg></span>
                    <span
                            class="tt">Предыдущая</span>
                </a></li>
        <? else: ?>
        <? /* Отключаем отображение стрелки назад, если некуда (первая или единственная страница),
            <li class="page-item prev"><a class="page-link" href="<?= $sPrevHref; ?>" class="page-link">
                    <span class="ar"><svg><use
                                    xlink:href="#arrow2"></use></svg></span>
                    <span
                            class="tt">Предыдущая</span>
                </a></li>
 */ ?>
        <? endif; ?>
        <?
        $bFirst = true;
        $bPoints = true;
        do {
            if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 1) {

                if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="page-item active"><a class="page-link" href="javascript:void(0);"
                                                    class="btn active"><?= $arResult["nStartPage"] ?></a></li>
                <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                        ><?= $arResult["nStartPage"] ?></a></li>
                <? else: ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
                        ><?= $arResult["nStartPage"] ?></a></li>
                <?
                endif;
                $bFirst = false;
                $bPoints = true;
            } else {
                if ($bPoints) {
                    ?>
                    <li class="page-item"><span class="page-link">...</span></li><?
                    $bPoints = false;
                }

            }
            $arResult["nStartPage"]++;
        } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);
        }
        ?>
        <? if (!$bNextDisabled): ?>
            <li class="page-item next active"><a href="<?= $sNextHref; ?>" class="page-link">
                    <span class="tt">Следующая</span>
                    <span class="ar"><svg><use
                                    xlink:href="#arrow2"></use></svg></span>
                </a></li>
        <? else: ?>
        <? /* Отключаем отображение стрелки вперед, когда некуда (последняя или единственная страница)
            <li class="page-item next "><a href="<?= $sNextHref; ?>" class="page-link">
                    <span class="tt">Следующая</span>
                    <span class="ar"><svg><use
                                    xlink:href="#arrow2"></use></svg></span>
                </a></li>
        */?>
        <? endif; ?>
    </ul>
</div>

