<!-- breadcrumb -->
<div>
    <?php include_once("breadcrumb.php"); ?>
</div>


<!--  end of breadcrumb -->
<?php //print_r_debug($list);
?>
<!-- boxContainer -->

<div class="container mx-auto px-4 mt-6">
    <?php
    if (isset($msg) && strlen($msg)) {
    ?>
        <div>
            <?php echo $msg; ?>
        </div>
    <?php
    }
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-center gap-y-8 gap-x-8">

        <?php
        if (isset($list) && count($list['list'])) {
            foreach ($list['list'] as $id => $fields) {
                $url = RELA_DIR . "article/" . $fields['Article_id'] . "/" . urlencode($fields['title']);
        ?>

                <div class="h-full">

                    <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden flex flex-col">
                        <?php
                        $file = ROOT_DIR . ltrim($fields['image'], '/');
                        ?>
                        <img class="h-48 w-full object-cover object-center" src="<?php echo (strlen($fields['image'])  ? STATIC_RELA_DIR . '/images/article/' . $fields['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="<?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?>">

                        <div class="p-4">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo (strlen($fields['date']) ? convertDate($fields['date']) : "-"); ?></h2>
                            <h1 class="text-lg font-semibold text-gray-900 mb-3"><?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?></h1>
                            <p class="leading-relaxed mb-3"><?php echo (strlen($fields['brif_description']) ? $fields['brif_description'] : "-"); ?></p>
                        </div>

                        <div class="flex items-center flex-wrap p-4 mt-auto">
                            <a href="<?php echo  $url; ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                                مشاهده جزئیات
                            </a>
                        </div>
                    </div>

                </div>

                <!-- <div class="col-xs-6 col-sm-6 col-md-3 pull-right boxA">
                <div class="article whiteBg boxBorder roundCorner content-article">
                    <a href="<?php echo  $url; ?>" 
                        class="displayBlock fullWidth" 
                        name="display_block" 
                        title="<?php echo  $fields['title'] ?>">
                        <header><?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?></header>
                    </a>

                    <div class="item text-center" data-articleID="<?php echo  $fields['Article_id']; ?>">

                        <div class="logoContainer center-block fullWidth">
                            <a href="<?php echo ($url); ?>" class="fullWidth displayBlock" name="f_display_block" title="<?php echo  $fields['title'] ?>">
                                <?php
                                $file = ROOT_DIR . ltrim($fields['image'], '/');
                                ?>
                                <img class="roundCorner center-block fullWidth boxBorder" 
                                    src="<?php echo (strlen($fields['image'])  ? STATIC_RELA_DIR . '/images/article/' . $fields['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" 
                                    alt="<?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?>">
                            </a>
                        </div>

                        <div class="content fullWidth">
                            <div class="article">
                                <span>
                                    <?php echo (strlen($fields['brif_description']) ? $fields['brif_description'] : "-"); ?>
                                </span>
                            </div>
                            <div class="calender pull-right rtl">
                                <i class="fa fa-calendar"></i>
                                <?php echo (strlen($fields['date']) ? convertDate($fields['date']) : "-"); ?>
                            </div>
                        </div>
                        <a href="<?php echo  $url; ?>" class="btn btn-block button-default show-more" name="more_info">مشاهده بیشتر</a>
                    </div>
                </div>
            </div> -->

            <?php
            }
            ?>





    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 mt-4 bg-gray-100 items-center">
        <div class="md:col-span-4">
            <div class="Pagination flex w-full justify-between items-center flex-wrap p-2">
                <!-------------------------------- pagination -------------------------------->
                <ul class="pagination center-block flex flex-wrap gap-2 mb-5 xl:mb-0">
                    <?php
                    foreach ($list['pagination'] as $k => $href) {
                    ?>
                        <li class="w-8 h-8">
                            <a class="border border-tolidatColor rounded-full block text-center h-full w-full leading-8 " href="<?php echo RELA_DIR . $href ?>" name="<?php echo $k + 1 ?>" title="<?php echo $href ?>">
                                <?php echo $k + 1 ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>


            </div>
        </div>


    </div>

<?php
        } else {
?>
    <div class="col-xs-12 col-sm-12 col-md-12 boxA noPadding">
        <div class="article whiteBg boxBorder roundCorner">
            <div class="alert alert-warning text-center alertMaxWidth center-block mt" role="alert">هیچ اطلاعاتی موجود نیست</div>
        </div>
    </div>
<?php
        }
?>

<!-- <div class="boxContainer container fullWidth noPadding container-article">
        <div class="content ltr">
            <div class="row">
                
            </div>
        </div>
    </div> -->
</div>

<!-- /end of boxContainer -->