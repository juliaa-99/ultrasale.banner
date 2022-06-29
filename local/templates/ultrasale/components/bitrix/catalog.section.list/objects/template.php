<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);
?>
<div class="object-page">
    <div class="object-page__holder">
        <div class="container">
            <div class="title-main">
                <h1><?= $APPLICATION->GetTitle(true); ?></h1><a class="button button-primary" href="#"
                                                                data-toggle="modal"
                                                                data-target="#modalApp"><span>Оставить заявку</span></a>
            </div>
            <div class="object-page__inner">
                <div class="row">
                    <?
                    foreach ($arResult['SECTIONS'] as $section) { ?>
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="objects__item"
                                 style="background-image: url('<?= $section['PICTURE']['SAFE_SRC'] ?>')"><a
                                        href="<?= $section['SECTION_PAGE_URL'] ?>"></a>
                                <div class="objects__item-title"><?= $section['NAME'] ?></div>
                                <div class="objects__item-tx"><?= $section['DESCRIPTION'] ?></div>
                                <div class="objects__item-arrow">
                                    <svg>
                                        <use xlink:href="#arrow2"></use>
                                    </svg>
                                </div>
                                <div class="objects__item-numb"><?= $section['UF_DONE_COUNT'] ?></div>
                                <div class="objects__item-arrow-mob"><img
                                            src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/arrow-roud.svg" alt="">
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>