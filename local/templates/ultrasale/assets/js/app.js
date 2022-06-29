'use strict';

$(document).ready(function () {
    (function bannerShow() {
        const banner = document.querySelector('.banner')
        if (!banner) return

        setTimeout(() => {
            banner.classList.add('active')
        }, 500)
    })()

    $('.ll').theiaStickySidebar({
        additionalMarginTop: 30
    });

    $('.comparison__descr-category-title').on('click', function (event) {
        $(this).parent().toggleClass('open');
    });

    $('.catalog__more-btn').on('click', function (event) {
        $(this).parent().toggleClass('open');
    });

    $(".footer-top__title .arrow").on('click', function (event) {
        $(this).parent().parent().toggleClass('open');
    });

    $('.footer-top__lnk').on('click', function (event) {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });

    $(".filter__group-check").mCustomScrollbar();

    $('.filter__all').on('click', function (event) {
        $(this).toggleClass('open').prevAll().toggleClass('open');
    });
    // $('.js-filter-mob').on('click', function (event) {
    //     $('.catalog-page__left').addClass('op');
    //     $('body').addClass('overfl');
    // });
    // $('.js-filter-close').on('click', function (event) {
    //     $('.catalog-page__left').removeClass('op');
    //     $('body').removeClass('overfl');
    // });
    $('.filter__title').on('click', function (event) {
        $(this).toggleClass('open').parent('.filter__item').toggleClass('open');
    });

    // $('.cart-product__description-tx-table-link').on('click', function (e) {
    //     $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top }, 1000);
    //     e.preventDefault();
    // });

    $('.mounting__text-btn').on('click', function (e) {
        $(this).parent().toggleClass('open');
    });

    $('.about-page__inf-left-list-btn').on('click', function (e) {
        $(this).prev().toggleClass('open');
    });

    $(".header__search-in input").keyup(function () {
        let searchContainer = $('.header__search-product');
        // INKODER Делаем запрос на ajax, получаем результат, добавляем в контейнер, показываем.
        if ($(this).val().length > 3) {
            $.get( "/ajax/search.php", {'q':$(this).val(),'sessid':$(this).data('session')}, function( data ) {
                searchContainer.empty();
                searchContainer.html(data);
            });
            $(this).parent().addClass('op');
        } else {
            $(this).parent().removeClass('op');
        }
    });

    // $('.certificates__btn-mob').on('click', function (e) {
    //     $(this).prev().addClass('open');
    // });

    $('.header__search-lnk').on('click', function (e) {
        $(this).parent().addClass('open');
        $('input[name=q]').focus();
    });
    $('.button.header__search-close').on('click', function (e) {
        $('input[name="q"]').val('');
        $(this).parent().removeClass('op');
        $('.header__search-product').empty();
        $('.header__search').removeClass('open');
    });

    $('.header__mob-toggler').on('click', function (e) {
        $(this).toggleClass('open');
        $('.header').toggleClass('open');
        $('body').toggleClass('overfl');
    });

    $('.header__menu ul > li.drop .arrow').on('click', function (e) {
        $(this).parent().toggleClass('op');
    });

    $('.js-certificates').slick({

        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 575,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.js-banner-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        fade: true,
        cssEase: 'linear'
    });

    $('.js-news-item-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        fade: true,
        cssEase: 'linear'
    });

    $('.comparison__slider').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 575,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.cart-product__slider-for.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        fade: true,
        asNavFor: '.slider-nav',
        responsive: [{
            breakpoint: 991,
            settings: {
                dots: true,
                arrows: false
            }
        }]
    });
    $('.cart-product__slider-nav.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        vertical: true,
        verticalSwiping: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                vertical: false,
                verticalSwiping: false,
                variableWidth: true
            }
        }]
    });

    $('.clients__inner').slick({
        slidesToShow: 8,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 575,
            settings: {
                slidesToShow: 2
            }
        }]
    });

    $('.js-certificates-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true
    });

    $(".polzunok-5").slider({
        min: $(".polzunok-5").data('min'),
        max: $(".polzunok-5").data('max'),
        values: [$(".polzunok-5").data('min-current'), $(".polzunok-5").data('max-current')],
        range: true,
        animate: true,
        slide: function slide(event, ui) {
            $(".polzunok-input-5-left").val(ui.values[0]);
            $(".polzunok-input-5-right").val(ui.values[1]);
        }
    });
    $(".polzunok-input-5-left").val($(".polzunok-5").slider("values", 0));
    $(".polzunok-input-5-right").val($(".polzunok-5").slider("values", 1));
    $(document).focusout(function () {
        var input_left = $(".polzunok-input-5-left").val(),
            opt_left = $(".polzunok-5").slider("option", "min"),
            where_right = $(".polzunok-5").slider("values", 1),
            input_right = $(".polzunok-input-5-right").val(),
            opt_right = $(".polzunok-5").slider("option", "max"),
            where_left = $(".polzunok-5").slider("values", 0);
        if (input_left > where_right) {
            input_left = where_right;
        }
        if (input_left < opt_left) {
            input_left = opt_left;
        }
        if (input_left == "") {
            input_left = 0;
        }
        if (input_right < where_left) {
            input_right = where_left;
        }
        if (input_right > opt_right) {
            input_right = opt_right;
        }
        if (input_right == "") {
            input_right = 0;
        }
        $(".polzunok-input-5-left").val(input_left);
        $(".polzunok-input-5-right").val(input_right);
        $(".polzunok-5").slider("values", [input_left, input_right]);
    });
    $('.polzunok-5').draggable();

    $('.catalog-page__content-vw select, .form__item select').selectric({
        inheritOriginalWidth: true,
    });
});


