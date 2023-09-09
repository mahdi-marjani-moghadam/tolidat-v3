<div class="tab section-title boxBorder roundCorner">
    <a class="menucompany">
        <span class="contentP1 companyName"><i class="fa fa-bars fa-bars2" aria-hidden="true"></i>   منو<span> <i class=" transition angle fa fa-angle-down angle-up-arrow" aria-hidden="true"></i> </span></span>
    </a>

        <?php //print_r_debug(count($list['side']['count']));?>
    <ul class="tabMenu center-block">
        <li class="pull-right">
            <a href="<?php echo $list['side']['canonical']; ?>"><i class="fa fa-home"></i> اطلاعات مجموعه</a>
        </li>
        <li class="pull-right">
            <a <?php echo(count($list['side']['product_list']) == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'product/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-cubes"></i> محصولات/خدمات
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo(count($list['side']['history_list']) == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'history/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-users"></i> سوابق و مشتریان ما
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo(count($list['side']['commercialName_list']) == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'companyCommercialName/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-briefcase"></i> نام تجاری
            </a>
        </li>
        <?php /*<li class="pull-right">
            <a <?php echo(count($list['side']['licence_list']) == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'licence/all/' . $list["side"]["list"]["Company_id"].'"'); ?>><i class="fa fa-certificate"></i> مجوز</a>
        </li>*/?>
        <li class="pull-right">
            <a <?php echo(count($list['side']['honour_list']) == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'honour/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-trophy"></i> افتخارات و گواهی ها
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo(count($list['side']['news_list']) == 0 ? 'class="transition disabled"' :'href="'.RELA_DIR . 'companyNews/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-rss-square"></i> اخبار و رویداد
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo(count($list['side']['representation_list']) == 0 & count($list['side']['branch_list']) == 1 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'representation/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-building-o"></i> نمایندگی و شعب
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo($list['side']['advertise_list'] == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'companyAdvertise/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-handshake-o"></i>آگهی ها
            </a>
        </li>
        <li class="pull-right">
            <a <?php echo($list['side']['employment_list'] == 0 ? 'class="transition disabled"' : 'href="'.RELA_DIR . 'employment/all/' . $list["side"]["list"]["Company_id"].'"'); ?>>
                <i class="fa fa-handshake-o"></i>فرصت های شغلی
            </a>
        </li>
        <?php if ($list['side']['list']['package_status'] != 1) { ?>
            <li class="pull-right">
                <a href="<?= RELA_DIR . 'companyContacts/' . $list["side"]["list"]["Company_id"] ?>">
                    <i class="fa fa-envelope"></i> تماس با <?php echo $list['side']['list']['company_name'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>