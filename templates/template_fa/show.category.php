<?php include_once("breadcrumb.php"); ?>

<style>
    .content-show-more {
        height: 130px;
        overflow: hidden;
    }

    .show-more {
        height: auto !important;
    }
</style>

<div class="">

    <?php if ($list['topLayer']) : ?>
        <div class="container m-auto px-4 my-4 max-h-80 md:max-h-full overflow-x-hidden md:overflow-auto">
            <div class="bg-gray-50 p-4 border-2 rounded">
                <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                    <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double">
                        <nav aria-label="...">
                            <ul class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php foreach ($list['category'] as $category) { ?>
                                    <li>
                                        <a class="flex gap-x-4 text-orange-700 hover:text-black" id="<?php echo  $category['Category_id']; ?>" href="<?php echo RELA_DIR . $category['link'] . $category['Category_id'] ?>">
                                            <img class="w-8 h-8 pull-right" src="<?php echo RELA_DIR . "statics/images/category/tinyCatImg/" . $category['Category_id'] . ".png"; ?>" alt="<?php echo $category['title'] ?>">
                                            <?php echo $category['title'] ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>  
        </div>
    <?php endif; ?>

    <?php if ($list['catBanner']->image != '') : ?>
        <div class="h-44">
            <img class="h-full w-full object-cover" src="<?php echo RELA_DIR . "statics/images/category_banner/" .  $list['catBanner']->image ?>" alt="">
        </div>
    <?php endif; ?>


    <div class="container mx-auto px-4">

        <h1 class="text-2xl my-4 font-bold">
            <?php if($list['cat']->title){?>
                دسته بندی: <?php echo $list['cat']->title; ?>
            <?php }?>    
        </h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php foreach ($list['category'] as $category) { ?>
                <div class="border-2 bg-gray-50 rounded" data-id="<?php echo  $category['Category_id']; ?>">
                    <div class="text-right text-title">
                        <a class="flex items-center gap-4  bg-gray-200 font-bold p-1" href="<?php echo RELA_DIR. $category['link'] . $category['Category_id'] ?>">
                            <?php if ($list['topLayer']) : ?>
                                <img width="50" class="pull-right" src="<?php echo RELA_DIR . "statics/images/category/tinyCatImg/" . $category['Category_id'] . ".png"; ?>" alt="<?php echo $category['title'] ?>">
                            <?php endif; ?>
                            <?php echo $category['title'] ?>
                        </a>
                    </div>

                    <div class="content whiteBg roundCorner fullWidth">
                        <?php
                        if (count($list['company'][$category['Category_id']])) {
                        ?>
                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 p-2">
                                <?php foreach ($list['company'][$category['Category_id']] as $company) { ?>
                                    <div class="company rounded bg-white border">

                                        <div class=" text-center h-28">
                                            <a class="block"
                                               href="<?php echo RELA_DIR . 'company/Detail/' . $company['Company_id'] . '/' . cleanUrl($company['company_name']); ?>">
                                                <img class="company-logo h-full object-contain mx-auto"
                                                     height="200"
                                                     src="<?php echo (!empty($company['image']) && file_exists(COMPANY_ADDRESS_ROOT . $company['Company_id'] . "/logo/" . $company['image']) ? COMPANY_ADDRESS . $company['Company_id'] . "/logo/" . $company['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="text-sm h-28 flex flex-col justify-between p-1">
                                            <h2 class="font-bold"><?php echo $company['company_name'] ?></h2>
                                            <div class="mb-0">

                                                <div><?php echo  $company['province_name'] ?></div>

                                                <? if ((int)$company['product_count']) { ?>
                                                    <p class="cubes mb-0"> <i class="fa fa-cubes" aria-hidden="true"></i> <span><?php echo  $company['product_count'] ?> محصول</span></p>
                                                <? } ?>

                                            </div>

                                            <a class="company-link text-xs block text-tolidatColor rounded-full"
                                               href="<?php echo RELA_DIR . 'company/Detail/' . $company['Company_id'] . '/' . cleanUrl($company['company_name']); ?>">
                                                دیدن کمپانی ←
                                            </a>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else {
                        ?>
                            <!-- <img class="empty-img center-block" src="< ?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png" style="position: absolute;left: 0;right: 0;top: 2px;bottom: 0;margin: 25% auto;"> -->
                        <?php
                        }
                        ?>
                        <a class="link-show-all-company bg-gray-600  text-white my-2 mx-2 px-3 py-1 rounded-full block text-center" href="<?php echo RELA_DIR . $category['link'] . $category['Category_id'] ?>"><?php echo  $list['buttonTitle'] ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>



        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php foreach ($list['categoryLevelTwo'] as $category) { ?>
                <div class="border-2 bg-gray-50 rounded" data-id="<?php echo  $category['Category_id']; ?>">
                    <div class="text-right text-title">
                        <a class="flex items-center gap-4  bg-gray-200 font-bold p-1" href="<?php echo RELA_DIR. $category['link'] . $category['url'] ?>">
                            <?php if ($list['topLayer']) : ?>
                                <img width="50" class="pull-right" src="<?php echo RELA_DIR . "statics/images/category/tinyCatImg/" . $category['Category_id'] . ".png"; ?>" alt="<?php echo $category['title'] ?>">
                            <?php endif; ?>
                            <?php echo $category['title'] ?>
                        </a>
                    </div>

                    <div class="content whiteBg roundCorner fullWidth">
                        <?php
                        if (count($list['company'][$category['Category_id']])) {
                        ?>
                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 p-2">
                                <?php foreach ($list['company'][$category['Category_id']] as $company) { ?>
                                    <div class="company rounded bg-white border">

                                        <div class=" text-center h-28">
                                            <a class="block"
                                               href="<?php echo RELA_DIR . 'company/Detail/' . $company['Company_id'] . '/' . cleanUrl($company['company_name']); ?>">
                                                <img class="company-logo h-full object-contain mx-auto"
                                                     height="200"
                                                     src="<?php echo (!empty($company['image']) && file_exists(COMPANY_ADDRESS_ROOT . $company['Company_id'] . "/logo/" . $company['image']) ? COMPANY_ADDRESS . $company['Company_id'] . "/logo/" . $company['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="text-sm h-28 flex flex-col justify-between p-1">
                                            <h2 class="font-bold"><?php echo $company['company_name'] ?></h2>
                                            <div class="mb-0">

                                                <div><?php echo  $company['province_name'] ?></div>

                                                <? if ((int)$company['product_count']) { ?>
                                                    <p class="cubes mb-0"> <i class="fa fa-cubes" aria-hidden="true"></i> <span><?php echo  $company['product_count'] ?> محصول</span></p>
                                                <? } ?>

                                            </div>

                                            <a class="company-link text-xs block text-tolidatColor rounded-full"
                                               href="<?php echo RELA_DIR . 'company/Detail/' . $company['Company_id'] . '/' . cleanUrl($company['company_name']); ?>">
                                                دیدن کمپانی ←
                                            </a>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else {
                        ?>
                            <!-- <img class="empty-img center-block" src="< ?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png" style="position: absolute;left: 0;right: 0;top: 2px;bottom: 0;margin: 25% auto;"> -->
                        <?php
                        }
                        ?>
                        <a class="link-show-all-company bg-gray-600  text-white my-2 mx-2 px-3 py-1 rounded-full block text-center" href="<?php echo RELA_DIR . $category['link'] . $category['url'] ?>"><?php echo  $list['buttonTitle'] ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php if($list['cat']->body != ''):  ?>
        <div class="content-show-more mt-8 text-justify category-description">
           <?php echo $list['cat']->body ?>
        </div>

        <div class="btn-show-more cursor-pointer text-tolidatColor mt-2">
            ادامه مطلب <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </div>
        <?php endif ?>
    </div>
</div>


<script>
    $(document).ready(function() {
        var moretext = 'ادامه مطلب <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
        var lesstext = 'مشاهده کمتر <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>';

        $('.btn-show-more').click(function(){
            if($('.content-show-more').hasClass('show-more')) {
                $('.content-show-more').removeClass('show-more');
                $(this).html(moretext);
            } else {
                $('.content-show-more').addClass('show-more');
                $(this).html(lesstext);
            }
        });
    });
</script>
