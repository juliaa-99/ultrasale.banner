<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Сотрудничество");
?>
<div class="news-item">
    <div class="news-item__holder">
        <div class="container">
            <div class="news-item__inner">
                <div class="news-item__text statistics-ab">
                    <h1><?=$APPLICATION->GetTitle(true);?></h1>
                    <p>Наша компания готова выполнить подрядные и субподрядные работы по проектированию, монтажу и поставке инженерного оборудования.</p>
                    <p> Мы сотрудничаем с архитектурными и строительными компаниями, службами эксплуатации зданий.</p>
                    <p> В качестве партнеров мы готовы рассматривать дизайнеров, прорабов, представителей технадзора. Учтем все интересы и пожелания.</p>
                    <p>Наши специалисты проведут экспертную оценку проекта или готовой системы вентиляции, доработают или реанимируют их на любой стадии с последующей гарантией.</p>
                    <div class="statistics">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="statistics__item bg1">
                                    <div class="statistics__item-tx">Огромный опыт, <br>накопленный за годы</div>
                                    <div class="statistics__item-numb">
                                        <div class="statistics__item-numb-nb">15</div>
                                        <div class="statistics__item-numb-tx">лет на рынке</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="statistics__item bg2">
                                    <div class="statistics__item-tx">Клиентоориентированность <br>и повышение уровня качества</div>
                                    <div class="statistics__item-numb">
                                        <div class="statistics__item-numb-nb">1200</div>
                                        <div class="statistics__item-numb-tx">проектов</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="statistics__item bg3">
                                    <div class="statistics__item-tx">Квалифицированные <br>специалисты</div>
                                    <div class="statistics__item-numb">
                                        <div class="statistics__item-numb-nb">45</div>
                                        <div class="statistics__item-numb-tx">сотрудников</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Начните сотрудничество с нами сейчас</h4>
                    <p>По всем вопросам звоните по телефону: <a href="tel:+74951207022"><b>+7 (495) 120-70-22</b></a> или воспользуйтесь формой обратной связи</p>
                </div><!-- div.soc
            <ul>
              <li><a href="#"><svg><use xlink:href="#soc-i1"></use></svg></a></li>
              <li><a href="#"><svg><use xlink:href="#soc-i2"></use></svg></a></li>
              <li><a href="#"><svg><use xlink:href="#soc-i3"></use></svg></a></li>
              <li><a href="#"><svg><use xlink:href="#soc-i4"></use></svg></a></li>
            </ul>
            <div class="soc-title">поделиться--></div>
        </div>
    </div>
</div>
<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "inline_app",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_2',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'inline_app001',
        'FORM_NAME'             => 'Свяжитесь с нами',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'FILE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ),
    )
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
