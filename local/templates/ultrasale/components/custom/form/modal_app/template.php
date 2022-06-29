<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
?>
    <div class="modal fade call" id="modalApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <svg>
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
                <div class="modal__text modal__text-call" id="form_<?= $arParams['TOKEN'] ?>">
                    <div class="form__inner">
                        <div class="form__holder">
                            <div class="modal__text-title">Оставить заявку</div>
                            <form>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form__item">
                                            <input type="text" name="name" placeholder="Имя" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form__item">
                                            <input type="email" name="email" placeholder="Почта" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form__item">
                                            <input name="phone" type="text" placeholder="Телефон" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form__item">
                                            <input type="text" name="text" placeholder="Текст сообщения" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="form__item form__item-upload">
                                            <input class="form__input form__input_type_file" name="file" type="file"
                                                   id="m-question-file<?= $arParams['TOKEN'] ?>" multiple>
                                            <label for="m-question-file<?= $arParams['TOKEN'] ?>" data-default="Прикрепить файл"><img
                                                        src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/upload.svg"
                                                        alt=""><span>Прикрепить файл</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form__item form__item-bottom">
                                            <button  class="button button-primary" type="submit" ><span>Отправить</span>
                                            </button>
                                            <div class="form__item-tx">Нажимая кнопку, я даю согласие на обработку <br>своих
                                                персональных данных в соответствии <br>с <a href="/policy/">Политикой
                                                    конфиденциальности</a></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}
