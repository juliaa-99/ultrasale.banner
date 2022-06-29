<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<script id="basket-item-template" type="text/html">


    <div class="catalog__item catalog__item-line" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        <a href="{{DETAIL_PAGE_URL}}" class="catalog__item-img"><img alt="{{NAME}}"
                                                                     src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}"></a><a
                class="catalog__item-title" href="{{DETAIL_PAGE_URL}}">{{NAME}}</a>
        <div class="catalog__item-price mob  basket-item-block-price"  id="basket-item-height-aligner-{{ID}}">
            <div class="catalog__item-price-now" id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</div>
            {{#SHOW_DISCOUNT_PRICE}}
            <div class="catalog__item-price-old">
                {{{FULL_PRICE_FORMATED}}}
            </div>
            {{/SHOW_DISCOUNT_PRICE}}
        </div>
        <div class="catalog__item-amount">
            <div class="amount" data-entity="basket-item-quantity-block">
                <input type="text" class="basket-item-amount-filed" value="{{QUANTITY}}"
                       {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
                data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                id="basket-item-quantity-{{ID}}"><span class="up basket-item-amount-btn-plus"
                                                   data-entity="basket-item-quantity-plus"></span><span class="down
                                                   basket-item-amount-btn-minus" data-entity="basket-item-quantity-minus"></span>
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
            </div>
        </div>
        <div class="catalog__item-price basket-item-block-price">
            <div class="catalog__item-price-now basket-item-price-current-text" id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</div>
            {{#SHOW_DISCOUNT_PRICE}}
            <div class="catalog__item-price-old basket-item-price-old-text" id="basket-item-sum-price-old-{{ID}}">
                {{{SUM_FULL_PRICE_FORMATED}}}
            </div>
            {{/SHOW_DISCOUNT_PRICE}}
        </div>
        <a class="basket-item-actions-remove catalog__item-delete" data-entity="basket-item-delete">
            <svg>
                <use xlink:href="#close"></use>
            </svg>
        </a>
        {{#SHOW_LOADING}}
        <div class="basket-items-list-item-overlay"></div>
        {{/SHOW_LOADING}}
    </div>

</script>