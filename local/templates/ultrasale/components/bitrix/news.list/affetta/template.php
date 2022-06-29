<?if (!empty($arResult)):?>
<?//dump($arResult['ITEMS']);?>
<div class="object-page__inner">
    <div class="row">
    <?foreach ($arResult['ITEMS'] as $item):
        $picture = CFile::GetPath($item['PICTURE']);
        $cols = ($item['UF_DISPLAY_TYPE'] == 5)?'col-xl-3 col-lg-3 col-md-6':'col-xl-6 col-lg-6 col-md-6';
        ?>
        <div class="<?=$cols?> ord">
            <a class="services__item" href="/<?=$item['LIST_PAGE_URL']?><?=$item['SECTION_PAGE_URL']?>"><span class="services__item-inner"><span class="services__item-title"><?=$item['NAME']?></span>
                <object>
                  <ul class="services__item-list">
                      <?foreach ($item['ELEMENTS'] as $element):?>
                          <li><a href="<?=$element['DETAIL_PAGE_URL']?>"><?=$element['NAME']?></a></li>
                      <?endforeach;?>
                  </ul>
                </object>
                <span class="services__item-icon">показать все <svg><use xlink:href="#arrow2"></use></svg></span>
                <span class="services__item-img"><img src="<?=$picture?>" alt=""></span></span>
            </a>
        </div>
    <?endforeach;?>
    </div>
</div>
<?endif?>