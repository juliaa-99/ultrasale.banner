<?php
/**
 * @global $APPLICATION
 * @global $arResult
 * @global $arParams
 */
?>

<script type="application/javascript">
    var previewWidth = 150, // ширина превью
        previewHeight = 150, // высота превью
        maxFileSize = 2 * 1024 * 1024, // (байт) Максимальный размер файла (2мб)
        selectedFiles = [],// объект, в котором будут храниться выбранные файлы
        queue = [],
        image = new Image(),
        imgLoadHandler,
        isProcessing = false,
        errorMsg, // сообщение об ошибке при валидации файла
        previewPhotoContainer = document.querySelector('#form_<?=$arParams['TOKEN']?> .modal__foto-inner'); // контейнер, в котором будут отображаться превью
 
    // Когда пользователь выбрал файлы, обрабатываем их
    $('input[type=file][id=review-photos<?= $arParams['TOKEN'] ?>]').on('change', function() {
        $('.modal__foto-text').css('display','none');

        var newFiles = $(this)[0].files; // массив с выбранными файлами
 
        for (var i = 0; i < newFiles.length; i++) {
 
            var file = newFiles[i];
 
            // В качестве "ключей" в объекте selectedFiles используем названия файлов
            // чтобы пользователь не мог добавлять один и тот же файл
            // Если файл с текущим названием уже существует в массиве, переходим к следующему файлу
            if (selectedFiles[file.name] != undefined) continue;
 
            // Валидация файлов (проверяем формат и размер)
            if ( errorMsg = validateFile(file) ) {
                alert(errorMsg);
                return;
            }
 
            // Добавляем файл в объект selectedFiles
            selectedFiles[file.name] = file;
            queue.push(file);
 
        }
 
        // $(this).val('');
        processQueue(); // запускаем процесс создания миниатюр
    });
 
    // Валидация выбранного файла (формат, размер)
    var validateFile = function(file)
    {
        if ( !file.type.match(/image\/(jpeg|jpg|png|gif)/) ) {
            return 'Фотография должна быть в формате jpg, png или gif';
        }
 
        if ( file.size > maxFileSize ) {
            return 'Размер фотографии не должен превышать 2 Мб';
        }
    };
 
    var listen = function(element, event, fn) {
        return element.addEventListener(event, fn, false);
    };
 
    // Создание миниатюры
    var processQueue = function()
    {
        // Миниатюры будут создаваться поочередно
        // чтобы в один момент времени не происходило создание нескольких миниатюр
        // проверяем запущен ли процесс
        if (isProcessing) { return; }
 
        // Если файлы в очереди закончились, завершаем процесс
        if (queue.length == 0) {
            isProcessing = false;
            return;
        }
 
        isProcessing = true;
 
        var file = queue.pop(); // Берем один файл из очереди
 
        var li = document.createElement('LI');
        var span = document.createElement('SPAN');
        var spanDel = document.createElement('SPAN');
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
 
        li.setAttribute('class', 'modal__foto-item');
        span.setAttribute('class', 'img');
        spanDel.setAttribute('class', 'delete modal__foto-cl');
        spanDel.innerHTML = '<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/close3.svg" alt="">';
 
        li.appendChild(span);
        li.appendChild(spanDel);
        li.setAttribute('data-id', file.name);
 
        image.removeEventListener('load', imgLoadHandler, false);
 
        // создаем миниатюру
        imgLoadHandler = function() {
            ctx.drawImage(image, 0, 0, previewWidth, previewHeight);
            URL.revokeObjectURL(image.src);
            span.appendChild(canvas);
            isProcessing = false;
            setTimeout(processQueue, 200); // запускаем процесс создания миниатюры для следующего изображения
        };
 
        // Выводим миниатюру в контейнере previewPhotoContainer
        previewPhotoContainer.prepend(li);
        listen(image, 'load', imgLoadHandler);
        image.src = URL.createObjectURL(file);
 
        // Сохраняем содержимое оригинального файла в base64 в отдельном поле формы
        // чтобы при отправке формы файл был передан на сервер
        var fr = new FileReader();
        fr.readAsDataURL(file);
        fr.onload = (function (file) {
            return function (e) {
                // $('#preview-photo').append(
                //         '<input type="hidden" name="photos[]" value="' + e.target.result + '" data-id="' + file.name+ '">'
                // );
            }
        }) (file);
    };
 
    // Удаление фотографии
    $(document).on('click', '#form_<?=$arParams['TOKEN']?> .modal__foto-inner li span.delete', function() {
        var fileId = $(this).parents('li').attr('data-id');
 
        if (selectedFiles[fileId] != undefined) delete selectedFiles[fileId]; // Удаляем файл из объекта selectedFiles
        $(this).parents('li').remove(); // Удаляем превью
        // $('input[name^=photo][data-id="' + fileId + '"]').remove(); // Удаляем поле с содержимым файла
    });



    `use strict`
    $(() => {

        $('#form_<?=$arParams['TOKEN']?> *[name="phone"]').mask('+7 (999) 999-99-99')

        $(`#form_<?=$arParams['TOKEN']?> *[name="file"]`).change(e => {
            $(e.currentTarget).next(`label`).html(e.currentTarget.files[0].name)
        })

        $(`#form_<?=$arParams['TOKEN']?>`).hover(() => {
            if (typeof recaptcha === "undefined") {
                const rescript = document.createElement('script');
                rescript.src = `https://www.google.com/recaptcha/api.js?render=<?= $arParams['RECAPTCHA_PUBLIC_KEY'] ?>`
                document.body.append(rescript)
            }
        })


        $(`#form_<?=$arParams['TOKEN']?> button`).click((e) => {
            e.preventDefault();

            let validate = true

            $(`#form_<?=$arParams['TOKEN']?> *[required]`).each((index, el) => {
                if ($(el).val() === '') {
                    $(el).css('border', '1px solid red')
                    validate = false
                } else if ($(el).is(':not(:checked)') && $(el).is(':checkbox')) {
                    $(el).parent().css('border', '1px solid red')
                    validate = false
                } else {
                    $(el).css('border', 'unset')
                }
            })
            
            if ($(`#form_<?=$arParams['TOKEN']?> *[name="rating"]:checked`).val() == undefined) validate = false

            let sendsPhoto = [];
            for (var key in selectedFiles) {
                sendsPhoto.push(selectedFiles[key]);
            };

            if (validate) {
                grecaptcha.ready(async () => {
                    const retoken = await grecaptcha.execute('<?=$arParams['RECAPTCHA_PUBLIC_KEY']?>', {action: 'feedback'})
                    let data = new FormData
                    data.append(`RECAPTCHA`, retoken)
                    data.append(`TOKEN`, `<?=$arParams['TOKEN']?>`)
                    data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="name"]`).val())
                    data.append(`MESSAGE`, $(`#form_<?=$arParams['TOKEN']?> *[name="text"]`).val())
                    data.append(`RATE`, $(`#form_<?=$arParams['TOKEN']?> *[name="rating"]:checked`).val())

                    data.append(`PHOTO1`, sendsPhoto[0])
                    data.append(`PHOTO2`, sendsPhoto[1])
                    data.append(`PHOTO3`, sendsPhoto[2])

                    data.append(`PRODUCT_ID`, $(`#form_<?=$arParams['TOKEN']?> *[name="product_id"]`).val())

                    $.ajax({
                        method: `post`,
                        url: "<?=$APPLICATION->GetCurDir()?>",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            data = JSON.parse(data)
                            if (data.status === true) {
                                // $('#modalReviews1').modal('hide')
                                // $('#modalThanks').modal('show')
                                // $('#modalThanks').on('hidden.bs.modal', function () {
                                    location.reload();
                                // })
                            } else {
                                alert(data.message)
                            }
                        }
                    })
                })
            }
        })
    })
</script>
