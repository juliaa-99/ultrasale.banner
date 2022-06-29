<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Created by PhpStorm.
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 17.11.2021
 */

if (!empty($arResult)) { ?>
        <ul class="drop-bl"><?php
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
    <?php
}

