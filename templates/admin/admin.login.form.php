<div class="content" style="margin: 0; top:0;">
    <div class="container">
        <div class="signin-wrapper">
            <div class="tab-content" style="background-color: white; padding:1em 3em; border-radius:5px; box-shadow: 0 0 15px rgba(0,0,0,0.1)">
                        <div class="signin">
                            <div class="signin-brand">
                                <a href="<?php echo RELA_DIR; ?>login.php">
                                    <img class="lazy" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/image/tolidat-logo.png" alt="Sign In">
                                </a>
                            </div>
                            <!--/signin-brand-->

                            <form action="" method="POST" data-validate="form" role="form">
                                <input type="hidden" name="action" value="login" />
                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon text-muted"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری" autocomplete="off" autofocus="" spellcheck="false" required>
                                    </div>
                                    <!--/input-group-->
                                </div>
                                <!--/form-group-->

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon text-muted"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="گذرواژه" autocomplete="off" spellcheck="false" required>
                                    </div>
                                    <!--/input-group-->
                                </div>
                                <!--/form-group-->

                                <div class="form-group form-actions">
                                    <input type="submit" class="btn btn-primary btn-default btn-block text-white text-16" value="ورود به سیستم">
                                </div>
                                <!--/form-group-->
                            </form>
                            <!--/#signin-form-->
                        </div>
                        <!--/signin-->
                    <!--/cols-->
                <!--/row-->

            </div>
            <!--/tab-content-->

            <div class="signin-footer">
                <ul class="list-inline pull-right">
                    <li>&copy; 2022 Daba Center</li>
                </ul>
            </div>
        </div>
        <!--/signin-wapper-->
    </div>
    <!--/container-->
</div>
<!--/content-->
<style>
    .section {
        top: 0;
        background-color: red;
        /* For browsers that do not support gradients */
        background-image: linear-gradient(to bottom right, rgb(255 113 13), #5e5e5e);
    }

    label {
        display: contents;
    }
</style>