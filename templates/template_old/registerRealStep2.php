<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<section class="container noPadding">
    <!-- boxContainer -->
    <div class="boxContainer reg-container">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>مرحله : 2</span></a>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">اطلاعات درخواستی را با دقت وارد نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">2 از 7</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                    <div class="row xxsmallSpace"></div>
                    <div class="row xxsmallSpace hidden-xs"></div>

                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block">
                                <label for="licence_list_id">نوع جواز خود را انتخاب نمایید</label>
                                <select name="licence_list_id" id="licence_list_id" class="form-control" tabindex="1" autofocus required data-error="لطفا نوع جواز خود را انتخاب نمایید">
                                    <?php foreach ($list['licenceList'] as $licence) { ?>
                                        <option value="<?php echo $licence['Licence_list_id']; ?>" <?php if ($licence['Licence_list_id'] == $list['data']['licence_list_id']) {
                                            echo "selected";
                                        } ?>><?php echo $licence['name']; ?></option>
                                    <?php } ?>
                                    <option value="0" <?php if (isset($list['data']['licence_list_id']) & $list['data']['licence_list_id'] == 0) {
                                        echo "selected";
                                    } ?>>غیره...
                                    </option>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="licence_type">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>

                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نوع جواز" data-content="نوع جواز خود را ذکر نمایید"></i>
                                <label for="licence_type" >نوع جواز</label>
                                <input name="licence_type" type="text" value="<?php echo $list['data']['licence_type'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="licence_type" data-minlength="3" data-error="نوع جواز خود را ذکر نمایید" tabindex="2" required>
                            </div>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block">
                                <i class="fa " aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="شماره جواز" data-content="شماره جواز انتخاب شده را وارد نمایید"></i>
                                <label for="licence_number" >شماره جواز</label>
                                <input name="licence_number" type="text" value="<?php echo $list['data']['licence_number'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin" id="licence_number" data-minlength="1" data-error="لطفا شماره جواز را وارد نمایید" tabindex="3" required>
                            </div>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="شماره تلفن همراه" data-content="شماره تلفن همراه خود را وارد نمایید"></i>
                                <label for="phone" >شماره تلفن همراه</label>
                                <input name="phone"
                                       type="text"
                                       value="<?= $list['data']['phone'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="phone"
                                       pattern="^[0-9]{11,}$"
                                       maxlength="11"
                                       data-error="لطفا شماره تلفن را وارد نمایید" tabindex="4" required>
                            </div>
                        </div>
                    </div>
                    <!-- separator -->
                    <div class="col-xs-12  col-sm-12 col-md-12">
                        <?php if (strlen($error['companyRecorded']['0'])) { ?>
                            <div class="errorHandler alert alert-danger" style="color: red ;"><?php echo $error['companyRecorded']['0'] ?></div>
                        <?php } ?>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12">
                            <div class="reg-alert">جهت دریافت کد فعالسازی، یکی از روش های زیر را انتخاب نمایید</div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row center-block" style="max-width: 400px;">
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner center-block">
                                <a class="roundCorner call" data-type="0">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                                    <span>تماس</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner center-block">
                                <a class="roundCorner sms" data-type="1">
                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i>
                                    <span>پیامک</span>
                                </a>
                            </div>
                        </div>
                        <input type="hidden" name="methodType" value="<?php echo(unserialize($_SESSION['step'])->data[1]['methodType']) ?>" class="methodType" aria-label="">
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <button name="step_2" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="3">
                    <input name="company_type" type="hidden" value="1">
                </form>

                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <input name="step" type="hidden" value="1">
                    <input name="company_type" type="hidden" value="2">
                    <button name="step1" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p">
                        <span class="fa fa-angle-right"></span>
                        مرحله قبل
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script>
    $(function () {

        $('.reg-radio a').on('click', function (e) {
            e.preventDefault();
            $('.methodType').val($(this).attr('data-type'));
            $('.reg-radio a').removeClass('reg-active');
            $(this).addClass('reg-active');
        });

        var x = $('.methodType').val();
        $('.reg-radio a').removeClass('reg-active');
        $('.reg-container')
            .find('.reg-radio:eq(' + x + ') a').addClass('reg-active');

        $('.reg-container input:nth-child(1)').focus();

        // show DIV licence_type
        $('#licence_type').hide();

        if ($('#licence_list_id').val() == 0) {
            $('#licence_type').show();
        }

        $('#licence_list_id').on('change', function () {
            var licence_list_id = $('#licence_list_id').val();
            if (licence_list_id == 0) {
                $('#licence_type').show();
            } else {
                $('#licence_type').hide();
            }
        });
        // end show DIV licence_type

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }
        
    });
</script>
