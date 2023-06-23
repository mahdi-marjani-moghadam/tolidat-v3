<!-- header-profile -->
<?php if ($admin_info!= -1) { ?>
    <!-- section header -->
    <header class="header fixed">
        <div class="header-profile pull-left">
            <div class="profile-nav">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <span class="profile-username text-16">حساب کاربری</span>
                    <span class="fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu animated fadeInDown pull-right" role="menu">
                    <li><a href="<?php echo RELA_DIR ?>admin/?component=admin&action=editProfileAdmin" class="text-16"><i class="fa fa-user"></i>
                            پروفایل</a></li>
                    <li><a href="<?php echo RELA_DIR ?>admin/?component=login&action=logout" class="text-16"><i
                                    class="fa fa-power-off"></i> خروج از حساب</a></li>
                </ul>
            </div>
            <!--                <div class="profile-picture">
                    <?php
            /*                    $admin_id = $admin_info['admin_id'];
                                $filename = ROOT_DIR."statics/adminPics/".$admin_id.'.jpg';
                                $filename1= ROOT_DIR."statics/adminPics/".$admin_id.'.jpeg';
                                $filename2= ROOT_DIR."statics/adminPics/".$admin_id.'.png';

                                if(file_exists($filename))
                                {
                                    $pic = $admin_id.'.jpg';
                                }
                                elseif (file_exists($filename1 ))
                                {
                                    $pic = $admin_id.'.jpeg';

                                }
                                elseif(file_exists($filename2))
                                {
                                    $pic = $admin_id.'.png';
                                }
                                else
                                {
                                    $pic = 'No Image';
                                }

                                if($pic!='No Image')
                                {
                                    */ ?>

                        <img alt="me" src="<?php /*echo RELA_DIR."statics/adminPics/".$pic;*/ ?>" >
                    <?php
            /*                    }else
                                {
                                    echo $pic;
                                }*/ ?>


                </div>-->
        </div><!-- header-profile -->


        <?php $taskCount = getTaskCount();
        if ($taskCount > 0) : ?>

            <div class="header-profile pull-left">
                <div class="profile-nav">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span class="profile-username text-16">تسک ها</span>
                        <span class="fa fa-angle-down"></span>
                        <span class="badge badge-primary" style="position: relative; top: -12px; left: 26px; background-color: indianred; color: whitesmoke; font-size: 14px"><?= $taskCount['total'] ?></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInDown pull-right" role="menu">
                        <li>
                            <a href="<?= RELA_DIR . 'admin/?component=crm&action=task'?>" class="text-16">
                                <span>تسک های لاگ</span>
                                <span class="badge badge-primary" style="background-color: indianred; color: whitesmoke; font-size: 14px"><?= $taskCount['log'] ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= RELA_DIR . 'admin/?component=crm&action=leadTask'?>" class="text-16">
                                <span>تسک های لید</span>
                                <span class="badge badge-primary" style="background-color: indianred; color: whitesmoke; font-size: 14px"><?= $taskCount['lead'] ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--<div class="header-profile pull-left">
            <div class="profile-nav">
                <a href="<?/*= RELA_DIR . 'admin/?component=crm&action=task' */?>">
                    <span class="profile-username text-16">تسک ها</span>
                    <span class="badge badge-primary" style="position: relative; top: -12px; left: 26px"><?/*= $taskCount */?></span>
                </a>
            </div>
        </div>-->
        <?php endif; ?>

        <div class="pull-right logoHolder">
            <!--   <img src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/images/logo-elin.png" alt="">-->
        </div>
        <a id="toggleSideBar"><i class="fa fa-bars"></i></a>
    </header><!--/header-->
<?php } ?>
<!-- content section -->
<section class="section">