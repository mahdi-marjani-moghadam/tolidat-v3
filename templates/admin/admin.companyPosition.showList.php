<script type="text/javascript"
        src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script>


<div class="container-branch-tab">
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
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="xvalue" id="xvalue" value="">
                <input type="hidden" name="yvalue" id="yvalue" value="">
                <input type="hidden" name="action"  id="action" value="edit" >
                <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $list['company_id']; ?>">
                <input type="hidden" name="company_id" id="company_id" value="<?php echo $list['branch_id'];?>">

                <button type="submit" class="submit-map btn-block btn btn-success text-ultralight transition">
                    <span>ثبت</span>
                </button>
            </form>
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

