<div class="modal fade call" id="modalCall2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <div class="modal__text-title">Обратный звонок</div>
                        <div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item">
                                        <input name="name" type="text" placeholder="Имя" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item">
                                        <input name="phone" type="text" placeholder="Телефон" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form__item form__item-bottom">
                                        <button class="button button-primary js-send-success" type="submit"><span>Отправить</span>
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
