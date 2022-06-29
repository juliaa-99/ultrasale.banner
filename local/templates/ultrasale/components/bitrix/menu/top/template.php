<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
if (!empty($arResult)) { ?>
    <div class="header-top__menu">
        <ul><?php
            foreach ($arResult as $arItem) {
                $sClass = '';
                if ($arItem["SELECTED"]) {
                    $sClass = ' selected ';
                }
                ?>
                <li class="<?= $arItem['PARAMS']["sCode"] ?>"><a href="<?= $arItem["LINK"] ?>"
                                                                 class="<?= $sClass ?>"><?= $arItem["TEXT"] ?></a>
                </li><?php
            }
            ?>
        </ul>
    </div>
    <?php
}