<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-checkout-container cart-item__all" data-entity="basket-checkout-aligner">
		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
			?>
            <div class="cart-item__all-promo">
                <div class="cart-item__all-promo-inner">
                    <div class="promo">
                        <input type="text" placeholder="Введите промокод" data-entity="basket-coupon-input">
                        <button class="button promo-btn basket-coupon-block-coupon-btn" type="submit">Применить</button>
                    </div>
                </div>
            </div>

			<?
		}
		?>
        <div class="cart-item__all-btn basket-checkout-section">
            {{#DISCOUNT_PRICE_FORMATED}}
            <div class="basket-coupon-block-total-price-difference cart-item__all-sale">
                <div class="cart-item__all-sale-title"><?=Loc::getMessage('SBB_BASKET_ITEM_ECONOMY')?></div>
                <div class="cart-item__all-sale-price">{{{DISCOUNT_PRICE_FORMATED}}}</div>
            </div>
            {{/DISCOUNT_PRICE_FORMATED}}
            <div class="cart-item__all-tx">Итого:</div>
            <div class="cart-item__all-sum">
                <div class="catalog__item-price-now" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</div>
            </div>
            <div class="cart-item__all-btn-gr">
                <a class="button button-bord" href="/catalog/"><span>Продолжить
                        покупки</span></a><a class="button button-primary basket-btn-checkout{{#DISABLE_CHECKOUT}}
                disabled{{/DISABLE_CHECKOUT}}"
                        data-entity="basket-checkout-button">
                    <span>
                    <?=Loc::getMessage('SBB_ORDER')?>
                        </span>
                </a>
            </div>
        </div>
	</div>
    <?
    if ($arParams['HIDE_COUPON'] !== 'Y')
    {
        ?>
        <div class="basket-coupon-alert-section">
            <div class="basket-coupon-alert-inner">
                {{#COUPON_LIST}}
                <div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
						</span>
                    <span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
						</span>
                </div>
                {{/COUPON_LIST}}
            </div>
        </div>
        <?
    }
    ?>
</script>