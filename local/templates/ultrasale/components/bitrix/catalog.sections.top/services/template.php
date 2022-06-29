<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); } ?>
<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 11.11.2021
 */
?>
<div class="object-page">
    <div class="object-page__holder services">
        <div class="container">
            <div class="title-main">
                <h1><?= $APPLICATION->GetTitle(true); ?></h1>
                <a class="button button-primary" href="#" data-toggle="modal" data-target="#modalCall">
                    <span>Оставить заявку</span>
                </a>
            </div>
            <div class="object-page__inner">
                <div class="row">
                <? foreach ($arResult['SECTIONS'] as $section) { ?>
                    <div class="<?=$section['Class']['div']?>">
                        <a class="services__item <?=$section['Class']['a']?>" href="<?=$section['SECTION_PAGE_URL']?>">
                            <span class="services__item-inner">
                                <span class="services__item-title"><?=$section["NAME"]?></span>
                                <? if (count($section['Children'])) { ?>
                                    <object>
                                        <ul class="services__item-list">
                                        <? foreach ($section['Children'] as $child) {?>
                                            <li><a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a></li>
                                        <? } ?>
                                        </ul>
                                    </object>
                                <? } ?>
                                <span class="services__item-icon">
                                    <svg><use xlink:href="#arrow2"></use></svg>
                                </span>
                                <span class="services__item-img"><img src="<?=$section['PICTURE']['SRC']?>" alt=""> </span>
                            </span>
                        </a>
                    </div>
                <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>