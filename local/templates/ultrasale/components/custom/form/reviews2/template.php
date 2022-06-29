<div class="modal fade rev" id="modalReviews2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="form_<?= $arParams['TOKEN'] ?>">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><img
                        src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/close.svg" alt=""></button>
            <div class="modal__text th">
                <div class="modal__text-title">Оставить отзыв</div>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required />
                    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4" required/>
                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="3" required/>
                    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="2" required/>
                    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="1" required/>
                    <label class = "full" for="star3" title="Meh - 3 stars"></label>
                </div>
                <div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form__item">
                                <input type="text" placeholder="Имя" name="name" required>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form__item">
                                <textarea type="text" placeholder="Комментарий" name="text" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal__foto">
                    <div class="modal__foto-title">Добавить файл</div>
                    <div class="modal__foto-inner">
                        <div class="modal__foto-item"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ii.jpg" alt="">
                            <div class="modal__foto-cl"><img
                                        src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/close3.svg" alt=""></div>
                        </div>
                        <div class="modal__foto-prev"></div>
                    </div>
                </div>
                <div class="modal__rt"><button type="submit" class="button button-primary" href="#"><span>Оставить отзыв</span></button></div>
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
