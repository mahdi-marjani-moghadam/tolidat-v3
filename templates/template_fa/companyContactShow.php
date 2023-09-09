<!-- <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script> -->
<!-- <script src="< ?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script> -->

<?php include_once 'companyDetail_top.php'; ?>


<div class="lg:col-span-2">


    <?php if ($list['side']['list']['package_status'] != 1) : ?>
        <!---------------------- اطلاعات تماس ---------------------->
        <div class="border-2 my-4 bg-gray-50 mt-12 rounded">
            <div id="contacts" class="detail showProduct whiteBg boxBorder roundCorner showProduct1 mb-double">
                <div>
                    <div class="pos-relative">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs flex mr-2 -mt-7" id="tabs" role="tablist">
                            <?php foreach ($list['side']['branch_list'] as $branch) { ?>
                                <li role="presentation" class="    pull-right branchName <?php echo ($branch['branch_name'] == "مرکزی" ? "active " : '') ?> ">
                                    <a href="#branch<?php echo $branch['Branch_id'] ?>" class="border-2 rounded-t border-b-0 p-1 ml-2 bg-gray-50 <?php echo ($branch['branch_name'] == "مرکزی" ? "active " : 'bg-gray-200') ?>" data-id="<?php echo $branch['Branch_id'] ?>" aria-controls="home" role="tab" data-toggle="tab">دفتر <?php echo $branch['branch_name'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                        <!-- Tab panes -->
                    </div>

                    <div class="tab-content leading-relaxed">
                        <?php foreach ($list['side']['branch_list'] as $branch) { ?>
                            <div role="tabpanel" class="p-2 text-sm tab-container <?php echo (!$branch['Branch_id'] ? "active" : "") ?>" id="branch<?php echo $branch['Branch_id'] ?>">
                                <h2 class="my-2">اطلاعات تماس <?php echo $list['side']['list']['company_name'] ?></h2>
                                <div class="panel-body">
                                    <div class="row grid grid-cols-2 gap-2">
                                        <div class="border bg-white  p-2 rounded ">
                                            <h3 class='text-tolidatColor' title="ایمیل">ایمیل</h3>
                                            <?php
                                            if (count($branch['emails'])) {
                                            ?>
                                                <ul>
                                                    <?php foreach ($branch['emails'] as $email) { ?>
                                                        <li>
                                                            <a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a>
                                                            <?php //echo(count($branch['emails']) > 1 ? '<hr>' : ''); 
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                -
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="border bg-white  p-2 rounded">
                                            <h3 class='text-tolidatColor' title="آدرس">آدرس</h3>
                                            <?php
                                            if (count($branch['addresses'])) {
                                            ?>
                                                <ul class="address-contact">
                                                    <?php
                                                    $cnt = 1;
                                                    foreach ($branch['addresses'] as $address) {
                                                    ?>
                                                        <li>
                                                            <?php echo ((int)$branch['addresses'] > 1 ? $cnt . '-' : '') . $address['address']; ?>
                                                            <?php //echo(count($branch['addresses']) > 1 ? '<hr>' : ''); 
                                                            ?>
                                                        </li>
                                                    <?php
                                                        $cnt++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                -
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="border bg-white  p-2 rounded">
                                            <h3 class='text-tolidatColor' title="آدرس اینترنتی">آدرس اینترنتی</h3>
                                            <?php
                                            if (count($branch['websites'])) {
                                            ?>
                                                <ul>
                                                    <?php foreach ($branch['websites'] as $website) { ?>
                                                        <li>
                                                            <a rel="nofollow" target="_blank" href="<?php echo 'http://' . $website['url'] ?>"><?php echo $website['url'] ?></a>
                                                            <?php //echo(count($branch['websites']) > 1 ? '<hr>' : ''); 
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                -
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="border bg-white  p-2 rounded">
                                            <h3 class='text-tolidatColor' title="تلفن">تلفن</h3>
                                            <?php
                                            if (count($branch['phones'])) {
                                            ?>
                                                <ul>
                                                    <?php foreach ($branch['phones'] as $phone) { ?>
                                                        <li>
                                                            <?php echo $phone['code'] . $phone['number'] . " " . $phone['state'] . "  " . $phone['value'] ?>
                                                            <?php //echo(count($branch['phones']) > 1 ? '<hr>' : ''); 
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                -
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <?php if (isset($branch['position'])) : ?>
                                        <?php include 'companyDetail_map.php'; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!---------------------- فرم تماس با ما ---------------------->
        <div class="border-2 my-4 bg-gray-50  rounded">
            <div class="contentProduct contentProduct2 transition whiteBg roundCorner mb container-floatinglabel boxBorder">
                <h2 class="bg-gray-200 p-3">فرم تماس با <?php echo $list['side']['list']['company_name'] ?>
                                    </h2>
                <div class="panel-body p-3">
                    <p class="iziContainer"></p>
                    <form class="addContactUs" method="post" name="contact" id="contact" role="form" novalidate="novalidate" data-toggle="validator">
                        <div class="row rowContact">
                            <div class=" grid grid-cols-4 gap-3 content2 pull-right">
                                    <label for="name">نام</label>
                                    <input required type="text" id="name" name="name" class="form-control col-span-3 keyboard" data-error="لطفا نام خود را وارد نمایید">

                                    <label for="email">ایمیل</label>
                                    <input required type="email" id="email" name="email" class="form-control  col-span-3 set-font-latin ltr" data-error="لطفا ایمیل خود را وارد نمایید">
                                    <label for="subject">موضوع</label>
                                    <input required type="text" name="subject" id="subject" class="form-control  col-span-3 keyboard" data-error="لطفا موضوع خود را وارد نمایید">
                                    <label for="message">پیام</label>
                                    <textarea required name="message" id="message" class="form-control  col-span-3" rows="3" data-error="لطفا پیام خود را وارد نمایید"></textarea>
                                
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 content2">
                                <div class="form-group content">
                                    <button type="submit" class="bg-tolidatColor px-3 text-white rounded text-lg" name="addContacts" id="addContacts" value="ثبت" tabindex="8">
                                        <span> ارسال</span>
                                    </button>
                                    <input name="action" id="action" type="hidden" value="add" />
                                    <input name="company_id" type="hidden" id="company_id" value="<?php echo $list['side']['list']['Company_id'] ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include_once 'companyDetail_bottom.php'; ?>

<script>
    $('#tabs li a:not(:first)').addClass('inactive');
    $('.tab-container').hide();
    $('.tab-container:first').show();
    $('#tabs li a').click(function() {
        var t = $(this).attr('href');
        $('#tabs li a').addClass('bg-gray-200');
        $(this).removeClass('bg-gray-200');
        $('.tab-container').hide();
        $(t).fadeIn('slow');
        return false;
    })

    if ($(this).hasClass('bg-gray-200')) { //this is the start of our condition 
        $('#tabs li a').addClass('bg-gray-200');
        $(this).removeClass('bg-gray-200');
        $('.tab-container').hide();
        $(t).fadeIn('slow');
    }
</script>