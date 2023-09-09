<?php include_once 'breadcrumb.php'; ?>

<div class="">
    <div class="container-company-showDetail">
        <div class=" detail-company1 noPadding">
            <div class="relative">
                <!---------------------- تاریخ آخرین بروزرسانی ---------------------->
                <div class="contBaner mb">
                    <div class="imgContentProduct  boxBorder" style="background:url(' <?php echo $list['side']['banner_list']?> ') no-repeat center / cover">
                    <?php /*
                    <div class="imgContentProduct  boxBorder" style="background:url(' <?php echo (file_exists($list['side']['banner_list']) ? $list['side']['banner_list'] : '/templates/' . CURRENT_SKIN . '/assets/image/placeholder1.png' )?> ') no-repeat center / cover"> 
                        <?php echo $list['side']['banner_list']?>
                    */?>

                        <div class="container relative m-auto py-2 px-4">

                            <img width="150" class="rounded-md  p-1 border m-auto sm:mr-1" alt="<?php echo  " لوگوی " . $list['side']['list']['company_name'] ?>" title="<?php echo  $list['side']['list']['company_name'] ?>" id="img" name="image"  src="<?php echo (isset($list['side']['logo_list']['0']['image']) && file_exists(COMPANY_ADDRESS_ROOT . $list['side']['list']['Company_id'] . '/logo/150.150.' . $list['side']['logo_list']['0']['image']) ? COMPANY_ADDRESS . $list['side']['list']['Company_id'] . '/logo/150.150.' . $list['side']['logo_list']['0']['image'] : DEFULT_LOGO_ADDRESS) ?>">

                            <p class="date sm:absolute left-2 bottom-2 p-1 text-sm bg-white rounded">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> </span> Date of last update:
                                <span><?php echo ($list['side']['list']['refresh_date'] == '0000-00-00 00:00:00' ? '00-00-0000' : convertDate($list['side']['list']['refresh_date'])); ?></span>
                            </p>

                        </div>

                    </div>
                </div>
            </div>

            <!-- company menu -->
            <?php include_once 'companyDetail_menu.php'; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 container m-auto px-4">

                <!---------------------- ساید بار ---------------------->
                <?php include_once 'companyDetail_sidebar.php'; ?>