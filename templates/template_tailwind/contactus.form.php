<?php include_once("breadcrumb.php"); ?>

<!-- boxContainer -->
<div class="container mx-auto px-4">

    <!-- separator -->
    <div class="rounded p-5 border-2 my-4 bg-gray-50 ">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9  pull-right">
                <div class="gap-x-3 flex flex-col">
                    <span class="text-gray-500"><i class="fa fa-map-marker text-danger"></i> آدرس : </span> فلکه دوم صادقیه بلوار فردوس شرق خیابان ولیعصر خیابان رز غربی پلاک 7 واحد 3
                    <br>
                    <br>
                    <span class="text-gray-500 hidden"><i class="fa fa-phone text-danger"></i> شماره تلفن: <br>
                        برای اطلاع از نحوه ثبت نام و شرایط فروش با ما تماس بگیرید
                        <span class="text-black" dir="ltr">
                            <a class="bg-lime-500 text-white  rounded-full px-5 py-1 mt-2 inline-block" id="cta-tolidat-phone" href="tel:02144048527"><i class="fa fa-phone"></i> 021-44048527</a>

                        </span></span>
                </div>
            </div>

        </div>
    </div>

    <div class="  rounded p-5   border-2 my-4 bg-gray-50">
        <form class="" action="" method="post" name="form1" id="form1" role="form" data-toggle="validator" novalidate="novalidate">




            <!-- <input name="action" type="hidden" id="action" value="send"> -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-5">
                <div class="">
                    <h2 class="text-tolidatColor border-b mb-4 pb-2">با ما در تماس باشید</h2>

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
                    <div class="">
                        <div class="w-full flex justify-center mt-4">
                            <div class="w-full">
                                <div class="relative">
                                    <label for="email">پست الکترونیک</label>
                                    <input name="email" id="email" type="text" class="xt-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" value="<?php echo (isset($list) && strlen($list['fields']['email']) ? $list['fields']['email'] : ""); ?>" tabindex="1" oninvalid="setCustomValidity('لطفا آدرس پست الکترونیک را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    <?php if (strlen($list['fields']['validation']['email']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['email']['0'] ?></div><?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-center mt-4">
                            <div class="w-full">
                                <div class="relative">
                                    <label for="subject">موضوع</label>
                                    <input name="subject" id="subject" type="text" class="xt-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" value="<?php echo (isset($list) && strlen($list['fields']['subject']) ? $list['fields']['subject'] : ""); ?>" tabindex="2" oninvalid="setCustomValidity('لطفا موضوع را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    <?php if (strlen($list['fields']['validation']['subject']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['subject']['0'] ?></div><?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-center mt-4">
                            <div class="w-full">
                                <div class="relative">
                                    <label for="comment">متن پیام</label>
                                    <textarea name="comment" id="comment" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="3" oninvalid="setCustomValidity('لطفا متن پیام خود را وارد نمایید')" oninput="setCustomValidity('')" required><?php echo (isset($list) && strlen($list['fields']['comment']) ? $list['fields']['comment'] : ""); ?></textarea>
                                    <?php if (strlen($list['fields']['validation']['comment']['0'])) { ?><div class="errorHandler"><?php echo $list['fields']['validation']['comment']['0'] ?></div><?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-4">
                        <script src="https://www.google.com/recaptcha/api.js?render=6LdmjDsmAAAAANswKgj3737SohuPSA7AIhSxMfNm"></script>
                        <script>
                            $('#form1').submit(function(event) {
                                event.preventDefault();
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('6LdmjDsmAAAAANswKgj3737SohuPSA7AIhSxMfNm', {
                                        action: 'send'
                                    }).then(function(token) {
                                        $('#form1').prepend('<input type="hidden" name="token" value="' + token + '">');
                                        $('#form1').prepend('<input type="hidden" name="action" value="send">');
                                        $('#form1').unbind('submit').submit();
                                    });;
                                });
                            });
                        </script>
                        <button type="submit" class=" flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600" tabindex="4">
                            <span>ارسال</span>
                        </button>
                    </div>



                </div>
                <div class="">
                    <div id="map" class="h-full w-full min-h-[250px]">

                    </div>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                    <script>
                        var map = L.map('map', {
                            center: [35.717993, 51.329152],
                            zoom: 16,
                            scrollWheelZoom: false
                        });
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);


                        L.marker([35.717993, 51.329152]).addTo(map)
                            // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
                            .openPopup();
                    </script>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($_SERVER['HTTP_HOST'] == 'tolidat.ir') : ?>
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "8dbfb235-b38a-417e-a9ae-4cb02b614b34";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
<?php endif ?>