<script type="text/javascript"
        src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> افزودن آدرس جدید</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم آدرس تولیدی</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl"
                        data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->
        <?php if ($msg != null) {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal"
                            novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Nav tabs -->
                            <!--map-->
                            <div class="col-xs-4 col-sm-4 col-md-4 pull-right mb5">
                                <div data-intro="تیتر شعب" class="contentPro contentPro-address whiteBg roundCorner">
                                    <h3 class="col-md-12 pull-right">
                                        <span class="title rtl">مکان مورد نظر را انتخاب نمایید</span>
                                    </h3>
                                    <button class="getLocation"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                    </button>
                                    <div id="company_map" class="company_map" style="height: 300px"></div>
                                    <input type="hidden" name="xvalue" id="xvalue" value="">
                                    <input type="hidden" name="yvalue" id="yvalue" value="">
                                    <input type="hidden" name="action" id="action" value="edit">
                                    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $list['company_id']; ?>">
                                    <input type="hidden" name="company_id" id="company_id" value="<?php echo $list['branch_id']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right margin-right">
                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="add"/>
                                        <input name="company_id" type="hidden" id="company_id"
                                                value="<?= $list['company_id'] ?>"/>
                                        <input name="branch_id" type="hidden" id="branch_id"
                                                value="<?= $list['branch_id'] ?>"/> <i class="fa fa-plus"></i> ثبت
                                    </button>
                                    <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        var $body = $('body');
        $('.getLocation').bind('click', function (e) {
            e.preventDefault();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
//                    // You can set it the plugin
                    $('.company_map').locationpicker({
                        location: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        },
                        onchanged: function (currentLocation, radius, isMarkerDropped) {
                            console.log("lat : " + currentLocation.latitude + " - long : " + currentLocation.longitude);
                        }
                    });
                });

            } else {
                alert("not support location");
            }
        });

        var x, y;
        $('.company_map').locationpicker({
            location: {
                latitude: 35.689389,
                longitude: 51.388686
            },
            radius: 200,
            draggable: true,
            inputBinding: {
                /* latitudeInput: $('#us6-lat'),
                 longitudeInput: $('#us6-lon'),
                 radiusInput: $('#us6-radius'),
                 locationNameInput: $('#us6-address')*/
            },
            markerInCenter: true,
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                x = currentLocation.latitude;
                $('#xvalue').val(x);
                y = currentLocation.longitude;
                $('#yvalue').val(y);

            }
        });
        /*
         $('#msg-success-map').hide();
         $('#msg-danger-map').hide();*/

        //$('.submit-map').on('click', function (e) {
        //e.preventDefault();

        /* $.ajax({
         url: 'RELA_DIR?>admin/?component=company&action=getCompanyPhone',
         type: 'post',
         data: {lat: x, long: y},
         cash: false,
         success: function (data) {
         var response = $.parseJSON(data);

         if (response.result === 1) {
         $.iziToastSuccess(response.msg);
         } else {
         $.iziToastError(response.msg);
         }
         }
         });*/
        // });


    });
</script>












