   <!-- Modal Wiki -->
<div class="holder-modal modal-step1 modal fade container-floatinglabel" id="modalWiki" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel" title="ویرایش ویکی">ویکی مجموعه <span class="companyName"></span></h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container izi-holder" data-izi="iziEdit-container"></div>

                <p>
                    <strong>توجه: </strong>
                    کاربر گرامی، ویکی به معنی اطلاعات غیر تأیید شده و قابل تغییر می باشد. در صورتی که اطلاعات مندرج این مجموعه ناقص و یا اینکه این اطلاعات متعلق به مجموعه شما می باشد، سایت تولیدات امکانی را برای شما به ارمغان آورده است که بتوانید به طور خیلی ساده هویت مجموعه خود را در تولیدات تصحیح و یا تأیید نمایید. با توجه به اینکه اپراتور های تولیدات پس از ثبت اطلاعات درخواستی شما، به آن رسیدگی می نمایند، لذا می بایست نام و نام خانوادگی و شماره تلفن خود را به طور صحیح وارد نمایید تا در اسرع وقت به درخواست شما رسیدگی نماییم
                    <br>
                    در صورت موافقت با شرایط مذکور، گزینه زیر را فعال نمایید.
                </p>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="checkbox">
                            <label>
                                <input id="approvePrivacy" type="checkbox">شرایط را قبول دارم
                            </label>
                        </div>
                    </div>
                </div>

                <!-- separator -->
                <div class="row xxsmallSpace"></div>

                <!-- Page 1 -->
                <form id="editAllWiki" class="form verify" enctype="multipart/form-data" method="post" data-toggle="validator" style="display: none;">

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input required name="name" type="text" class="form-control" id="name"
                                       data-error="لطفا نام را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="family">نام خانوادگی</label>
                                <input required name="family" type="text" class="form-control" id="family"
                                       data-error="لطفا نام خانوادگی را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="phone">شماره تلفن</label>
                                <input type="text"
                                       name="phone"
                                       id="phone"
                                       class="form-control set-font"
                                       pattern="^[0-9]{11,}$"
                                       maxlength="11"
                                       required
                                       data-error="لطفا تلفن را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="reg-alert">جهت دریافت کد فعالسازی، یکی از روش های زیر را انتخاب نمایید</div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row center-block" style="max-width: 450px;">
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner">
                                <a class="roundCorner call" data-type="0">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> <span>تماس صوتی</span> </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner">
                                <a class="roundCorner sms" data-type="1">
                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i> <span>پیامک</span> </a>
                            </div>
                        </div>
                    </div>

                    <input name="methodType" type="hidden" class="methodType" value="1" aria-label="">
                    <input name="company_id" type="hidden" class="company_id_step1">
                    <div class="row xxxsmallSpace"></div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="editAllWiki" class="btn btn-success btn-sm">مرحله بعد</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>

                <!-- Page 2 -->
                <form id="codeVerification" class="form page2 display-none" enctype="multipart/form-data" method="post"
                      data-toggle="validator">
                    <div class="row xsmallSpace"></div>
                    <div class="row" id="key">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="reg-alert">کد فعالسازی دریافت شده را در این قسمت وارد نمایید</div>
                        </div>
                        <div class="row xxxsmallSpace"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                                <div class="form-group has-feedback">
                                    <label for="registration_number">کد فعالسازی</label>
                                    <input name="key"
                                           type="text"
                                           class="form-control fullWidth displayBlock noRadius noPadding transition"
                                           id="registration_number"
                                           data-minlength="5"
                                           data-error="لطفا کد فعالسازی را وارد کنید"
                                           tabindex="1"
                                           required
                                           autofocus>
                                </div>
                            </div>
                        </div>

                        <input name="company_id" type="hidden" class="company_id_step1">
                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                                <div id="myTimer"><span id="time">02:00</span></div>
                                    <button type="button" id="sendCodeAgain" disabled
                                            class="btn btnDisable myBtn btn-primary  dropdown-toggle reg-btn-refresh center-block text-white"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fa fa-refresh"></span>
                                        <img style="display: none" id="loading" src="<?= RELA_DIR ?>templates/template_fa/assets/images/loading1.gif">ارسال دوباره
                                    </button>
                                <div class="row xsmallSpace"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="codeVerification" class="btn btn-success btn-sm">مرحله بعد</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>

                <!-- actual -->
                <form id="actualInformation" class="form actualInformation display-none" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="company_name">نام مجموعه</label>
                                <input name="company_name"
                                       type="text"
                                       class="form-control"
                                       id="company_name"
                                       required
                                       data-error="لطفا نام تولیدی را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="maneger_name">نام مدیر</label>
                                <input name="maneger_name"
                                       class="form-control"
                                       type="text"
                                       id="maneger_name"
                                       required
                                       data-error="لطفا نام مدیر را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="name">نام صاحب جواز</label>
                                <input name="name"
                                       type="text"
                                       id="name"
                                       class="form-control"
                                       required
                                       data-error="لطفا نام صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="family">نام خانوادگی صاحب جواز</label>
                                <input name="family"
                                       type="text"
                                       class="form-control"
                                       id="family"
                                       required
                                       data-error="لطفا نام خانوادگی صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description"
                                          type="text"
                                          id="description"
                                          class="form-control"
                                          required
                                          data-error="لطفا زمینه فعالیت  را وارد نمایید"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="licence_type">نوع جواز</label>
                                <select name="licence_type"
                                        id="licence_type"
                                        class="licence_type form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group div-licence_type">
                                <label for="licence_type_name">نوع جواز</label>
                                <input name="licence_type_name"
                                       type="text"
                                       class="form-control"
                                       id="licence_type_name"
                                       data-error="لطفا نوع جواز خود را وارد کنید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="licence_number">شماره جواز</label>
                                <input name="licence_number"
                                       type="text"
                                       class="form-control"
                                       id="licence_number"
                                       data-error="لطفا شماره جواز خود را وارد کنید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="national_code">کد ملی صاحب جواز</label>
                                <input name="national_code"
                                       maxlength="11"
                                       type="text"
                                       class="form-control"
                                       pattern="^[0-9]{11,}$"
                                       id="national_code"
                                       required
                                       data-error="لطفا کد ملی صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="issuence_date">تاریخ صدور جواز:</label>
                                <input type="text"
                                       name="issuence_date"
                                       class="form-control datePicker"
                                       readonly
                                       id="issuence_date"
                                       data-error="لطفا تاریخ صدور جواز خود را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="expiration_date">تاریخ انقضا جواز</label>
                                <input type="text"
                                       name="expiration_date"
                                       class="form-control datePicker"
                                       readonly
                                       id="expiration_date"
                                       data-error="لطفا تاریخ انقضا جواز خود را وارد کنید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="exporter_refrence">مرجع صادرکننده</label>
                                <input name="exporter_refrence"
                                       type="text"
                                       class="form-control"
                                       id="exporter_refrence"
                                       data-error="لطفا مرجع صادرکننده را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-right">تصویر جواز</p>
                            <a class="logoNew roundCorner boxBorder pull-right">
                                <img name="actual_image"
                                     class="boxBorder roundCorner actual_image"
                                     src="<?php echo DEFULT_PRODUCT_ADDRESS ?>">
                                <label for="upload">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <input name="actual_image"
                                           class="uploadFile"
                                           type="file"
                                           id="upload">
                                </label>
                            </a>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback">
                                <label for="address">آدرس</label>
                                <textarea name="address"
                                          id="address"
                                          type="text"
                                          required
                                          data-error="لطفا آدرس را وارد نمایید"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="state_id">استان</label>
                                <select name="state_id"
                                        id="state_id"
                                        class="province_id form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="city_id">شهر</label>
                                <select name="city_id"
                                        id="city_id"
                                        class="city_id form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="number">تلفن</label>
                                <input name="number"
                                       id="number"
                                       type="text"
                                       class="form-control"
                                       pattern="^[0-9]{3,}$" maxlength="8"
                                       required
                                       data-error="لطفا تلفن را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="code">کد پیش شماره</label>
                                <input name="code"
                                       id="code"
                                       type="text"
                                       class="form-control"
                                       maxlength="3" max="999" pattern="^[0-9]{3,3}$"
                                       required
                                       data-error="لطفا کد پیش شماره را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input name="email"
                                       id="email"
                                       type="text"
                                       class="form-control"
                                       data-error="لطفا ایمیل  را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="url">وب سایت</label>
                                <input name="url"
                                       id="url"
                                       type="text"
                                       class="form-control"
                                       data-error="لطفا وب سایت  را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="search-box search-box1 boxBorder categoryContainer">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی ها</header>
                                </div>
                                <div class="mmenuHolder mmenu-register active">
                                    <nav class="menu2 mm-opened" data-placeholder="جستجو در دسته بندی ها"
                                         data-title="دسته بندی تولیدی ها">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="container-view boxBorder">
                                <header><i class="fa fa-bars" aria-hidden="true"></i>دسته های انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>
                            <input type="hidden" class="maxCanSelected" value="1">
                            <input type="hidden" class="selectedCategories">
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-right">در صورت دارا بودن لوگو مجموعه، از طریق قسمت پایین آن را بارگذاری نمایید.</p>
                            <a class="logoNew roundCorner boxBorder pull-right">
                                <img name="logo_image"
                                     class="boxBorder roundCorner logo_image"
                                     src="<?php echo DEFULT_LOGO_ADDRESS ?>">
                                <label for="upload1">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <input name="logo_image"
                                           class="uploadFile"
                                           type="file"
                                           id="upload1">
                                </label>
                            </a>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <input name="company_id" type="hidden" class="company_id_step1">
                    <input name="company_type" type="hidden" class="company_type_step1">

                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="actualInformation" class="btn btn-success btn-sm">مرحله بعد</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>

                <!-- legal -->
                <form id="legalInformation" class="form legalInformation display-none" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="company_name">نام تولیدی</label>
                                <input name="company_name"
                                       type="text"
                                       class="form-control"
                                       id="company_name"
                                       required
                                       data-error="لطفا نام تولیدی را وارد نمایید">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="maneger_name">نام مدیر</label>
                                <input name="maneger_name"
                                       class="form-control"
                                       type="text"
                                       id="maneger_name"
                                       required
                                       data-error="لطفا نام مدیر را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="registration_number">شماره ثبت</label>
                                <input name="registration_number"
                                       class="form-control"
                                       type="text"
                                       id="registration_number"
                                       required
                                       data-error="لطفا شماره ثبت را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="national_id">شناسه ملی</label>
                                <input name="national_id"
                                       maxlength="11"
                                       type="text"
                                       class="form-control"
                                       id="national_id"
                                       required
                                       data-error="لطفا شناسه ملی مجموعه را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description"
                                          type="text"
                                          id="description"
                                          class="form-control"
                                          required
                                          data-error="لطفا زمینه فعالیت  را وارد نمایید"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="personality_type">نوع شخصیت حقوقی</label>
                                <select name="personality_type"
                                        id="personality_type"
                                        class="personality_type form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block">
                                <label for="address">آدرس را وارد نمایید</label>
                                <textarea name="address"
                                          id="address"
                                          type="text"
                                          required
                                          data-error="لطفا آدرس را وارد نمایید"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="state_id">استان</label>
                                <select name="state_id"
                                        id="state_id"
                                        class="province_id form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="city_id">شهر</label>
                                <select name="city_id"
                                        id="city_id"
                                        class="city_id form-control"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="number">تلفن را وارد نمایید</label>
                                <input name="number" id="number" type="text" class="form-control" required
                                       data-error="لطفا تلفن را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="code">کد را وارد نمایید</label>
                                <input name="code" id="code" type="text" class="form-control" required
                                       data-error="لطفا کد را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="email">ایمیل را وارد نمایید</label>
                                <input name="email"
                                       id="email"
                                       type="email"
                                       class="form-control"
                                       data-error="لطفا ایمیل  را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="url">وب سایت را وارد نمایید</label>
                                <input name="url"
                                       id="url"
                                       type="text"
                                       class="form-control"
                                       data-error="لطفا وب سایت را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="search-box search-box1 boxBorder categoryContainer">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی ها</header>
                                </div>
                                <div class="mmenuHolder mmenu-register active">
                                    <nav class="menu2 mm-opened" data-placeholder="جستجو در دسته بندی ها"
                                         data-title="دسته بندی تولیدی ها">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="container-view boxBorder">
                                <header><i class="fa fa-bars" aria-hidden="true"></i>دسته های انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>
                            <input type="hidden" class="maxCanSelected" value="1">
                            <input type="hidden" class="selectedCategories">
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-right">در صورت دارا بودن لوگو مجموعه، از طریق قسمت پایین آن را بارگذاری نمایید.</p>
                            <a class="logoNew roundCorner boxBorder pull-right">
                                <img name="logo_image"
                                     class="boxBorder roundCorner logo_image"
                                     src="<?php echo DEFULT_LOGO_ADDRESS ?>">
                                <label for="upload">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <input name="logo_image"
                                           class="uploadFile"
                                           type="file"
                                           id="upload">
                                </label>
                            </a>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input id="toggleLicense" type="checkbox"> آیا دارای مجوز می باشید؟
                                </label>
                            </div>
                            <?php /*<button id="addLicence" type="button" class="btn btn-main transition" aria-label="Left Align">
                                افزودن جواز
                            </button>
                            <button id="removeLicence" type="button" class="btn btn-main transition" aria-label="Left Align">
                                حذف جواز
                            </button>*/?>
                        </div>
                    </div>

                    <div id="licenceBox" style="display: none;">
                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="name">نام صاحب جواز</label>
                                    <input name="name"
                                           type="text"
                                           id="name"
                                           class="form-control"
                                           data-error="لطفا نام صاحب جواز را وارد نمایید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="family">نام خانوادگی صاحب جواز</label>
                                    <input name="family"
                                           type="text"
                                           class="form-control"
                                           id="family"
                                           data-error="لطفا نام خانوادگی صاحب جواز را وارد نمایید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group div-licence_type">
                                    <label for="licence_type_name">نوع جواز</label>
                                    <input name="licence_type_name"
                                           type="text"
                                           class="form-control"
                                           id="licence_type_name"
                                           data-error="لطفا نام تجاری خود را وارد کنید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 ">
                                <div class="form-group typing">
                                    <label for="licence_type_name">نوع جواز</label>
                                    <select name="licence_type"
                                            id="licence_type"
                                            class="licence_type form-control"></select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="licence_number">شماره جواز</label>
                                    <input name="licence_number"
                                           type="text"
                                           class="form-control"
                                           id="licence_number"
                                           data-error="لطفا شماره جواز خود را وارد کنید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="national_code">کد ملی صاحب جواز</label>
                                    <input name="national_code"
                                           maxlength="10"
                                           type="text"
                                           class="form-control"
                                           id="national_code"
                                           data-error="لطفا کد ملی صاحب جواز را وارد نمایید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="issuence_date">تاریخ صدور جواز:</label>
                                    <input type="text"
                                           name="issuence_date"
                                           class="form-control datePicker"
                                           id="issuence_date"
                                           data-error="لطفا تاریخ صدور جواز خود را وارد نمایید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="expiration_date">تاریخ انقضا جواز</label>
                                    <input type="text"
                                           name="expiration_date"
                                           class="form-control datePicker"
                                           id="expiration_date"
                                           data-error="لطفا تاریخ انقضا جواز خود را وارد کنید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="exporter_refrence">مرجع صادرکننده</label>
                                    <input name="exporter_refrence"
                                           type="text"
                                           class="form-control"
                                           id="exporter_refrence"
                                           data-error="لطفا مرجع صادرکننده را وارد نمایید">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p class="text-right">تصویر جواز</p>
                                    <a class="logoNew roundCorner boxBorder pull-right">
                                        <img name="legal_image"
                                             class="boxBorder roundCorner legal_image"
                                             src="<?php echo DEFULT_PRODUCT_ADDRESS ?>">
                                        <label for="upload">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <input name="legal_image"
                                                   class="uploadFile"
                                                   type="file"
                                                   id="upload">
                                        </label>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <input name="remove_licence" type="hidden" value="" id="remove_licence">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <input name="company_id" type="hidden" class="company_id_step1">
                    <input name="company_type" type="hidden" class="company_type_step1">
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="actualInformation" class="btn btn-success btn-sm">ثبت اطلاعات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-------------------------------- Scripts -------------------------------->

<script src="<?php echo RELA_DIR ?>templates/template_fa/assets/js/companyWiki.js"></script>
<script src="<?php echo RELA_DIR?>templates/template_fa/assets/js/cropper.min.js"></script>