function parseLocalFavs(){
    $(".catalog__item-fav").each(function(){$(this).removeClass('active')});
    let favs = JSON.parse(localStorage.getItem("favorites")) || [];
    $('.header__fav .header__cart-numb').text(favs.length);
    if (favs.length > 0){
        $.each(favs, function(i, val){
            $(".catalog__item-fav[data-id="+val+"]").addClass("active");
        });
        if ($("body").data("is_authorized")){
            $.ajax({
                url: "/ajax/favorite_sync.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: favs,
                    sessid: $("body").data("session_id")
                }
            }).done(function(response){
                if (response.status == "OK"){
                    localStorage.removeItem("favorites");
                } else {
                    console.log("Error: "+response.payload);
                }
            });
        }
    }
}

function parseAuthorizedFavs(){
    // $(".catalog__item-fav").each(function(){$(this).removeClass('active')});
    // $.ajax({
    //     url: "/ajax/load_favs.php",
    //     type: "GET",
    //     dataType: "html",
    //     data: {
    //         sessid: $("body").data("session_id")
    //     }
    // }).done(function(response){
    //     $("#favsList").replaceWith(response);
    //     console.log(response);
    // });
}

function loadLocalFavs(){
    let favs = JSON.parse(localStorage.getItem("favorites")) || [];
    $('.header__fav .header__cart-numb').text(favs.length);
    $.ajax({
        url: "/ajax/load_favs.php",
        type: "GET",
        dataType: "html",
        data: {
            id: favs,
            sessid: $("body").data("session_id")
        }
    }).done(function(response){
        $("#favsList").replaceWith(response);
        $('.catalog__item-fav').each(function () {
            $(this).addClass('active');
        })

        $('.jsToggleCompare').click(function(){
            let compareNum = parseInt($('.compare-numb').html());
            if(!$(this).parent().hasClass('active'))
                compareNum--;
            else
                compareNum++;
            $('.compare-numb').html(compareNum);
        });

        $('.catalog__item-fav').click(function(){
            if($(this).hasClass('active')) $(this).parent().parent().parent().parent().remove();
        })

    });
}

$(document).ready(function(){
    if ($("body").data("is_authorized")){
        parseAuthorizedFavs();
    } else {
        parseLocalFavs();
    }

    $(document).on("click", ".catalog__item-fav", function(e){
        e.preventDefault();
        let $link = $(this);
        let id = $link.data("id");
        $(this).toggleClass("active");
        if ($("body").data("is_authorized")){
            $.ajax({
                url: "/ajax/favorite.php",
                type: "POST",
                dataType: "json",
                data: {
                    action: ($(this).hasClass("active") ? "add" : "del"),
                    id: id,
                    sessid: $("body").data("session_id")
                }
            }).done(function(response){
                if (response.status != "OK"){
                    console.log("Ошибка", response.payload);
                } else {
                    $('.header__fav .header__cart-numb').text(response.payload);
                }
            });
        } else {
            let favs = JSON.parse(localStorage.getItem("favorites")) || [];
            if ($(this).hasClass("active")){
                if ($.inArray(id, favs) == -1){
                    favs.push(id);
                }
            } else {
                favs = $.grep(favs, function(val){
                    return val != id;
                });
            }
            $('.header__fav .header__cart-numb').text(favs.length);
            localStorage.setItem("favorites", JSON.stringify(favs));
        }
    });
})
//# sourceMappingURL=app.js.map

