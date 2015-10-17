/* jQuery Validation Set Defaults */
(function () {
    if (!$.validator) {
        throw new Error('jquery.validate.js required');
    }

    $.validator.setDefaults({
        highlight: function (element) {
            return $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            return $(element).closest('.form-group').removeClass('has-error').find('help-block-hidden').removeClass('help-block-hidden').addClass('help-block').show();
        },
        errorElement: 'div',
        errorClass: 'jquery-validate-error',
        errorPlacement: function (error, element) {
            var $p, has_e, is_c;
            is_c = element.is('input[type="checkbox"]') || element.is('input[type="radio"]');
            has_e = element.closest('.form-group').find('.jquery-validate-error').length;
            if (!is_c || !has_e) {
                if (!has_e) {
                    element.closest('.form-group').find('.help-block').removeClass('help-block').addClass('help-block-hidden').hide();
                }
                error.addClass('help-block');
                if (is_c) {
                    return element.closest('[class*="col-"]').append(error);
                } else {
                    $p = element.parent();
                    if ($p.is('.input-group')) {
                        return $p.parent().append(error);
                    } else {
                        return $p.append(error);
                    }
                }
            }
        }
    });

}).call(this);

$(document).on('ready', function () {

    /* Default Form Submission Function */
    var defaultFormSubmit = function (form) {

        var submit = $(form).find(':submit');
        var default_text = submit.text();
        submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');


        form.submit();
    }

    var modalFormErrorPlacement = function (error, element) {
        $(element).parents('.modal-content').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
            function () {

                $(this).removeClass('animated shake');

            });

        var $p, has_e, is_c;
        is_c = element.is('input[type="checkbox"]') || element.is('input[type="radio"]');
        has_e = element.closest('.form-group').find('.jquery-validate-error').length;
        if (!is_c || !has_e) {
            if (!has_e) {
                element.closest('.form-group').find('.help-block').removeClass('help-block').addClass('help-block-hidden').hide();
            }
            error.addClass('help-block');
            if (is_c) {
                return element.closest('[class*="col-"]').append(error);
            } else {
                $p = element.parent();
                if ($p.is('.input-group')) {
                    return $p.parent().append(error);
                } else {
                    return $p.append(error);
                }
            }
        }
    }


    /* Validation */
    $.validator.setDefaults(
        {
            submitHandler: function (form) {


                defaultFormSubmit(form);


            }
        });

    $('#form-add-keyword').validate(
        {

            highlight: function (element) {

            },
            unhighlight: function (element) {

            },
            errorElement: 'div',
            errorClass: 'jquery-validate-error',
            errorPlacement: function (error, element) {
                return $(element).closest('.form-box').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {

                        $(this).removeClass('animated shake');

                    });
            },

            submitHandler: function (form) {

                var submit = $(form).find(':submit');
                var default_text = submit.html();
                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');

                $.post($(form).attr('action'), $(form).serialize(), function (data) {

                    _kmq.push(['record', 'Topic added to campaign', {'keyword': data.keyword_name, 'Campaign ID': data.campaign_id}]);

                    submit.html(default_text).prop('disabled', false);
                    if (data.status == 'success') {
                        $('#keyword-input').tooltip('destroy');
                        $('#keyword-ul').prepend('<li><a href="#" style="background: green">' + data.keyword_name + ' <span class="remove-keyword" data-route="/campaign/remove-keyword/' + data.keyword_hash + '/' + data.keyword_id + '"><i class="ico ico-times-circle"></i></span></a></li>');


                        $('#keyword-ul li:first-child a').animate({

                            backgroundColor: '#fff'

                        }, 2500);

                        $('#keyword-input').val('');
                    }
                    else {
                        $('#keyword-input').tooltip({
                            title: 'Keyword already added',
                            placement: 'left',
                            trigger: 'manual'
                        }).tooltip('show');

                        setTimeout(function () {
                            $('#keyword-input').tooltip('destroy');

                        }, 3000);
                    }

                });

                return false;
            }

        });

    $('.form-box').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function () {

            $(this).removeClass('animated shake');

        });

    /* Campaign Creation Form on /brands/ page */
    $('#form-campaign-creator-1').validate(
        {
            highlight: function (element) {

            },
            unhighlight: function (element) {

            },
            errorElement: 'div',
            errorClass: 'jquery-validate-error',
            errorPlacement: function (error, element) {

                return $(element).closest('.get-started').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {

                        $(this).removeClass('animated shake');

                    });
            },
            submitHandler: function (form) {
                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="url"]');
                url.val(addHttp(url.val()));

                _kmq.push(['record', 'Submitted Brands Page Step 1', {
                    'url': url.val(),
                    'form_location': 'top_marketers_page'
                }]);

                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();
            }
        });

    $('#form-campaign-creator-1-bottom').validate(
        {
            highlight: function (element) {

            },
            unhighlight: function (element) {

            },
            errorElement: 'div',
            errorClass: 'jquery-validate-error',
            errorPlacement: function (error, element) {
                return $(element).closest('.get-started').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {

                        $(this).removeClass('animated shake');

                    });
            },
            submitHandler: function (form) {

                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="url"]');
                url.val(addHttp(url.val()));

                _kmq.push(['record', 'Submitted Brands Page Step 1', {
                    'url': url.val(),
                    'form_location': 'bottom_marketers_page'
                }]);

                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();
            }
        });


    $('#form-edit-campaign-dashboard').validate(
        {
            submitHandler: function (form) {
                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="destination_blog_domain"]');
                url.val(addHttp(url.val()));
                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();
            }
        });

    $('.get-started').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function () {

            $(this).removeClass('animated shake');

        });

    /* blogger get started form */
    $('#form-create-blogger-account').validate(
        {
            highlight: function (element) {

            },
            unhighlight: function (element) {

            },
            errorElement: 'div',
            errorClass: 'jquery-validate-error',
            errorPlacement: function (error, element) {
                return $(element).closest('.get-started').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {

                        $(this).removeClass('animated shake');

                    });
            },
            submitHandler: function (form) {
                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="url"]');
                url.val(addHttp(url.val()));

                _kmq.push(['record', 'Submitted Blogger Signup Step 1', {
                    'url': url.val(),
                    'form_location': 'top_bloggers_page'
                }]);

                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();
            }
        });

    /* blogger get started form */
    $('#form-create-blogger-account-bottom').validate(
        {
            highlight: function (element) {

            },
            unhighlight: function (element) {

            },
            errorElement: 'div',
            errorClass: 'jquery-validate-error',
            errorPlacement: function (error, element) {
                return $(element).closest('.get-started').addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {

                        $(this).removeClass('animated shake');

                    });
            },
            submitHandler: function (form) {
                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="url"]');
                url.val(addHttp(url.val()));

                _kmq.push(['record', 'Submitted Blogger Signup Step 1', {
                    'url': url.val(),
                    'form_location': 'bottom_bloggers_page'
                }]);

                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();
            }
        });


    $('#form-update-campaign-blog').validate(
        {
            submitHandler: function (form) {

                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="blog_domain"]');
                url.val(addHttp(url.val()));
                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();

            }
        });

    $('#form-create-campaign').validate(
        {
            submitHandler: function (form) {

                var submit = $(form).find(':submit');
                var default_text = submit.text();
                var url = $(form).find('input[name="campaign_name"]');
                url.val(addHttp(url.val()));
                submit.attr('disabled', true).html('<i class="ico ico-spin ico-spinner"></i> Please wait...');
                form.submit();

            }
        });


    var $formsToValidate = [

        '#form-signup',
        '#form-edit-payout',
        '#form-edit-password',
        '#form-password_reset',
        '#form-edit-profile',
        '#form-edit-user',
        '#form-delete-client',
        '#form-create-client',
        '#form-create-license',
        '#form-add-blog',
        '#form-add-articles',
        '#form-add-advertiser',
        '#form-login',
        '#form-edit-campaign',
        '#form-add-author',
        '#form-edit-blog',
        '#form-create-account-blogger',
        '#form-approve-content',
        '#form-campaign-update-destination-blog',
        '#form-edit-blog-post',
        '#form-edit-content',
        '#lead-form-2',
        '#form-add-adbuyout-assets'
    ];


    var $modalFormsToValidate = [
        '#form-create-user',
        '#form-update-dashboard-segments',
        '#form-add-keywords'
    ];

    for (i = 0; i < $modalFormsToValidate.length; i++) {

        $($modalFormsToValidate[i]).validate(
            {
                errorPlacement: function (error, element) {
                    modalFormErrorPlacement(error, element);
                }
            });

    }

    for (i = 0; i < $formsToValidate.length; i++) {

        $($formsToValidate[i]).validate();

    }
});