<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if (count($arResult['SECTIONS'])) {?>
<div class="filter__group-check">
    <ul>
        <?php
                foreach ($arResult['SECTIONS'] as $section) {
                    $css = '';
                    if ($request->getRequestedPageDirectory().'/' == $section['SECTION_PAGE_URL']) {
                        $css = ' class="active" ';
                    }
                    ?>
                    <li <?=$css?>><a href="<?= $section['SECTION_PAGE_URL'] ?>"><?= $section['NAME'] ?></a></li>
                <? } ?>

    </ul>
</div>
<?php } ?>