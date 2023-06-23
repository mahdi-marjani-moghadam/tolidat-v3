<div class="row xxsmallSpace"></div>

<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span class="title-pro">ویرایش اطلاعات نماینده</span>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>

<div class="row page-editPassword container-floatinglabel">
    <div class="col-xs-12 col-sm-12 col-md-4 center-block whiteBg boxBorder" data-value="">
            <div class="container-editPassword">
                <div class="row xxxsmallSpace"></div>
                <form id="editprofile" class="edit-profile" action="/profile/editPassword" method="POST" data-toggle="validator">

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="name" >نام</label>
                        <input required class="form-control" data-error="لطفا نام را وارد نمایید" type="text" name="name" id="name" value="<?= $list['name'] ?>">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="family" >نام خانوادگی</label>
                        <input required class="form-control" data-error="لطفا نام خانوادگی را وارد نمایید" type="text" name="family" id="family" value="<?= $list['family'] ?>">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="mobile" >شماره تماس</label>
                        <input required class="form-control set-font-latin" data-error="لطفا شماره تماس را وارد نمایید" type="text" name="mobile" id="mobile" value="<?= $list['mobile'] ?>">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="email" >ایمیل</label>
                        <input required class="form-control set-font-latin ltr" data-error="لطفا ایمیل را وارد نمایید" type="email" name="email" id="email" value="<?= $list['email'] ?>">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="password" >رمز عبور را وارد نمایید</label>
                        <input required class="form-control set-font-latin ltr" data-error="لطفا رمز عبور را وارد نمایید" type="password" name="password" id="password" value="">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="newPassword" >رمز عبور جدید را وارد نمایید</label>
                        <input required class="form-control set-font-latin ltr" data-error="لطفا رمز عبور جدید را وارد نمایید" type="password" name="newPassword" id="newPassword" value="">
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="form-group mb">
                        <label for="reNewPassword" >رمز عبور را مجددا وارد نمایید</label>
                        <input required class="form-control set-font-latin ltr" data-error="لطفا رمز عبور را مجددا وارد نمایید" type="password" name="reNewPassword" id="reNewPassword" value="">
                    </div>

                    <div class="row xxxsmallSpace"></div>
                    <button type="submit" class="btn btn-success btn-block mb text-ultralight text-white roundCorner transition mt" tabindex="4">
                        <span> ثبت</span>
                    </button>
                </form>
                <div class="row xxxsmallSpace"></div>
            </div>
    </div>
    <div class="row xxsmallSpace"></div>
    <div class="col-xs-12 col-sm-12 col-md-4 center-block">
        <?php echo $list['msg'] ? '<p class="msg-toast-error">' . $list["msg"] . '</p>' : '' ?>
    </div>
</div>

<script>
    $(function () {
        if( $('.page-editPassword .msg-toast-error').length ) {
            $.iziToastError($('.page-editPassword .msg-toast-error').text(), '.izi-container');
        }
    });

</script>
