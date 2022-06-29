<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);
?>

<div class="row">
    <?
    foreach ($arResult['SECTIONS'] as $section) { ?>
        <?
            $picture = $section['PICTURE']['SAFE_SRC'];
            if (empty($picture)) $picture = SITE_TEMPLATE_PATH."/assets/images/placeholder.png";
        ?>
        <div class="col-xl-4 col-lg-4 col-md-6"><a class="about-mont__item"
                                                   href="<?= $section['SECTION_PAGE_URL'] ?>"><span
                        class="about-mont__item-img"
                        style="background-image: url('<?= $picture ?>')
                                "></span><span
                        class="about-mont__item-tx"><span
                            class="about-mont__item-title"><?= $section['NAME'] ?></span><span
                            class="about-mont__item-arrow"><svg><use
                                    xlink:href="#arrow2"></use></svg></span></span></a></div>

    <? } ?>
</div>
