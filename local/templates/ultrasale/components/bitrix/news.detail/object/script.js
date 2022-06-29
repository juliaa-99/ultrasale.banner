/**
 * Created by Sergey Akulov (sergey.a.akulov@gmail.com) on 16.11.2021.
 */
"use strict";

$(document).ready(function(){
    // Init
    let amount;
    let counter = 0;
    let block = $('.js-block[data-hide="true"]');
    let button = $('a[data-rel=".js-block"]');
    if (typeof block.data('amount') !== "undefined") {
        amount = parseInt(block.data('amount'));
    } else {
        amount = 4;
    }
    hideBlocks();

    function showBlocks() {
        counter = 0;
        block.children('div').each(function(){
            counter++;
            if (counter>amount) {
                $(this).show()
            }
        });
    }

    function hideBlocks() {
        counter = 0;
        block.children('div').each(function(){
            counter++;
            if (counter>amount) {
                $(this).hide()
            }

        });
    }

    button.on('click',function(e){
        e.preventDefault();
        if (typeof $(this).data('state') == 'undefined' || $(this).data('state') === 'hidden') {
            showBlocks();
            $(this).data('state','shown');
            $(this).find('span').text('Свернуть');
        } else {
            hideBlocks();
            $(this).data('state','hidden');
            $(this).find('span').text('Показать еще');
        }
    });
});