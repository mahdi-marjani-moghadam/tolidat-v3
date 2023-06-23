<!-- <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script> -->
<!-- <script src="< ?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script> -->
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<!-- boxContainer -->
<div class="boxContainer container noPadding">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>
    <!-- separator -->
    <div class="contact clear whiteBg boxBorder roundCorner fullWidth ">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9  pull-right">
                <div class="content fullWidth">
                    <span><i class="fa fa-map-marker text-danger"></i> آدرس : </span> زعفرانیه- خیابان فلاحی - خیابان فیروز کوه-خیابان نیاز زاده-کوچه کوه پیکر-پلاک
                    3 - واحد 4
                    <br>
                    <span><i class="fa fa-phone text-danger"></i> شماره تلفن: </span> ۲۲۴۳۵۲۰۰-۰۲۱
                    <br>
                    <span><i class="fa fa-envelope-o text-danger"></i> ایمیل: </span> info@tolidat.ir
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 text-center mb mt  pull-left">
                <img class="mt" src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/contactUs_img.png" alt="نحوه ارتباط با سایت تولیدات">
            </div>
        </div>
    </div>
    <!-- separator -->
    <div class="or-spacer center-block">
        <div class="mask"></div>
    </div><!-- /end of separator -->
    <div class="contact clear whiteBg boxBorder roundCorner fullWidth">
        <form class="" action="" method="post" name="form1" id="form1" role="form" data-toggle="validator" novalidate="novalidate">
            <input name="action" type="hidden" id="action" value="send">
            <div class="row noMargin">
                <div class="col-xs-12 col-sm-12 col-md-6  pull-right noPadding mb container-floatinglabel">
                    <header>با ما در تماس باشید</header>
                    <div class="row xxxsmallSpace"></div>
                    <?php
                    $msg .= (strlen($messageStack->output('contactus')) ? $messageStack->output('contactus') : "");
                    if (isset($msg) && !empty($msg)) {
                    ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <?php echo $msg; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mb eror">
                            <input type="text" name="email" id="email" class="form-control transition set-font-latin ltr" data-error="لطفا آدرس پست الکترونیک را وارد نمایید" value="<?php echo (isset($list) && strlen($list['fields']['email']) ? $list['fields']['email'] : ""); ?>" tabindex="1" required>
                            <label for="email">پست الکترونیک</label>
                            <?php if (strlen($list['fields']['validation']['email']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['email']['0'] ?></div><?php } ?>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mb eror company-list-keyboard-container">
                            <label for="subject">موضوع</label>
                            <input name="subject" id="subject" class="form-control rtl transition keyboard" type="text" data-error="لطفا موضوع را وارد نمایید" value="<?php echo (isset($list) && strlen($list['fields']['subject']) ? $list['fields']['subject'] : ""); ?>" tabindex="2" required>
                            <?php if (strlen($list['fields']['validation']['subject']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['subject']['0'] ?></div><?php } ?>
                            <?php /*<img class="icon hidden-xs" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/keyboard.png" alt="Persian On Screen Keyboard">*/ ?>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mb eror company-list-keyboard-container company-list-keyboard-container-textarea ">
                            <label for="comment">متن پیام</label>
                            <textarea name="comment" class="form-control rtl transition fullWidth keyboard" data-error="لطفا متن پیام خود را وارد نمایید" id="comment" tabindex="3"><?php echo (isset($list) && strlen($list['fields']['comment']) ? $list['fields']['comment'] : ""); ?></textarea>
                            <?php if (strlen($list['fields']['validation']['comment']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['comment']['0'] ?></div><?php } ?>
                            <?php /*<img class="icon hidden-xs" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/keyboard.png" alt="Persian On Screen Keyboard">*/ ?>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-left mb">
                        <button type="submit" class="btn button-default show-more btn-block transition" tabindex="4">
                            <span>ارسال</span>
                        </button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6  pull-left noPadding">
                    <div class="map contact-map fullWidth">


                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                        <div id="map" class="company_map"></div>
                        <script>
                            var map = L.map('map', {
                                center: [35.813155, 51.417052],
                                zoom: 16,
                                scrollWheelZoom:false
                            });
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);


                            L.marker([35.813155, 51.417052]).addTo(map)
                                // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
                                .openPopup();

                            // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}', {
                            //     attribution: 'Map data &copy; contributors, Imagery © ',
                            //     maxZoom: 18,
                            //     id: 'mapbox/streets-v11',
                            //     tileSize: 100,
                            //     // zoomOffset: -1,
                            //     // accessToken: 'your.mapbox.access.token'
                            // }).addTo(map);
                        </script>



                        <?php /*<iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3235.4731620588063!2d51.41640450000003!3d35.812864999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e08a716c96309%3A0x997a8b0e7ef5c224!2sTehran%2C+Kooh+Peykar!5e0!3m2!1sen!2sir!4v1442735189471"
                            width="100%" frameborder="0" allowfullscreen=""
                            class="item-center roundCorner">
                        </iframe> */ ?>



                        <!-- <div id="company_map" class="company_map"></div> -->
                        <script>
                            // $('.getLocation').bind('click', function (e) {
                            //     e.preventDefault();

                            //     if (navigator.geolocation) {
                            //         navigator.geolocation.getCurrentPosition(function (position) {
                            //             // You can set it the plugin
                            //             $(' #company_map').locationpicker({
                            //                 location: {latitude: position.coords.latitude, longitude: position.coords.longitude},
                            //                 onchanged: function (currentLocation, radius, isMarkerDropped) {
                            //                 }
                            //             });
                            //         });

                            //     } else {
                            //         alert("not support location");
                            //     }
                            // });

                            // $(' #company_map').locationpicker({
                            //     location: {
                            //         latitude:35.813155,
                            //         longitude:51.417052
                            //     },
                            //     radius: 200,
                            //     draggable: true,
                            //     inputBinding: {
                            //         latitudeInput: $('#us6-lat'),
                            //         longitudeInput: $('#us6-lon'),
                            //         radiusInput: $('#us6-radius'),
                            //         locationNameInput: $('#us6-address')
                            //     },
                            //     enableAutocomplete: true,
                            //     markerDraggable: false
                            // });
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end of boxContainer -->