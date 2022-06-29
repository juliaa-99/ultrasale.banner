<?php
/**
 * @global $APPLICATION
 * @global $arResult
 * @global $arParams
 */
?>

<script type="application/javascript">
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

            if(!validateEmail($('#form_<?=$arParams['TOKEN']?> *[name="email"]').val())) {
                $('#form_<?=$arParams['TOKEN']?> *[name="email"]').css('border', '1px solid red');
                return;
            }

            if (validate) {
                grecaptcha.ready(async () => {
                    const retoken = await grecaptcha.execute('<?=$arParams['RECAPTCHA_PUBLIC_KEY']?>', {action: 'feedback'})
                    let data = new FormData
                    data.append(`RECAPTCHA`, retoken)
                    data.append(`TOKEN`, `<?=$arParams['TOKEN']?>`)
                    data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="name"]`).val())
                    data.append(`PHONE`, $(`#form_<?=$arParams['TOKEN']?> *[name="phone"]`).val())
                    data.append(`EMAIL`, $(`#form_<?=$arParams['TOKEN']?> *[name="email"]`).val())
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
                                $('#get_price').modal('hide')
                                $('#modalThanks').modal('show')
                                $('#modalThanks').on('hidden.bs.modal', function () {
                                    location.reload();
                                })
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