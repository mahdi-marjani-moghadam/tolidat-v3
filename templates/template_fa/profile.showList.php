<!--button-->
<div class="row xxsmallSpace hidden-xx"></div>

<!--container iziToast-->
<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace hidden-xs"></div>

<div class="row page-showProfile">
    <div class="col-xs-12 col-sm-4 col-md-4 pull-right" data-value="">
        <div data-position="right" data-intro="اطلاعات پایه" class="contentPro contentPro-profile contentPro-honour whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
            <div class="kebabMenu" style="height: 60px;position: absolute;left: .5em;">
                <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                <ul class="kebab-menu-content profile roundCorner boxBorder">
                    <li>
                        <a class="" href="<?php echo RELA_DIR . 'profile/edit' ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش اطلاعات</span></a>
                    </li>
                    <li>
                        <a class="" href="<?php echo RELA_DIR . 'profile/editPassword' ?>"><i class="fa fa-key" aria-hidden="true"></i><span>تغییر اطلاعات نماینده و گذرواژه</span></a>
                    </li>
                </ul>
            </div>
            <div class="row noMargin">
                <div class="col-xs-12 col-md-4 col-md-3 pull-right">
                    <div class="logoContainer" style="padding: 1em;">
                        <img src="<?php echo($information_company['companyLogoDraft'] ? COMPANY_ADDRESS . $information_company['companyId'] . '/logo/' . $information_company['companyLogoDraft'] : DEFULT_LOGO_ADDRESS); ?>" class="boxBorder roundCorner center-block" alt="<?php echo(strlen($value['title']) ? $value['title'] : '-'); ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 col-md-9 pull-right">
                    <div class="mt">
                        <h4><?php echo  $list['company_name'] ?></h4>
                    </div>
                </div>
            </div>

            <hr>

            <?php
            if(strlen($list['name']) || strlen($list['family'])) :
            ?>
            <div class="row noMargin">
                <div class="col-md-12 pull-right">
                    <h6 style="color: #bbb"><i class="fa fa-envelope pull-right"></i>نام نماینده: </h6>
                    <h4 style="color: #888"><?php echo  $list['name']. ' ' .$list['family'] ?></h4>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            <?php
            endif;
            ?>

            <?php
            if(strlen($list['email'])) :
            ?>
            <div class="row noMargin">
                <div class="col-md-12 pull-right">
                    <h6 style="color: #bbb"><i class="fa fa-envelope pull-right"></i>ایمیل نماینده: </h6>
                    <h4 style="color: #888"><?php echo  $list['email'] ?></h4>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            <?php
            endif;
            ?>

            <?php
            if(strlen($list['mobile'])) :
            ?>
            <div class="row noMargin">
                <div class="col-md-12 pull-right">
                    <h6 style="color: #bbb"><i class="fa fa-envelope pull-right"></i>شماره تلفن نماینده: </h6>
                    <h4 style="color: #888"><?php echo  $list['mobile'] ?></h4>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            <?php
            endif;
            ?>

            <?php
            if(strlen($list['province'])) :
            ?>
            <div class="row noMargin">
                <div class="col-md-12 pull-right">
                    <h6 style="color: #bbb"><i class="fa fa-globe pull-right"></i>محل استان فعالیت: </h6>
                    <h4 style="color: #888"><?php echo  $list['province'] ?></h4>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            <?php
            endif;
            ?>

            <?php
            if(strlen($list['city'])) :
            ?>
            <div class="row noMargin">
                <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                    <h6 style="color: #bbb"><i class="fa fa-map-pin pull-right"></i>محل شهرستان فعالیت: </h6>
                    <h4 style="color: #888"><?php echo  $list['city'] ?></h4>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            <?php
            endif;
            ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 pull-left" data-value="">
        <div data-position="right" data-intro="جزئیات اطلاعات" class="contentPro contentPro-profile contentPro-honour whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
            <div class="text profile-page">
                <p class="mt noBg"><span>شناسه ملی مجموعه : </span><?php echo  $list['national_id'] ?></p>
            </div>

            <hr>

            <div class="text profile-page">
                <p class="mt noBg"><span>شماره ثبت مجموعه : </span><?php echo  $list['registration_number'] ?></p>
            </div>

            <hr>

            <div class="text profile-page">
                <p class="mt noBg"><span>دسته بندی های مجموعه : </span><?php echo  implode($list['category'], ' - '); ?></p>
            </div>

            <hr>

            <div class="text profile-page">
                <p class="mt noBg"><span>زمینه فعالیت : </span><?php echo  $list['description'] ?></p>
            </div>

            <hr>

            <div class="text profile-page">
                <p class="mt noBg"><span>کلمات کلیدی مربوط به زمینه فعالیت : </span><?php echo  $list['meta_keyword'] ?></p>
            </div>

            <hr>
        </div>
    </div>

</div>

<script>
    $(function () {
        if ($('.page-showProfile .msg-toast-success').length) {
            var msg = $('.page-showProfile .msg-toast-success').text();
            $.iziToastSuccess(msg);
        }
    });
</script>