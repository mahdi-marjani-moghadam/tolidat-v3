/*
 *
 *   start Poolad project
 *   data 03/01/2014
 *   ui : omid khosrojerdi
 *
 */


$(document).ready(function () {

    var $body = $('body'),
        windowWidth = $(window).width(),
        windowHeight = $(window).height(),
        $toggleSideBar = $('#toggleSideBar'),
        $datePicker = $('.date'),
        $sideBar = $('.side-left'),
        $categoryContainer = $('.container-view'),
        $updateAllowedCat = $('.updateAllowedCat'),
        $selectedCat = $('#selectedCategories');

    $body.find('.pdp-default').each(function (index) {
        $(this).insertAfter('.date:eq(' + index + ')');
    });


    /* ------ Responsive Menu ------*/
    $toggleSideBar.bind('click', function () {
        $sideBar.toggleClass('active');
    });

    $(window).resize(function(){
        var $body            = $('body'),
            windowWidth      = $(window).width(),
            $sideBar         = $('.side-left');

        if(windowWidth < 801)
        {
            $sideBar.find('li').has('ul').each(function(){
                $(this).find('a:eq(0)').addClass('hasMenu');
                $(this).find('ul').removeClass('animated flipInY');
            });

            $body.on('click','.hasMenu',function(){
                $(this).parent().find('ul').toggleClass('active');
            });
        }
        else
        {
            $sideBar.find('li').has('ul').each(function(){
                $(this).find('a:eq(0)').removeClass('hasMenu');
                $(this).find('ul').addClass('animated flipInY');
            });
        }
    });
    if(windowWidth < 801)
    {
        $sideBar.find('li').has('ul').each(function(){
            $(this).find('a:eq(0)').addClass('hasMenu');
            $(this).find('ul').removeClass('animated flipInY');
        });

        $body.on('click','.hasMenu',function(){
            $(this).parent().find('ul').toggleClass('active');
            $(this).parent().find('b').toggleClass('fa-rotate-180');
        });
    }


    /* ------ Check All ------*/
    $('label[for="checkAll"]').bind('click', function () {
        var input = $(this).find('input[id="checkAll"]');

        if (input.prop("checked")) {
            input.prop("checked", true);

            $('.companyTable tbody tr td:first-child input[type="checkbox"]').each(function () {
                $(this).prop("checked", true);
            });
        } else {
            input.prop("checked", false);

            $('.companyTable tbody tr td:first-child input[type="checkbox"]').each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    if($('select').length) {
        $('select').select2();
    }

    /* ------ Recorder------*/
    // Utility method that will give audio formatted time
    getAudioTimeByDec = function (cTime, duration) {
        var duration = parseInt(duration),
            currentTime = parseInt(cTime),
            left = duration - currentTime, second, minute;
        second = (left % 60);
        minute = Math.floor(left / 60) % 60;
        second = second < 10 ? "0" + second : second;
        minute = minute < 10 ? "0" + minute : minute;
        return minute + ":" + second;
    };

// Custom Audio Control using Jquery
    $("body").on("click", ".audioControl", function (e) {
        var ID = $(this).attr("id");
        var progressArea = $("#audioProgress" + ID);
        var audioTimer = $("#audioTime" + ID);
        var audio = $("#audio" + ID);
        var audioCtrl = $(this);
        e.preventDefault();
        var R = $(this).attr('rel');
        if (R == 'play') {
            $(this).removeClass('audioPlay').addClass('audioPause').attr("rel", "pause");
            audio.trigger('play');
        }
        else {
            $(this).removeClass('audioPause').addClass('audioPlay').attr("rel", "play");
            audio.trigger('pause');
        }

// Audio Event listener, its listens audio time update events and updates Progress area and Timer area
        audio.bind("timeupdate", function (e) {
            var audioDOM = audio.get(0);
            audioTimer.text(getAudioTimeByDec(audioDOM.currentTime, audioDOM.duration));
            var audioPos = (audioDOM.currentTime / audioDOM.duration) * 100;
            progressArea.css('width', audioPos + "%");
            if (audioPos == "100") {
                $("#" + ID).removeClass('audioPause').addClass('audioPlay').attr("rel", "play");
                audio.trigger('pause');
            }
        });
// Custom Audio Control End
    });

    $("body").on('click', '.recordOn', function () {
        $("#recordContainer").toggle();
    });
//Record Button
    $("#recordCircle").mousedown(function () {
        $(this).removeClass('startRecord').addClass('stopRecord');
        $("#recordContainer").removeClass('startContainer').addClass('stopContainer');
        $("#recordText").html("Stop");
        $.stopwatch.startTimer('sw'); // Stopwatch Start
        startRecording(this); // Audio Recording Start
    }).mouseup(function () {
        $.stopwatch.resetTimer(); // Stopwatch Reset
        $(this).removeClass('stopRecord').addClass('startRecord');
        $("#recordContainer").removeClass('stopContainer').addClass('startContainer');
        $("#recordText").html("Record");
        stopRecording(this); // Audio Recording Stop
    });

    // vaziry -> add phone numbers,emails,addresses to compony
    // phone
    $('#btn-add-phone-container').on('click', function (e) {

        e.preventDefault();
        var row =
            '<div class="row bordered-box select-select2">' +
                '<div class="col-xs-12 col-sm-6 col-md-2">' +
                    '<div class="form-group">' +
                        '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
                        '<div class="col-xs-12 col-sm-8 pull-right">' +
                            '<input type="text" class="form-control" name="company_phone[subject][]" id="phone_subject" value="">' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xs-12 col-sm-6 col-md-3">' +
                    '<div class="form-group">' +
                        '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">شماره تلفن</label>' +
                        '<div class="col-xs-12 col-sm-9 pull-right">' +
                            '<div class="input-group">' +
                                '<input type="text" class="form-control" id="phone_number" name="company_phone[number][]" value="" required>' +
                                '<div class="input-group-addon">+98</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xs-12 col-sm-6 col-md-2">' +
                    '<div class="form-group">' +
                        '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">کدتلفن:</label>' +
                            '<div class="col-xs-12 col-sm-8 pull-right">' +
                                '<input type="text" class="form-control" name="company_phone[code][]" id="phone_code value="" required>' +
                            '</div>' +
                     '</div>' +
                '</div>' +
                '<div class="col-xs-12 col-sm-6 col-md-2">' +
                    '<div class="form-group">' +
                        '<div class="col-xs-12 col-sm-8 pull-right">' +
                            '<select name="company_phone[state][]" class="select-phone-state checkPhone">' +
                                '<option value="0" selected> </option>' +
                                '<option value="1">داخلی</option>' +
                                '<option value="2">الی</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xs-12 col-sm-6 col-md-2">' +
                    '<div class="form-group formGroup">' +
                        '<label class="col-xs-12 col-sm-2 pull-right control-label rtl" for="">مقدار</label>' +
                        '<div class="col-xs-12 col-sm-8 pull-right">' +
                            '<input type="text" class="form-control" id="phone_value" name="company_phone[value][]" value="">' +
                        '</div>' +
                    '</div>' +
                '</div>' +

                '<div class="col-xs-12 col-sm-6 col-md-1">' +
                    '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-12 pull-right">' +
            '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-phone-container">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#phone-container').append(row);
        $('select').select2();
    });
    $('#phone-container').on('click', '.btn-remove-phone-container', function (e) {
        e.preventDefault();
        if ($('#phone-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });

    //checkPhone sakhamanesh
    var selectVal = $('.checkPhone').find('option[selected]').val();
    if (selectVal == 0) {
        $('.formGroup').css('display', 'none');
    }
    else {
        $('body').find('.formGroup').css('display','block');
    }

    $('body').on('change','.checkPhone', function () {
        if ($(this).val() == 0) {
            $('.formGroup').css('display', 'none');
        }
        else {
            $('body').find('.formGroup').css('display','block');
        }
    });

    // email
    $('#btn-add-email-container').on('click', function (e) {
        e.preventDefault();
        var row = '<div class="row bordered-box">' +
            '<div class="col-xs-12 col-sm-6 col-md-3">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<input type="text" class="form-control" name="company_email[subject][]" id="email_subject" value="">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-8">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس ایمیل</label>' +
            '<div class="col-xs-12 col-sm-9 pull-right">' +
            '<input type="email" class="form-control" id="email_email" name="company_email[email][]" value="">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-1">' +
            '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-12 pull-right">' +
            '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-email-container">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#email-container').append(row);
    });
    $('#email-container').on('click', '.btn-remove-email-container', function (e) {
        e.preventDefault();
        if ($('#email-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    // address
    $('#btn-add-address-container').on('click', function (e) {
        e.preventDefault();
        var row = '<div class="row bordered-box">' +
            '<div class="col-xs-12 col-sm-6 col-md-3">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<input type="text" class="form-control" name="company_address[subject][]" id="address_subject" value="">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-8">' +
                '<div class="form-group">' +
                    '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس</label>' +
                    '<div class="col-xs-12 col-sm-9 pull-right">' +
                        '<textarea class="form-control valid" id="address_address" name="company_address[address][]" rows="3"></textarea>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-8">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="postal_code">کد پستی</label>' +
            '<div class="col-xs-12 col-sm-9 pull-right">' +
            '<input class="form-control valid" id="postal_code" name="company_address[postal_code][]">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-1">' +
            '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-12 pull-right">' +
            '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-address-container">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#address-container').append(row);
    });
    $('#address-container').on('click', '.btn-remove-address-container', function (e) {
        e.preventDefault();
        if ($('#address-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });
    // website
    $('#btn-add-website-container').on('click', function (e) {
        e.preventDefault();
        var row = '<div class="row bordered-box">' +
            '<div class="col-xs-12 col-sm-6 col-md-3">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<input type="text" class="form-control" name="company_website[subject][]" id="website_subject" value="">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-8">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس وب سایت</label>' +
            '<div class="col-xs-12 col-sm-9 pull-right">' +
            '<input type="text" class="form-control valid" id="website_url" name="company_website[url][]">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-1">' +
            '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-12 pull-right">' +
            '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-website-container">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#website-container').append(row);
    });
    $('#website-container').on('click', '.btn-remove-website-container', function (e) {
        e.preventDefault();
        if ($('#website-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });

    if($('[data-toggle="popover"]').length) {
        $('[data-toggle="popover"]').popover({
            html: true,
        });
    }
    // end vaziry


    ///vahed
    // add history on history component
    $('#btn-add-history-container').on('click', function (e) {
        e.preventDefault();
        var row = '<div class="row">' +
            '<div class="col-xs-12 col-sm-12 col-md-6">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title"> عنوان :</label>' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<input type="text" class="form-control" name="history[title][]" id="title"  placeholder="عنوان" required value="">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-12 col-md-6">' +
            '<div class="form-group">' +
            '<label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">توضیحات :</label>' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<textarea name="history[description][]" class="form-control" id="description" placeholder="توضیحات" required="required"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="row xsmallSpace hidden-xs"></div>' +
            '<div class="row">' +
            '<div class="col-xs-12 col-sm-12 col-md-6">' +
            '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-8 pull-right">' +
            '<input name="history[]" class="" type="file" value="انتخاب فایل"  />' +
            '</div>' +
            '<div id="preview" style="display:none">' +
            '<strong>Selected Thumbnails</strong>' +
            '<div id="thumbnails"></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-sm-6 col-md-1">' +
            '<div class="form-group">' +
            '<div class="col-xs-12 col-sm-12 pull-right">' +
            '<a href="#" class="btn btn-sm btn-block btn-danger btn-remove-history-container">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div><br><br>' +
            '<hr style="border-width: 5px;color: #6B6464">' +
            '</div>';
        $('#history-container').append(row);
        $('select').select2();
    });

    $('#history-container').on('click', '.btn-remove-history-container', function (e) {
        e.preventDefault();
        if ($('#history-container .row').length > 0)
            $(this).parent().parent().parent().parent('.row').remove();
    });


    //------> hamid vahed

    //------> licence
    $("#addLicence").on("click", function () {
        $.addLicence();
    });

    $("#removeLicence").on("click", function () {
        $.removeLicence();
    });

    //------> end

        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var $dataRotate = $('#dataRotate');
        var $dataScaleX = $('#dataScaleX');
        var $dataScaleY = $('#dataScaleY');

        var options = {
            width: 250,
            height: 250,
            viewMode: 0,
            minContainerWidth: 250,
            minContainerHeight: 250,
            restore: false,
            aspectRatio: 1,
            preview: '.img-preview',
            crop: function (e) {
                $dataX.val(Math.round(e.x));
                $dataY.val(Math.round(e.y));
                $dataHeight.val(Math.round(e.height));
                $dataWidth.val(Math.round(e.width));
                $dataRotate.val(e.rotate);
                $dataScaleX.val(e.scaleX);
                $dataScaleY.val(e.scaleY);
            }
        };

        var cropper = $('.image-crop'); // logo

        function readURL(input, cropInstance) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img-container .image-crop').attr('src', e.target.result);
                    cropInstance.cropper('destroy');
                    cropInstance.cropper(options);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#myModal2').on('show.bs.modal', function (e) {
            cropper.cropper('destroy');
        });

        $('#myModal2').on('shown.bs.modal', function (e) {
            cropper = cropper.cropper(options);
        });


        $('#myModal1').on('shown.bs.modal', function (e) {
            cropper.cropper('destroy');
        });


        $('#avatar-modal').on('show.bs.modal', function (e) {
            cropper.cropper('destroy');
        });

        $('#avatar-modal').on('shown.bs.modal', function (e) {
            cropper = cropper.cropper(options);
        });

        $("#inputImage").change(function () {
            readURL(this, cropper);
        });

        $("#inputImageL").change(function () {
            readURL(this, cropper);
        });

        $("#inputImageLogo").change(function () {
            readURL(this, cropper);
        });

        $("#inputImage-edit").change(function () {
            readURL(this, cropper);
        });

        var myCanvas;

        function initCanvas(){
            try {
                myCanvas = document.getElementsByTagName("canvas");
                document.write('<img src="'+myCanvas[0].toDataURL("image/png")+'"/>');
            } catch(e) {}
        }

        window.addEventListener('load', initCanvas, false);

        cropper.on('cropend', function (e) {
            try {
                var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-crop').val(result.toDataURL('image/jpeg'));
            } catch(e) {}
        });

        cropper.on('zoom', function (e) {
            try {
                var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-crop').val(result.toDataURL('image/jpeg'));
            } catch(e) {}
        });

        cropper.on('ready', function (e) {
            try {
                var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-crop').val(result.toDataURL('image/jpeg'));
            } catch(e) {}
        });

      ///////////////////////////////////
    var $img1; // logo

    function readURL1(input, cropInstance) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                cropInstance.attr('src', e.target.result);
                cropInstance.cropper('destroy');
                cropInstance.cropper(options);
                $img1 = cropInstance;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $body.on('change', '.uploadImg', function () {
            var $img = $(this).parents('.cropper-parent').find('.image-crop1');
        readURL1(this, $img);
            window.addEventListener('load', initCanvas, false);
            try {
                $img.on('cropend', function (e) {
                    try {
                        var result = $img1.cropper('getCroppedCanvas', {fillColor: '#fff'});
                        $(this).parents('.cropper-parent').find('.result-crop1').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                });

                $img.on('zoom', function (e) {
                    try {
                        var result = $img1.cropper('getCroppedCanvas', {fillColor: '#fff'});
                        $(this).parents('.cropper-parent').find('.result-crop1').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                });

                $img.on('ready', function (e) {
                    try {
                        var result = $img1.cropper('getCroppedCanvas', {fillColor: '#fff'});
                        $(this).parents('.cropper-parent').find('.result-crop1').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                });
            } catch(e) {e}
    });

});







$.addLicence = function () {
    $("#removeLicence").show();
    $("body").find("#licenceBox input, #licenceBox select").prop("disabled",false);
    $("#licenceBox").show();
    $("#addLicence").hide();
}

$.removeLicence = function () {
    $("#addLicence").show();
    $("body").find("#licenceBox input, #licenceBox select").prop("disabled",true);
    $("#licenceBox").hide();
    $("#removeLicence").hide();
    $("#licence_number").val('') == '';
}

/* ------------------------------------------------------ */
/*  company add product form  */
/* ------------------------------------------------------ */