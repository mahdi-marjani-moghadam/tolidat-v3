<?php
$activePage = explode('/', $_SERVER['REQUEST_URI'])[1];
?>

<div class="bg-gray-100 company-detail-menu">
    <div class="container m-auto px-4 relative pt-16 lg:pt-0 ">

        <a class="menucompany hidden">
            <span class="contentP1 companyName"><i class="fa fa-bars fa-bars2" aria-hidden="true"></i> منو<span> <i class=" transition angle fa fa-angle-down angle-up-arrow" aria-hidden="true"></i> </span></span>
        </a>

        <!-- mobile menu  -->
        <div class="lg:hidden absolute right-4 top-4 flex items-center">
            <button id="btn-show-mobile-company-menu" type="button" class="bg-gray-100 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tolidatColor" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                <span class="sr-only">Open menu</span>
                <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <span class="text-sm text-gray-600 mr-1">
                Company menu</span>
        </div>

        <ul id="container-mobile-company-menu" class="hidden lg:flex flex-col lg:flex-row lg:divide-y-0 lg:divide-s divide-gray-300 text-sm divide-y">
            <li class="pull-right">
                <a class="py-3 px-2 block <?php echo (($activePage == 'company') ? 'border-b-4 border-tolidatColor' : '') ?> " href="<?php echo $list['side']['canonical']; ?>"><i class="fa fa-home"></i>
                    Company information</a>
            </li>

            <?php if (count($list['side']['product_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['product_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2 "' : 'href="' . RELA_DIR . 'product/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block ' . (($activePage == 'product') ? 'border-b-4 border-tolidatColor' : '') . ' "'); ?>>
                        <i class="fa fa-cubes"></i> Products/Services
                    </a>
                </li>
            <?php endif ?>

            <?php if (count($list['side']['history_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['history_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'history/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block ' . (($activePage == 'history') ? 'border-b-4 border-tolidatColor' : '') . ' "'); ?>>
                        <i class="fa fa-users"></i>    Our records and clients

                    </a>
                </li>
            <?php endif ?>

            <?php if (count($list['side']['commercialName_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['commercialName_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'companyCommercialName/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block ' . (($activePage == 'companyCommercialName') ? 'border-b-4 border-tolidatColor' : '') . ' "'); ?>>
                        <i class="fa fa-briefcase"></i> نام تجاری
                    </a>
                </li>
            <?php endif ?>

            <?php /*<li class="pull-right">
                <a    <?php echo(count($list['side']['licence_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="'.RELA_DIR . 'licence/all/' . $list["side"]["list"]["Company_id"].'"'); ?>><i class="fa fa-certificate"></i> مجوز</a>
            </li>*/ ?>

            <?php if (count($list['side']['honour_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['honour_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'honour/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block  ' . (($activePage == 'honour') ? 'border-b-4 border-tolidatColor' : '') . ' "'); ?>>
                        <i class="fa fa-trophy"></i> Honors and certificates
                    </a>
                </li>
            <?php endif ?>

            <?php if (count($list['side']['news_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['news_list']) == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'companyNews/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block ' . (($activePage == 'companyNews') ? 'border-b-4 border-tolidatColor' : '') . '  "'); ?>>
                        <i class="fa fa-rss-square"></i>  News or events
                    </a>
                </li>
            <?php endif ?>

            <?php if (count($list['side']['representation_list']) != 0) : ?>
                <li class="pull-right">
                    <a <?php echo (count($list['side']['representation_list']) == 0 & count($list['side']['branch_list']) == 1 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'representation/all/' . $list["side"]["list"]["Company_id"] . '" class="py-3 px-2 block ' . (($activePage == 'representation') ? 'border-b-4 border-tolidatColor' : '') . '"'); ?>>
                        <i class="fa fa-building-o"></i> نمایندگی و شعب
                    </a>
                </li>
            <?php endif ?>

            <?php if ($list['side']['advertise_list'] != 0) : ?>
                <li class="pull-right">
                    <a <?php echo ($list['side']['advertise_list'] == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'companyAdvertise/all/' . $list["side"]["list"]["Company_id"] . '"   class="py-3 px-2 block  ' . (($activePage == 'companyAdvertise') ? 'border-b-4 border-tolidatColor' : '') . ' "   '); ?>>
                        <i class="fa fa-handshake-o"></i>آگهی ها
                    </a>
                </li>
            <?php endif ?>

            <?php if ($list['side']['employment_list'] != 0) : ?>
                <li class="pull-right">
                    <a <?php echo ($list['side']['employment_list'] == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'employment/all/' . $list["side"]["list"]["Company_id"] . '"  class="py-3 px-2 block  ' . (($activePage == 'employment') ? 'border-b-4 border-tolidatColor' : '') . ' "  '); ?>>
                        <i class="fa fa-handshake-o"></i>فرصت های شغلی
                    </a>
                </li>
            <?php endif ?>


            <li class="pull-right">
                <a <?php echo ($list["side"]["list"]["Company_id"] == 0 ? 'class="transition text-gray-500 block py-3 px-2"' : 'href="' . RELA_DIR . 'survey/all/' . $list["side"]["list"]["Company_id"] . '"  class="py-3 px-2 block  ' . (($activePage == 'survey') ? 'border-b-4 border-tolidatColor' : '') . ' "  '); ?>>
                    <i class="fa fa-handshake-o"></i>Comments and Suggestions
                </a>
            </li>


            <?php if ($list['side']['list']['package_status'] != 1) { ?>
                <li class="pull-right text-center">
                    <a class="py-1 px-2 block bg-green-600 text-white hover:text-gray-900 rounded-full m-2" href="<?php echo RELA_DIR . 'companyContacts/' . $list["side"]["list"]["Company_id"] ?>">
                        <i class="fa fa-envelope"></i> Contact <?php echo $list['side']['list']['company_name'] ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script>
    //hamburger menu company
    $('#btn-show-mobile-company-menu').on("click", function(e) {
        e.stopPropagation();
        if ($('#container-mobile-company-menu').hasClass('is-active')) {
            $('#container-mobile-company-menu').removeClass('is-active');
        } else {
            $('#container-mobile-company-menu').addClass('is-active');
        }
    });
    //end of hamburger menu company
</script>