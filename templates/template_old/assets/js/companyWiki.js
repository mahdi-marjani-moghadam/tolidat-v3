$(function () {
    var $body = $('body'),
        modal_edit = $('#modalWiki'),
        $pageType = $('#page_type');

    modal_edit.on('hide.bs.modal', function (e) {
        removeHashFromUrl();

        window.location.reload();
    });

    function removeHashFromUrl() {
        var url = window.location.href,
            urlTmp = url.split('/#');

        window.history.pushState({href: urlTmp[0]}, '', urlTmp[0]);
    }

    function checkRequiredEmpty(frm) {
        var cnt  = 0;
        $(frm).find('[required]').each(function() {
            if($(this).val().length === 0) {
                cnt++;
            }
        });

        return cnt === 0;
    }

    $("#editAllWiki").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[0];
        var formData = new FormData(form);

        if(!checkRequiredEmpty(form)) {
            $.iziToastError('لطفا تمامی موارد ستاره دار را پر نمایید.', '.iziEdit-container');

            return false;
        }

        $.ajax({
            url: '/wiki/editAllWiki/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                try {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.iziEdit-container');
                    } else {
                        $('.page2').show();
                        $('.verify').hide();
                        var fiveMinutes = 60 * 2;
                        startTimer(fiveMinutes);
                    }

                    return false;
                } catch(e) {console.log(e);}
            }
        });
    });

    var cnt = 0;
    $('.editWiki').bind('click', function (e) {
        e.preventDefault();

        if(cnt) return false;

        $(this).find('input, textarea').each(function () {
            $(this).val("");
        });

        modal_edit.find('.companyName').html($(this).data('companyname'));

        modal_edit.modal({
            show: true,
            backdrop: "static",
            keyboard: false
        });

        var company_id = $(this).data("value");
        $(".company_id_step1").val(company_id);

        removeHashFromUrl();

        var url = window.location.href;
        window.history.pushState({href: url + "/#/id="+company_id}, '', url + "/#/id="+company_id);

        /*$('.verify').show();
        $('.actualInformation').hide();
        $('.legalInformation').hide();
        $('.page2').hide();*/

        addFloatingLabel();

        cnt++;
    });

    /////////////// codeVerification jQuery /////////
    $("#codeVerification").on("submit", function (e) {
        e.preventDefault();
        var $this = $(this);

        $('.errorHandler').text('');
        var form = $('.form')[1];
        var formData = new FormData(form);
        var dataID = $(".company_id_step1").val();

        if(!checkRequiredEmpty(form)) {
            $.iziToastError('لطفا مد فعال سازی را وارد نمایید.', '.iziEdit-container');

            return false;
        }

        $.ajax({
            url: '/wiki/codeVerification/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);

                if (response.result == -1) {
                    $.iziToastError(response.msg, '.iziEdit-container');
                }
                else {
                    if (response.company_type == 2) {
                        $(".actualInformation").show();
                    } else if (response.company_type == 1) {
                        $(".legalInformation").show();
                    }

                    editItem(dataID, $this);
                    $(".verify").hide();
                    $('.page2').hide();
                    $('nav.menu2').html(response.category);
                    $('nav.menu2').each(function () {
                        var placeholder = $(this).attr('data-placeholder');
                        var title = $(this).attr('data-title');
                        $(this).mmenu({
                                "searchfield": {
                                    "placeholder": placeholder,
                                    "noResults": "جستجویی پیدا نشد",
                                    "add": true,
                                    "search": true,
                                    "resultsPanel": true,
                                    "showSubPanels": false,
                                    "showTextItems": true
                                },
                                extensions: ['effect-slide-menu', 'pageshadow'],
                                searchField: false,
                                counters: true,
                                navbars: [
                                    {
                                        position: 'top',
                                        content: ['searchfield']
                                    }
                                ],
                                navbar: {
                                    add: true,
                                    title: title,
                                    titleLink: "parent"
                                }
                            },
                            {
                                clone: false,
                                offCanvas: {
                                    menuWrapperSelector: $(this).parent()
                                },
                                "searchfield": {
                                    "clear": true
                                }
                            });
                    });

                    addFloatingLabel();

                    return false;
                }
            }
        });
    });

    function addFloatingLabel() {
        modal_edit.find('input, textarea').each(function () {
            if ($(this).val().length !== 0) {
                $(this).parent().addClass('typing');
            }

            if ($(this).attr('required')) {
                $(this).attr('autocomplete', 'off');
            }

            var val = $(this).val().length;

            if (val !== 0) {
                $(this).parents('.form-group').addClass('typing');
            } else if($(this).prop('tagName') !== undefined && $(this).prop('tagName') === 'SELECT') {
                $(this).parents('.form-group').addClass('typing');
            }
        });
    }

    ///////////////actualInformation jQuery /////////
    $("#actualInformation").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[2];
        var formData = new FormData(form);

        if(!checkRequiredEmpty(form)) {
            $.iziToastError('لطفا تمامی موارد ستاره دار را پر نمایید.', '.iziEdit-container');

            return false;
        }

        $.ajax({
            url: '/wiki/getActualInformation/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.result == -1) {
                    $.iziToastError(response.msg, '.iziEdit-container');
                } else {
                    modal_edit.modal('hide');
                }
                return false;
            }
        });
    });

    ///////////////legalInformation jQuery /////////
    $("#legalInformation").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[3];
        var formData = new FormData(form);


        $.ajax({
            url: '/wiki/getLegalInformation/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.result == -1) {
                    $.iziToastError(response.msg, '.iziEdit-container');
                } else {
                    modal_edit.modal('hide');
                }
                return false;
            }
        });
    });

    /////////////////////////////////////////////////////

    function editItem(dataID, $this) {

        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $this.find('image').each(function () {
            $this.attr("src", "");
        });
        $.post('/wiki/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data),
                html = '',
                selectedCatValue = '',
                companyType = '';
            $.each(result, function (key, value) {
                if (key === 'actual_image' || key === 'legal_image' || key ==='logo_image') {
                    modal_edit.find('img[name="' + key + '"]').attr('src', value);
                }
                else if (key === 'category_id') {
                    selectedCatValue = value;
                }
                else if(key === 'company_type') {
                    companyType = value;
                } else {
                    modal_edit.find('[name="' + key + '"]').val(value);
                }

                $('.selected-category').html(html);
            });

            var $obj = {};

            if (companyType === '1') {
                $('#legalInformation').find('.mm-panels input[value="' + selectedCatValue + '"]').prop('checked', true);

                $obj = {
                    container: $('#legalInformation')
                };

                $.fillSelectedCategories($obj);
            } else if (companyType === '2') {
                $('#actualInformation').find('.mm-panels input[value="' + selectedCatValue + '"]').prop('checked', true);

                $obj = {
                    container: $('#actualInformation')
                };

                $.fillSelectedCategories($obj);
            }

            getCity(dataID);
            getLicenceType(result);
            getPersonalityType(result);
            getRefrenceType(result.reference_type);
            getLicenceInformation(result);
            addFloatingLabel();
        });
    }

    $body.on('change', '#toggleLicense', function() {
        if($(this).is(':checked')) {
            $.addLicence();
        } else {
            $.removeLicence();
        }
    });

    function getLicenceInformation(result) {
        if (result.licence_number != '' && result.licence_number !=  null) {
            $.addLicence();
        }
        else {
            $.removeLicence();
        }
    }

    function getLicenceType(result) {
        $('.div-licence_type').hide();

        $('.licence_type').on('change', function () {
            if ($(this).val() == 0) {
                $('.div-licence_type').show();
            } else {
                $('.div-licence_type').hide();
            }
        });
        $.each(result.licence_list, function (key, value) {
            $('.licence_type').append($('<option>', {
                value: value.Licence_list_id,
                text: value.name
            }));
        });
        $('.licence_type').find('option[value="' + result.licence_type + '"]').attr('selected', true);
        $('.licence_type').append('<option value="0">غیره...</option>');
    }

    function getPersonalityType(result) {

        $('.personality_type').on('change', function () {
            $('.div-personality_type').show();
        });
        $.each(result.personality, function (key, value) {
            $('.personality_type').append($('<option>', {
                value: value.Personality_type_id,
                text: value.type
            }));
        });
        $('.personality_type').find('option[value="' + result.personality_type + '"]').attr('selected', true);
    }

    function getCity(dataID) {
        $.post('/wiki/getProvince', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            $('.province_id').append('<option value="0">استان را انتخاب کنید...</option>');
            $.each(result.province, function (key, value) {
                $('.province_id').append($('<option>', {
                    value: value.province_id,
                    text: value.name
                }));
            });
            $('.province_id').find('option[value="' + result.state_id + '"]').attr('selected', true);
            ///---------------- get City with Ajax
            $('.city_id').append('<option value="0">شهر را انتخاب کنید...</option>');
            $.each(result.city, function (key, value) {
                $('.city_id').append($('<option>', {
                    value: value.City_id,
                    text: value.name
                }));
            });
            $('.city_id').find('option[value="' + result.city_id + '"]').attr('selected', true);
        });

        ////////////////////////change city with Ajax
        $('.province_id').on('change', function () {
            var province_id = $(this).val();
            $('.city_id').empty();
            $.post('/city/getCityByProvinceID', {province_id: province_id}, function (data) {
                var result = $.parseJSON(data);
                $('.city_id').append('<option value="0">شهرستان را انتخاب کنید...</option>');
                $.each(result, function (key, value) {
                    $('.city_id').append($('<option>', {
                        value: value.City_id,
                        text: value.name
                    }));
                });
            });

        });
    }

    ////////////////////sendCodeAgain
    $('#sendCodeAgain').click(function () {
        if (timer != 0) {
            $.iziToastError('زمان انتظار شما به پایان نرسیده است', '.modal-body .iziContainer');
            $(".myBtn").prop( "disabled", true );
            return false;
        }
        $(this).attr('disabled', 'disabled').find('span.fa-refresh').hide();
        $(this).find('#loading').show();

        $.ajax({
            url: '/wiki/sendCodeAgain/',
            type: 'post',
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    $.iziToastSuccess(response.msg, '.iziEdit-container');
                    $('#sendCodeAgain').removeAttr('disabled');
                    $('#sendCodeAgain').find('span.fa-refresh').show();
                    $('#sendCodeAgain').find('#loading').hide();
                    var fiveMinutes = 60 * 2;
                    startTimer(fiveMinutes);
                } else if (response.result == -1) {
                    $.iziToastError(response.msg, '.iziEdit-container');
                    $('#sendCodeAgain').attr('disabled', 'disabled');
                    $('#sendCodeAgain').find('span.fa-refresh').show();
                    $('#sendCodeAgain').find('#loading').hide();
                }
            }
        });
    });


    ////////////////////duration
    var timerSetInterval,
        timer;
    function startTimer(duration) {
        var minutes,
            seconds;
         timer = duration;
         timerSetInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
             $('#time').html( minutes + ":" + seconds);

            if (--timer == 0) {
                timer = duration;
                $(".myBtn").prop( "disabled", false );
                $("#myTimer").fadeTo(1000, 0);
                clearInterval(timerSetInterval);
            }
        }, 1000);
    }


    //////////////////////methodType
    $('.reg-radio a').on('click', function (e) {
        e.preventDefault();
        $('.methodType').val($(this).attr('data-type'));
        $('.reg-radio a').removeClass('reg-active');
        $(this).addClass('reg-active');
    });

    var x = $('.methodType').val();
    $('.reg-radio a').removeClass('reg-active');
    $('.modal-step1')
        .find('.reg-radio:eq(' + x + ') a').addClass('reg-active');

    $('.modal-step1 input:nth-child(1)').focus();

    if ($('p.error').text().length != 0) {
        $.iziToastError($('p.error').text(), '.iziEdit-container');
    }

    ////////////////reference_type
    function getRefrenceType(reference_type) {
        $('.reference_type').find('option[value="' + reference_type + '"]').attr('selected', true);
        if ($('.reference_type').val() == 1) {
            $('.label_reference_value').empty().text('شماره روزنامه رسمی را وارد کنید');
        } else if ($('.reference_type').val() == 2) {
            $('.label_reference_value').empty().text('لینک سایت را وارد کنید');
        }
        $('.reference_type').on('change', function () {
            if ($('.reference_type').val() == 1) {
                $('.label_reference_value').empty().text('شماره روزنامه رسمی را وارد کنید');
            } else if ($('.reference_type').val() == 2) {
                $('.label_reference_value').empty().text('لینک سایت را وارد کنید');
            }
        });
    }

    $.addLicence = function () {
        $("#licenceBox").show();
        document.getElementById("remove_licence").value = 0;
    };

    $.removeLicence = function () {
        $("#licenceBox").hide();
        document.getElementById("remove_licence").value = 1;
    };

    $body.on('click', '#approvePrivacy', function() {
        if($(this).is(':checked')) {
            $body.find('#editAllWiki').slideDown('fast');
        } else {
            $body.find('#editAllWiki').slideUp('fast');
        }
    });

});