$(document).ready(function(){
    $('.jsToggleCompare').click(function(){
        let compareNum = parseInt($('.compare-numb').html());
        if(!$(this).parent().hasClass('active'))
            compareNum--;
        else
            compareNum++;
        $('.compare-numb').html(compareNum);
    });


// order props
    $('#bx-soa-properties input[name=ORDER_PROP_2]').mask('+7 (999) 999-99-99');
    $('#bx-soa-properties input[name=ORDER_PROP_3]').change(function(){
        if(!validateEmail($(this).val())){
            // $(this).val('');
            $(this).css('border','1px solid red');
        } else {
            $(this).css('border','1px solid rgba(169, 171, 189, 0.4)');
        }
    });
// /order props


    $('input[type=email]').change(function(){
        if(!validateEmail($(this).val())){
            // $(this).val('');
            $(this).css('border','1px solid red');
        } else {
            $(this).css('border','1px solid rgba(255, 255, 255, 0.4)');
        }
    });

    // let newUrl = window.location.href;
    // $('.selectric-wrapper select').on('change',function(e){
    //     newUrl = updateURLParameter(window.location.href, 'amount', $(this).val());
    //     window.location.href = newUrl;
    // });

    // $(".js-send-success").click(function(){
    //     $('#modalThanks').modal('show')
    // })

    $(".js-catalog-view-type").click(function(){
        var type = $(this).attr('type');
        document.cookie = "catalog_view_type="+ type +"; max-age=604800; path=/";
        location.reload();
    })

    $(".js-catalog-count-to-view").on("change", function(){
        var type = $(this).val();
        document.cookie = "catalog_count_to_view="+ type +"; max-age=604800; path=/";
        location.reload();
    })

    $(".js-catalog-sort").click(function(){
        var type = $(this).attr('sort1');
        var arrow = $(this).attr('order1');
        document.cookie = "sort1="+ type +"; max-age=604800; path=/";
        document.cookie = "order1="+ arrow +"; max-age=604800; path=/";
        location.reload();
    })

    $(".js-catalog_product_quantity").click(function(){
        var type = $(this).attr('active');
        document.cookie = "catalog_product_quantity="+ type +"; max-age=604800; path=/";
        location.reload();
    })

    $(".js-catalog-available").on('change',function(){
        location.href = location.pathname + '?available_type=' + $(this).val();
    })

    $(".js-modal-query-price").click(function (){
        $('#get_price input[name=product_id]').val($(this).attr('prodid'));
    })

    $('.js-filter-mob').on('click', function (event) {
        $('body').toggleClass('overfl');
        $('.catalog__sidebar').toggleClass('catalog__sidebar_hide');
    });

    $('.js-filter-close').on('click', function (event) {
        $('body').toggleClass('overfl');
        $('.catalog__sidebar').toggleClass('catalog__sidebar_hide');
    });

    $(".js-catalog-show-more").click(function(){
        var url = $(this).attr('data-url');
        var page = $(this).attr('page');
        url += page;
        BX.ajax({
            method: 'GET',
            dataType: 'html',
            url: url + (url.indexOf('?') !== -1 ? '&' : '?') + 'ajax_action1=Y',
            onsuccess: function(data){
                var cards = $(data).find('.row').html();
                $('.catalog_products').find('.row').append(cards);
                var page = $('.catalog_products').find('.js-catalog-show-more').attr('page');
                page = parseInt(page) + 1;
                $('.catalog_products').find('.js-catalog-show-more').attr('page', page);
            }
        });
    })

    $(".js-scrol-to-pay-tab").click(function(e){
        e.preventDefault();

        $("#myTab .nav-item a").removeClass('active');
        $("#myTab #pay-tab").addClass('active');

        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $("#pay").addClass('active');
        $("#pay").addClass('show');

        // $("#myTab").scroll();
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#myTab").offset().top
        }, 500);
    });

    $(".js-open-all-reviws").click(function(e) {
        e.preventDefault();

        $('.cart-product__content-reviews-item').removeClass('d-none');
    })
});

function validateEmail(email) {
    // var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return re.test(String(email).toLowerCase());
}

function updateURLParameter(url, param, paramVal)
{
    let TheParams;
    let tmpAnchor;
    let TheAnchor = null;
    let newAdditionalURL = "";
    let tempArray = url.split("?");
    let baseURL = tempArray[0];
    let additionalURL = tempArray[1];
    let temp = "";

    if (additionalURL)
    {
        tmpAnchor = additionalURL.split("#");
        TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if(TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i=0; i<tempArray.length; i++)
        {
            if(tempArray[i].split('=')[0] != param)
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    else
    {
        tmpAnchor = baseURL.split("#");
        TheParams = tmpAnchor[0];
        TheAnchor  = tmpAnchor[1];

        if(TheParams)
            baseURL = TheParams;
    }

    if(TheAnchor)
        paramVal += "#" + TheAnchor;

    let rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}

// function setFilterCount(count){
//     $(document).ready(function(){
//         $('.filter_count').text(' ( '+count+' )')
//     })
// }