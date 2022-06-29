<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);
?>
<div class="brands-page">
    <div class="brands-page__holder">
        <div class="container">
            <div class="title-main">
                <h1><?= $APPLICATION->GetTitle(true); ?></h1>
            </div>
            <div class="brands-page__inner">
                <div class="brands-page__list">
                    <? foreach ($arResult['Toc'] as $item) {
                        if (!count($arResult['SectionByLetterEx'][$item['link']]) && $item['link']!='all') { continue; }
                        $active = '';
                        if ($_REQUEST['what'] == $item['link']) {
                            $active = 'active';
                        } elseif (!$_REQUEST['what'] && $item['link'] == 'all') {
                            $active = 'active';
                        }
                        ?>
                        <a class="brands-page__list-item <?=$active?>"
                        href="?what=<?=$item['link']?>"><?=$item['value']?></a>
                    <? } ?>
                </div>
                <div class="brands-page__inner">
                    <?
                        foreach ($arResult['Toc'] as $tocItem) {
                            if ($tocItem['link'] == 'all') { continue; }
                            if (!count($arResult['SectionByLetter'][$tocItem['link']])) { continue; }
                            ?><div class="brands-page__item">
                                <div class="brands-page__item-title"><?=$tocItem['value']?></div>
                                    <div class="brands-page__item-list">
                                        <? foreach ($arResult['SectionByLetter'][$tocItem['link']] as $section) {?>
                                            <a class="brands-page__item-list-item" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
                                        <? } ?>
                                    </div>
                            </div>
                            <?
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>