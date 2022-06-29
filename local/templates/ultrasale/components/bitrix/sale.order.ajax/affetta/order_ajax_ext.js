(function () {
    'use strict';

    var initParent = BX.Sale.OrderAjaxComponent.init,
        getBlockFooterParent = BX.Sale.OrderAjaxComponent.getBlockFooter,
        editOrderParent = BX.Sale.OrderAjaxComponent.editOrder
    ;

    BX.namespace('BX.Sale.OrderAjaxComponentExt');

    BX.Sale.OrderAjaxComponentExt = BX.Sale.OrderAjaxComponent;

    BX.Sale.OrderAjaxComponentExt.init = function (parameters) {
        initParent.apply(this, arguments);

        var editSteps = this.orderBlockNode.querySelectorAll('.bx-soa-editstep'), i;
        for (i in editSteps) {
            if (editSteps.hasOwnProperty(i)) {
                BX.remove(editSteps[i]);
            }
        }

        // Переопределяю блоки для отображения итогов
        if (this.totalBlockNode)
        {
            this.totalInfoBlockNode = this.totalBlockNode.querySelector('.js-cart-total');
            BX.removeClass(this.totalInfoBlockNode,'bx-soa-cart-total');
            this.totalGhostBlockNode = this.totalBlockNode.querySelector('.bx-soa-cart-total-ghost');
        }

    };

    BX.Sale.OrderAjaxComponentExt.getBlockFooter = function (node) {
        var parentNodeSection = BX.findParent(node, {className: 'bx-soa-section'});

        var sections = this.orderBlockNode.querySelectorAll('.bx-soa-section.bx-active'),
            firstSection = sections[0],
            lastSection = sections[sections.length - 1],
            currentSection = BX.findParent(node, {className: "bx-soa-section"}),
            isLastNode = false,
            buttons = [];



        if (/bx-soa-auth|bx-soa-properties|bx-soa-basket/.test(parentNodeSection.id)) {
            BX.remove(parentNodeSection.querySelector('.pull-left'));
            BX.remove(parentNodeSection.querySelector('.pull-right'));
        }

    };

    /**
     * Edit order block nodes with this.result/this.params data
     */

    BX.Sale.OrderAjaxComponentExt.editOrder = function (section) {

            if (!this.orderBlockNode || !this.result)
                return;

            this.orderSaveBlockNode.style.display = this.result.SHOW_AUTH ? 'none' : '';
            this.mobileTotalBlockNode.style.display = this.result.SHOW_AUTH ? 'none' : '';

            this.checkPickUpShow();

            var sections = this.orderBlockNode.querySelectorAll('.bx-soa-section.bx-active'), i;
            for (i in sections)
            {
                if (sections.hasOwnProperty(i))
                {
                    this.editSection(sections[i]);
                }
            }

            this.editTotalBlock();
            this.totalBlockFixFont();

            this.showErrors(this.result.ERROR, false);
            this.showWarnings();



        var sections = this.orderBlockNode.querySelectorAll('.bx-soa-section.bx-active'), i;

        for (i in sections) {
            if (sections.hasOwnProperty(i)) {
                /* Скрывем блоки, не подходящие под маску */
                if (!(/bx-soa-auth|bx-soa-properties|bx-soa-basket|bx-soa-paysystem|bx-soa-delivery/.test(sections[i].id))) {
                    sections[i].classList.add('bx-soa-section-hide');
                } else if (/bx-soa-auth|bx-soa-properties|bx-soa-basket|bx-soa-paysystem|bx-soa-delivery/.test(sections[i].id)) {
//                    sections[i].classList.add(['bx-selected','bx-active']);
                }
            }
        }

        // дальше похожий код, но для сокрытия сайдбара с общей ценой
        var sections2 = this.orderBlockNode.querySelectorAll('.bx-soa-sidebar'), i;

        for (i in sections2) {
            if (sections2.hasOwnProperty(i)) {
                if (!(/bx-soa-total/.test(sections2[i].id))) {
                    sections2[i].classList.add('bx-soa-section-hide');
                }
            }
        }


        this.show(BX('bx-soa-properties'));

        this.editActiveBasketBlock(true);

        this.alignBasketColumns();

        if (!this.result.IS_AUTHORIZED) {
            this.switchOrderSaveButtons(true);
        }

    };


    BX.Sale.OrderAjaxComponentExt.initFirstSection = function (parameters) {
            var firstSection = this.orderBlockNode.querySelector('.bx-soa-section.bx-active');
//            BX.addClass(firstSection, 'bx-selected');
            this.activeSectionId = firstSection.id;
    };

    BX.Sale.OrderAjaxComponentExt.totalBlockScrollCheck = function()
    {
        if (!this.totalInfoBlockNode || !this.totalGhostBlockNode)
            return;

        var scrollTop = BX.GetWindowScrollPos().scrollTop,
            ghostTop = BX.pos(this.totalGhostBlockNode).top,
            ghostBottom = BX.pos(this.orderBlockNode).bottom,
            width;

        if (ghostBottom - this.totalBlockNode.offsetHeight < scrollTop + 20)
            BX.addClass(this.totalInfoBlockNode, 'bx-soa-cart-total-bottom');
        else
            BX.removeClass(this.totalInfoBlockNode, 'bx-soa-cart-total-bottom');


    };

    /** INKODER Корзина */

    BX.Sale.OrderAjaxComponentExt.editTotalBlock = function()
    {
        if (!this.totalInfoBlockNode || !this.result.TOTAL)
            return;

        var total = this.result.TOTAL,
            priceHtml, params = {},
            discText, valFormatted, i,
            curDelivery, deliveryError, deliveryValue,
            showOrderButton = this.params.SHOW_TOTAL_ORDER_BUTTON === 'Y';

        BX.cleanNode(this.totalInfoBlockNode);

        if (parseFloat(total.ORDER_PRICE) === 0)
        {
            priceHtml = this.params.MESS_PRICE_FREE;
            params.free = true;
        }
        else
        {
            priceHtml = total.ORDER_PRICE_FORMATED;
        }

        if (this.options.showPriceWithoutDiscount)
        {
            priceHtml += '<br><span class="bx-price-old">' + total.PRICE_WITHOUT_DISCOUNT + '</span>';
        }

        this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_SUMMARY'), priceHtml, params));

        if (this.options.showOrderWeight)
        {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_WEIGHT_SUM'), total.ORDER_WEIGHT_FORMATED));
        }

        if (this.options.showTaxList)
        {
            for (i = 0; i < total.TAX_LIST.length; i++)
            {
                valFormatted = total.TAX_LIST[i].VALUE_MONEY_FORMATED || '';
                this.totalInfoBlockNode.appendChild(
                    this.createTotalUnit(
                        total.TAX_LIST[i].NAME + (!!total.TAX_LIST[i].VALUE_FORMATED ? ' ' + total.TAX_LIST[i].VALUE_FORMATED : '') + ':',
                        valFormatted
                    )
                );
            }
        }

        params = {};
        curDelivery = this.getSelectedDelivery();
        deliveryError = curDelivery && curDelivery.CALCULATE_ERRORS && curDelivery.CALCULATE_ERRORS.length;

        if (deliveryError)
        {
            deliveryValue = BX.message('SOA_NOT_CALCULATED');
            params.error = deliveryError;
        }
        else
        {
            if (parseFloat(total.DELIVERY_PRICE) === 0)
            {
                deliveryValue = this.params.MESS_PRICE_FREE;
                params.free = true;
            }
            else
            {
                deliveryValue = total.DELIVERY_PRICE_FORMATED;
            }

            if (
                curDelivery && typeof curDelivery.DELIVERY_DISCOUNT_PRICE !== 'undefined'
                && parseFloat(curDelivery.PRICE) > parseFloat(curDelivery.DELIVERY_DISCOUNT_PRICE)
            )
            {
                deliveryValue += '<br><span class="bx-price-old">' + curDelivery.PRICE_FORMATED + '</span>';
            }
        }

        if (this.options.showDiscountPrice)
        {
            discText = this.params.MESS_ECONOMY;
            if (total.DISCOUNT_PERCENT_FORMATED && parseFloat(total.DISCOUNT_PERCENT_FORMATED) > 0)
                discText += total.DISCOUNT_PERCENT_FORMATED;

            this.totalInfoBlockNode.appendChild(this.createTotalUnit(discText + ':', cutRub(total.DISCOUNT_PRICE_FORMATED), {highlighted: true}));
        }


        if (this.result.DELIVERY.length)
        {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_DELIVERY'), deliveryValue, params));
        }



        if (this.options.showPayedFromInnerBudget)
        {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_IT'), total.ORDER_TOTAL_PRICE_FORMATED));
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_PAYED'), total.PAYED_FROM_ACCOUNT_FORMATED));
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_LEFT_TO_PAY'), total.ORDER_TOTAL_LEFT_TO_PAY_FORMATED, {total: true}));
        }
        else
        {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_IT'), total.ORDER_TOTAL_PRICE_FORMATED, {total: true}));
        }

        if (parseFloat(total.PAY_SYSTEM_PRICE) >= 0 && this.result.DELIVERY.length)
        {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_PAYSYSTEM_PRICE'), '~' + total.PAY_SYSTEM_PRICE_FORMATTED));
        }

        if (!this.result.SHOW_AUTH)
        {
            this.totalInfoBlockNode.appendChild(
                BX.create('DIV', {
                    props: {className: 'bx-soa-cart-total-button-container' + (!showOrderButton ? ' d-block d-sm-none' : '')},
                    children: [
                        BX.create('A', {
                            props: {
                                href: 'javascript:void(0)',
                                className: 'btn btn-primary btn-lg btn-order-save'
                            },
                            html: this.params.MESS_ORDER,
                            events: {
                                click: BX.proxy(this.clickOrderSaveAction, this)
                            }
                        })

                    ]
                })
            );
        }

        this.editMobileTotalBlock();
    };

    BX.Sale.OrderAjaxComponentExt.editMobileTotalBlock = function()
    {
        if (this.result.SHOW_AUTH)
            BX.removeClass(this.mobileTotalBlockNode, 'd-block d-sm-none');
        else
            BX.addClass(this.mobileTotalBlockNode, 'd-block d-sm-none');

        BX.cleanNode(this.mobileTotalBlockNode);
        this.mobileTotalBlockNode.appendChild(this.totalInfoBlockNode.cloneNode(true));
        BX.bind(this.mobileTotalBlockNode.querySelector('a.bx-soa-price-not-calc'), 'click', BX.delegate(function(){
            this.animateScrollTo(this.deliveryBlockNode);
        }, this));
        BX.bind(this.mobileTotalBlockNode.querySelector('a.btn-order-save'), 'click', BX.proxy(this.clickOrderSaveAction, this));
    };

    BX.Sale.OrderAjaxComponentExt.createTotalUnit = function(name, value, params)
    {
        var totalValue, className = 'cart-order__total-item';
        let extClass = '';

        name = name || '';
        value = value || '';
        params = params || {};

        if (params.error)
        {
            totalValue = [BX.create('A', {
                props: {className: 'bx-soa-price-not-calc'},
                html: value,
                events: {
                    click: BX.delegate(function(){
                        this.animateScrollTo(this.deliveryBlockNode);
                    }, this)
                }
            })];
        }
        else if (params.free)
        {
            extClass = ' tw';
            totalValue = [value];
        }
        else
        {
            totalValue = [value];
        }

        if (params.total)
        {
            className += ' all';
        }


        return BX.create('DIV', {
            props: {className: className},
            children: [
                BX.create('DIV', {props: {className: 'cart-order__total-text'}, text: name}),
                BX.create('DIV', {
                    props: {
                        className: 'cart-order__total-price'
                    },
                    children: [
                        BX.create('DIV', {
                            props: {
                                className: 'cart-order__total-price-pr '+extClass
                            },
                            children: cutRub(totalValue)
                        })
                    ]
                })
            ]
        });
    };

    BX.Sale.OrderAjaxComponentExt.createBasketItem = function(basketItemsNode, item, index, active)
    {
        var mainColumns = [],
            otherColumns = [],
            hiddenColumns = [],
            currentColumn, basketColumnIndex = 0,
            i, tr, cols;

        if (this.options.showPreviewPicInBasket || this.options.showDetailPicInBasket)
            mainColumns.push(this.createBasketItemImg(item.data));

        mainColumns.push(this.createBasketItemContent(item.data));

        for (i = 0; i < this.result.GRID.HEADERS.length; i++)
        {
            currentColumn = this.result.GRID.HEADERS[i];

            if (currentColumn.id === 'NAME' || currentColumn.id === 'PREVIEW_PICTURE' || currentColumn.id === 'PROPS' || currentColumn.id === 'NOTES')
                continue;

            if (currentColumn.id === 'DETAIL_PICTURE' && !this.options.showPreviewPicInBasket)
                continue;

            otherColumns.push(this.createBasketItemColumn(currentColumn, item, active));

            ++basketColumnIndex;
            if (basketColumnIndex == 4 && this.result.GRID.HEADERS[i + 1])
            {
                otherColumns.push(BX.create('DIV', {props: {className: 'bx-soa-item-nth-4p1'}}));
                basketColumnIndex = 0;
            }
        }

        if (active)
        {
            for (i = 0; i < this.result.GRID.HEADERS_HIDDEN.length; i++)
            {
                tr = this.createBasketItemHiddenColumn(this.result.GRID.HEADERS_HIDDEN[i], item);
                if (BX.type.isArray(tr))
                    hiddenColumns = hiddenColumns.concat(tr);
                else if (tr)
                    hiddenColumns.push(tr);
            }
        }
/*
        cols = [
            BX.create('DIV', {
                props: {className: 'catalog__item catalog__item-list'},
                children: mainColumns
            })
        ].concat(otherColumns);
*/
        basketItemsNode.appendChild(BX.create('DIV', {
            props: {className: 'catalog__item catalog__item-list'},
            children: mainColumns.concat(otherColumns)
        }));
/*        basketItemsNode.appendChild(
            BX.create('DIV', {
                props: {className: 'catalog__item catalog__item-list'},
                children: cols
            })
        );
*/

    }

    BX.Sale.OrderAjaxComponentExt.createBasketItemImg = function(data)
    {
        if (!data)
            return;

        var logoNode, logotype;

        logoNode = BX.create('DIV', {props: {className: 'bx-soa-item-imgcontainer'}}); // INKODER  --

        if (data.PREVIEW_PICTURE_SRC && data.PREVIEW_PICTURE_SRC.length)
            logotype = this.getImageSources(data, 'PREVIEW_PICTURE');
        else if (data.DETAIL_PICTURE_SRC && data.DETAIL_PICTURE_SRC.length)
            logotype = this.getImageSources(data, 'DETAIL_PICTURE');

        if (logotype && logotype.src_2x)
        {
            logoNode.setAttribute('style',
                'background-image: url("' + logotype.src_1x + '");' +
                'background-image: -webkit-image-set(url("' + logotype.src_1x + '") 1x, url("' + logotype.src_2x + '") 2x);'+
                'width:100%; height: 100%; border: none; padding-top:0;'
            );
        }
        else
        {
            logotype = logotype && logotype.src_1x || this.defaultBasketItemLogo;
            logoNode.setAttribute('style', 'background-image: url("' + logotype + '");');
        }

        if (this.params.HIDE_DETAIL_PAGE_URL !== 'Y' && data.DETAIL_PAGE_URL && data.DETAIL_PAGE_URL.length)
        {
            logoNode = BX.create('A', {
                props: {href: data.DETAIL_PAGE_URL, className: 'catalog__item-img'},
                children: [logoNode]
            });
        }

/*        return BX.create('DIV', {
            props: {className: 'bx-soa-item-img-block', style:'width: 100px;'},
            children: [logoNode]
        });
 */
        return logoNode;
    }

    BX.Sale.OrderAjaxComponentExt.createBasketItemContent = function(data)
    {
        var itemName = data.NAME || '',
            titleHtml = this.htmlspecialcharsEx(itemName),
            props = data.PROPS || [],
            propsNodes = [];

        if (this.params.HIDE_DETAIL_PAGE_URL !== 'Y' && data.DETAIL_PAGE_URL && data.DETAIL_PAGE_URL.length)
        {
            titleHtml = '<a href="' + data.DETAIL_PAGE_URL + '" class="catalog__item-title">' + titleHtml + '</a>';
        }

        if (this.options.showPropsInBasket && props.length)
        {
            for (var i in props)
            {
                if (props.hasOwnProperty(i))
                {
                    var name = props[i].NAME || '',
                        value = props[i].VALUE || '';

                    propsNodes.push(
                        BX.create('DIV', {
                            props: {className: 'bx-soa-item-td-title'},
                            style: {textAlign: 'left'},
                            text: name
                        })
                    );
                    propsNodes.push(
                        BX.create('DIV', {
                            props: {className: 'bx-soa-item-td-text'},
                            style: {textAlign: 'left'},
                            text: value
                        })
                    );
                }
            }
        }

        return titleHtml;
/*        return BX.create('DIV', {
            props: {className: 'bx-soa-item-content'},
            children: propsNodes.length ? [
                BX.create('DIV', {props: {className: 'bx-soa-item-title'}, html: titleHtml}),
                BX.create('DIV', {props: {className: 'bx-scu-container'}, children: propsNodes})
            ] : [
                BX.create('DIV', {props: {className: 'bx-soa-item-title'}, html: titleHtml})
            ]
        });
 */
    }


    BX.Sale.OrderAjaxComponentExt.editActiveBasketBlock = function(activeNodeMode)
    {
        var node = !!activeNodeMode ? this.basketBlockNode : this.basketHiddenBlockNode,
            basketContent, basketTable;

        if (this.initialized.basket)
        {
            this.basketHiddenBlockNode.appendChild(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.basketHiddenBlockNode));
        }
        else
        {
            basketContent = node.querySelector('.bx-soa-section-content');
//            BX.addClass(basketContent,'card-body-inner');
            basketTable = BX.create('DIV', {props: {className: 'bx-soa-item-table'}});

            if (!basketContent)
            {
                basketContent = this.getNewContainer();
                node.appendChild(basketContent);
            }
            else
            {
                BX.cleanNode(basketContent);
            }

            this.editBasketItems(basketTable, true);

            basketContent.appendChild(
                BX.create('DIV', {
                    props: {className: 'bx-soa-table-fade'},
                    children: [
                        BX.create('DIV', {
                            style: {overflowX: 'auto', overflowY: 'hidden'},
                            children: [basketTable]
                        })
                    ]
                })
            );

            if (this.params.SHOW_COUPONS_BASKET === 'Y')
            {
                this.editCoupons(basketContent);
            }

            this.getBlockFooter(basketContent);

            BX.bind(
                basketContent.querySelector('div.bx-soa-table-fade').firstChild,
                'scroll',
                BX.proxy(this.basketBlockScrollCheckEvent, this)
            );
        }

        this.alignBasketColumns();
    }

    BX.Sale.OrderAjaxComponentExt.editActivePropsBlock = function(activeNodeMode)
    {
        var node = activeNodeMode ? this.propsBlockNode : this.propsHiddenBlockNode,
            propsContent, propsNode, selectedDelivery, showPropMap = false, i, validationErrors;

        if (this.initialized.props)
        {
//            BX.remove(BX.lastChild(node));
            this.maps && setTimeout(BX.proxy(this.maps.propsMapFocusWaiter, this.maps), 200);
        }
        else
        {
            propsContent = node.querySelector('.bx-soa-section-content');
            if (!propsContent)
            {
                propsContent = this.getNewContainer();
                node.appendChild(propsContent);
            }
            else
                BX.cleanNode(propsContent);

            this.getErrorContainer(propsContent);

            propsNode = BX.create('DIV', {props: {className: 'row'}});
            selectedDelivery = this.getSelectedDelivery();

            if (
                selectedDelivery && this.params.SHOW_MAP_IN_PROPS === 'Y'
                && this.params.SHOW_MAP_FOR_DELIVERIES && this.params.SHOW_MAP_FOR_DELIVERIES.length
            )
            {
                for (i = 0; i < this.params.SHOW_MAP_FOR_DELIVERIES.length; i++)
                {
                    if (parseInt(selectedDelivery.ID) === parseInt(this.params.SHOW_MAP_FOR_DELIVERIES[i]))
                    {
                        showPropMap = true;
                        break;
                    }
                }
            }

            this.editPropsItems(propsNode);
            showPropMap && this.editPropsMap(propsNode);

            if (this.params.HIDE_ORDER_DESCRIPTION !== 'Y')
            {
                this.editPropsComment(propsNode);
            }

            propsContent.appendChild(propsNode);
            this.getBlockFooter(propsContent);

            if (this.propsBlockNode.getAttribute('data-visited') === 'true')
            {
                validationErrors = this.isValidPropertiesBlock(true);
                if (validationErrors.length)
                    BX.addClass(this.propsBlockNode, 'bx-step-error');
                else
                    BX.removeClass(this.propsBlockNode, 'bx-step-error');
            }
        }
    }


    /**
     * Edit certain block node
     */
    BX.Sale.OrderAjaxComponentExt.editSection = function(section)
    {
        if (!section || !section.id)
            return;

        var active = true,
            titleNode = section.querySelector('.bx-soa-section-title-container'),
            editButton, errorContainer;


        errorContainer = section.querySelector('.alert.alert-danger');
        this.hasErrorSection[section.id] = errorContainer && errorContainer.style.display != 'none';

        switch (section.id)
        {
            case this.authBlockNode.id:
                this.editAuthBlock();
                break;
            case this.basketBlockNode.id:
                this.editBasketBlock(active);
                break;
            case this.regionBlockNode.id:
                this.editRegionBlock(active);
                break;
            case this.paySystemBlockNode.id:
                this.editPaySystemBlock(active);
                break;
            case this.deliveryBlockNode.id:
                this.editDeliveryBlock(active);
                break;
            case this.pickUpBlockNode.id:
                this.editPickUpBlock(active);
                break;
            case this.propsBlockNode.id:
                this.editPropsBlock(active);
                break;
        }

        if (active)
            section.setAttribute('data-visited', 'true');
    }

    BX.Sale.OrderAjaxComponentExt.changeVisibleSection =  function(section, state)
    {
        var titleNode, content, editStep;

        if (section.id !== this.basketBlockNode.id)
        {
            content = section.querySelector('.bx-soa-section-content');
        }

        editStep = section.querySelector('.bx-soa-editstep');

        titleNode = section.querySelector('.bx-soa-section-title-container');
        if (titleNode && !state)
            BX.unbindAll(titleNode);
    }

    BX.Sale.OrderAjaxComponentExt.createBasketItemColumn = function(column, allData, active)
    {
        if (!column || !allData)
            return;

        var data = allData.columns[column.id] ? allData.columns : allData.data,
            toRight = BX.util.in_array(column.id, ["QUANTITY", "PRICE_FORMATED", "DISCOUNT_PRICE_PERCENT_FORMATED", "SUM"]),
            textNode = BX.create('DIV', {props: {className: 'bx-soa-item-td-text'}}),
            logotype, img;

        if (column.id === 'PRICE_FORMATED')
        {
            textNode.appendChild(BX.create('STRONG', {props: {className: 'bx-price'}, html: data.PRICE_FORMATED}));
            if (parseFloat(data.DISCOUNT_PRICE) > 0)
            {
                textNode.appendChild(BX.create('BR'));
                textNode.appendChild(BX.create('STRONG', {
                    props: {className: 'bx-price-old'},
                    html: data.BASE_PRICE_FORMATED
                }));
            }

            if (this.options.showPriceNotesInBasket && active)
            {
                textNode.appendChild(BX.create('BR'));
                textNode.appendChild(BX.create('SMALL', {text: data.NOTES}));
            }
        }
        else if (column.id === 'SUM')
        {
            let priceNode;

            if (parseFloat(data.DISCOUNT_PRICE) > 0)
            {
                priceNode = BX.create('DIV', {
                    props: {className: 'catalog__item-price'},
                    html: data[column.id],
                    children: [BX.create('DIV',{
                            props: {className: 'catalog__item-price-now'},
                            html: cutRub(data.SUM)
                        }),
                        BX.create('DIV',{
                            props: {className: 'catalog__item-price-old'},
                            html: cutRub(data.SUM_BASE_FORMATED)
                        })
                    ]
                });
            } else {
                priceNode = BX.create('DIV', {
                    props: {className: 'catalog__item-price'},
                    html: data[column.id],
                    children: [BX.create('DIV',{
                        props: {className: 'catalog__item-price-now'},
                        html: cutRub(data.SUM)
                    })
                    ]
                });
            }

            return priceNode;
        }
        else if (column.id === "QUANTITY")
        {
            return BX.create('DIV', {
                props: {className: 'catalog__item-nb'},
                html: data[column.id]
            });
        }

        else
        {
            var columnData = data[column.id], val = [];
            if (BX.type.isArray(columnData))
            {
                for (var i in columnData)
                {
                    if (columnData.hasOwnProperty(i))
                    {
                        if (columnData[i].type == 'image')
                            val.push(this.getImageContainer(columnData[i].value, columnData[i].source));
                        else if (columnData[i].type == 'linked')
                        {
                            textNode.appendChild(BX.create('SPAN', {html: columnData[i].value_format}));
                            textNode.appendChild(BX.create('BR'));
                        }
                        else if (columnData[i].value)
                        {
                            textNode.appendChild(BX.create('SPAN', {html: columnData[i].value}));
                            textNode.appendChild(BX.create('BR'));
                        }
                    }
                }

                if (val.length)
                {
                    textNode.appendChild(
                        BX.create('DIV', {
                            props: {className: 'bx-scu-list'},
                            children: [BX.create('UL', {props: {className: 'bx-scu-itemlist'}, children: val})]
                        })
                    );
                }
            }
            else if (columnData)
            {
                textNode.appendChild(BX.create('SPAN', {html: BX.util.htmlspecialchars(columnData)}));
            }
        }

        return BX.create('DIV', {
            props: {className: 'bx-soa-item-td bx-soa-item-properties' + (toRight ? ' bx-text-right' : '')},
            children: [
                BX.create('DIV', {
                    props: {className: 'bx-soa-item-td-title d-none d-md-block d-lg-none'},
                    text: column.name
                }),
                textNode
            ]
        });
    }


    BX.Sale.OrderAjaxComponentExt.editDeliveryBlock = function(active)
    {
        if (!this.deliveryBlockNode || !this.deliveryHiddenBlockNode || !this.result.DELIVERY)
            return;

        if (active)
            this.editActiveDeliveryBlock(true);
        else
            this.editFadeDeliveryBlock();

        this.checkPickUpShow();

        this.initialized.delivery = true;
    }

    BX.Sale.OrderAjaxComponentExt.editActiveDeliveryBlock = function(activeNodeMode)
    {
        var node = activeNodeMode ? this.deliveryBlockNode : this.deliveryHiddenBlockNode,
            deliveryContent, deliveryNode;

        if (this.initialized.delivery)
        {
            BX.remove(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.deliveryHiddenBlockNode));
        }
        else
        {
            deliveryContent = node.querySelector('.bx-soa-section-content');
            if (!deliveryContent)
            {
                deliveryContent = this.getNewContainer();
                node.appendChild(deliveryContent);
            }
            else
                BX.cleanNode(deliveryContent);

            this.getErrorContainer(deliveryContent);

            deliveryNode = BX.create('DIV', {props: {className: 'bx-soa-pp row'}});
            this.editDeliveryItems(deliveryNode);
            deliveryContent.appendChild(deliveryNode);
            this.editDeliveryInfo(deliveryNode);

            this.getBlockFooter(deliveryContent);
        }
    }

    BX.Sale.OrderAjaxComponentExt.editDeliveryItems = function(deliveryNode)
    {
        if (!this.result.DELIVERY || this.result.DELIVERY.length <= 0)
            return;

        var deliveryItemsContainer = BX.create('DIV', {props: {className: 'cart-order__delivery'}}),
            deliveryItemsContainerRow = BX.create('DIV', {props: {className: 'cart-order__delivery-inner'}}),
            deliveryItemNode, k;

        for (k = 0; k < this.deliveryPagination.currentPage.length; k++)
        {
            deliveryItemNode = this.createDeliveryItem(this.deliveryPagination.currentPage[k]);
            deliveryItemsContainerRow.appendChild(deliveryItemNode);
        }
        deliveryItemsContainer.appendChild(deliveryItemsContainerRow);

        if (this.deliveryPagination.show)
            this.showPagination('delivery', deliveryItemsContainer);

        deliveryNode.appendChild(deliveryItemsContainer);
    }

    BX.Sale.OrderAjaxComponentExt.editDeliveryInfo = function(deliveryNode)
    {
        if (!this.result.DELIVERY)
            return;

        // deliveryInfoContainer = BX.create('DIV', {props: {className: 'col-md-5 mb-lg-0 col-12 mb-3 order-md-2 order-1 bx-soa-pp-desc-container'}}),
        var currentDelivery, logotype, name, logoNode,
            subTitle, label, title, price, period,
            clear, infoList, extraServices, extraServicesNode;

//        BX.cleanNode(deliveryInfoContainer);
        currentDelivery = this.getSelectedDelivery();

        logoNode = BX.create('DIV', {props: {className: 'bx-soa-pp-company-image'}});
        logotype = this.getImageSources(currentDelivery, 'LOGOTIP');
        if (logotype && logotype.src_2x)
        {
            logoNode.setAttribute('style',
                'background-image: url("' + logotype.src_1x + '");' +
                'background-image: -webkit-image-set(url("' + logotype.src_1x + '") 1x, url("' + logotype.src_2x + '") 2x)'
            );
        }
        else
        {
            logotype = logotype && logotype.src_1x || this.defaultDeliveryLogo;
            logoNode.setAttribute('style', 'background-image: url("' + logotype + '");');
        }

        name = this.params.SHOW_DELIVERY_PARENT_NAMES != 'N' ? currentDelivery.NAME : currentDelivery.OWN_NAME;

        if (this.params.SHOW_DELIVERY_INFO_NAME == 'Y')
            subTitle = BX.create('DIV', {props: {className: 'bx-soa-pp-company-subTitle'}, text: name});

        label = BX.create('DIV', {
            props: {className: 'bx-soa-pp-company-logo'},
            children: [
                BX.create('DIV', {
                    props: {className: 'bx-soa-pp-company-graf-container'},
                    children: [logoNode]
                })
            ]
        });
        title = BX.create('DIV', {
            props: {className: 'bx-soa-pp-company-block'},
            children: [
                BX.create('DIV', {props: {className: 'bx-soa-pp-company-desc'}, html: currentDelivery.DESCRIPTION}),
                currentDelivery.CALCULATE_DESCRIPTION
                    ? BX.create('DIV', {props: {className: 'bx-soa-pp-company-desc'}, html: currentDelivery.CALCULATE_DESCRIPTION})
                    : null
            ]
        });

        if (currentDelivery.PRICE >= 0)
        {
            price = BX.create('LI', {
                children: [
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-list-termin'},
                        html: this.params.MESS_PRICE + ':'
                    }),
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-list-description'},
                        children: this.getDeliveryPriceNodes(currentDelivery)
                    })
                ]
            });
        }

        if (currentDelivery.PERIOD_TEXT && currentDelivery.PERIOD_TEXT.length)
        {
            period = BX.create('LI', {
                children: [
                    BX.create('DIV', {props: {className: 'bx-soa-pp-list-termin'}, html: this.params.MESS_PERIOD + ':'}),
                    BX.create('DIV', {props: {className: 'bx-soa-pp-list-description'}, html: currentDelivery.PERIOD_TEXT})
                ]
            });
        }

        clear = BX.create('DIV', {style: {clear: 'both'}});
        infoList = BX.create('UL', {props: {className: 'bx-soa-pp-list'}, children: [price, period]});
        extraServices = this.getDeliveryExtraServices(currentDelivery);

        if (extraServices.length)
        {
            extraServicesNode = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-block'},
                children: extraServices
            });
        }

        /*
        deliveryInfoContainer.appendChild(
            BX.create('DIV', {
                props: {className: 'bx-soa-pp-company'},
                children: [subTitle, label, title, clear, extraServicesNode, infoList]
            })
        );
        deliveryNode.appendChild(deliveryInfoContainer);
         */

        if (this.params.DELIVERY_NO_AJAX != 'Y')
            this.deliveryCachedInfo[currentDelivery.ID] = currentDelivery;
    }

    BX.Sale.OrderAjaxComponentExt.createDeliveryItem = function(item)
    {
        var checked = item.CHECKED == 'Y',
            deliveryId = parseInt(item.ID),
            labelNodes = BX.create('INPUT', {
                    props: {
                        id: 'ID_DELIVERY_ID_' + deliveryId,
                        name: 'DELIVERY_ID',
                        type: 'radio',
                        className: '',
                        value: deliveryId,
                        checked: checked
                    }
                }),
            deliveryCached = this.deliveryCachedInfo[deliveryId],
            logotype,
            label = BX.create('LABEL', {
                attrs: {
                        for: 'ID_DELIVERY_ID_' + deliveryId,

                    },
                html: this.params.SHOW_DELIVERY_PARENT_NAMES != 'N' ? item.NAME : item.OWN_NAME
                })
            , title, itemNode, logoNode;


        itemNode = BX.create('DIV', {
            props: {className: 'cart-order__delivery-item'},
            children: [labelNodes, label],
            events: {click: BX.proxy(this.selectDelivery, this)}
        });
//        checked && BX.addClass(itemNode, 'bx-selected');

        if (checked && this.result.LAST_ORDER_DATA.PICK_UP)
            this.lastSelectedDelivery = deliveryId;

        return itemNode;
    }


    BX.Sale.OrderAjaxComponentExt.selectDelivery = function(event)
    {
        if (!this.orderBlockNode)
            return;


        var target = event.target || event.srcElement,
            actionSection =  BX.hasClass(target, 'cart-order__delivery-item') ? target : BX.findParent(target, {className: 'cart-order__delivery-item'}),
            selectedSection = this.deliveryBlockNode.querySelector('.cart-order__delivery-item.bx-selected'),
            actionInput, selectedInput;

        if (BX.hasClass(actionSection, 'bx-selected'))
            return BX.PreventDefault(event);

        if (actionSection)
        {
            actionInput = actionSection.querySelector('input[type=radio]');
            BX.addClass(actionSection, 'bx-selected');
            actionInput.checked = true;
        }
        if (selectedSection)
        {
            selectedInput = selectedSection.querySelector('input[type=radio]');
            BX.removeClass(selectedSection, 'bx-selected');
            selectedInput.checked = false;
        }

        this.sendRequest();
    }

    BX.Sale.OrderAjaxComponentExt.getSelectedDelivery = function()
    {
        var deliveryCheckbox = this.deliveryBlockNode.querySelector('input[type=radio][name=DELIVERY_ID]:checked'),
            currentDelivery = false,
            deliveryId, i;


        if (deliveryCheckbox)
        {
            deliveryId = deliveryCheckbox.value;

            for (i in this.result.DELIVERY)
            {
                if (this.result.DELIVERY[i].ID == deliveryId)
                {
                    currentDelivery = this.result.DELIVERY[i];
                    break;
                }
            }
        }

        return currentDelivery;
    }


    BX.Sale.OrderAjaxComponentExt.editPaySystemBlock = function(active)
    {
        if (!this.paySystemBlockNode || !this.paySystemHiddenBlockNode || !this.result.PAY_SYSTEM)
            return;

        if (active)
            this.editActivePaySystemBlock(true);
        else
            this.editFadePaySystemBlock();

        this.initialized.paySystem = true;
    }

    BX.Sale.OrderAjaxComponentExt.editActivePaySystemBlock = function(activeNodeMode)
    {
        var node = activeNodeMode ? this.paySystemBlockNode : this.paySystemHiddenBlockNode,
            paySystemContent, paySystemNode;

        if (this.initialized.paySystem)
        {
            BX.remove(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.paySystemHiddenBlockNode));
        }
        else
        {
            paySystemContent = node.querySelector('.bx-soa-section-content');
            if (!paySystemContent)
            {
                paySystemContent = this.getNewContainer();
                node.appendChild(paySystemContent);
            }
            else
                BX.cleanNode(paySystemContent);

            this.getErrorContainer(paySystemContent);
            paySystemNode = BX.create('DIV', {props: {className: 'bx-soa-pp row'}});
            this.editPaySystemItems(paySystemNode);
            paySystemContent.appendChild(paySystemNode);

            this.getBlockFooter(paySystemContent);
        }
    }

    BX.Sale.OrderAjaxComponentExt.editPaySystemItems = function(paySystemNode)
    {
        if (!this.result.PAY_SYSTEM || this.result.PAY_SYSTEM.length <= 0)
            return;

        var paySystemItemsContainer = BX.create('DIV', {props: {className: 'cart-order__delivery'}}),
            paySystemItemsContainerRow = BX.create('DIV', {props: {className: 'cart-order__delivery-inner'}}),
            paySystemItemNode, i;

        for (i = 0; i < this.paySystemPagination.currentPage.length; i++)
        {
            paySystemItemNode = this.createPaySystemItem(this.paySystemPagination.currentPage[i]);
            paySystemItemsContainerRow.appendChild(paySystemItemNode);
        }
        paySystemItemsContainer.appendChild(paySystemItemsContainerRow);

        paySystemNode.appendChild(paySystemItemsContainer);
    }

    BX.Sale.OrderAjaxComponentExt.createPaySystemItem = function(item)
    {
        var checked = item.CHECKED == 'Y',
            logotype, logoNode,
            paySystemId = parseInt(item.ID),
            title, label, itemNode;

        itemNode = BX.create('DIV', {
            props: {className: 'cart-order__delivery-item'},
            children: [
                BX.create('INPUT', {
                    props: {
                        id: 'ID_PAY_SYSTEM_ID_' + paySystemId,
                        name: 'PAY_SYSTEM_ID',
                        type: 'radio',
                        className: '',
                        value: paySystemId,
                        checked: checked
                    }
                }),
                BX.create('LABEL',{
                    attrs: {for: 'ID_PAY_SYSTEM_ID_' + paySystemId},
                    html: item.NAME
                })
            ],
            events: {
                click: BX.proxy(this.selectPaySystem, this)
            }
        });

        if (checked)
            BX.addClass(itemNode, 'bx-selected');

        return itemNode;
    }

    BX.Sale.OrderAjaxComponentExt.editPaySystemInfo = function(paySystemNode)
    {
        if (!this.result.PAY_SYSTEM || (this.result.PAY_SYSTEM.length == 0 && this.result.PAY_FROM_ACCOUNT != 'Y'))
            return;

        var paySystemInfoContainer = BX.create('DIV', {
                props: {
                    className: (this.result.PAY_SYSTEM.length == 0 ? 'col-12 mb-3' : 'col-md-5 mb-lg-0') + ' col-12 mb-3 order-md-2 order-1 bx-soa-pp-desc-container'
                }
            }),
            innerPs, extPs, delimiter, currentPaySystem,
            logotype, logoNode, subTitle, label, title, price;

        BX.cleanNode(paySystemInfoContainer);

        if (this.result.PAY_FROM_ACCOUNT == 'Y')
            innerPs = this.getInnerPaySystem(paySystemInfoContainer);

        currentPaySystem = this.getSelectedPaySystem();
        if (currentPaySystem)
        {
            logoNode = BX.create('DIV', {props: {className: 'bx-soa-pp-company-image'}});
            logotype = this.getImageSources(currentPaySystem, 'PSA_LOGOTIP');
            if (logotype && logotype.src_2x)
            {
                logoNode.setAttribute('style',
                    'background-image: url("' + logotype.src_1x + '");' +
                    'background-image: -webkit-image-set(url("' + logotype.src_1x + '") 1x, url("' + logotype.src_2x + '") 2x)'
                );
            }
            else
            {
                logotype = logotype && logotype.src_1x || this.defaultPaySystemLogo;
                logoNode.setAttribute('style', 'background-image: url("' + logotype + '");');
            }

            if (this.params.SHOW_PAY_SYSTEM_INFO_NAME == 'Y')
            {
                subTitle = BX.create('DIV', {
                    props: {className: 'bx-soa-pp-company-subTitle'},
                    text: currentPaySystem.NAME
                });
            }

            label = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-logo'},
                children: [
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-company-graf-container'},
                        children: [logoNode]
                    })
                ]
            });

            title = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-block'},
                children: [BX.create('DIV', {props: {className: 'bx-soa-pp-company-desc'}, html: currentPaySystem.DESCRIPTION})]
            });

            if (currentPaySystem.PRICE && parseFloat(currentPaySystem.PRICE) > 0)
            {
                price = BX.create('UL', {
                    props: {className: 'bx-soa-pp-list'},
                    children: [
                        BX.create('LI', {
                            children: [
                                BX.create('DIV', {props: {className: 'bx-soa-pp-list-termin'}, html: this.params.MESS_PRICE + ':'}),
                                BX.create('DIV', {props: {className: 'bx-soa-pp-list-description'}, text: '~' + currentPaySystem.PRICE_FORMATTED})
                            ]
                        })
                    ]
                });
            }

            extPs = BX.create('DIV', {children: [subTitle, label, title, price]});
        }

        if (innerPs && extPs)
            delimiter = BX.create('HR', {props: {className: 'bxe-light'}});

        paySystemInfoContainer.appendChild(
            BX.create('DIV', {
                props: {className: 'bx-soa-pp-company'},
                children: [innerPs, delimiter, extPs]
            })
        );
        paySystemNode.appendChild(paySystemInfoContainer);
    }


    BX.Sale.OrderAjaxComponentExt.selectPaySystem = function(event)
    {
        if (!this.orderBlockNode || !event)
            return;

        var target = event.target || event.srcElement,
            innerPaySystemSection = this.paySystemBlockNode.querySelector('div.bx-soa-pp-inner-ps'),
            innerPaySystemCheckbox = this.paySystemBlockNode.querySelector('input[type=checkbox][name=PAY_CURRENT_ACCOUNT]'),
            fullPayFromInnerPaySystem = this.result.TOTAL && parseFloat(this.result.TOTAL.ORDER_TOTAL_LEFT_TO_PAY) === 0;

        var innerPsAction = BX.hasClass(target, 'bx-soa-pp-inner-ps') ? target : BX.findParent(target, {className: 'bx-soa-pp-inner-ps'}),
            actionSection =  BX.hasClass(target, 'cart-order__delivery-item') ? target : BX.findParent(target, {className: 'cart-order__delivery-item'}),
            actionInput, selectedSection;

        if (innerPsAction)
        {
            if (target.nodeName == 'INPUT')
                innerPaySystemCheckbox.checked = !innerPaySystemCheckbox.checked;

            if (innerPaySystemCheckbox.checked)
            {
                BX.removeClass(innerPaySystemSection, 'bx-selected');
                innerPaySystemCheckbox.checked = false;
            }
            else
            {
                BX.addClass(innerPaySystemSection, 'bx-selected');
                innerPaySystemCheckbox.checked = true;
            }
        }
        else if (actionSection)
        {
            if (BX.hasClass(actionSection, 'bx-selected'))
                return BX.PreventDefault(event);

            if (innerPaySystemCheckbox && innerPaySystemCheckbox.checked && fullPayFromInnerPaySystem)
            {
                BX.addClass(actionSection, 'bx-selected');
                actionInput = actionSection.querySelector('input[type=radio]');
                actionInput.checked = true;
                BX.removeClass(innerPaySystemSection, 'bx-selected');
                innerPaySystemCheckbox.checked = false;
            }
            else
            {
                selectedSection = this.paySystemBlockNode.querySelector('.cart-order__delivery-item.bx-selected');
                BX.addClass(actionSection, 'bx-selected');
                actionInput = actionSection.querySelector('input[type=radio]');
                actionInput.checked = true;

                if (selectedSection)
                {
                    BX.removeClass(selectedSection, 'bx-selected');
                    selectedSection.querySelector('input[type=radio]').checked = false;
                }
            }
        }

        this.sendRequest();
    }


    BX.Sale.OrderAjaxComponentExt.editPropsItems = function(propsNode)
    {

        if (!this.result.ORDER_PROP || !this.propertyCollection)
            return;

        var propsItemsContainer = BX.create('DIV', {props: {className: 'col-sm-12 cart-order__form'}}),
            group, property, groupIterator = this.propertyCollection.getGroupIterator(), propsIterator;

        if (!propsItemsContainer)
            propsItemsContainer = this.propsBlockNode.querySelector('.form-group');

        while (group = groupIterator())
        {
            propsIterator =  group.getIterator();
            while (property = propsIterator())
            {
                if (
                    this.deliveryLocationInfo.loc == property.getId()
                    || this.deliveryLocationInfo.zip == property.getId()
                    || this.deliveryLocationInfo.city == property.getId()
                )
                    continue;

                this.getPropertyRowNode(property, propsItemsContainer, false);
            }
        }

        propsNode.appendChild(propsItemsContainer);
    }


    BX.Sale.OrderAjaxComponentExt.getPropertyRowNode = function(property, propsItemsContainer, disabled)
    {
        var propsItemNode = BX.create('DIV'),
            textHtml = '',
            propertyType = property.getType() || '',
            propertyDesc = property.getDescription() || '',
            label;

        if (disabled)
        {
            propsItemNode.innerHTML = '<strong>' + BX.util.htmlspecialchars(property.getName()) + ':</strong> ';
        }
        else
        {
            BX.addClass(propsItemNode, "form-group bx-soa-customer-field");
        }

        switch (propertyType)
        {
            case 'LOCATION':
                this.insertLocationProperty(property, propsItemNode, disabled);
                break;
            case 'DATE':
                this.insertDateProperty(property, propsItemNode, disabled);
                break;
            case 'FILE':
                this.insertFileProperty(property, propsItemNode, disabled);
                break;
            case 'STRING':
                this.insertStringProperty(property, propsItemNode, disabled);
                break;
            case 'ENUM':
                this.insertEnumProperty(property, propsItemNode, disabled);
                break;
            case 'Y/N':
                this.insertYNProperty(property, propsItemNode, disabled);
                break;
            case 'NUMBER':
                this.insertNumberProperty(property, propsItemNode, disabled);
        }

        propsItemsContainer.appendChild(propsItemNode);
    }


    BX.Sale.OrderAjaxComponentExt.insertStringProperty = function(property, propsItemNode, disabled)
    {
        var prop, inputs, values, i, propContainer, propLabel='';

        propLabel = BX.util.htmlspecialchars(property.getName());
        if (property.isRequired())
            propLabel += '*';


        if (disabled)
        {
            prop = this.propsHiddenBlockNode.querySelector('div[data-property-id-row="' + property.getId() + '"]');
            if (prop)
            {
                values = [];
                inputs = prop.querySelectorAll('input[type=text]');
                if (inputs.length == 0)
                    inputs = prop.querySelectorAll('textarea');

                if (inputs.length)
                {
                    for (i = 0; i < inputs.length; i++)
                    {
                        if (inputs[i].value.length)
                            values.push(inputs[i].value);
                    }
                }

                propsItemNode.innerHTML += this.valuesToString(values);
            }
        }
        else
        {

            propContainer = BX.create('DIV', {props: {className: 'soa-property-container'}});
            property.appendTo(propContainer);
            propsItemNode.appendChild(propContainer);
            this.alterProperty(property.getSettings(), propContainer);
            this.alterProperty({DESCRIPTION:propLabel}, propContainer);
            this.bindValidation(property.getId(), propContainer);
        }
    }

})();

function cutRub(val) {
    re = /\s&#8381;/;
    if (typeof val !== 'undefined' && re.test(val.toString())) {
        return (val.toString().replace(re,''));
    } else {
        return val;
    }
}