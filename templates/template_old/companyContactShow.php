<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script>

<?php include_once 'companyDetail_top.php'; ?>

<?php if ($list['side']['list']['package_status'] != 1) : ?>
    <!---------------------- اطلاعات تماس ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left" style="margin-top: 2.5rem;">
        <div id="contacts" class="detail showProduct whiteBg boxBorder roundCorner showProduct1 mb-double">
            <div>
                <div class="pos-relative">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($list['side']['branch_list'] as $branch) { ?>
                            <li role="presentation"
                                class="pull-right branchName <?php echo($branch['branch_name'] == "مرکزی" ? "active" : '') ?> ">
                                <a href="#branch<?php echo $branch['Branch_id'] ?>"
                                   data-id="<?php echo $branch['Branch_id'] ?>" aria-controls="home" role="tab"
                                   data-toggle="tab">دفتر <?php echo $branch['branch_name'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- Tab panes -->
                </div>

                <div class="tab-content">
                    <?php foreach ($list['side']['branch_list'] as $branch) { ?>
                        <div role="tabpanel" class="tab-pane <?php echo(!$branch['Branch_id'] ? "active" : "") ?>"
                             id="branch<?php echo $branch['Branch_id'] ?>">
                            <header>اطلاعات تماس <?php echo $list['side']['list']['company_name'] ?></header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-3 pull-right Border-contact">
                                        <h2 title="ایمیل">ایمیل</h2>
                                        <?php
                                        if (count($branch['emails'])) {
                                            ?>
                                            <ul>
                                                <?php foreach ($branch['emails'] as $email) { ?>
                                                    <li>
                                                        <a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a>
                                                        <?php //echo(count($branch['emails']) > 1 ? '<hr>' : ''); ?>
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
                                    <div class="col-xs-12 col-sm-12 col-md-3 pull-right Border-contact">
                                        <h2 title="آدرس">آدرس</h2>
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
                                                        <?php //echo(count($branch['addresses']) > 1 ? '<hr>' : ''); ?>
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
                                    <div class="col-xs-12 col-sm-12 col-md-3  pull-right Border-contact">
                                        <h2 title="آدرس اینترنتی">آدرس اینترنتی</h2>
                                        <?php
                                        if (count($branch['websites'])) {
                                            ?>
                                            <ul>
                                                <?php foreach ($branch['websites'] as $website) { ?>
                                                    <li>
                                                        <a rel="nofollow" target="_blank"
                                                           href="<?php echo 'http://' . $website['url'] ?>"><?php echo $website['url'] ?></a>
                                                        <?php //echo(count($branch['websites']) > 1 ? '<hr>' : ''); ?>
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
                                    <div class="col-xs-12 col-sm-12 col-md-3  pull-right Border-contact">
                                        <h2 title="تلفن">تلفن</h2>
                                        <?php
                                        if (count($branch['phones'])) {
                                            ?>
                                            <ul>
                                                <?php foreach ($branch['phones'] as $phone) { ?>
                                                    <li>
                                                        <?php echo $phone['code'] . $phone['number'] . " " . $phone['state'] . "  " . $phone['value'] ?>
                                                        <?php //echo(count($branch['phones']) > 1 ? '<hr>' : ''); ?>
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

                                <?php if (isset($branch['position'])): ?>
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
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3">
        <div class="contentProduct contentProduct2 transition whiteBg roundCorner mb container-floatinglabel boxBorder">
            <header>فرم تماس با <?php echo $list['side']['list']['company_name'] ?>
            </header>
            <div class="panel-body">
                <p class="iziContainer"></p>
                <form class="addContactUs" method="post" name="contact" id="contact" role="form"
                      novalidate="novalidate" data-toggle="validator">
                    <div class="row rowContact">
                        <div class="col-xs-12 col-sm-6 col-md-6 content2 pull-right">
                            <div class="form-group has-feedback eror mb detail-list-keyboard-container name">
                                <label for="name">نام</label>
                                <input required type="text" id="name" name="name"
                                       class="form-control keyboard"
                                       data-error="لطفا نام خود را وارد نمایید">
                                <img class="icon hidden-xs"
                                     src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/keyboard.png"
                                     alt="Persian On Screen Keyboard">
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>

                            <div class="form-group has-feedback eror email">
                                <label for="email">ایمیل</label>
                                <input required type="email" id="email" name="email"
                                       class="form-control set-font-latin ltr"
                                       data-error="لطفا ایمیل خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>

                            <div class="form-group has-feedback eror mb detail-list-keyboard-container subject">
                                <label for="subject">موضوع</label>
                                <input required type="text" name="subject" id="subject"
                                       class="form-control keyboard"
                                       data-error="لطفا موضوع خود را وارد نمایید">
                                <img class="icon hidden-xs"
                                     src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/keyboard.png"
                                     alt="Persian On Screen Keyboard">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 content2 pull-right">
                            <div class="form-group eror mb detail-list-keyboard-container detail-list-keyboard-container-textarea message">
                                <label for="message">پیام</label>
                                <textarea required name="message" id="message" class="form-control keyboard"
                                          rows="3" data-error="لطفا پیام خود را وارد نمایید"></textarea>
                                <img class="icon hidden-xs"
                                     src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/keyboard.png"
                                     alt="Persian On Screen Keyboard">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 content2">
                            <div class="form-group content">
                                <button type="submit"
                                        class="button-default btn btn-main show-more btn-block transition"
                                        name="addContacts" id="addContacts" value="ثبت" tabindex="8">
                                    <span> ارسال</span>
                                </button>
                                <input name="action" id="action" type="hidden" value="add"/>
                                <input name="company_id" type="hidden" id="company_id"
                                       value="<?php echo $list['side']['list']['Company_id'] ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>

<script>

    $('.company_map').each(function () {
        var x = $(this).siblings('.x').val();
        var y = $(this).siblings('.y').val();

        $(this).locationpicker({
            location: {
                latitude: x,
                longitude: y
            },
            radius: 100,
            draggable: true,
            enableAutocomplete: true,
            markerDraggable: false
        });
    });
</script>
