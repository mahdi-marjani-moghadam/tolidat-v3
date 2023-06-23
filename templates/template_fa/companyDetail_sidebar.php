<div class="whiteBg boxBorder roundCorner side-bar-knob mb-double">
    <div class="Proprietary-code header-color">
        <div class="proprietary-code-title">
            <h1 <?php echo (strlen($list['side']['list']['company_name']) > 60 ? 'class="long-text"' : ''); ?> title="<?= $list['side']['list']['company_name'] ?>"><?php echo $list['side']['list']['company_name']; ?></h1>
        </div>
    </div>

    <div class="container-edit-pen">
        <?php echo ($list['side']['list']['package_status'] != 1 ? '<a class="' . $list['side']['rate']['package_class'] . '" data-toggle="tooltip" data-placement="top" title="' . $list['side']['rate']['package_type'] . '"><i class="fa fa-trophy" aria-hidden="true"></i></a>' : '<a href="' . RELA_DIR . 'wiki/' . $list['side']['list']['Company_id'] . '" class="btn btn-sm btn-success" data-value="' . $list['side']['company_id'] . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش اطلاعات">ویرایش</a>'); ?>
    </div>

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>

    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
            <div id="pieContainer" class="center-block"></div>
        </div>
    </div>

    <?php /*<div class="row noMargin">
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
            <div class="content-circular-process center-block roundCornerFull">
                <input type="text" value="<?php echo $list['side']['list']['priority'] ?>" class="dial">
                <span class="icon-percent">%</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
            <div id="qrcode" class="center-block"></div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
        </div>
    </div>*/ ?>

    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="icon-side text-center">
                <li>
                    <span data-html="true" data-trigger="hover" data-toggle="popover" rel="popover" title="تأیید شده توسط تولیدات" data-content="<div class='popoverContainer'><span><i class='fa fa-check-square-o' aria-hidden='true'></i></span><span>تأیید شده توسط تولیدات</span></div>" data-placement="top">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                </li>
                <?php
                if ((int)$list['side']['rate']['product_count']) {
                ?>
                    <li>
                        <span data-html="true" data-trigger="hover" data-toggle="popover" rel="popover" title="محصولات" data-content="<div class='popoverContainer'><span><i class='fa fa-cubes' aria-hidden='true'></i></span><span> <?php echo $list['side']['rate']['product_count'] . ' محصول معرفی شده'; ?></span></div>" data-placement="top">
                            <i class="fa fa-cubes" aria-hidden="true"></i>
                        </span>
                    </li>
                <?php
                }
                ?>
                <?php
                if ($list['list']['package_status'] == 1) { ?>
                    <li class="<?php echo ((int)$list['side']['rate']['product_count'] == 0 ? "disabled" : ""); ?>">
                        <span class="<?php echo $list['side']['rate']['package-class'] ?>" data-html="true" data-trigger="hover" data-toggle="popover" title="" rel="popover" data-content="<div class='popoverContainer'><h5>پکیج   <?= ((int)$value['rate']['package_type'] != 0 ? $value['rate']['package_type'] : 'رایگان'); ?></h5><span><i class='fa fa-trophy' aria-hidden='true'></i></span><span><?php echo ((int)$list['side']['rate']['package_type'] ? 'پکیج ' . $list['side']['rate']['package_type'] : 'رایگان'); ?></span></div>" data-placement="top">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                        </span>
                    </li>
                <?php } ?>
                <li>
                    <span data-html="true" data-trigger="hover" data-toggle="popover" title="نوع مجموعه" rel="popover" data-content="<div class='popoverContainer'><span><i class='fa fa-exclamation-circle' aria-hidden='true'></i></span><span><?php echo $list['side']['rate']['personality_type'] ?></span></div>" data-placement="top">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </span>
                </li>
            </ul>

        </div>
    </div>
    <div class="row noMargin overlayCompany">
        <div class="col-xs-6 col-sm-12 col-md-12 pull-right">
            <p>
                <b>نام مدیرعامل :</b>
                <span><?php echo ($list['side']['list']['maneger_name'] != "" ? $list['side']['list']['maneger_name'] : "-"); ?> </span>
            </p>
        </div>
        <?php if (($list['side']['list']['company_type'] == 1)) { ?>
            <div class="col-xs-6 col-sm-12 col-md-12 pull-right">
                <p><b>شماره ثبت :</b>
                    <span><?php echo ($list['side']['list']['registration_number'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </p>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-12 pull-right">
                <p><b>شناسه ملی :</b>
                    <span><?php echo ($list['side']['list']['national_id'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </p>
            </div>
        <?php } else { ?>
            <div class="col-xs-6 col-sm-12 col-md-12 pull-right">
                <p><b>شماره جواز :</b>
                    <span><?php echo ($list['side']['licence']['licence_number'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </p>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-12 pull-right">
                <p><b>نوع جواز :</b>
                    <span><?php echo ($list['side']['licence']['licence_name'] != "" ? $list['side']['licence']['licence_name'] : "-"); ?></span>
                </p>
            </div>
        <?php } ?>
        <div class="col-xs-6 col-sm-12 col-md-12 pull-right code-company">
            <p><b>کد اختصاصی مجموعه :</b>
                <span class="badge"><?php echo $list['side']['list']['Company_id'] ?></span>
            </p>
            <a <?php echo ($list['side']['list']['catalog'] ? 'target="_blank" href="' . COMPANY_ADDRESS . $list['side']['list']['Company_id'] . '/catalog/' . $list['side']['list']['catalog'] . '"' : 'class="disabled"') ?>><img class="no-width " src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/pdf.png">
                <span>دریافت کاتالوگ</span> </a>
            <a <?php echo (strlen(trim($list['side']['list']['video_script'])) ? 'data-toggle="modal" data-target="#myModal"' : 'class="disabled"') ?>>
                <img class="no-width" src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/video-player.png">
                <span>نمایش ویدیو</span> </a>
            <!-- Modal -->
            <div class="holder-modal modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" title="ویدیو">ویدیو</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo $list['side']['list']['video_script'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
        </div>

        <!-- contact and category -->
        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
            <hr class="noMargin">

            <div class="icon-footer branch-info">
                <?php
                $cnt = 0;
                foreach ($list['side']['branch_list'] as $branch => $k) :
                    if ($cnt == 0) :
                ?>

                        <?php if (strlen($k['phones'][array_keys($k['phones'])[0]]['number'])) : ?>
                            <a href="tel:<?= $k['phones'][array_keys($k['phones'])[0]]['code'] . $k['phones'][array_keys($k['phones'])[0]]['number']; ?>">
                                <i class="pull-right text-center fa fa-phone" aria-hidden="true"></i>
                                <span class="pull-right"><?= $k['phones'][array_keys($k['phones'])[0]]['code'] . $k['phones'][array_keys($k['phones'])[0]]['number']; ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if (strlen($k['websites'][array_keys($k['websites'])[0]]['url'])) : ?>
                            <a rel="nofollow" href="<?= 'http://' . $k['websites'][array_keys($k['websites'])[0]]['url']; ?>" target="_blank">
                                <i class="pull-right text-center fa fa-globe" aria-hidden="true"></i>
                                <span class="pull-right"><?= $k['websites'][array_keys($k['websites'])[0]]['url']; ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if (strlen($k['emails'][array_keys($k['emails'])[0]]['email'])) : ?>
                            <a href="mailto:<?= $k['emails'][array_keys($k['emails'])[0]]['email']; ?>">
                                <i class="pull-right text-center fa fa-envelope" aria-hidden="true"></i>
                                <span class="pull-right"><?= $k['emails'][array_keys($k['emails'])[0]]['email']; ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if (strlen($k['addresses'][array_keys($k['addresses'])[0]]['address'])) : ?>
                            <a>
                                <i class="pull-right text-center fa fa-map-marker" aria-hidden="true"></i>
                                <span class="pull-right">
                                    <?= $list['side']['province'] . ' - ' . $k['addresses'][array_keys($k['addresses'])[0]]['address']; ?>
                                </span>
                            </a>
                        <?php endif; ?>

                <?php
                    endif;

                    $cnt++;
                endforeach;

                ?>

                <div class="category-inside">
                    <i class="pull-right text-center fa fa-bars" aria-hidden="true"></i>
                    <?php
                    $cnt = 0;
                    foreach ($list['side']['category_title'] as $category => $v) :
                    ?>
                        <a class="pull-right" href="<?php echo RELA_DIR . 'company/type/تولیدی/category/' . $v['Category_id'] ?>">
                            <?= $v['title'] . ($cnt < count($list['side']['category_title']) - 1 ? ' - ' : ''); ?>
                        </a>
                    <?php
                        $cnt++;
                    endforeach;
                    ?>
                </div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>
            </div>
        </div>

        <?php
        if (count($list['side']['socials'])) :
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                <hr class="noMargin">

                <div class="icon-footer branch-info">
                    <?php
                    foreach ($list['side']['socials'] as $branch) :
                        if (count($branch)) {
                    ?>
                            <a target="_blank" href="<?php echo $branch['url']; ?>">
                                <i class="pull-right text-center fa fa-<?= $branch['type']; ?>" aria-hidden="true"></i>
                                <span class="pull-right"><?php echo str_replace(array("http://","https://"),"",$branch['url']); ?></span>
                            </a>
                    <?php
                        }
                    endforeach;
                    ?>
                </div>
            </div>
        <?php
        endif;
        ?>

        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
            
            <div id="qrcode" class="center-block"></div>
            <div class="row xxxsmallSpace"></div>

            <a onclick="myFunction('<?php echo RELA_DIR . $list['side']['list']['Company_id'] ?>')">کپی لینک پروفایل</a>
            
            <script>
                function myFunction(copyText) {
                    
                    /* Copy the text inside the text field */
                    navigator.clipboard.writeText(copyText);

                    /* Alert the copied text */
                    // window.location = copyText;

                     alert("آدرس پروفایل کپی شد.");
                }
            </script>
            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
        </div>
    </div>

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>
</div>