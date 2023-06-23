<aside class="side-left" id="side-left">
    <ul class="sidebar">
        <!--/sidebar-item-->

        <!----------------------------- خانه ----------------------------->

        <li>
            <a href="<?php print RELA_DIR; ?>admin/index.php">
                <i class="sidebar-icon fa fa-home"></i>
                <span class="sidebar-text">خانه</span>
            </a>
        </li>
        <!--/sidebar-item-->

        <!----------------------------- کمپانی ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-adn"></i>
                <span class="sidebar-text"> کمپانی</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=add&type=1">
                        <span class="sidebar-text text-16"> افزودن کمپانی حقوقی</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=add&type=2">
                        <span class="sidebar-text text-16">افزودن کمپانی حقیقی </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company">
                        <span class="sidebar-text text-16">لیست کمپانی ها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=showNewCompany">
                        <span class="sidebar-text text-16">لیست کمپانی های جدید</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=showDraftCompany">
                        <span class="sidebar-text text-16">لیست کمپانی های ویرایش شده</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=showWiki">
                        <span class="sidebar-text text-16">لیست Wiki ها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=expired">
                        <span class="sidebar-text text-16">لیست کمپانی های منقضی شده</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=unverified">
                        <span class="sidebar-text text-16">لیست کمپانی های تایید نشده</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=showBlock">
                        <span class="sidebar-text text-16">نمایش همه کمپانی lock شده</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=company&action=showLockById">
                        <span class="sidebar-text text-16">نمایش کمپانی lock شده</span>
                    </a>
                </li>
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- لیست پرداخت های آنلاین ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">لیست پرداخت های آنلاین</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=onlinePayment&action=showAllPay">
                        <span class="sidebar-text text-16">لیست پرداخت ها</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- پکیج ها ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">پکیج ها</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=package">
                        <span class="sidebar-text text-16">لیست پکیج ها</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- فاکتورها ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">فاکتور</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=invoice&action=showInvoiceErrorForm">
                        <span class="sidebar-text text-16">لیست فاکتورهای پرداخت نشده </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=invoice&action=showInvoiceSuccessForm">
                        <span class="sidebar-text text-16">لیست فاکتورهای پرداخت شده </span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- کد تخفیف ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">کد تخفیف</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=discountCode">
                        <span class="sidebar-text text-16">تعریف کد تخفیف</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=discountCode&action=companyList">
                        <span class="sidebar-text text-16">لیست کمپانی های تخفیف خورده</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- اعلان ها ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">اعلان ها</span>
                <b class="fa fa-angle-left"></b>

            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=notification&action=showRecive">
                        <span class="sidebar-text text-16">اعلان های دریافتی من</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=notification&action=showAllRecive">
                        <span class="sidebar-text text-16">تمام اعلان های دریافتی</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=notification&action=showAllUnread">
                        <span class="sidebar-text text-16">تمام اعلان های خوانده نشده</span>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <!--                <li>-->
                <!--                    <a href="-->
                <? //= RELA_DIR; 
                ?>
                <!--admin/?component=notification&action=addNotification">-->
                <!--                        <span class="sidebar-text text-16">ارسال اعلان</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- دسته بندی ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">دسته بندی</span>
                <b class="fa fa-angle-left"></b>

            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=category">
                        <span class="sidebar-text text-16">لیست دسته بندی</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=category&action=add">
                        <span class="sidebar-text text-16">افزودن دسته بندی جدید</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=categoryBanner">
                        <span class="sidebar-text text-16">بنرهای دسته بندی</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- گواهی ها ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-newspaper-o"></i>
                <span class="sidebar-text">گواهی ها</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=certification">
                        <span class="sidebar-text text-16">لیست گواهی ها</span>
                    </a>
                </li>
                <!--/child-item-->
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=certification&action=add">
                        <span class="sidebar-text text-16">افزودن گواهی جدید</span>
                    </a>
                </li>
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- قوانین و فاکتورها ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-newspaper-o"></i>
                <span class="sidebar-text">قوانین و مقررات</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=laws">
                        <span class="sidebar-text text-16">لیست قوانین و مقررات</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=laws&action=addLaws">
                        <span class="sidebar-text text-16">افزودن قانون جدید</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- اخبار ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-newspaper-o"></i>
                <span class="sidebar-text">اخبار</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=news">
                        <span class="sidebar-text text-16">لیست اخبار</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=news&action=addNews">
                        <span class="sidebar-text text-16">افزودن خبر جدید</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- رویداد ----------------------------->

        <li>

            <a href="#">
                <i class="sidebar-icon fa fa-newspaper-o"></i>
                <span class="sidebar-text">رویداد</span>
                <b class="fa fa-angle-left"></b>
            </a>

            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=event">
                        <span class="sidebar-text text-16">لیست رویدادها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=event&action=create">
                        <span class="sidebar-text text-16">افزودن رویداد جدید</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- مقالات ----------------------------->

        <li>
            <a href="<?php echo  RELA_DIR; ?>admin/?component=survey">
                <i class="sidebar-icon fa fa-archive"></i>
                <span class="sidebar-text text-16">مشاهده نظرات</span>
            </a>
        </li>
        <!--/child-item-->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-archive"></i>
                <span class="sidebar-text">مقالات</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=article">
                        <span class="sidebar-text text-16">لیست مقالات</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=article&action=addArticle">
                        <span class="sidebar-text text-16">افزودن مقاله جدید</span>
                    </a>
                </li>
                <!--/child-item-->

            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- تبلیغات ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-picture-o"></i>
                <span class="sidebar-text">تبلیغات</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=publicAdvertise">
                        <span class="sidebar-text text-16">لیست تبلیغات عمومی</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=publicAdvertise&action=addAdvertise">
                        <span class="sidebar-text text-16">افزودن تبلیغ عمومی</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=searchAdvertise">
                        <span class="sidebar-text text-16">لیست تبلیغات جستجو</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=searchAdvertise&action=addAdvertise">
                        <span class="sidebar-text text-16">افزودن تبلیغ جستجو</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=directoryAdvertise">
                        <span class="sidebar-text text-16">لیست تبلیغات دایرکتوری</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=advertise&type=directoryAdvertise&action=addAdvertise">
                        <span class="sidebar-text text-16">افزودن تبلیغ دایرکتوری</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- بنر ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-picture-o"></i>
                <span class="sidebar-text">بنر</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=banner">
                        <span class="sidebar-text text-16">لیست بنر</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=banner&action=addBanner">
                        <span class="sidebar-text text-16">افزودن بنر جدید</span>
                    </a>
                </li>
                <!--/child-item-->
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=bannerExhibition">
                        <span class="sidebar-text text-16">بنر نمایشگاه</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- CRM ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">CRM</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=companies">
                        <span class="sidebar-text text-16">لیست کمپانی ها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=allLogs">
                        <span class="sidebar-text text-16">لیست همه لاگ ها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=allLogByAdmin">
                        <span class="sidebar-text text-16">لیست لاگ های من</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=tasks">
                        <span class="sidebar-text text-16">لیست همه تسک ها</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=task">
                        <span class="sidebar-text text-16">لیست تسک های من</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=leads">
                        <span class="sidebar-text text-16">لیست لیدها و افزودن لید</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=leadTasks">
                        <span class="sidebar-text text-16">لیست همه تسک های لید</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=leadTask">
                        <span class="sidebar-text text-16">لیست تسک های لید من</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=actions">
                        <span class="sidebar-text text-16">لیست نحوه ارسال</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=crm&action=letters">
                        <span class="sidebar-text text-16">لیست اکشن های اصلی</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- مدیر ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">مدیر</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=admin">
                        <span class="sidebar-text text-16">لیست مدیران</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=admin&action=addAdmin">
                        <span class="sidebar-text text-16">افزودن مدیر جدید</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- سایت مپ ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-tasks"></i>
                <span class="sidebar-text">سایت مپ</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>sitemap/create/xml">
                        <span class="sidebar-text text-16">آپدیت فایل xml سایت مپ</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR; ?>sitemap/create/html">
                        <span class="sidebar-text text-16">آپدیت فایل html سایت مپ</span>
                    </a>
                </li>
            </ul>
        </li>

        <!----------------------------- درباره ما ----------------------------->

        <li>
            <a href="#">
                <i class="sidebar-icon fa fa-info"></i>
                <span class="sidebar-text">درباره ما</span>
                <b class="fa fa-angle-left"></b>
            </a>
            <ul class="sidebar-child animated">
                <li>
                    <a href="<?php echo  RELA_DIR; ?>admin/?component=aboutus&action=addAboutus">
                        <span class="sidebar-text text-16"> ویرایش</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
            <!--/sidebar-child-->
        </li>
        <!--/sidebar-item-->

        <!----------------------------- تماس با ما ----------------------------->

        <li>
            <a href="<?php echo  RELA_DIR; ?>admin/?component=contactus">
                <i class="sidebar-icon fa fa-envelope"></i>
                <span class="sidebar-text">تماس با ما</span>
            </a>
        </li>
        <!--/sidebar-item-->

    </ul>
    <!--/sidebar-->
</aside>
<!--/side-left-->

<div class="content">