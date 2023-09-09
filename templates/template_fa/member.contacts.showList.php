<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places&language=fa'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script>

<div class="row xxsmallSpace crop"></div>

<!--container iziToast-->
<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<!--title-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="اطلاعات تماس" class="title-pro">اطلاعات تماس</span>
        </div>
    </div>
</div>

<!-- separator -->
<div class="row xxsmallSpace"></div>

<!--box dynamic-->
<div class="container-branch-tab">
    <!-- Nav tabs -->
    <ul class="branch nav nav-tabs " role="tablist">
        <?php foreach ($list as $key => $value) : ?>
            <li <?php echo ($key == 0 ? 'class="active"' : ''); ?> role="presentation">
                <a href="<?php echo "#branch" . $value['Branch_id'] ?>" aria-controls="" role="tab" data-toggle="tab"><?php echo $value['branch_name']; ?>
                </a>
                <?php if ($key != 0) { ?>
                    <div class="kebabMenu">
                        <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                        <ul class="kebab-menu-content roundCorner boxBorder">
                            <li><a class="link-edit editBranchs" data-value="<?php echo $value['Branch_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>
                            <li><a class="link-trash deleteBranch" data-value="<?php echo $value['Branch_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>
                        </ul>
                    </div>

                <?php } ?>
            </li>
        <?php endforeach; ?>
        <li role="presentation" class="add-tab">
            <a data-intro="افزودن شعب" href="" class="addBranchLink" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-plus-circle transition" aria-hidden="true"></i></a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php foreach ($list as $key => $value) : ?>
            <div role="tabpanel" class="tab-pane noPadding <?php echo ($key == 0 ? "active" : ''); ?> " id="<?php echo "branch" . $value['Branch_id'] ?>" data-value="<?php echo $value['Branch_id']; ?>">
                <div class="row xxsmallSpace"></div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb5">
                        <!--address-->
                        <div data-intro="افزودن آدرس" class="contentPro contentPro-address whiteBg roundCorner address mb5 boxBorder">
                            <h3>
                                <button data-intro="افزودن آدرس" type="button" class="btn btn-sm pull-left add-btnPro add-btnPro-info addModalAddress" data-toggle="modal" data-target="">
                                    <i class="fa fa-plus transition bc-color-lightGreen1" aria-hidden="true"></i>
                                </button>
                                <span class="title">آدرس</span>
                            </h3>
                            <?php if (isset($value['address']) && count($value['address'])) : ?>
                                <div class="content-scroll add-address">
                                    <?php foreach ($value['address'] as $id => $fields) : ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-address" data-value="<?php echo $fields['Addresses_d_id'] ?>">
                                            <div class="container-input<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> transition roundCorner" data-toggle="tooltip" data-placement="bottom" title="">
                                                <div class="kebabMenu">
                                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                                    <ul class="kebab-menu-content roundCorner boxBorder">
                                                        <li><a class="link-edit editAddress" data-value="<?php echo $fields['Addresses_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>
                                                        <?php if ($fields['isMain'] == 0) { ?>
                                                            <li><a class="link-trash deleteAddress" data-value="<?php echo $fields['Addresses_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <span class="span-title"><?php echo $fields['subject'] ?></span>
                                                <span class="span-report"><?php echo $fields['address'] ?></span>
                                                <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="add-address"></div>
                                <div class="notRecord">
                                    <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                                    <p class="empty-text">اطلاعاتی موجود نیست!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--email-->
                        <div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner email mb5 boxBorder">
                            <h3>
                                <button data-intro="تیتر شعب" type="button" class="btn btn-sm pull-left add-btnPro add-btnPro-info addModalEmail" data-toggle="modal" data-target="">
                                    <i class="fa fa-plus transition bc-color-lightGreen1" aria-hidden="true"></i>
                                </button>
                                <span class="title">ایمیل</span>
                            </h3>
                            <?php if (isset($value['email']) && count($value['email'])) : ?>
                                <div class="content-scroll add-email">
                                    <?php foreach ($value['email'] as $id => $fields) : ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-email" data-value="<?php echo $fields['Emails_d_id'] ?>">
                                            <div class="container-input<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> transition  roundCorner" data-toggle="tooltip" data-placement="bottom" title="">
                                                <div class="kebabMenu">
                                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                                    <ul class="kebab-menu-content roundCorner boxBorder">
                                                        <li><a class="link-edit editEmail" data-value="<?php echo $fields['Emails_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                                        </li>
                                                        <li><a class="link-trash deleteEmail" data-value="<?php echo $fields['Emails_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-title"><?php echo $fields['subject'] ?></span>
                                                <span class="span-report"><?php echo $fields['email'] ?></span>
                                                <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="add-email"></div>
                                <div class="notRecord">
                                    <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                                    <p class="empty-text">اطلاعاتی موجود نیست!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--social-->
                        <div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner social mb5 boxBorder">
                            <h3>
                                <button data-intro="تیتر شعب" type="button" class="btn btn-sm pull-left add-btnPro add-btnPro-info addModalSocial" data-toggle="modal" data-target="">
                                    <i class="fa fa-plus transition bc-color-lightGreen1" aria-hidden="true"></i>
                                </button>
                                <span class="title">شبکه اجتماعی</span>
                            </h3>
                            <?php if (isset($value['social']) && count($value['social'])) : ?>
                                <div class="content-scroll add-social">
                                    <?php foreach ($value['social'] as $id => $fields) : ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-social" data-value="<?php echo $fields['Socials_d_id'] ?>">
                                            <div class="container-input<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> transition  roundCorner" data-toggle="tooltip" data-placement="bottom" title="">
                                                <div class="kebabMenu">
                                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                                    <ul class="kebab-menu-content roundCorner boxBorder">
                                                        <li><a class="link-edit editSocial" data-value="<?php echo $fields['Socials_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                                        </li>
                                                        <li><a class="link-trash deleteSocial" data-value="<?php echo $fields['Socials_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-title"><?php echo $fields['social_type_id'] ?></span>
                                                <span class="span-report"><?php echo $fields['url'] ?></span>
                                                <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="add-social"></div>
                                <div class="notRecord">
                                    <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                                    <p class="empty-text">اطلاعاتی موجود نیست!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb5">
                        <!--website-->
                        <div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner website mb5 boxBorder">
                            <h3>
                                <button data-intro="تیتر شعب" type="button" class="btn btn-sm pull-left add-btnPro add-btnPro-info addModalWebsite" data-toggle="modal" data-target="">
                                    <i class="fa fa-plus transition bc-color-lightGreen1" aria-hidden="true"></i>
                                </button>
                                <span class="title">وب سایت</span>
                            </h3>
                            <?php if (isset($value['website']) && count($value['website'])) : ?>
                                <div class="content-scroll add-website">
                                    <?php foreach ($value['website'] as $id => $fields) : ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-website" data-value="<?php echo $fields['Websites_d_id'] ?>">
                                            <div class="container-input<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> transition  roundCorner" data-toggle="tooltip" data-placement="bottom" title="">
                                                <div class="kebabMenu">
                                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                                    <ul class="kebab-menu-content roundCorner boxBorder">
                                                        <li><a class="link-edit editWebsite" data-value="<?php echo $fields['Websites_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                                        </li>
                                                        <li><a class="link-trash deleteWebsite" data-value="<?php echo $fields['Websites_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-title"><?php echo $fields['subject'] ?></span>
                                                <span class="span-report"><?php echo $fields['url'] ?></span>
                                                <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="add-website"></div>
                                <div class="notRecord">
                                    <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                                    <p class="empty-text">اطلاعاتی موجود نیست!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--phone-->
                        <div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner phone mb5 boxBorder">
                            <h3>
                                <button data-intro="تیتر شعب" type="button" class="btn btn-sm pull-left add-btnPro add-btnPro-info addModalPhone" data-toggle="modal" data-target="">
                                    <i class="fa fa-plus transition bc-color-lightGreen1" aria-hidden="true"></i>
                                </button>
                                <span class="title">شماره تماس</span>
                            </h3>
                            <?php if (isset($value['phone']) && count($value['phone'])) : ?>
                                <div class="content-scroll add-phone">
                                    <?php foreach ($value['phone'] as $id => $fields) : ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-phone" data-value="<?php echo $fields['Phones_d_id'] ?>">
                                            <div class="container-input<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> transition  roundCorner" data-toggle="tooltip" data-placement="bottom" title="">
                                                <div class="kebabMenu">
                                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                                    <ul class="kebab-menu-content roundCorner boxBorder">
                                                        <li><a class="link-edit editPhone" data-value="<?php echo $fields['Phones_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                                        </li>
                                                        <li><a class="link-trash deletePhone" data-value="<?php echo $fields['Phones_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-title"><?php echo $fields['subject'] ?></span>
                                                <span class="span-report rtl"><?php echo (strlen($fields['code']) ? $fields['code'] . ' - ' : '') . $fields['number']; ?></span>
                                                <span class="span-report rtl"><?php echo $fields['value'] . ' ' . $fields['state'] ?></span>
                                                <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="add-phone"></div>
                                <div class="notRecord">
                                    <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                                    <p class="empty-text">اطلاعاتی موجود نیست!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--map-->
                        <?php /*<div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner mb5 boxBorder">
                            <h3><span class="title"> مکان مورد نظر را انتخاب نمایید(نمادک قرمز را بر روی مکان مورد نظر جابجا کنید)</span></h3>
                            <div class="iziMapAddress-container"></div>
                            <div class="container-mapPro">
                                <button class="getLocation"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></button>
                                <input type="text" class="us2-address" placeholder="مکان مورد نظر را وارد کنید">
                                <input id="<?php echo "xbranch" . $value['Branch_id'] ?>" type="hidden" value="<?php echo $value['position']['x']; ?>">
                                <input id="<?php echo "ybranch" . $value['Branch_id'] ?>" type="hidden" value="<?php echo $value['position']['y']; ?>">
                                <input id="Branch_id" type="hidden" value="<?php echo $value['Branch_id']; ?>">
                                <div class="company_map"></div>
                                <button class="submit-map btn-block btn btn-success text-ultralight transition"><span>ثبت</span></button>
                            </div>
                        </div>*/ ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!--Modal add address-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن آدرس</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAddAddress-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addAddress" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="title-address1">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="title-address1" data-error="لطفا عنوان را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="address1">آدرس را وارد نمایید</label>
                                <textarea required name="address" class="form-control" rows="3" id="address1" data-error="لطفا آدرس را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="postal_code1">کد پستی را وارد نمایید</label>
                                <input required name="postal_code" class="form-control" id="postal_code1" data-error="لطفا کد پستی را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addAddress" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal add email-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن ایمیل</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAddEmail-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addEmail" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="subject-title1">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="subject-title1" data-error="لطفا عنوان را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="email1">ایمیل را وارد نمایید</label>
                                <input required name="email" type="email" class="form-control set-font-latin ltr" id="email1" data-error=" ایمیل را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addEmail" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal add website-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن وب سایت</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAddWebsite-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addWebsite" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="url-title1">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="url-title1" data-error="لطفا عنوان را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="url1">آدرس وب سایت را وارد نمایید</label>
                                <input required name="url" type="text" class="form-control set-font-latin ltr" id="url1" data-error="لطفا آدرس وب سایت را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addWebsite" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal add social-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن شبکه اجتماعی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAddSocial-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addSocial" class="form container-social-type" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb">
                                <select name="social_type_id" id="select-social-type" data-input="select2" class="form-control select-social-type-class" data-error="لطفا شبکه اجتماعی را وارد نمایید">
                                    <option value="0" selected disabled>یکی از شبکه های اجتماعی زیر را انتخاب کنید</option>
                                    <option value="1" data-placeholder="http://t.me/example :مثال">تلگرام</option>
                                    <option value="2" data-placeholder="https://www.instagram.com/example :مثال">اینستاگرام</option>
                                    <option value="3" data-placeholder="https://www.facebook.com/example :مثال">فیسبوک</option>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group form-link mb">
                                <label class="control-label rtl" for="title">لینک:</label>
                                <input type="text" class="form-control placeholder-input" data-error="لطفا لینک را وارد نمایید" placeholder="" required name="url" id="social2" value="">
                                <span class="text-sample-social"></span>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addSocial" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal add phone-->
<div class="holder-modal modal-address modal fade container-floatinglabel" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن شماره تماس</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAddPhone-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addPhone" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">

                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                            <div class="form-group">
                                <label for="phone-title1">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="phone-title1" data-error="لطفا عنوان را وارد نمایید">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb">
                            <div class="form-group">
                                <label for="phone-number-title1">شماره تلفن</label>
                                <input required name="number" id="phone-number-title1" type="text" class="form-control" pattern="^[0-9]{3,8}$" data-error="لطفا شماره تلفن را وارد نمایید" aria-describedby="sizing-addon2">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-2 col-md-3 pull-right mb">
                            <div class="form-group">
                                <label for="code">کد شهر</label>
                                <input name="code" id="code" type="text" class="form-control set-font-latin" tabindex="5" maxlength="3" max="999" pattern="^[0-9]{3,3}$" data-error="۳ رقم وارد شود" required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-3 pull-right mb">
                            <div class="form-group">
                                <select class="phoneValue col-sm-12 col-md-12 form-control" name="state">
                                    <option value="" selected>هیچکدام</option>
                                    <option value="داخلی">داخلی</option>
                                    <option value="الی">الی</option>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>

                        <div class="phone_value col-xs-12 col-sm-2 col-md-2 pull-right mb">
                            <div class="form-group">
                                <label for="value1">هیچکدام</label>
                                <input name="value" class="form-control" id="value1">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addPhone" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal edit address-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش آدرس</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEditAddress-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editAddress" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="title-address2">عنوان را وارد نمایید</label>
                                <textarea required name="subject" type="text" class="form-control" id="title-address2" data-error="لطفا عنوان را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="address2">آدرس را وارد نمایید</label>
                                <textarea required name="address" class="form-control" rows="3" id="address2" data-error="لطفا آدرس را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="postal_code2">کد پستی را وارد نمایید</label>
                                <input required name="postal_code" class="form-control" id="postal_code2" data-error="لطفا کد پستی را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                        </div>
                        <input type="hidden" name="Addresses_d_id" value="">
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addAddress" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal edit email-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش ایمیل</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEditEmail-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editEmail" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="subject-title2">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="subject-title2" data-error="لطفا عنوان را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="email2">ایمیل را وارد نمایید</label>
                                <input required name="email" type="email" class="form-control" rows="3" id="email2" data-error=" ایمیل را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <input type="hidden" name="Emails_d_id" value="">
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addEmail" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal edit website-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش وب سایت</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEditWebsite-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editWebsite" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group mb">
                                <label for="url-title2">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="url-title2" data-error="لطفا عنوان را وارد نمایید">
                                <div class="errorHandler"></div>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="url2">آدرس وب سایت را وارد نمایید</label>
                                <input required name="url" type="text" class="form-control set-font-latin ltr" id="url2" data-error="لطفا آدرس وب سایت را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <input type="hidden" name="Websites_d_id" value="">
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addWebsite" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal edit social-->
<div class="holder-modal modal-honour modal fade container-floatinglabel" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش شبکه اجتماعی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEditSocial-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editSocial" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb">
                                <label class="control-label rtl" for="title">لینک:</label>
                                <input type="text" class="form-control" name="url" id="social2" required value="">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <select name="social_type_id" id="social-title2" data-input="select2" class="form-control">
                                    <option>شبکه های اجتماعی</option>
                                    <?
                                    foreach ($list[0]['socials'] as $key => $value) {
                                    ?>

                                        <option value="<?php echo  $value['Social_type_id'] ?>">
                                            <?php echo  $value['type'] ?>
                                        </option><?
                                                }
                                                    ?>
                                </select>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                        </div>
                        <input type="hidden" name="Socials_d_id" value="">
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addSocial" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal edit phone-->
<div class="holder-modal modal-address modal fade container-floatinglabel" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش شماره تماس</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEditPhone-container"></div>
                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editPhone" class="form" enctype="multipart/form-data" method="post" data-toggle="validator">

                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                            <div class="form-group">
                                <label for="phone-title1">عنوان را وارد نمایید</label>
                                <input required name="subject" type="text" class="form-control" id="phone-title1" data-error="لطفا عنوان را وارد نمایید">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb">
                            <div class="form-group">
                                <label for="phone-number-title1">شماره تلفن</label>
                                <input required name="number" id="phone-number-title1" type="text" pattern="^[0-9]{3,8}$" class="form-control" data-error="لطفا شماره تلفن را وارد نمایید" aria-describedby="sizing-addon2">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-2 col-md-3 pull-right mb">
                            <div class="form-group">
                                <label for="code">کد شهر</label>
                                <input name="code" id="code" type="text" class="form-control set-font-latin" tabindex="5" maxlength="3" max="999" pattern="^[0-9]{3,3}$" data-error="۳ رقم وارد شود" required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-3 pull-right mb">
                            <div class="form-group">
                                <select class="phoneValue col-sm-12 col-md-12 form-control" name="state">
                                    <option value="" selected>هیچکدام</option>
                                    <option value="داخلی">داخلی</option>
                                    <option value="الی">الی</option>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>

                        <div class="phone_value col-xs-12 col-sm-2 col-md-2 pull-right mb">
                            <div class="form-group">
                                <label for="value1">هیچکدام</label>
                                <input name="value" class="form-control" id="value1">
                            </div>
                        </div>
                    </div>

                    <input name="Phones_d_id" id="Phones_d_id" type="hidden">
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addPhone" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal addBranch -->
<div class="holder-modal modal-product modal fade container-floatinglabel" id="modalAddBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-md " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن شعب</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAdd-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addBranch" class="form addBranch" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="branch_name_add">نام شعبه را وارد نمایید</label>
                                <input name="branch_name" type="text" class="form-control" id="branch_name_add" required data-error="لطفا نام شعبه را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb has-feedback center-block">
                                <!--<i class="fa fa-user" aria-hidden="true"></i>-->
                                <label for="coordinator_name">نام مدیر را وارد نمایید</label>
                                <input name="maneger_name" type="text" class="form-control fullWidth displayBlock noRadius noPadding transition" id="coordinator_name" data-minlength="3" required data-error="لطفا نام مدیر را وارد نمایید" tabindex="5">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <select name="state_id" class="province_id form-control" data-input="select2"></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb">
                                <select name="city_id" class="city_id form-control" data-input=""></select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <input name="Branch_id" type="hidden"> <input id="company_id" type="hidden">
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addBranch" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal editBranch -->
<div class="holder-modal modal-product modal fade container-floatinglabel" id="modalEditBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-md " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش شعبه</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container"></div>
                <!-- separator -->

                <div class="row xxxsmallSpace"></div>

                <form id="editBranch" class="form editBranch" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="branch_name_edit">نام شعبه را وارد نمایید</label>
                                <input name="branch_name" type="text" class="form-control" id="branch_name_edit" required data-error="لطفا نام شعبه را وارد نمایید">
                            </div>
                            <input name="Branch_id" type="hidden">

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb has-feedback center-block">
                                <!--<i class="fa fa-user" aria-hidden="true"></i>-->
                                <label for="coordinator_name">نام مدیر را وارد نمایید</label>
                                <input name="maneger_name" type="text" class="form-control fullWidth displayBlock noRadius noPadding transition" id="coordinator_name" data-minlength="3" required data-error="لطفا نام مدیر را وارد نمایید" tabindex="5">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group mb">
                                <select name="city_id" class="city_id form-control" data-input=""></select>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb">
                                <select name="state_id" class="province_id form-control" data-input="select2"></select>
                            </div>
                        </div>
                        <input id="company_id" type="hidden">
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="editBranch" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo RELA_DIR ?>templates/template_tailwind/assets/js/companyContacts.js"></script>
<script>
    $.iziToastError = function(msg) {
        iziToast.settings({
            onOpen: function(e) {}
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };
    var $body = $('body');
    var id = $('.branch.nav.nav-tabs li.active a').attr('href'),
        x, y;

    function setPosition(id) {
        var id_x = 'x' + id.substring(1);
        var id_y = 'y' + id.substring(1);
        x = $body.find('input[id="' + id_x + '"]').val() ? $body.find('input[id="' + id_x + '"]').val() : 35.689389;
        y = $body.find('input[id="' + id_y + '"]').val() ? $body.find('input[id="' + id_y + '"]').val() : 51.388686;
    }

    $.showMap = function(id) {
        setPosition(id);
        $body.find(id).find('.company_map').locationpicker({
            location: {
                latitude: x,
                longitude: y
            },
            radius: 200,
            draggable: true,
            //markerInCenter: true,
            enableAutocomplete: true,
            inputBinding: {
                locationNameInput: $body.find('.us2-address')
            },
            onchanged: function(currentLocation) {
                x = currentLocation.latitude;
                y = currentLocation.longitude;
            }
        });
    };

    setTimeout(function() {
        $('.branch.nav.nav-tabs li.active a').trigger('click');
    }, 2000);

    $('a[data-toggle="tab"]').on('click', function(e) {
        id = $(e.target).attr('href');

        $('.company_map').html('');

        $('body').find('.pac-container').remove();

        setTimeout(function() {
            $.showMap(id);
        }, 1000);
    });

    /*button my location*/
    $body.on('click', '.getLocation', function(e) {
        e.preventDefault();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                // You can set it the plugin
                $('.us1').locationpicker({
                    location: {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    },
                    onchanged: function(currentLocation, radius, isMarkerDropped) {}
                });
            });

        } else {
            alert("not support location");
        }
    });

    $('#msg-success-map').hide();
    $('#msg-danger-map').hide();

    $body.on('click', '.submit-map', function(e) {
        e.preventDefault();

        var branch_id = $('div.active').data('value');

        $.ajax({
            url: '/member/companyPositions/edit/',
            type: 'post',
            data: {
                x: x,
                y: y,
                branch_id: branch_id
            },
            cash: false,
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    $.iziToastSuccess(response.msg, '.iziMapAddress-container');
                } else {
                    $.iziToastError(response.msg, '.iziMapAddress-container');
                }
            }
        });
    });

    $('.select-social-type-class').on('change', function() {
        var $select = $(this).val(),
            $dataSelect = $(this).find('option:selected').data('placeholder'),
            $show = $('.text-sample-social');

        $('.form-link').css('display', 'block');

        switch ($select) {
            case '1':
                $show.text($dataSelect);
                //$placeholderInput.attr("placeholder", $placeholder);
                break;

            case '2':
                $show.text($dataSelect);
                //$placeholderInput.attr("placeholder", $placeholder);
                break;

            case '3':
                $show.text($dataSelect);
                //$placeholderInput.attr("placeholder", $placeholder);
                break;
        }
    });

    $body.on('change', '.phoneValue', function() {
        if ($(this).val() != '') {
            $(".phone_value input").removeAttr('disabled');
            $(".phone_value label").text($(this).val());
        } else {
            $(".phone_value input").attr('disabled', 'disabled');
            $(".phone_value label").text('هیچکدام');
        }
    });
</script>