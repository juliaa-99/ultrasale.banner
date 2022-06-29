<div class="modal fade call" id="modalCall" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <svg>
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="modal__text modal__text-call" id="form_<?= $arParams['TOKEN'] ?>">
                <div class="form__inner">
                    <div class="form__holder">
                        <div class="modal__text-title">Свяжитесь с нами</div>
                        <div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form__item">
                                        <input name="name" type="text" placeholder="Имя" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form__item">
                                        <input name="email" type="email" placeholder="Почта" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item">
                                        <input name="phone" type="text" placeholder="Телефон" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item">
                                        <input name="text" type="text" placeholder="Текст сообщения">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="form__item form__item-upload">
                                        <input name="file" class="form__input form__input_type_file" type="file"
                                               id="m-question-file">
                                        <label for="m-question-file" data-default="Прикрепить файл"><img
                                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/upload.svg" alt=""><span>Прикрепить файл</span></label>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item form__item-bottom">
                                        <button class="button button-primary" type="submit"><span>Отправить</span>
                                        </button>
                                        <div class="form__item-tx">Нажимая кнопку, я даю согласие на обработку <br>своих
                                            персональных данных в соответствии <br>с <a href="#">Политикой
                                                конфиденциальности</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}